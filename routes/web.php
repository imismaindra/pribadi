<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Project;

Route::get('/', function () {
    $featuredProjects = Project::where('featured', true)
        ->orderBy('sort_order')
        ->get();

    $projects = Project::orderBy('sort_order')->get();

    return view('home', compact('featuredProjects', 'projects'));
});


Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');


Route::post('/admin/login', function (Request $request) {

    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {

        $request->session()->regenerate();

        if (! Auth::user()->is_admin) {
            Auth::logout();

            return back()->withErrors([
                'email' => 'You do not have permission to access the admin area.',
            ]);
        }

        return redirect()->route('admin.dashboard');
    }

    return back()->withErrors([
        'email' => 'The provided credentials are incorrect.',
    ])->onlyInput('email');

})->name('admin.login.submit');

Route::middleware('admin')->prefix('admin')->group(function () {

    // Route::resource('projects', \App\Http\Controllers\Admin\ProjectController::class)
    //     ->except(['show']);

    Route::get('/projects', [\App\Http\Controllers\Admin\ProjectController::class, 'index'])
    ->name('admin.projects.index');

    Route::get('/projects/create', [\App\Http\Controllers\Admin\ProjectController::class, 'create'])
        ->name('admin.projects.create');

    Route::post('/projects', [\App\Http\Controllers\Admin\ProjectController::class, 'store'])
        ->name('admin.projects.store');

    Route::get('/projects/{project}/edit', [\App\Http\Controllers\Admin\ProjectController::class, 'edit'])
        ->name('admin.projects.edit');

    Route::put('/projects/{project}', [\App\Http\Controllers\Admin\ProjectController::class, 'update'])
        ->name('admin.projects.update');

    Route::delete('/projects/{project}', [\App\Http\Controllers\Admin\ProjectController::class, 'destroy'])
        ->name('admin.projects.destroy');

        
    Route::get('/dashboard', function () {
        $totalProjects = Project::count();

        $featuredProjects = Project::where('featured', true)->count();

        return view('admin.dashboard', compact(
            'totalProjects',
            'featuredProjects'
        ));
    })->name('admin.dashboard');


    Route::post('/logout', function (Request $request) {

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');

    })->name('admin.logout');

});