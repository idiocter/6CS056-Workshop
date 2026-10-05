@extends('layouts.app')

@section('title', 'Students')

@section('content')
    <div class="page-header">
        <div>
            <h1>Students</h1>
            <p class="muted">Create and manage training institute students.</p>
        </div>
        <a class="button" href="{{ route('students.create') }}">Create Student</a>
    </div>

    <div class="card table-wrap">
        <table>
            <thead>
                <tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @forelse ($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->phone ?: 'Not provided' }}</td>
                        <td>
                            <div class="actions">
                                <a class="button secondary small" href="{{ route('students.show', $student) }}">View</a>
                                <a class="button secondary small" href="{{ route('students.edit', $student) }}">Edit</a>
                                <form action="{{ route('students.destroy', $student) }}" method="POST" onsubmit="return confirm('Delete this student?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="button danger small" type="submit">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5">No students found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
