@extends('layouts.app')

@section('title', 'Create Student')

@section('content')
    <div class="page-header"><h1>Create Student</h1></div>
    <div class="card">
        <form action="{{ route('students.store') }}" method="POST">
            @csrf
            @include('students._form', ['student' => null])
            <div class="actions" style="margin-top: 1.25rem">
                <button class="button" type="submit">Create Student</button>
                <a class="button secondary" href="{{ route('students.index') }}">Cancel</a>
            </div>
        </form>
    </div>
@endsection
