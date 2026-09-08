<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Project::create([
            'title' => 'Website CMS dan Profile Sekolah',
            'slug' => Str::slug('Website CMS dan Profile Sekolah'),
            'category' => 'Web Development',
            'year' => 2026,
            'description' => 'Website CMS dan profile sekolah yang digunakan untuk mengelola informasi, konten, dan profil sekolah secara terstruktur.',
            'thumbnail' => 'projects/school.jpg',
            'technologies' => [
                'Laravel',
                'MySQL',
                'Tailwind CSS',
                'JavaScript',
            ],
            'github_url' => null,
            'live_url' => null,
            'featured' => true,
            'sort_order' => 1,
        ]);

        Project::create([
            'title' => 'Look at History | Sejarah',
            'slug' => Str::slug('Look at History Sejarah'),
            'category' => 'Media & Publishing',
            'year' => 2026,
            'description' => 'Website media sejarah yang menyajikan artikel dan konten sejarah dalam format editorial yang informatif dan mudah dibaca.',
            'thumbnail' => 'projects/look-at-history.jpg',
            'technologies' => [
                'Laravel',
                'Blade',
                'Tailwind CSS',
                'MySQL',
            ],
            'github_url' => null,
            'live_url' => 'https://lookathistory.web.id',
            'featured' => true,
            'sort_order' => 2,
        ]);

        Project::create([
            'title' => 'Website Manajemen Praktikum Lab RPL Teknik Informatika ITATS',
            'slug' => Str::slug('Website Manajemen Praktikum Lab RPL Teknik Informatika ITATS'),
            'category' => 'Web System',
            'year' => 2026,
            'description' => 'Sistem manajemen praktikum untuk membantu pengelolaan kegiatan praktikum Laboratorium RPL Teknik Informatika ITATS.',
            'thumbnail' => 'projects/lab-rpl.jpg',
            'technologies' => [
                'Laravel',
                'MySQL',
                'Tailwind CSS',
                'JavaScript',
            ],
            'github_url' => null,
            'live_url' => null,
            'featured' => true,
            'sort_order' => 3,
        ]);
    }
}