<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use DateTime;
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

    public function weekendAttendanceAdjustment(Request $request)
    {
        $dateSlice = explode('-',$request->entry_date);
        $monthNum  = $dateSlice[1];
        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
        $monthName = $dateObj->format('M');
        $finalDateFormat = $dateSlice[2].'-'.$monthName.'-'.$dateSlice[0];
        $flag = MonthlyAttendence::where(['ac_no'=>$request->weekend_acc_no,'date'=>$finalDateFormat])->first()->update(['weekend_adjustment_date'=>$request->weekend_adj_date_new,'weekend_adjustment'=> 1]);
        if ($flag == 1){
            return true;
        }else{
            return false;
        }
    }
    public function leaveDayAdjustment(Request $request)
    {

        $dateSlice = explode('-',$request->entry_date_param);
        $monthNum  = $dateSlice[1];
        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
        $monthName = $dateObj->format('M');
        $finalDateFormat = $dateSlice[2].'-'.$monthName.'-'.$dateSlice[0];
        ($request->leaveDaySplitAdj_param == 'fullDay') ? $leaveCount = 1 : $leaveCount = 0.5;
        $flag = MonthlyAttendence::where(['ac_no'=>$request->weekend_leave_adjust_employee_acc_no_param,'date'=>$finalDateFormat])->first()->update(['leave_adjustment'=>$leaveCount]);
        if ($flag == 1){
            return true;
        }else{
            return false;
        }
    }
    public function attendanceAdjustmentUpdate(Request $request)
    {
//        echo '<pre>';
//        print_r($request->date);die();
        $dateSlice = explode('-',$request->date);
        $monthNum  = $dateSlice[1];
        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
        $monthName = $dateObj->format('M');
        $finalDateFormat = $dateSlice[2].'-'.$monthName.'-'.$dateSlice[0];
        $flag = MonthlyAttendence::where(['ac_no'=>$request->account_no,'date'=>$finalDateFormat])->first()->update(['clock_in'=>$request->clock_in,'clock_out'=>$request->clock_out,'absent'=>($request->absent == "Yes")? 0 : 1,'weekend_adjustment'=> ($request->weekAdj == "Yes" )? 1 : 0,'wfh'=> ($request->wfh == "Yes" )? 1 : 0,'leave_adjustment'=> ($request->leaveAdj == "Yes" )? 1 : 0]);
        return redirect()->route("monthly_attendence.index");

    }
    public function attendanceAdjustmentTabInitial()
    {
        $todayDate = date('Y-m-d');
        $empNameList = Employee::select('name')->where(['active'=> 1, 'primary_account' => 1])->get()->toArray();
        $empNameFinalList = [];
        foreach ($empNameList as $empName){
            array_push($empNameFinalList,$empName['name']);
        }
        return view('attendence.attendanceAdjustmentTab', compact('empNameFinalList','todayDate'));

    }

    public function getAttendanceAdjustmentTabDataField(Request $request)
    {

        $dateSlice = explode('-',$request->entryDateTabFormParam);
        $monthNum  = $dateSlice[1];
        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
        $monthName = $dateObj->format('M');
        $finalDateFormat = $dateSlice[2].'-'.$monthName.'-'.$dateSlice[0];
        $dataListEmpTab = MonthlyAttendence::where('name', 'like', '%' . $request->employeeNameTabFormParam . '%')->where('date',$finalDateFormat)->first()->toArray();
        return $dataListEmpTab;


    }

}
