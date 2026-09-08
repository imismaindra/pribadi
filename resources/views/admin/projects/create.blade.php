@extends('layouts.admin')

@section('content')

<div class="admin-page">

    <div class="admin-header">

        <div>
            <div class="admin-eyebrow">
                ADMIN / PROJECTS / CREATE
            </div>

            <h1>
                Add Project
            </h1>

            <p class="admin-page-description">
                Add a new project to your portfolio.
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
        action="{{ route('admin.projects.store') }}"
        enctype="multipart/form-data"
        class="admin-form"
    >

        @csrf


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
                            value="{{ old('title') }}"
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
                            value="{{ old('category') }}"
                            placeholder="Web Development"
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
                            value="{{ old('year') }}"
                            min="2000"
                            max="2100"
                            placeholder="2026"
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
                        >{{ old('description') }}</textarea>

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
                            value="{{ old('technologies') }}"
                            placeholder="Laravel, MySQL, Tailwind CSS, JavaScript"
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
                            value="{{ old('github_url') }}"
                            placeholder="https://github.com/..."
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
                            value="{{ old('live_url') }}"
                            placeholder="https://example.com"
                        >

                    </div>

                </div>

            </div>


            <div class="admin-form-side">

                <div class="admin-form-section">

                    <div class="admin-form-label">
                        PROJECT IMAGE
                    </div>

                    <div class="admin-field">

                        <label for="thumbnail">
                            Thumbnail
                        </label>

                        <input
                            type="file"
                            id="thumbnail"
                            name="thumbnail"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        <small>
                            JPG, PNG, or WEBP. Maximum 2MB.
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
                            value="{{ old('sort_order', 0) }}"
                            min="0"
                        >

                    </div>


                    <label class="admin-checkbox">

                        <input
                            type="checkbox"
                            name="featured"
                            value="1"
                            {{ old('featured') ? 'checked' : '' }}
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
                Save Project
            </button>

        </div>

    </form>

</div>

@endsection