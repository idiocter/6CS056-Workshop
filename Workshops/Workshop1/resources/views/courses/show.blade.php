@extends('layouts.app')

@section('title', 'Course Details')

@section('content')
    <div class="page-header">
        <h1>Course Details</h1>
        <div class="actions">
            <a class="button" href="{{ route('courses.edit', $course) }}">Edit Course</a>
            <a class="button secondary" href="{{ route('courses.index') }}">Back to Courses</a>
        </div>
    </div>
    <div class="card">
        <dl class="detail-grid">
            <dt>ID</dt><dd>{{ $course->id }}</dd>
            <dt>Name</dt><dd>{{ $course->name }}</dd>
            <dt>Description</dt><dd>{{ $course->description }}</dd>
            <dt>Duration</dt><dd>{{ $course->duration }} weeks</dd>
            <dt>Fee</dt><dd>£{{ number_format((float) $course->fee, 2) }}</dd>
            <dt>Difficulty</dt><dd><span class="badge">{{ $course->difficulty }}</span></dd>
            <dt>Status</dt><dd>{{ $course->is_active ? 'Active' : 'Inactive' }}</dd>
        </dl>
    </div>
@endsection
