@extends('layouts.app')

@section('title', 'Students')

@section('content')
    <div class="page-header">
        <div>
            <p class="eyebrow">Records</p>
            <h1>Students</h1>
        </div>
        <a href="{{ route('students.create') }}" class="btn">Create student</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col" class="actions-column">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td class="primary-cell">{{ $student->name }}</td>
                        <td><a href="mailto:{{ $student->email }}">{{ $student->email }}</a></td>
                        <td>{{ $student->phone }}</td>
                        <td>
                            <div class="table-actions">
                                <a href="{{ route('students.show', $student) }}" class="btn btn-secondary btn-small">View</a>
                                <a href="{{ route('students.edit', $student) }}" class="btn btn-secondary btn-small">Edit</a>
                                <x-delete-form :action="route('students.destroy', $student)" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty-state">No students found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
