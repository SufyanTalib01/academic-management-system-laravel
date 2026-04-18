<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;
use PhpParser\Builder\Class_;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.class.class');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = new Classes();
        $data->name = $request->name;
        $data->save();

        return redirect()->route('class.create')->with('success', 'Class Added Successfully');
    }

    public function read()
    {
        $data = Classes::get();
        return view('admin.class.class_list', compact('data'));
    }


    public function edit(Request $request, $id)
    {
        $data = Classes::find($id);

        return view('admin.class.class_edit', compact('data'));
    }

    public function update(Request $request, $id)
    {

        $findUser = Classes::find($id);

        $request->validate([
            'name' => 'required',
        ]);

        $findUser->name = $request->name;
        $findUser->save();

        return redirect()->route('class.read')->with('success', 'Class Edit Successfully');
    }

    public function delete($id)
    {
        $findUser = Classes::find($id);

        $findUser->delete();

        return redirect()->route('class.read')->with('success', 'Delete Successfully');
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
    public function show(Classes $classes)
    {
        //
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classes $classes)
    {
        //
    }
}
