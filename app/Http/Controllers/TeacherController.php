<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        return view('admin.teacher.form');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'mob' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->father_name = $request->father_name;
        $user->mother_name = $request->mother_name;
        $user->dob = $request->dob;
        $user->mob = $request->mob;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'teacher'; // Set the role to 'teacher'
        $user->save();
        // Redirect back with a success message
        return redirect()->route('teacher.create')->with('success', 'Teacher created successfully!');
    }

    public function read()
    {
        $data = User::where('role', 'teacher')->get();
        return view('admin.teacher.teacher_list', compact('data'));
    }

    public function edit($id)
    {
        $teacher = User::findOrFail($id);
        return view('admin.teacher.edit_form', compact('teacher'));
    }

    public function delete($id)
    {
        $teacher = User::findOrFail($id);
        $teacher->delete();
        return redirect()->route('teacher.read')->with('success', 'Teacher deleted successfully!');
    }
}
