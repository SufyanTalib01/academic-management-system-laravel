<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Classes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Builder\Class_;

class StudentController extends Controller
{
    public function index()
    {
        $data['classes'] = Classes::all();
        $data['academic_years'] = AcademicYear::all();

        return view('admin.student.student', $data);
    }

    function store(Request $request)
    {
        $request->validate([
            'academic_year_id' => 'required',
            'class_id' => 'required',
            'admission_date' => 'required',
            'name' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'dob' => 'required',
            'mob' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = new User();

        $user->academic_year_id = $request->academic_year_id;
        $user->class_id = $request->class_id;
        $user->admission_date = $request->admission_date;
        $user->name = $request->name;
        $user->father_name = $request->father_name;
        $user->mother_name = $request->mother_name;
        $user->dob = $request->dob;
        $user->mob = $request->mob;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'student';
        $user->save();

        return redirect()->route('student.create')->with('success', 'Student Added Successfully');
    }

    public function read()
    {
        $data = User::query()->with('classModel', 'academicYear')->where('role', 'student')->latest()->get();

        return view('admin.student.student_list', compact('data'));
    }

    // laravel controller store function with name email password validation and json response
    public function edit($id)
    {
        $data['student'] = User::find($id);
        $data['academic_years'] = AcademicYear::all();
        $data['classes'] = Classes::all();

        return view('admin.student.edit_student', $data);
    }

    // update function 
    public function update(Request $request, $id)
    {
        $request->validate([
            'academic_year_id' => 'required',
            'class_id' => 'required',
            'admission_date' => 'required',
            'name' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'dob' => 'required',
            'mob' => 'required',
            'email' => 'required',
        ]);

        $user = User::find($id);
        $user->academic_year_id = $request->academic_year_id;
        $user->class_id = $request->class_id;
        $user->admission_date = $request->admission_date;
        $user->name = $request->name;
        $user->father_name = $request->father_name;
        $user->mother_name = $request->mother_name;
        $user->dob = $request->dob;
        $user->mob = $request->mob;
        $user->email = $request->email;
        if ($user->password) {
            $user->password = Hash::make($request->password);
        }
        $user->role = 'student';
        $user->save();

        return redirect()->route('student.read')->with('success', 'Student Updated Successfully');
    }

    public function delete($id)
    {
        $findUser = User::find($id);
        $findUser->delete();
        return redirect()->route('student.read')->with('success', 'Student Deleted Successfully');
    }
}
