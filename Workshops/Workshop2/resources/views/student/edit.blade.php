@extends('layouts.app')

@section('title', 'Edit Student')

@section('content')
    <div class="page-header compact">
        <div>
            <p class="eyebrow">Students</p>
            <h1>Edit student</h1>
        </div>
    </div>

    <form action="{{ route('students.update', $student) }}" method="POST" class="record-form">
        @csrf
        @method('PUT')
        @include('student._form')

        <div class="form-actions">
            <button type="submit" class="btn">Update student</button>
            <a href="{{ route('students.show', $student) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
