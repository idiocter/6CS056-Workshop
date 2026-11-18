@extends('layouts.app')

@section('title', 'Create Student')

@section('content')
    <div class="page-header compact">
        <div>
            <p class="eyebrow">Students</p>
            <h1>Create student</h1>
        </div>
    </div>

    <form action="{{ route('students.store') }}" method="POST" class="record-form">
        @csrf
        @include('student._form')

        <div class="form-actions">
            <button type="submit" class="btn">Create student</button>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
