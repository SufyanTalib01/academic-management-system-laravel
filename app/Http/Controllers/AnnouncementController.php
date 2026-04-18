<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.announcement.form');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'type' => 'required'
        ]);

        $announcement = new Announcement();
        $announcement->message = $request->message;
        $announcement->type = $request->type;
        $announcement->save();
        return back()->with('success', 'Announcement Created Successfully');
    }

    public function read()
    {
        $data['announcements'] = Announcement::latest()->get();
        return view('admin.announcement.list', $data);
    }
    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $findUser = Announcement::find($id);
        return view('admin.announcement.edit', compact('findUser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $findUser = Announcement::find($id);

        $request->validate([
            'message' => 'required',
            'type' => 'required'
        ]);

        $findUser->message = $request->message;
        $findUser->type = $request->type;
        $findUser->save();
        return back()->with('success', 'Announcement Updated Successfully');
    }

    public function delete($id)
    {
        $findUser = Announcement::find($id);
        $findUser->delete();
        return redirect()->route('announcement.read')->with('success', 'Announcement Deleted Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        //
    }
}
