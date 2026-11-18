@extends('layouts.app')

@section('title', $course->name)

@section('content')
    <div class="page-header">
        <div>
            <p class="eyebrow">Course #{{ $course->id }}</p>
            <h1>{{ $course->name }}</h1>
        </div>
        <div class="header-actions">
            <a href="{{ route('courses.edit', $course) }}" class="btn">Edit course</a>
            <a href="{{ route('courses.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <dl class="detail-list">
        <div class="detail-wide">
            <dt>Description</dt>
            <dd>{{ $course->description ?: 'Not provided' }}</dd>
        </div>
        <div>
            <dt>Duration</dt>
            <dd>{{ $course->duration }} weeks</dd>
        </div>
        <div>
            <dt>Fee</dt>
            <dd>{{ number_format((float) $course->fee, 2) }}</dd>
        </div>
        <div>
            <dt>Difficulty</dt>
            <dd>{{ $course->difficulty }}</dd>
        </div>
        <div>
            <dt>Status</dt>
            <dd>{{ $course->is_active ? 'Active' : 'Inactive' }}</dd>
        </div>
    </dl>
@endsection
