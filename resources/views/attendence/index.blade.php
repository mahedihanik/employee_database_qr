<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-md-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Attendence') }}
                </h2>
            </div>
            <div class="col-md-6">
                <a href="{{ route('attendence.create') }}" style="float: right;"><i class="fas fa-plus"></i> Import CSV</a>
            </div>
        </div>


    </x-slot>

<!--    --><?php
//        echo '<pre>';
//        print_r($monthly_attendence);die();
//
//
//    ?>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table table-striped" id="attendence-table" >
                        <thead>
                          <tr>

                            <th scope="col">Ac_no</th>
                            <th scope="col">Employee_Name</th>
                            <th scope="col">Entry_Date</th>
                            <th scope="col">Clock_In</th>
                            <th scope="col">Clock_Out</th>
                            <th scope="col">Late</th>
                            <th scope="col">Early</th>
                            <th scope="col">Absent</th>
                            <th scope="col">Work_Time</th>
                            <th scope="col">NDays</th>
                            <th scope="col">ATT_Time</th>
                            <th scope="col">WFH</th>
                            <th scope="col">WA</th>
                            <th scope="col">LA</th>

                          </tr>
                        </thead>
                        <tbody>
                          @if(!empty($monthly_attendence))
                            @foreach ($monthly_attendence as $item)
                                <tr style="cursor: pointer">

                                    <td>{{ $item->ac_no }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->date }}</td>
                                    <td>{{ $item->clock_in }}</td>
                                    <td>{{ $item->clock_out}}</td>
                                    <td>{{ $item->late}}</td>
                                    <td>{{ $item->early}}</td>
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
                                      $minWorkDuration = 465; //in miniute
                                      if($totalMin < $workDuration && $totalMin >=$minWorkDuration)
                                      {
                                       echo '<td style="background-color:#FFFF33">',$item->att_time,'</td>';
                                      }
                                      elseif($totalMin < $minWorkDuration)
                                      {
                                       echo '<td style="background-color:#F24D3F">',$item->att_time,'</td>';

                                      }
                                      else{
                                        echo  '<td>',$item->att_time,'</td>';
                                      }
                                     ?>

                                     <?php
                                     $wfh=$item->wfh;
                                     if($wfh==1)
                                     {
                                         echo '<td>', "Yes",'</td>';
                                     }
                                     elseif($wfh==0)
                                     {
                                         echo '<td>', "No",'</td>';
                                     }
                                     ?>

                                     <?php
                                     $weekend_adjustment=$item->weekend_adjustment;
                                     if($weekend_adjustment==1)
                                     {
                                         echo '<td>', "Yes",'</td>';
                                     }
                                     elseif($weekend_adjustment==0)
                                     {
                                         echo '<td>', "No",'</td>';
                                     }
                                     ?>
                                     <?php
                                     $leave_adjustment=$item->leave_adjustment;
                                     if($leave_adjustment==1)
                                     {
                                         echo '<td>', "Yes",'</td>';
                                     }
                                     elseif($leave_adjustment==0)
                                     {
                                         echo '<td>', "No",'</td>';
                                     }
                                     ?>

                                    <!-- </td> -->




                                </tr>
                            @endforeach
                          @endif
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>


    @section('scripts')
        <script>
            $(document).ready( function () {
                $("#attendence-table").DataTable({
                    scrollX:true,
                });
                $("#attendence-table").on( 'click', 'tr', function () {
                    let data = $("#attendence-table").DataTable().row(this).data();
                    var newDataSet = {};
                    newDataSet['acc_no']=data[0];
                    newDataSet['name']=data[1];
                    newDataSet['date']=data[2];
                    newDataSet['clock_in']=data[3];
                    newDataSet['clock_out']=data[4];
                    newDataSet['absent']=data[5];
                    newDataSet['wfh']=data[6];
                    newDataSet['weekend_adj']=data[7];
                    newDataSet['leave_adj']=data[8];
                    //console.log(JSON.stringify(newDataSet));
                    window.open("/attendance_adjustment/"+JSON.stringify(newDataSet),'_blank');
                    //window.location.href = "/attendance_adjustment/"+JSON.stringify(newDataSet);
                } );
            });
        </script>
    @endsection
</x-app-layout>
