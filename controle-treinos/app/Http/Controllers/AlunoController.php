<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentController extends Controller
{
    public function index()
    {
        return view('students.index');
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        //$student = Student::create([ 'name' => $request->name ]);
        
        return response()->json($request);
    }

    public function destroy()
    {

    }

    public function api() 
    {
        $students = Student::all();
        return response()->json($students);
    }
}
