<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(): View
    {
        return view('student.list', [
            'students' => Student::query()->orderBy('name')->get(),
        ]);
    }

    public function create(): View
    {
        return view('student.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $student = Student::create($request->validate($this->rules()));

        return redirect()
            ->route('students.index')
            ->with('success', "Student {$student->name} created successfully.");
    }

    public function show(Student $student): View
    {
        return view('student.detail', ['student' => $student]);
    }

    public function edit(Student $student): View
    {
        return view('student.edit', ['student' => $student]);
    }

    public function update(Request $request, Student $student): RedirectResponse
    {
        $student->update($request->validate($this->rules($student)));

        return redirect()
            ->route('students.show', $student)
            ->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student): RedirectResponse
    {
        $student->delete();

        return redirect()
            ->route('students.index')
            ->with('success', 'Student deleted successfully.');
    }

    private function rules(?Student $student = null): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('students', 'email')->ignore($student?->id),
            ],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'date_of_birth' => ['nullable', 'date'],
        ];
    }
}
