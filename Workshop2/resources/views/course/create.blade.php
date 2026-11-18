@extends('layouts.app')

@section('title', 'Create Course')

@section('content')
    <div class="page-header compact">
        <div>
            <p class="eyebrow">Courses</p>
            <h1>Create course</h1>
        </div>
    </div>

    <form action="{{ route('courses.store') }}" method="POST" class="record-form">
        @csrf
        @include('course._form')

        <div class="form-actions">
            <button type="submit" class="btn">Create course</button>
            <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
