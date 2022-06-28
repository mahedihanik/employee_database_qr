<?php

namespace App\Http\Controllers;

use App\Http\Helpers\RoleCheck;
use App\Models\MonthlyAttendence;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $id = RoleCheck::findEmployeeIdByLoggedInUserId(auth()->id());
        $cardData = MonthlyAttendence::where(['ac_no'=>$id])->latest(DB::raw('str_to_date(date, "%d-%M-%Y")'))->first();
        $cardsArr = [];
//        $lastClockIn = $cardData->clock_in;
//        $lastClockOut = $cardData->clock_out;
//        $workingHours = $cardData->att_time;
//        $late = $cardData->late;
        $cardsArr['clock_in'] = $cardData->clock_in;
        $cardsArr['clock_out'] = $cardData->clock_out;
        $cardsArr['working_hours'] = $cardData->att_time;
        $cardsArr['late'] = $cardData->late;




//        echo '<pre>';
//        print_r($cardsArr);die();


        return view('dashboard',compact('cardsArr'));
    }
}
