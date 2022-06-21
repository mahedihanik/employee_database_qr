<?php
//echo '<pre>'
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

<h2>HTML Table</h2>

<table>
    <tr>
        <th>Name</th>
        <th>Physical Office</th>
        <th>Work From Home</th>
        <th>Weekend Adjustment</th>
        <th>Leave Adjustment</th>
        <th>Total Working Days</th>
        <th>Total Working Hours</th>
        <th>Weekly Average Hours</th>
        <th>Expected Working Hours</th>
{{--        <th>Difference</th>--}}
    </tr>
    @foreach($returnArr as $mainKey => $arr)
        <tr>
            <td>{{$mainKey}}</td>
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
                    echo '<td>'.date('H:i:s', $seconds/$days).'</td>';
                }
                else{
                    $dt = new DateTime;
                    $dt->setTime(0, 0);
                    echo '<td>'.$dt->format('H:i:s').'</td>';
                }
                    $dt = new DateTime;
                    $dt->setTime(8, 0);
                echo '<td>'.$dt->format('H:i:s').'</td>';

                //$expectedTime = $dt->format('H:i:s');
               // $actualTime = date('H:i:s', $seconds/$days);


               // echo $expectedTime.' '.$actualTime;die();



                    //echo '<td>'.date('H:i:s', $interval).'</td>';
            @endphp





        </tr>
    @endforeach
</table>

</body>
</html>
