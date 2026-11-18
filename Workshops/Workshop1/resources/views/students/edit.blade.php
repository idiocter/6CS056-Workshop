@extends('layouts.app')

@section('title', 'Edit Student')

@section('content')
    <div class="page-header"><h1>Edit Student</h1></div>
    <div class="card">
        <form action="{{ route('students.update', $student) }}" method="POST">
            @csrf
            @method('PUT')
            @include('students._form', ['student' => $student])
            <div class="actions" style="margin-top: 1.25rem">
                <button class="button" type="submit">Update Student</button>
                <a class="button secondary" href="{{ route('students.show', $student) }}">Cancel</a>
            </div>
        </form>
    </div>
@endsection
