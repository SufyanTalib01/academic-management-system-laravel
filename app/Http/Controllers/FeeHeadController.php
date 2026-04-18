<?php

namespace App\Http\Controllers;

use App\Models\FeeHead;
use Illuminate\Http\Request;

class FeeHeadController extends Controller
{
    public function index()
    {
        // return 'OK';
        return view('admin.feehead.fee_head');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = new FeeHead();
        $data->name = $request->name;
        $data->save();

        return redirect()->route('fee-head.create')->with('success', 'Fee Head Added Successfully');
    }

    public function read()
    {
        $data = FeeHead::get();
        return view('admin.feehead.fee_head_list', compact('data'));
    }


    public function edit(Request $request, $id)
    {
        $data = FeeHead::find($id);

        return view('admin.feehead.fee_head_edit', compact('data'));
    }

    public function update(Request $request, $id)
    {

        $findUser = FeeHead::find($id);

        $request->validate([
            'name' => 'required',
        ]);

        $findUser->name = $request->name;
        $findUser->save();

        return redirect()->route('fee-head.read')->with('success', 'Fee Head Edit Successfully');
    }

    public function delete($id)
    {
        $findUser = FeeHead::find($id);

        $findUser->delete();

        return redirect()->route('fee-head.read')->with('success', 'Delete Successfully');
    }
}
