<?php

namespace App\Http\Controllers\Application;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Student;
use App\Http\Controllers\API\API_StudentController;

class StudentController extends Controller
{
    public function __construct(API_StudentController $studentService) 
    {
        $this->studentService = $studentService;
    }

    public function index()
    {
        $students = $this->studentService->index()->getData();

        return view('students.index', compact('students')); 
    }

    public function show(int $id)
    {
        $student = $this->studentService->show($id)->getData();

        return view('students.show', compact('student'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $this->studentService->store($request);

        return redirect("/students");
    }

    public function update(Request $request, int $id)
    {
        $student = $this->studentService->update($request, $id);

        return redirect("/students");
    }

    public function destroy(int $id)
    {
        $student = $this->studentService->destroy($id);

        return redirect()->route('show_students');
    }

}
