@extends('layouts.admin')

@section('content')

<div class="admin-page">

    <div class="admin-header">

        <div>
            <div class="admin-eyebrow">
                ADMIN / PROJECTS / EDIT
            </div>

            <h1>
                Edit Project
            </h1>

            <p class="admin-page-description">
                Update project information and portfolio settings.
            </p>
        </div>

        <a
            href="{{ route('admin.projects.index') }}"
            class="admin-button admin-button-secondary"
        >
            ← Back
        </a>

    </div>


    @if ($errors->any())
        <div class="admin-alert admin-alert-error">

            <strong>Please fix the following:</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif


    <form
        method="POST"
        action="{{ route('admin.projects.update', $project) }}"
        enctype="multipart/form-data"
        class="admin-form"
    >

        @csrf
        @method('PUT')


        <div class="admin-form-grid">

            <div class="admin-form-main">

                <div class="admin-form-section">

                    <div class="admin-form-label">
                        BASIC INFORMATION
                    </div>


                    <div class="admin-field">

                        <label for="title">
                            Project Title
                        </label>

                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title', $project->title) }}"
                            required
                        >

                    </div>


                    <div class="admin-field">

                        <label for="category">
                            Category
                        </label>

                        <input
                            type="text"
                            id="category"
                            name="category"
                            value="{{ old('category', $project->category) }}"
                            required
                        >

                    </div>


                    <div class="admin-field">

                        <label for="year">
                            Year
                        </label>

                        <input
                            type="number"
                            id="year"
                            name="year"
                            value="{{ old('year', $project->year) }}"
                            min="2000"
                            max="2100"
                        >

                    </div>


                    <div class="admin-field">

                        <label for="description">
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="7"
                            required
                        >{{ old('description', $project->description) }}</textarea>

                    </div>

                </div>


                <div class="admin-form-section">

                    <div class="admin-form-label">
                        TECHNOLOGIES
                    </div>


                    <div class="admin-field">

                        <label for="technologies">
                            Technologies
                        </label>

                        <input
                            type="text"
                            id="technologies"
                            name="technologies"
                            value="{{ old('technologies', implode(', ', $project->technologies ?? [])) }}"
                        >

                        <small>
                            Separate each technology with a comma.
                        </small>

                    </div>

                </div>


                <div class="admin-form-section">

                    <div class="admin-form-label">
                        LINKS
                    </div>


                    <div class="admin-field">

                        <label for="github_url">
                            GitHub URL
                        </label>

                        <input
                            type="url"
                            id="github_url"
                            name="github_url"
                            value="{{ old('github_url', $project->github_url) }}"
                        >

                    </div>


                    <div class="admin-field">

                        <label for="live_url">
                            Live Website URL
                        </label>

                        <input
                            type="url"
                            id="live_url"
                            name="live_url"
                            value="{{ old('live_url', $project->live_url) }}"
                        >

                    </div>

                </div>

            </div>


            <div class="admin-form-side">

                <div class="admin-form-section">

                    <div class="admin-form-label">
                        PROJECT IMAGE
                    </div>


                    @if($project->thumbnail)

                        <div class="admin-current-image">

                            <img
                                src="{{ asset('storage/' . $project->thumbnail) }}"
                                alt="{{ $project->title }}"
                            >

                        </div>

                    @endif


                    <div class="admin-field">

                        <label for="thumbnail">
                            Replace Thumbnail
                        </label>

                        <input
                            type="file"
                            id="thumbnail"
                            name="thumbnail"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        <small>
                            Leave empty to keep the current image. Max 10MB, auto-compressed.
                        </small>

                    </div>

                </div>


                <div class="admin-form-section">

                    <div class="admin-form-label">
                        DISPLAY
                    </div>


                    <div class="admin-field">

                        <label for="sort_order">
                            Sort Order
                        </label>

                        <input
                            type="number"
                            id="sort_order"
                            name="sort_order"
                            value="{{ old('sort_order', $project->sort_order) }}"
                            min="0"
                        >

                    </div>


                    <label class="admin-checkbox">

                        <input
                            type="checkbox"
                            name="featured"
                            value="1"
                            {{ old('featured', $project->featured) ? 'checked' : '' }}
                        >

                        <span>
                            Featured project
                        </span>

                    </label>

                </div>

            </div>

        </div>


        <div class="admin-form-actions">

            <a
                href="{{ route('admin.projects.index') }}"
                class="admin-button admin-button-secondary"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="admin-button admin-button-primary"
            >
                Update Project
            </button>

        </div>

    </form>

</div>

@endsection