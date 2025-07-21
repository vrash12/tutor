<?php

// app/Http/Controllers/Student/StudentController.php
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    // List children for current parent
    public function index()
    {
        $parent   = Auth::user();
        $students = $parent->students;

        return view('student.index', compact('students'));
    }

    // Show form to add a new child
    public function create()
    {
        return view('student.create');
    }

    // Store new child record
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:100',
            'date_of_birth'  => 'required|date',
        ]);

        $data['parent_id'] = Auth::id();
        Student::create($data);

        return redirect()->route('student.index')->with('status', 'Student added.');
    }

    // Show form to edit a child
    public function edit($id)
    {
        $student = Auth::user()->students()->findOrFail($id);
        return view('student.edit', compact('student'));
    }

    // Update child record
    public function update(Request $request, $id)
    {
        $student = Auth::user()->students()->findOrFail($id);
        $data    = $request->validate([
            'name'           => 'required|string|max:100',
            'date_of_birth'  => 'required|date',
        ]);

        $student->update($data);
        return redirect()->route('student.index')->with('status', 'Student updated.');
    }

    // Remove a child record
    public function destroy($id)
    {
        $student = Auth::user()->students()->findOrFail($id);
        $student->delete();

        return redirect()->route('student.index')->with('status', 'Student removed.');
    }
}
