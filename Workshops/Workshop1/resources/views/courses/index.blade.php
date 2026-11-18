@extends('layouts.app')

@section('title', 'Courses')

@section('content')
    <div class="page-header">
        <div>
            <h1>Courses</h1>
            <p class="muted">Create and manage training institute courses.</p>
        </div>
        <a class="button" href="{{ route('courses.create') }}">Create Course</a>
    </div>

    <div class="card table-wrap">
        <table>
            <thead>
                <tr><th>ID</th><th>Name</th><th>Duration</th><th>Fee</th><th>Difficulty</th><th>Status</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @forelse ($courses as $course)
                    <tr>
                        <td>{{ $course->id }}</td>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->duration }} weeks</td>
                        <td>£{{ number_format((float) $course->fee, 2) }}</td>
                        <td><span class="badge">{{ $course->difficulty }}</span></td>
                        <td>{{ $course->is_active ? 'Active' : 'Inactive' }}</td>
                        <td>
                            <div class="actions">
                                <a class="button secondary small" href="{{ route('courses.show', $course) }}">View</a>
                                <a class="button secondary small" href="{{ route('courses.edit', $course) }}">Edit</a>
                                <form action="{{ route('courses.destroy', $course) }}" method="POST" onsubmit="return confirm('Delete this course?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="button danger small" type="submit">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7">No courses found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
