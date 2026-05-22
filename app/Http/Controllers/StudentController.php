<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function dashboard()
    {
        $totalUsers    = User::count();
        $totalStudents = Student::count();
        $totalProducts = Product::where('user_id', Auth::id())->count();
        
        $active     = Student::where('status', 'Active')->count();
        $inactive   = Student::where('status', 'Inactive')->count();
        $graduated  = Student::where('status', 'Graduated')->count();

        $byCourse = Student::selectRaw('course, COUNT(*) as count')
            ->groupBy('course')->pluck('count', 'course');

        $byYear = Student::selectRaw('year_level, COUNT(*) as count')
            ->groupBy('year_level')->orderBy('year_level')->pluck('count', 'year_level');

        return view('dashboard', compact('totalUsers', 'totalStudents', 'totalProducts', 'active', 'inactive', 'graduated', 'byCourse', 'byYear'));
    }

    public function index()
    {
        $students = Student::latest()->paginate(10);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|unique:students',
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:students',
            'course'     => 'required|string|max:100',
            'year_level' => 'required|integer|between:1,4',
            'gpa'        => 'required|numeric|between:0,4',
            'status'     => 'required|in:Active,Inactive,Graduated',
        ]);

        Student::create($request->all());
        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'student_id' => 'required|unique:students,student_id,' . $student->id,
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:students,email,' . $student->id,
            'course'     => 'required|string|max:100',
            'year_level' => 'required|integer|between:1,4',
            'gpa'        => 'required|numeric|between:0,4',
            'status'     => 'required|in:Active,Inactive,Graduated',
        ]);

        $student->update($request->all());
        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}
