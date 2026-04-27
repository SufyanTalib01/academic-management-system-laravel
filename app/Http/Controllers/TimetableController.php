<?php

namespace App\Http\Controllers;

use App\Models\AssignSubjectToClass;
use App\Models\Classes;
use App\Models\Day;
use App\Models\Subject;
use App\Models\Timetable;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['days'] = Day::all();
        $data['classes'] = Classes::all();
        $data['subjects'] = Subject::all();
        return view('admin.timetable.create', $data);
    }

    public function FindSubject(Request $request)
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
            'class_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);


        $class_id = $request->class_id;
        $subject_id = $request->subject_id;

        $saved = false;

        foreach ($request->timetable as $timetable) {
            $day_id = $timetable['day_id'];
            $start_time = $timetable['start_time'];
            $end_time = $timetable['end_time'];
            $room_no = $timetable['room_no'];

            if ($start_time != null && $end_time != null && $room_no != null) {
                Timetable::updateOrCreate(
                    [
                        'class_id' => $class_id,
                        'subject_id' => $subject_id,
                        'day_id' => $day_id
                    ],
                    [
                        'class_id' => $class_id,
                        'subject_id' => $subject_id,
                        'day_id' => $day_id,
                        'start_time' => $start_time,
                        'end_time' => $end_time,
                        'room_no' => $room_no
                    ]
                );
                $saved = true;
            }
        }

        if ($saved) {
            return redirect()->route('time-table.create')->with('success', 'Time Table created successfully.');
        } else {
            return redirect()->route('time-table.create')->with('error', 'Failed to create Time Table.');
        }
    }

    public function read(Request $request)
    {
        $classes = Classes::all();
        $subjects = Subject::all();
        $timetables = Timetable::with('class', 'subject', 'day')->latest();

        if ($request->has('class_id')) {
            $timetables->where('class_id', $request->class_id);
            $subjects = AssignSubjectToClass::with('subject')->where('class_id', $request->class_id)->get();
        }

        if ($request->has('subject_id')) {
            $timetables->where('subject_id', $request->subject_id);
        }

        $timetables = $timetables->get();
        return view('admin.timetable.table', compact('timetables', 'classes', 'subjects'));
    }



    public function delete($id)
    {
        $timetable = Timetable::findOrFail($id);
        $timetable->delete();
        return redirect()->route('time-table.read')->with('success', 'Time Table deleted successfully.');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * Display the specified resource.
     */
    public function show(Timetable $timetable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Timetable $timetable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Timetable $timetable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Timetable $timetable)
    {
        //
    }
}
