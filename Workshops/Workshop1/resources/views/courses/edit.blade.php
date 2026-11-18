@extends('layouts.app')

@section('title', 'Edit Course')

@section('content')
    <div class="page-header"><h1>Edit Course</h1></div>
    <div class="card">
        <form action="{{ route('courses.update', $course) }}" method="POST">
            @csrf
            @method('PUT')
            @include('courses._form', ['course' => $course])
            <div class="actions" style="margin-top: 1.25rem">
                <button class="button" type="submit">Update Course</button>
                <a class="button secondary" href="{{ route('courses.show', $course) }}">Cancel</a>
            </div>
        </form>
    </div>
@endsection
