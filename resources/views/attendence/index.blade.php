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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table table-striped" id="attendence-table" style="width:100%">
                        <thead>
                          <tr>

                            <th scope="col">Ac-no</th>
                            <th scope="col">Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Clock In</th>
                            <th scope="col">Clock Out</th>
                            <th scope="col">Late</th>
                            <th scope="col">Early</th>
                            <th scope="col">Absent</th>
                            <th scope="col">Work_Time</th>
                            <th scope="col">NDays</th>
                            <th scope="col">ATT_Time</th>

                          </tr>
                        </thead>
                        <tbody>
                          @if(!empty($monthly_attendence))
                            @foreach ($monthly_attendence as $item)
                                <tr style="cursor: pointer">

                                    <td>{{ $item->ac_no }}</td>
                                    <td width="30%">{{ $item->name }}</td>
                                    <td width="20%">{{ $item->date }}</td>
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
                $("#attendence-table").DataTable();
                $("#attendence-table").on( 'click', 'tr', function () {
                    let data = $("#attendence-table").DataTable().row(this).data();
                    //console.log('Here is your data: ', data);
                    window.location.href = "/attendance_adjustment/"+9;
                } );
            });
        </script>
    @endsection
</x-app-layout>
