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
            text-align: left;
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
        <th>WFH</th>
        <th>WA</th>
        <th>LA</th>
        <th>Total No Of NDays</th>
        <th>Total Hours</th>
    </tr>
    @foreach($returnArr as $mainKey => $arr)
        <tr>

                <td>{{$mainKey}}</td>
            @foreach($arr as $arn)
                <td>{{count(array_filter($arn, function($x) { return !empty($x); }))}}</td>
            @endforeach
                <td>DD</td>
                <td>FF</td>

        </tr>
    @endforeach
</table>

</body>
</html>
