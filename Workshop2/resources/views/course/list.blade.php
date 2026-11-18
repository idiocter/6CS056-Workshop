@extends('layouts.app')

@section('title', 'Courses')

@section('content')
    <div class="page-header">
        <div>
            <p class="eyebrow">Catalogue</p>
            <h1>Courses</h1>
        </div>
        <a href="{{ route('courses.create') }}" class="btn">Create course</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Fee</th>
                    <th scope="col">Difficulty</th>
                    <th scope="col">Status</th>
                    <th scope="col" class="actions-column">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($courses as $course)
                    <tr>
                        <td>{{ $course->id }}</td>
                        <td class="primary-cell">{{ $course->name }}</td>
                        <td>{{ $course->duration }} weeks</td>
                        <td>{{ number_format((float) $course->fee, 2) }}</td>
                        <td>{{ $course->difficulty }}</td>
                        <td>
                            <span class="status {{ $course->is_active ? 'status-active' : 'status-inactive' }}">
                                {{ $course->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div class="table-actions">
                                <a href="{{ route('courses.show', $course) }}" class="btn btn-secondary btn-small">View</a>
                                <a href="{{ route('courses.edit', $course) }}" class="btn btn-secondary btn-small">Edit</a>
                                <x-delete-form :action="route('courses.destroy', $course)" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="empty-state">No courses found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
