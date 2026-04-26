<?php

namespace App\Http\Controllers;

use App\Models\AssignTeacherToClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    // Teacher Login View
    public function teacherLogin()
    {
        return view('teacher.login');
    }

    // Teacher Login Authentication
    public function teacherAuthenticate(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        Auth::logout();

        if (auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'teacher',
        ])) {
            return redirect()->route('teacher.dashboard');
        }
        return back()->with('error', 'Invalid Login Details');
    }

    // Teacher Dashboard
    public function teacherDashboard()
    {
        return view('teacher.dashboard');
    }

    // Teacher Logout
    public function teacherLogout()
    {
        auth()->logout();
        return redirect()->route('teacher.login')->with('success', 'Logout Successfully');
    }

    // Change Password View
    public function changePassword()
    {
        return view('teacher.change_password');
    }

    // Update Password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'password_confirmation' => 'required|same:new_password',
        ]);

        $user = User::find(auth()->user()->id);

        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return back()->with('success', 'Password Updated Successfully');
        } else {
            return back()->with('error', 'Invalid Old Password');
        }
    }

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
        return view('admin.teacher.edit', compact('teacher'));
    }

    public function update(Request $request, $id)
    {
        // Find the teacher by ID
        $teacher = User::findOrFail($id);

        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'mob' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
        ]);

        // Update the teacher data
        $teacher->name = $request->name;
        $teacher->father_name = $request->father_name;
        $teacher->mother_name = $request->mother_name;
        $teacher->dob = $request->dob;
        $teacher->mob = $request->mob;
        $teacher->email = $request->email;

        // Only update password if provided
        if ($request->filled('password')) {
            $teacher->password = Hash::make($request->password);
        }

        $teacher->save();

        // Redirect back with a success message
        return redirect()->route('teacher.read')->with('success', 'Teacher updated successfully!');
    }

    public function delete($id)
    {
        $teacher = User::findOrFail($id);
        $teacher->delete();
        return redirect()->route('teacher.read')->with('success', 'Teacher deleted successfully!');
    }

    public function myClasses()
    {
        $teacher_id = auth()->user()->id;
        $assignTeacher = AssignTeacherToClass::where('teacher_id', $teacher_id)->with('class', 'subject')->get();
        return view('teacher.my_classes', compact('assignTeacher'));
    }
}
