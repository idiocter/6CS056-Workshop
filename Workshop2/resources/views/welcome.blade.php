@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <section class="hero">
        <p class="eyebrow">Workshop 2</p>
        <h1>Training Institute Management System</h1>
        <p>Manage student records and course information from one place.</p>
    </section>

    <div class="home-grid">
        <a href="{{ route('students.index') }}" class="home-card">
            <span class="home-card-label">Students</span>
            <span>View and maintain student records.</span>
        </a>
        <a href="{{ route('courses.index') }}" class="home-card">
            <span class="home-card-label">Courses</span>
            <span>View and maintain the course catalogue.</span>
        </a>
    </div>
@endsection
