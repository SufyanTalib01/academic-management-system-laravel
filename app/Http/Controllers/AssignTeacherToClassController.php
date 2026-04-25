<?php

namespace App\Http\Controllers;

use App\Models\AssignSubjectToClass;
use App\Models\AssignTeacherToClass;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class AssignTeacherToClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['classes'] = Classes::all();
        $data['subjects'] = Subject::all();
        $data['teachers'] = User::where('role', 'teacher')->get();
        return view('admin.assign_teacher.form', $data);
    }


    public function findSubject(Request $request)
    {
        $class_id = $request->class_id;
        $subjects = AssignSubjectToClass::with('subject')->where('class_id', $class_id)->get();
        return response()->json([
            'status' => true,
            'subjects' => $subjects
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required',
            'class_id' => 'required',
            'subject_id' => 'required',
        ]);

        AssignTeacherToClass::updateOrCreate(
            [
                'class_id' => $request->class_id,
                'subject_id' => $request->subject_id,
            ],
            [
                'class_id' => $request->class_id,
                'subject_id' => $request->subject_id,
                'teacher_id' => $request->teacher_id,
            ]
        );
        return redirect()->back()->with('success', 'Teacher assigned to class successfully.');
    }

    function read()
    {
        $data = AssignTeacherToClass::with('teacher', 'class', 'subject')->latest();
        $classes = Classes::all();
        if (filled(request()->class_id)) {
            $data->where('class_id', request()->class_id);
        }
        $data = $data->get();
        return view('admin.assign_teacher.table', compact('data', 'classes'));
    }

    function edit($id)
    {
        $data['classes'] = Classes::all();
        $data['subjects'] = Subject::all();
        $data['teachers'] = User::where('role', 'teacher')->get();
        $res = AssignTeacherToClass::findOrFail($id);
        $data['assignTeacherToClass'] = $res;
        $data['subjects'] = AssignSubjectToClass::with('subject')->where('class_id', $res->class_id)->get();
        return view('admin.assign_teacher.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'teacher_id' => 'required',
            'class_id' => 'required',
            'subject_id' => 'required',
        ]);

        $alreadyExists = AssignTeacherToClass::where('class_id', $request->class_id)
            ->where('subject_id', $request->subject_id)
            ->where('id', '!=', $id)
            ->exists();
        if ($alreadyExists) {
            return redirect()->back()->with('error', 'This subject is already assigned to another teacher for the selected class.');
        }

        $user = AssignTeacherToClass::findOrFail($id);
        $user->teacher_id = $request->teacher_id;
        $user->class_id = $request->class_id;
        $user->subject_id = $request->subject_id;
        $user->save();

        return redirect()->route('assign-teacher.read')->with('success', 'Teacher assigned to class updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssignTeacherToClass $assignTeacherToClass)
    {
        //
    }
}
