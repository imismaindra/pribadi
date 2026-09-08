@extends('layouts.admin')

@section('content')

<div class="admin-page">

    <div class="admin-header">

        <div>
            <div class="admin-eyebrow">
                ADMIN / DASHBOARD
            </div>

            <h1>
                Welcome, {{ auth()->user()->name }}
            </h1>
        </div>

        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf

            <button
                type="submit"
                class="admin-button admin-button-secondary"
            >
                Logout
            </button>
        </form>

    </div>


    <div class="admin-stats">

        <div class="admin-card">

            <div class="admin-label">
                TOTAL PROJECTS
            </div>

            <div class="admin-stat">
                {{ $totalProjects }}
            </div>

        </div>


        <div class="admin-card">

            <div class="admin-label">
                FEATURED
            </div>

            <div class="admin-stat">
                {{ $featuredProjects }}
            </div>

        </div>


        <div class="admin-card">

            <div class="admin-label">
                STATUS
            </div>

            <div class="admin-stat">
                ONLINE
            </div>

        </div>

    </div>


    <div class="admin-card admin-project-management">

        <div>

            <h2>
                Project Management
            </h2>

            <p>
                Manage projects displayed on your portfolio.
            </p>

        </div>

        <a
            href="{{ route('admin.projects.index') }}"
            class="admin-button admin-button-primary"
        >
            Manage Projects →
        </a>

    </div>

</div>

@endsection