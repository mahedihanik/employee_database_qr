<?php

namespace App\Http\Controllers;

use App\Models\MonthlyAttendence;
use Barryvdh\DomPDF\Facade\Pdf;
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
//                        echo '<pre>';
//                print_r($dataSetByDateRange);
//        die();

        foreach ($dataSetByDateRange as $nameKey => $result) {
            foreach ($result as $key => $val){
                $returnArr[$nameKey]['physical_office'][$key] = ($val['absent'] == '0');
                $returnArr[$nameKey]['work_from_home'][$key] = ($val['wfh'] == 1);
                $returnArr[$nameKey]['weekend_adjustment'][$key] = ($val['weekend_adjustment'] == 1);
                $returnArr[$nameKey]['leave_adjustment'][$key] = ($val['leave_adjustment'] == 1);
                $returnArr[$nameKey]['N_Days'][$key] = $val['ndays'];
                $returnArr[$nameKey]['Total_Working_Hours'][$key] = $val['att_time'] ;
                $returnArr[$nameKey]['remarks'][$key] = isset($val['remarks']) ;
//                echo '<pre>';
//                print_r($val['absent'].$nameKey);
            }

        }

//        foreach ($returnArr as $arr){
////            $total = $arr['Total_Working_Hours'];
////
////            $sum = strtotime('00:00:00');
////            $sum2=0;
////            foreach ($total as $v){
////
////                $sum1=strtotime($v)-$sum;
////
////                $sum2 = $sum2+$sum1;
////            }
////
////            $sum3=$sum+$sum2;
//
//
//
//            echo '<pre>';
//            print_r(date("H:i:s",$sum3));
//
//
//            foreach ($arr as $arn){
//                //echo '<pre>';
//
//                //print_r(count(array_filter($arn, function($x) { return !empty($x); })));
//            }
//        }

        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y')
        ];

        $pdf = PDF::loadView('report.viewReportPdf', $data);
        $path = public_path('reportPdf');
        $fileName =  time().'.'.'pdf' ;
        $pdf->save($path . '/' . $fileName);
        return public_path('reportPdf/'.$fileName);

    }
}
