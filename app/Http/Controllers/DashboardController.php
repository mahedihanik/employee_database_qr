<?php

namespace App\Http\Controllers;

use App\Http\Helpers\RoleCheck;
use App\Models\MonthlyAttendence;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $id = RoleCheck::findEmployeeIdByLoggedInUserId(auth()->id());
        $cardData = MonthlyAttendence::where(['ac_no'=>$id])->latest(DB::raw('str_to_date(date, "%d-%M-%Y")'))->first();
        $cardsArr = [];
        $cardsArr['clock_in'] = $cardData->clock_in ?? null;
        $cardsArr['clock_out'] = $cardData->clock_out ?? null;
        $cardsArr['working_hours'] = $cardData->att_time ?? null;
        $cardsArr['late'] = $cardData->late ?? null;
        $cardsArr['date'] = $cardData->date ?? null;
        return view('dashboard',compact('cardsArr'));
    }

    public function getDashboardBarChartData(): array
    {

        $id = RoleCheck::findEmployeeIdByLoggedInUserId(auth()->id());
        $returnArrBarChartLabelDateData =[];
        $returnArrBarChartLabelWorkingHourData =[];
        $resultSet = MonthlyAttendence::where(['ac_no'=>$id])->whereMonth(DB::raw('str_to_date(date, "%d-%M-%Y")'), date('m'))
            ->whereYear(DB::raw('str_to_date(date, "%d-%M-%Y")'), date('Y'))
            ->get(['date','att_time']);

        foreach ($resultSet as $set){
            $slice = explode(':',$set->att_time);
            $timeToFloat= (float)$slice[0].'.'.$slice[1];
            $returnArrBarChartLabelDateData[] = $set->date;
            $returnArrBarChartLabelWorkingHourData[] = $timeToFloat;

        }
        return [$returnArrBarChartLabelDateData,$returnArrBarChartLabelWorkingHourData];
    }

    public function getDashboardPieChartData(): array
    {

        $id = RoleCheck::findEmployeeIdByLoggedInUserId(auth()->id());

        $resultSet = MonthlyAttendence::where(['ac_no'=>$id])->whereMonth(DB::raw('str_to_date(date, "%d-%M-%Y")'), date('m'))
            ->whereYear(DB::raw('str_to_date(date, "%d-%M-%Y")'), date('Y'))
            ->get(['wfh','weekend_adjustment','leave_adjustment','ndays']);

//        echo '<pre>';
//        print_r($resultSet);die();
        $returnArr =[];

        foreach ($resultSet as $key => $set){
            $returnArr['wfh'][$key] = $set->wfh;
            $returnArr['weekend_adjustment'][$key] = $set->weekend_adjustment;
            $returnArr['leave_adjustment'][$key] = $set->leave_adjustment;
            $returnArr['N_Days'][$key] = $set->ndays;

        }

        $finalArr = [];
        foreach ($returnArr as $item => $arr){
            $finalArr[$item] = count(array_filter($arr, function($x) { return !empty($x); }));
            if ($item == 'N_Days'){
                $finalArr['physical_office'] = array_sum($arr);
            }
        }

        $finalArrLabels =[];
        $finalArrData = [];

        foreach ($finalArr as $fKey => $fItem){
            $finalArrLabels[]=$fKey;
            $finalArrData[]=$fItem;

        }

//                echo '<pre>';
//        print_r($finalArrLabels);
//        echo '<br>';
//        print_r($finalArrData);
//        die();
        return [$finalArrLabels,$finalArrData];
    }
}
