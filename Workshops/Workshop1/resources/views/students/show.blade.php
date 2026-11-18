@extends('layouts.app')

@section('title', 'Student Details')

@section('content')
    <div class="page-header">
        <h1>Student Details</h1>
        <div class="actions">
            <a class="button" href="{{ route('students.edit', $student) }}">Edit Student</a>
            <a class="button secondary" href="{{ route('students.index') }}">Back to Students</a>
        </div>
    </div>
    <div class="card">
        <dl class="detail-grid">
            <dt>ID</dt><dd>{{ $student->id }}</dd>
            <dt>Name</dt><dd>{{ $student->name }}</dd>
            <dt>Email</dt><dd>{{ $student->email }}</dd>
            <dt>Phone</dt><dd>{{ $student->phone ?: 'Not provided' }}</dd>
            <dt>Address</dt><dd>{{ $student->address ?: 'Not provided' }}</dd>
            <dt>Date of Birth</dt><dd>{{ $student->date_of_birth?->format('d M Y') ?? 'Not provided' }}</dd>
        </dl>
    </div>
@endsection
