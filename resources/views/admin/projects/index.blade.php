@extends('layouts.admin')

@section('content')

<div class="admin-page">

    {{-- Header --}}
    <div class="admin-header">

        <div>
            <div class="admin-eyebrow">
                ADMIN / PROJECTS
            </div>

            <h1>
                Manage Projects
            </h1>

            <p class="admin-page-description">
                Manage projects displayed on your portfolio.
            </p>
        </div>

        <a
            href="{{ route('admin.projects.create') }}"
            class="admin-button admin-button-primary"
        >
            + Add Project
        </a>

    </div>


    {{-- Success Message --}}
    @if(session('success'))
        <div class="admin-alert admin-alert-success">
            {{ session('success') }}
        </div>
    @endif


    {{-- Projects --}}
    <div class="admin-project-list">

        @forelse($projects as $project)

            <div class="admin-project-item">

                {{-- Thumbnail --}}
                <div class="admin-project-thumbnail">

                    @if($project->thumbnail)

                        <img
                            src="{{ asset('storage/' . $project->thumbnail) }}"
                            alt="{{ $project->title }}"
                        >

                    @else

                        <div class="admin-no-image">
                            NO IMAGE
                        </div>

                    @endif

                </div>


                {{-- Info --}}
                <div class="admin-project-info">

                    <div class="admin-project-title">

                        <h2>
                            {{ $project->title }}
                        </h2>

                        @if($project->featured)

                            <span class="admin-badge admin-badge-featured">
                                Featured
                            </span>

                        @else

                            <span class="admin-badge">
                                Archive
                            </span>

                        @endif

                    </div>


                    <div class="admin-project-meta">
                        {{ $project->category }}

                        @if($project->year)
                            · {{ $project->year }}
                        @endif
                    </div>


                    <div class="admin-project-tech">
                        {{ implode(' · ', $project->technologies ?? []) }}
                    </div>

                </div>


                {{-- Actions --}}
                <div class="admin-project-actions">

                    <a
                        href="{{ route('admin.projects.edit', $project) }}"
                        class="admin-button admin-button-secondary"
                    >
                        Edit
                    </a>

                    <form
                        method="POST"
                        action="{{ route('admin.projects.destroy', $project) }}"
                        onsubmit="return confirm('Yakin ingin menghapus project ini?')"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="admin-button admin-button-danger"
                        >
                            Delete
                        </button>

                    </form>

                </div>

            </div>

        @empty

            <div class="admin-empty">

                <p>
                    Belum ada project.
                </p>

                <a
                    href="{{ route('admin.projects.create') }}"
                    class="admin-empty-link"
                >
                    Tambahkan project pertama →
                </a>

            </div>

        @endforelse

    </div>

</div>

@endsection