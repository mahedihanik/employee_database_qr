<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-md-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Attendence Management') }}
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
                            <th scope="col">NDays</th>
                            <th scope="col">ATT_Time</th>
                            <th scope="col">WFH</th>
                            <th scope="col">WA</th>
                            <th scope="col">LA</th>
                            <th style="display: none"  scope="col">RM</th>
                            <th scope="col">Remarks</th>

                          </tr>
                        </thead>
                        <tbody>
                          @if(!empty($monthly_attendence))
                            @foreach ($monthly_attendence as $item)
                                <tr style="cursor: pointer">

                                    <td class="onTap">{{ $item->ac_no }}</td>
                                    <td class="onTap">{{ $item->name }}</td>
                                    <td class="onTap">{{ $item->date }}</td>
                                    <td class="onTap">{{ $item->clock_in }}</td>
                                    <td class="onTap">{{ $item->clock_out}}</td>
                                    @if($item->late == ' ')
                                         <td class="onTap">{{ date('H:i',strtotime('00:00'))}}</td>
                                    @else
                                         <td class="onTap">{{ $item->late}}</td>
                                    @endif
                                    <td class="onTap">{{ $item->early}}</td>
                                    <?php
                                    $val1=$item->absent;
                                    if($val1==1)
                                    {
                                    echo '<td class="onTap" style="background-color:#43EB8D">', "No",'</td>';
                                    }
                                    elseif($val1==0)
                                    {
                                      echo '<td class="onTap">', "Yes",'</td>';
                                    }
                                    ?>
                                    <td class="onTap">{{ $item->ndays }}</td>
                                    <!-- <td> -->
                                     <?php
                                      $var1=$item->att_time;
                                      $timeArray = explode(":",$var1); //slice ATT time into array from string
                                      $totalMin = ($timeArray[0]*60 + $timeArray[1]); //convert into miniutes
                                      $workDuration = 480; //in miniute
                                      $minWorkDuration = 465; //in miniute
                                      if($totalMin < $workDuration && $totalMin >=$minWorkDuration)
                                      {
                                       echo '<td class="onTap" style="background-color:#FFFF33">',$item->att_time,'</td>';
                                      }
                                      elseif($totalMin < $minWorkDuration)
                                      {
                                       echo '<td class="onTap" style="background-color:#F24D3F">',$item->att_time,'</td>';

                                      }
                                      else{
                                        echo  '<td class="onTap">',$item->att_time,'</td>';
                                      }
                                     ?>

                                     <?php
                                     $wfh=$item->wfh;
                                     if($wfh==1)
                                     {
                                         echo '<td class="onTap">', "Yes",'</td>';
                                     }
                                     elseif($wfh==0)
                                     {
                                         echo '<td class="onTap">', "No",'</td>';
                                     }
                                     ?>

                                     <?php
                                     $weekend_adjustment=$item->weekend_adjustment;
                                     if($weekend_adjustment==1)
                                     {
                                       echo '<td class="onTap"><span data-toggle="tooltip" data-placement="top" title="'.$item->weekend_adjustment_date.'" class="badge badge-info">Yes</span></td>';
                                         //echo '<td>', "Yes",'</td>';
                                     }
                                     elseif($weekend_adjustment==0)
                                     {
                                         echo '<td class="onTap">', "No",'</td>';
                                     }
                                     ?>
                                     <?php
                                     $leave_adjustment=$item->leave_adjustment;
                                     if($leave_adjustment == 1)
                                     {
                                         echo '<td class="onTap">', "Full",'</td>';
                                     }
                                     elseif((float)($leave_adjustment) == 0.5)
                                     {
                                         echo '<td class="onTap">', "Half",'</td>';
                                     }
                                     elseif($leave_adjustment == 0)
                                     {
                                         echo '<td class="onTap">', "No",'</td>';
                                     }

                                     ?>
                                    <td style="display: none">{{$item->remarks}}</td>
                                    <td>
                                        <button  type="button" class="remarkAddButton btn btn-dark btn-sm" data-toggle="modal" data-id="{{$item->id}}"  data-item="{{$item->remarks}}" data-target="#exampleModalCenter">
                                            +
                                        </button>
                                        @if($item->remarks != null)
                                            <span data-toggle="tooltip" data-placement="top" title="{{$item->remarks}}"> <i class="far fa-comment-dots fa-lg ml-2"></i></span>
                                        @endif
                                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Add Remark</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action= "{{ url ('store') }}" method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <input id="hiddenAtt_id" type="hidden" name="id" value="">
                                                                <label for="message-text" class="col-form-label">Message:</label>
                                                                <textarea class="form-control" name="remarks" id="message-text" >{{$item->remarks != null ? $item->remarks : "Write your comment here .... "}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
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
                $("#attendence-table").on( 'click', 'td.onTap', function () {
                    let data = $("#attendence-table").DataTable().row(this).data();
                    //console.log(JSON.stringify(data));
                    var newDataSet = {};
                    newDataSet['acc_no']=data[0];
                    newDataSet['name']=data[1];
                    newDataSet['date']=data[2];
                    newDataSet['clock_in']=data[3];
                    newDataSet['clock_out']=data[4];
                    newDataSet['late']=data[5];
                    newDataSet['early']=data[6];
                    newDataSet['absent']=data[7];
                    newDataSet['NDays']=data[8];
                    newDataSet['att_time']=data[9];
                    newDataSet['wfh']=data[10];
                    newDataSet['weekend_adj']=stripHtml(data[11]);
                    newDataSet['leave_adj']=(data[12]==='Full') ? 'Yes':(data[12]==='Half') ? 'Yes' : 'No';
                    newDataSet['remarks']=data[13];
                    console.log(data);
                    window.open("/attendance_adjustment/"+JSON.stringify(newDataSet),'_blank');
                    //window.location.href = "/attendance_adjustment/"+JSON.stringify(newDataSet);
                } );
            });

            function stripHtml(html)
            {
                let tmp = document.createElement("DIV");
                tmp.innerHTML = html;
                return tmp.textContent || tmp.innerText || "";
            }
            $(".remarkAddButton").click(function () {
                let monthly_att_id = $(this).data('id');
                let remarks = $(this).data('item');
                $("#hiddenAtt_id").val(monthly_att_id);
                $("#message-text").val(remarks);
                //console.log(monthly_att_id+' '+remarks)
            });
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
        <script src="{{asset('js/popper.min.js?v=7.0.5')}}"></script>
    @endsection
</x-app-layout>
