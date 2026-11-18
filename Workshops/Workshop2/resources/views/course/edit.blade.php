@extends('layouts.app')

@section('title', 'Edit Course')

@section('content')
    <div class="page-header compact">
        <div>
            <p class="eyebrow">Courses</p>
            <h1>Edit course</h1>
        </div>
    </div>

    <form action="{{ route('courses.update', $course) }}" method="POST" class="record-form">
        @csrf
        @method('PUT')
        @include('course._form')

        <div class="form-actions">
            <button type="submit" class="btn">Update course</button>
            <a href="{{ route('courses.show', $course) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
