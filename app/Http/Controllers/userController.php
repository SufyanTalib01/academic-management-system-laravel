<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\AssignTeacherToClass;
use App\Models\Timetable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Metadata\Uses;

class userController extends Controller
{
    public function index()
    {
        return view('student.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        Auth::logout();
        Auth::guard('admin')->logout();

        if (auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'student',
        ])) {
            return redirect()->route('student.dashboard');
        }
        return back()->with('error', 'Invalid Login Details');
    }

    public function dashboard()
    {
        $data['announcement'] = Announcement::where('type', 'student')->latest()->limit(1)->get();
        return view('student.dashboard', $data);
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('student.login')->with('success', 'Logout Successfully');
    }

    public function changePassword()
    {
        // return echo "OK";
        return view('student.change_password');
    }

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

    public function mySubjects()
    {
        $class_id = auth()->user()->class_id;
        $data['assigns'] = AssignTeacherToClass::where('class_id', $class_id)->with('subject', 'teacher')->get();
        return view('student.my_subject', $data);
    }

    public function timetable()
    {
        $student_class_id = Auth::user()->class_id;
        $timetable = Timetable::with(['day', 'subject'])->where('class_id', $student_class_id)->latest()->get();
        $group = [];
        foreach ($timetable as $item) {
            $group[$item->day->name][] = [
                'subject' => $item->subject->name,
                'start_time' => $item->start_time,
                'end_time' => $item->end_time,
                'room_no' => $item->room_no
            ];
        }
        $data['group'] = $group;
        return view('student.timetable', $data);
    }
}
