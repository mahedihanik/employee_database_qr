<?php

namespace App\Http\Controllers;

use App\Models\MonthlyAttendence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        return view('report.index');
    }
    public function generateEmployeesReport(Request $request)
    {
        $reportStartDate = $request->emp_startDateParam;
        $reportEndDate = $request->emp_endDateParam;

        $dataSetByDateRange = MonthlyAttendence::whereBetween(DB::raw('DATE(date)'), array($reportStartDate, $reportEndDate))->get();


        echo '<pre>';
        print_r($dataSetByDateRange);die();

    }
}
