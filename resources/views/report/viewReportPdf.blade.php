<?php
//echo '<pre>';
//print_r($returnArr);die();
//
//?>

<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 2px solid #dddddd;
            text-align: center;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>
<table>
    <tr>
        <th style="padding: 20px" colspan="11">
            <p style="font-size: large">Attendance Sheet ( {{$reportStartDate.' '.'to'.' '.$reportEndDate }} ) </p>
            @foreach($returnArr as $mainKey => $arr)
            <p>Total Working Days : {{array_sum($returnLeaveDays[$mainKey]['leave_adjustment'])+array_sum($returnArrNDays[$mainKey]['N_Days'])+count(array_filter($returnArr[$mainKey]['weekend_adjustment'], function ($x) {return !empty($x) ?? null;}))+count(array_filter($returnArr[$mainKey]['work_from_home'], function ($x) {return !empty($x) ?? null;}))}}</p>
            @break;
            @endforeach
            <span>Total Executive: {{count($returnArr)}}</span><span>, Office Hour : {{$officeTimeStart->value.' '.'To'.' '.$officeTimeEnd->value}}</span>
        </th>
    </tr>
    <tr>
        <th>SL.NO.</th>
        <th>Name</th>
        <th>Physical Office</th>
        <th>Work From Home</th>
        <th>Weekend Adjustment</th>
        <th>Leave Adjustment</th>
        <th>Total Working Days</th>
        <th>Total Working Hours</th>
        <th>Weekly Average Hours</th>
        <th>Expected Working Hours</th>
        <th>Difference</th>
    </tr>
    @php
        $sl = 1;
    @endphp
    @foreach($returnArr as $mainKey => $arr)
        <tr>
            <td>{{$sl}}</td>
            <td width="100%">{{$mainKey}}</td>
            <td>{{array_sum($returnArrNDays[$mainKey]['N_Days'])}}</td>
            @foreach($arr as $arn)
                <td>{{count(array_filter($arn, function($x) { return !empty($x); }))}}</td>
            @endforeach
            <td>{{array_sum($returnLeaveDays[$mainKey]['leave_adjustment'])}}</td>
            <td>{{array_sum($returnLeaveDays[$mainKey]['leave_adjustment'])+array_sum($returnArrNDays[$mainKey]['N_Days'])+count(array_filter($returnArr[$mainKey]['weekend_adjustment'], function ($x) {return !empty($x) ?? null;}))+count(array_filter($returnArr[$mainKey]['work_from_home'], function ($x) {return !empty($x) ?? null;}))}}</td>
            @php
                $total = $returnWorkingHours[$mainKey]['Total_Working_Hours'];
                $sum = strtotime('00:00:00');
                $sum2=0;
                foreach ($total as $v){
                    $sum1=strtotime($v)-$sum;
                    $sum2 = $sum2+$sum1;
                }
                $sum3=$sum+$sum2;
                echo '<td>'.date("H:i:s",$sum3).'</td>';
                if (array_sum($returnArrNDays[$mainKey]['N_Days'])!= '0'){
                            $time =date("H:i:s",$sum3);
                            $days = (float)array_sum($returnArrNDays[$mainKey]['N_Days']);
                            list($hours, $minutes, $seconds) = explode(":", $time);
                            $minutes += $hours*60;
                            $seconds += $minutes*60;
                            date_default_timezone_set ("UTC");
                            $actualTime_N_Days = date('H:i:s', $seconds/$days);
                    echo '<td>'.$actualTime_N_Days.'</td>';
                }
                else{
                    $dt = new DateTime;
                    $dt->setTime(0, 0);
                    echo '<td>'.$dt->format('H:i:s').'</td>';
                }
                    $dt = new DateTime;
                    $dt->setTime(8, 0);
                echo '<td>'.$expectedWorkingHours->value.'</td>';

                $expectedTime = $dt->format('H:i:s');
                $actualTime = date('H:i:s', $seconds/$days);
                $start_t = new DateTime($actualTime);
                $current_t = new DateTime($expectedTime);
                $difference = $start_t ->diff($current_t );
                $return_time = $difference ->format('%H:%I:%S');
                if ($actualTime > $expectedTime){
                    echo '<td style ="background-color: #b5e7a0">'.$return_time.'</td>';
                }else{
                    echo '<td style ="background-color: coral">'.'-'.$return_time.'</td>';
                }
            @endphp
        </tr>
    @php
        $sl+=1;
    @endphp
    @endforeach
</table>

</body>
</html>
