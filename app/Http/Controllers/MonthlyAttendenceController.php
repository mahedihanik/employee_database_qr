<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MonthlyAttendence;
use App\Models\Attendence;
use Excel;
use App\Imports\MonthlyAttendenceImport;

class MonthlyAttendenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $monthly_attendence = MonthlyAttendence::all();

        return view('attendence.index', compact('monthly_attendence'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('attendence.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function import(Request $request)
    {

        Excel::import(new MonthlyAttendenceImport,$request->file);
        $monthly_attendence = MonthlyAttendence::all();

        // return view('attendence.index', compact('monthly_attendence'));
        return redirect()->route("monthly_attendence.index");


    }

    public function attendanceAdjustment($data)
    {
        //
        //$monthly_attendence = MonthlyAttendence::all();

        return view('attendence.adjustment', compact('data'));
    }
}
