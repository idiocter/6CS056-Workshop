@extends('layouts.app')

@section('title', $student->name)

@section('content')
    <div class="page-header">
        <div>
            <p class="eyebrow">Student #{{ $student->id }}</p>
            <h1>{{ $student->name }}</h1>
        </div>
        <div class="header-actions">
            <a href="{{ route('students.edit', $student) }}" class="btn">Edit student</a>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <dl class="detail-list">
        <div>
            <dt>Email</dt>
            <dd><a href="mailto:{{ $student->email }}">{{ $student->email }}</a></dd>
        </div>
        <div>
            <dt>Phone</dt>
            <dd>{{ $student->phone }}</dd>
        </div>
        <div>
            <dt>Address</dt>
            <dd>{{ $student->address ?: 'Not provided' }}</dd>
        </div>
        <div>
            <dt>Date of birth</dt>
            <dd>{{ $student->date_of_birth?->format('d M Y') ?? 'Not provided' }}</dd>
        </div>
        <div>
            <dt>Age</dt>
            <dd>{{ $student->age ?? 'Not available' }}</dd>
        </div>
    </dl>
@endsection
