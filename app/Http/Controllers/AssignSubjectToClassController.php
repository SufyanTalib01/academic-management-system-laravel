<?php

namespace App\Http\Controllers;

use App\Models\AssignSubjectToClass;
use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Http\Request;

class AssignSubjectToClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['subjects'] = Subject::all();
        $data['classes'] = Classes::all();
        return view('admin.assign_subject.form', $data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'subject_id' => 'required',
        ]);

        $class_id = $request->class_id;
        $subject_ids = $request->subject_id;

        foreach ($subject_ids as $subject_id) {
            AssignSubjectToClass::updateOrCreate(
                [
                    'class_id' => $class_id,
                    'subject_id' => $subject_id,
                ],
                [
                    'class_id' => $class_id,
                    'subject_id' => $subject_id,
                ]
            );
        }
        return redirect()->route('assign-subject.create')->with('success', 'Subjects assigned to class successfully.');
    }

    public function read(Request $request)
    {
        $query = AssignSubjectToClass::query()->with('class', 'subject');
        if (filled(request()->class_id)) {
            $query->where('class_id', request()->class_id);
        }
        $data['assignedSubjects'] = $query->get();
        $data['classes'] = Classes::all();
        return view('admin.assign_subject.list', $data);
    }

    /**
     * Display the specified resource.
     */
    public function show(AssignSubjectToClass $assignSubjectToClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['assignedSubject'] = AssignSubjectToClass::findOrFail($id);
        $data['subjects'] = Subject::all();
        $data['classes'] = Classes::all();
        return view('admin.assign_subject.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'class_id' => 'required',
            'subject_id' => 'required',
        ]);

        $alreadyExist = AssignSubjectToClass::where('class_id', $request->class_id)
            ->where('subject_id', $request->subject_id)
            ->where('id', '!=', $id)
            ->first();

        if ($alreadyExist) {
            return redirect()->back()->with('error', 'This subject is already assigned to the selected class.');
        }

        $assignedSubject = AssignSubjectToClass::findOrFail($id);
        $assignedSubject->class_id = $request->class_id;
        $assignedSubject->subject_id = $request->subject_id;
        $assignedSubject->save();

        return redirect()->route('assign-subject.read')->with('success', 'Assigned subject updated successfully.');
    }

    public function delete($id)
    {
        $assignedSubject = AssignSubjectToClass::findOrFail($id);
        $assignedSubject->delete();
        return redirect()->route('assign-subject.read')->with('success', 'Assigned subject deleted successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssignSubjectToClass $assignSubjectToClass)
    {
        //
    }
}
