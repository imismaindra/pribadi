<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'year' => ['nullable', 'integer', 'min:2000', 'max:2100'],
            'description' => ['required', 'string'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:10240'],
            'technologies' => ['nullable', 'string'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'live_url' => ['nullable', 'url', 'max:255'],
            'featured' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;

        while (Project::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        $thumbnail = null;

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $this->storeOptimizedThumbnail($request->file('thumbnail'));
        }

        Project::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'category' => $validated['category'],
            'year' => $validated['year'] ?? null,
            'description' => $validated['description'],
            'thumbnail' => $thumbnail,
            'technologies' => collect(explode(',', $request->technologies ?? ''))
                ->map(fn ($item) => trim($item))
                ->filter()
                ->values()
                ->all(),
            'github_url' => $validated['github_url'] ?? null,
            'live_url' => $validated['live_url'] ?? null,
            'featured' => $request->boolean('featured'),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project berhasil ditambahkan.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'year' => ['nullable', 'integer', 'min:2000', 'max:2100'],
            'description' => ['required', 'string'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:10240'],
            'technologies' => ['nullable', 'string'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'live_url' => ['nullable', 'url', 'max:255'],
            'featured' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;

        while (
            Project::where('slug', $slug)
                ->where('id', '!=', $project->id)
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $count++;
        }

        if ($request->hasFile('thumbnail')) {

            if (
                $project->thumbnail &&
                Storage::disk('public')->exists($project->thumbnail)
            ) {
                Storage::disk('public')->delete($project->thumbnail);
            }

            $project->thumbnail = $this->storeOptimizedThumbnail($request->file('thumbnail'));
        }

        $project->update([
            'title' => $validated['title'],
            'slug' => $slug,
            'category' => $validated['category'],
            'year' => $validated['year'] ?? null,
            'description' => $validated['description'],
            'technologies' => collect(explode(',', $request->technologies ?? ''))
                ->map(fn ($item) => trim($item))
                ->filter()
                ->values()
                ->all(),
            'github_url' => $validated['github_url'] ?? null,
            'live_url' => $validated['live_url'] ?? null,
            'featured' => $request->boolean('featured'),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        $project->save();

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        if (
            $project->thumbnail &&
            Storage::disk('public')->exists($project->thumbnail)
        ) {
            Storage::disk('public')->delete($project->thumbnail);
        }

        $project->delete();

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project berhasil dihapus.');
    }

    /**
     * Downscale + compress upload via GD so big photos never
     * trip validation or bloat storage. Output WebP (fallback JPEG).
     */
    private function storeOptimizedThumbnail($file): string
    {
        $raw = @file_get_contents($file->getRealPath());
        $src = $raw !== false ? @imagecreatefromstring($raw) : false;

        // ponytail: GD missing/corrupt image → store original, never 500
        if ($src === false) {
            return $file->store('projects', 'public');
        }

        if (function_exists('exif_read_data') && in_array(strtolower($file->getClientOriginalExtension()), ['jpg', 'jpeg'], true)) {
            $exif = @exif_read_data($file->getRealPath());
            $orientation = $exif['Orientation'] ?? 1;
            $src = match ($orientation) {
                3 => imagerotate($src, 180, 0),
                6 => imagerotate($src, -90, 0),
                8 => imagerotate($src, 90, 0),
                default => $src,
            };
        }

        $width = imagesx($src);
        $height = imagesy($src);
        $maxSide = 1600;

        if (max($width, $height) > $maxSide) {
            $scale = $maxSide / max($width, $height);
            $dst = imagecreatetruecolor((int) ($width * $scale), (int) ($height * $scale));
            imagealphablending($dst, false);
            imagesavealpha($dst, true);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, imagesx($dst), imagesy($dst), $width, $height);
            imagedestroy($src);
            $src = $dst;
        }

        $path = 'projects/' . Str::uuid()->toString();

        if (function_exists('imagewebp')) {
            $path .= '.webp';
            imagewebp($src, Storage::disk('public')->path($path), 80);
        } else {
            $path .= '.jpg';
            $bg = imagecreatetruecolor(imagesx($src), imagesy($src));
            imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
            imagecopy($bg, $src, 0, 0, 0, 0, imagesx($src), imagesy($src));
            imagedestroy($src);
            $src = $bg;
            imagejpeg($src, Storage::disk('public')->path($path), 82);
        }

        imagedestroy($src);

        return $path;
    }
}