@extends('layouts.app')

@section('title', 'Create Course')

@section('content')
    <div class="page-header"><h1>Create Course</h1></div>
    <div class="card">
        <form action="{{ route('courses.store') }}" method="POST">
            @csrf
            @include('courses._form', ['course' => null])
            <div class="actions" style="margin-top: 1.25rem">
                <button class="button" type="submit">Create Course</button>
                <a class="button secondary" href="{{ route('courses.index') }}">Cancel</a>
            </div>
        </form>
    </div>
@endsection
