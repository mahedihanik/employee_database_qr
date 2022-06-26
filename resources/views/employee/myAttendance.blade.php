<x-app-layout>
    <x-slot name="header">

        <div class="row">
            <div class="col-md-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('My Attendance') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <section>
                    <hr>
                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="marig" style="padding-bottom: 17px;">
                                <h1 style="font-weight:700;">Attendence Details</h1>
                            </div>

                            <div class="container pd_right" style="" >
                                <a href='/exportpdf/{{$employee->id}}' class="btn btn-success" style="float:right;margin-left: 7px;">Export to PDF</a>
                            </div>

                            <div class="container" style="top: 50px;"  >
                                <a href='/exportexcel/{{$employee->id}}' class="btn btn-success" style="float:right;">Export to Excel</a>
                            </div>


                            <!-- <div class="col-md-6">
       <div class ="flex1" >

        <form action="{{route('employee.show',[$employee->id])}}" method="get"  style="display:flex;">
            <select name="year" id="year" class="form-control " style="width: 130px; margin-right: 10px;" required>
                <option value="">Select Year</option>
                @for($i=2020;$i<=2030;$i++)
                                @if(request()->has('year'))
                                    <option value="{{$i}}" @if(request()->year == $i) selected @endif>{{$i}}</option>
                    @else
                                    <option value="{{$i}}">{{$i}}</option>
                    @endif
                            @endfor
                            </select>
@php
                                $monthArray = ['Jan','Feb','Mar',"Apr",'May',"Jun",'Jul',"Aug","Sep","Oct","Nov","Dec"];
                            @endphp
                                <select name="month" id="month" class="form-control " style="width: 138px; margin-right: 10px;" required>

                                  <option value="">Select Month</option>
@foreach($monthArray as $i)
                                @if(request()->has('month'))
                                    <option value="{{$i}}" @if(request()->month == $i) selected @endif>{{$i}}</option>
                    @else
                                    <option value="{{$i}}">{{$i}}</option>
                    @endif
                            @endforeach
                            </select>
                            <button type="submit" class="btn btn-info btn-sm">Search</button>
                        </form>

                       </div>

                </div> -->
                            <!-- <form action="{{route('employee.show',[$employee->id])}}" method="get"  style="display:flex;">
         <label for="bday-month"></label>
         <input id="bday-month" type="month" name="bday-month">

    </form> -->
                            <form >
                                <div>
                                    <label for="month"></label>
                                    @if(!is_null($month))
                                        <input id="month" type="month" name="month" required value="{{$month}}">
                                    @else
                                        <input id="month" type="month" name="month" required value="">
                                    @endif
                                    <span class="validity"></span>



                                    <button type="submit" class="btn btn-info">
                                        <i class="fa fa-search"></i> Search
                                    </button>



                                </div>

                            </form>


                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                                <div class="p-6 bg-white border-b border-gray-200">

                                    <table class="table table-striped" id="attendence-table" style="width:100%">
                                        <thead>

                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Clock In</th>
                                            <th scope="col">Clock Out</th>
                                            <th scope="col">Late In</th>
                                            <th scope="col">Early Out</th>
                                            <th scope="col">Absent</th>
                                            <th scope="col">Work_Time</th>
                                            <th scope="col">NDays</th>
                                            <th scope="col">ATT_Time</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $i=1;
                                        @endphp
                                        @foreach ($monthly_attendence as $item)
                                            <tr>
                                                <td width="20%">{{ $item->date }}</td>
                                                <td>{{ $item->clock_in }}</td>
                                                <td>{{ $item->clock_out}}</td>

                                                <?php
                                                $temp1=$item->late;
                                                $timeArray = explode(":",$temp1);
                                                $totalMin = ($timeArray[0]*60 + $timeArray[1]);
                                                $workDuration = 480; //in miniute


                                                if($totalMin < $workDuration && $totalMin >=$max_late_min)
                                                {
                                                    echo '<td style="background-color:#EDFC02">',$item->late,'</td>';

                                                }
                                                else
                                                {
                                                    echo '<td>',$item->late,'</td>';
                                                }
                                                ?>

                                                <?php
                                                $temp2=$item->early;
                                                $timeArray = explode(":",$temp2);
                                                $totalMin = ($timeArray[0]*60 + $timeArray[1]);
                                                $workDuration = 480; //in miniute


                                                if($totalMin < $workDuration && $totalMin >=$max_early_min)
                                                {
                                                    echo '<td style="background-color:#EDFC02">',$item->early,'</td>';

                                                }
                                                else
                                                {
                                                    echo '<td>',$item->early,'</td>';
                                                }
                                                ?>


                                                <?php
                                                $val1=$item->absent;
                                                if($val1==1)
                                                {
                                                    echo '<td style="background-color:#43EB8D">', "Yes",'</td>';
                                                }
                                                elseif($val1==0)
                                                {
                                                    echo '<td>', "No",'</td>';
                                                }
                                                ?>
                                                <td>{{ $item->work_time }}</td>
                                                <td>{{ $item->ndays }}</td>
                                                <!-- <td> -->
                                                <?php
                                                $var1=$item->att_time;
                                                $timeArray = explode(":",$var1); //slice ATT time into array from string
                                                $totalMin = ($timeArray[0]*60 + $timeArray[1]); //convert into miniutes
                                                $workDuration = 480; //in miniute
                                                $avgworkduration1=475;
                                                $avgworkduration1=478;
                                                $minWorkDuration = 475; //in miniute
                                                if($totalMin < $workDuration && $totalMin >=$minWorkDuration)
                                                {
                                                    echo '<td style="background-color:#F2A150">',$item->att_time,'</td>';
                                                }
                                                elseif($totalMin < $minWorkDuration)
                                                {
                                                    echo '<td style="background-color:#F24D3F">',$item->att_time,'</td>';

                                                }
                                                else{
                                                    echo  '<td style="background-color:#7EDC86 " >',$item->att_time,'</td>';
                                                }
                                                ?>
                                            </tr>
                                        @endforeach

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>

            </div>

        </div>
    </div>


</x-app-layout>
