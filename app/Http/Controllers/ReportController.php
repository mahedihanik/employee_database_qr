<?php

namespace App\Http\Controllers;

use App\Exports\ReportExcelExport;
use App\Exports\UserAttendenceExport;
use App\Models\MonthlyAttendence;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {
        return view('report.index');
    }
    public function generateEmployeesReport(Request $request)
    {

//        $total = array('1:00','2:20','4:00','5:10');
//
//        $sum = strtotime('00:00:00');
//        $sum2=0;
//        foreach ($total as $v){
//
//            $sum1=strtotime($v)-$sum;
//
//            $sum2 = $sum2+$sum1;
//        }
//
//        $sum3=$sum+$sum2;
//
//        echo date("H:i:s",$sum3);
        $reportStartDate = $request->emp_startDateParam;
        $reportEndDate = $request->emp_endDateParam;

        $dataSetByDateRange = MonthlyAttendence::where(DB::raw('str_to_date(date, "%d-%M-%Y")'),'>=',$reportStartDate)->where(DB::raw('str_to_date(date, "%d-%M-%Y")'),'<=',$reportEndDate)->get()->groupBy('name')->toArray();
        $returnArr = [];
        $returnArrNDays = [];
        $returnWorkingHours = [];
        $returnLeaveDays = [];
        //$returnRemarks = [];

//                        echo '<pre>';
//                print_r($dataSetByDateRange);
//        die();

        foreach ($dataSetByDateRange as $nameKey => $result) {
            foreach ($result as $key => $val){
                //$returnArr[$nameKey]['physical_office'][$key] = ($val['absent'] == '0');
                $returnArr[$nameKey]['work_from_home'][$key] = ($val['wfh'] == 1);
                $returnArr[$nameKey]['weekend_adjustment'][$key] = ($val['weekend_adjustment'] == 1);
                $returnLeaveDays[$nameKey]['leave_adjustment'][$key] = $val['leave_adjustment'];
                $returnArrNDays[$nameKey]['N_Days'][$key] = $val['ndays'];
                $returnWorkingHours[$nameKey]['Total_Working_Hours'][$key] = $val['att_time'] ;
                //$returnRemarks[$nameKey]['remarks'] = isset($val['remarks']) ;
//                echo '<pre>';
//                print_r($val['absent'].$nameKey);
            }
//                            echo '<pre>';
//                print_r($result);

        }
//        foreach($returnArr as $mainKey => $arr){
//            echo '<pre>';
//            print_r($arr);
//        }
        //die();

//        echo '<pre>';
//        print_r($returnArr);die();

       //foreach ($returnArr as $arr){
//            $total = $arr['Total_Working_Hours'];
//
//            $sum = strtotime('00:00:00');
//            $sum2=0;
//            foreach ($total as $v){
//
//                $sum1=strtotime($v)-$sum;
//
//                $sum2 = $sum2+$sum1;
//            }
//
//            $sum3=$sum+$sum2;
//
//
//
//            echo '<pre>';
//            print_r(date("H:i:s",$sum3));


//            foreach ($arr as $dd => $arn){
//                echo '<pre>';
//
//
//                print_r(count(array_filter($arn, function($x) { return !empty($x); })).$dd);
//            }
           // if ($arr['N_Days'])

                       //echo '<pre>';
            //print_r(array_sum($arr['N_Days']));
//
        //}

//die();

        //echo '<pre>';
       // print_r($returnArr);die();

//        $newArr = [];
//
////        foreach ($arr as $dd => $arn){
////            if (isset($nameKey[$keyNew])) {
////                $nameKey[$keyNew][$dd] = count(array_filter($arn, function ($x) {
////                    return !empty($x);
////                }));
////            }
////        }
//
//        foreach($returnArr as  $keyNew => $arr){
//
////                foreach ($arr as $dd => $arn){
////
//                        $nameKey[$keyNew][$dd] = count(array_filter($arn, function ($x) {return !empty($x) ?? null;}));
////                    }
//            echo '<pre>';
//            print_r($arr);
//
//
//        }
//
////        echo '<pre>';
////        print_r($newArr);
//        die();




        $officeTimeStart = Setting::select(['value'])->where(['settings_key'=>'office_time_start','id'=>3])->first();
        $officeTimeEnd = Setting::select(['value'])->where(['settings_key'=>'office_time_end','id'=>4])->first();
        $expectedWorkingHours = Setting::select(['value'])->where(['settings_key'=>'expected_working_hours','id'=>5])->first();

        if ($request->doc_typeParam == "PDF"){
            $pdf = PDF::loadView('report.viewReportPdf', compact('returnArr','returnArrNDays','returnWorkingHours','returnLeaveDays','reportStartDate','reportEndDate','officeTimeStart','officeTimeEnd','expectedWorkingHours'))->setPaper('a4', 'landscape');
            $path = public_path('reportPdf');
            $fileName =  time().'.'.'pdf' ;
            $pdf->save($path . '/' . $fileName);
            return public_path('reportPdf/'.$fileName);
        }elseif ($request->doc_typeParam == "Excel"){
              $excelFileName = 'Excel_Report'.time().'.'.'xlsx' ;
              Excel::store(new ReportExcelExport($returnArr,$returnArrNDays,$returnWorkingHours,$returnLeaveDays,$reportStartDate,$reportEndDate,$officeTimeStart,$officeTimeEnd,$expectedWorkingHours), 'public/reportExcel/'.$excelFileName);
              echo Storage::url('reportExcel/'.$excelFileName);
        }

    }
}
