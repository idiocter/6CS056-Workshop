<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function showForm()
    {
        return view('student-form');
    }

    public function submitForm(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $age = $request->age;

        Student::create([
            'name' => $name,
            'email' => $email,
            'age' => $age,
        ]);

        return 'Student information saved successfully!';
    }
}
