<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Classes;
use App\Models\FeeHead;
use App\Models\FeeStructure;
use Illuminate\Http\Request;

class FeeStructureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['academy_years'] = AcademicYear::all();
        $data['classes'] = Classes::all();
        $data['fee_heads'] = FeeHead::all();
        return view('admin.fee-structure.fee-structure', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'academic_year_id' => 'required',
            'class_id' => 'required',
            'fee_head_id' => 'required',
        ]);

        FeeStructure::create($request->only([
            'class_id',
            'academic_year_id',
            'fee_head_id',
            'april',
            'may',
            'june',
            'july',
            'august',
            'september',
            'october',
            'november',
            'december',
            'january',
            'february',
            'march',
        ]));

        return redirect()->route('fee-structure.create')->with('success', 'Fee Structure Added Successfully');
    }

    function read(Request $request)
    {

        $feeStructure = FeeStructure::query()->with(['feeHead', 'classModel', 'academicYear'])->latest();

        if ($request->filled('class_id')) {
            $feeStructure->where('class_id', $request->class_id);
        }
        if ($request->filled('academic_year_id')) {
            $feeStructure->where('academic_year_id', $request->academic_year_id);
        }

        $data = $feeStructure->get();
        $academy_years = AcademicYear::all();
        $classes = Classes::all();
        $fee_heads = FeeHead::all();
        return view('admin.fee-structure.fee-structure_list', compact('data', 'academy_years', 'classes', 'fee_heads'));
    }

    public function delete($id)
    {
        $findId = FeeStructure::find($id);
        $findId->delete();

        return redirect()->route('fee-structure.read')->with('success', 'Deleted Successfully');
    }


    public function edit($id)

    {
        $data['fee'] = FeeStructure::find($id);
        $data['academy_years'] = AcademicYear::all();
        $data['classes'] = Classes::all();
        $data['fee_heads'] = FeeHead::all();

        return view('admin.fee-structure.fee-structure_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $find = FeeStructure::find($id);

        $request->validate([
            'academic_year_id' => 'required',
            'class_id' => 'required',
            'fee_head_id' => 'required',
        ]);

        $find->update($request->only([
            'class_id',
            'academic_year_id',
            'fee_head_id',
            'april',
            'may',
            'june',
            'july',
            'august',
            'september',
            'october',
            'november',
            'december',
            'january',
            'february',
            'march',
        ]));

        return redirect()->route('fee-structure.read')->with('success', 'Updated Successfully');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FeeStructure $feeStructure)
    {
        //
    }
}
