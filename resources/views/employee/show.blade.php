<x-app-layout>
    <x-slot name="header">

        <div class="row">
            <div class="col-md-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Employee') }}
                </h2>
            </div>
            <div class="col-md-6">
                <a href="{{ route("employee.create") }}" style="float: right;"><i class="fas fa-plus"></i> Add New</a>
            </div>
        </div>


    </x-slot>




    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200">
                <div class="marig" style="padding-bottom: 17px;">
                  <h1 style="font-weight:700;">Employee Details</h1>
                 </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="{{ asset('storage/'.$employee->image) }}" alt="" style="height: 200px;">
                            </div>
                            <div class="col-md-6">
                                <table border="0" style="width: 100%">
                                    <tr>
                                        <td style="font-weight: 700">Employee ID</td>
                                        <td>{{ $employee->employee_id }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Name</td>
                                        <td>{{ $employee->name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Date of Birth</td>
                                        <td>{{ $employee->dob }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Blood Group</td>
                                        <td>{{ $employee->blood_group }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Marital Status</td>
                                        <td>{{ $employee->marital_status }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Company</td>
                                        <td>{{ $employee->company_name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Department</td>
                                        <td>{{ $employee->department }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Designation</td>
                                        <td>{{ $employee->designation }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Personal Email</td>
                                        <td>{{ $employee->personal_email }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Official Email</td>
                                        <td>{{ $employee->official_email }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Personal Number</td>
                                        <td>{{ $employee->personal_number }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Official Number</td>
                                        <td>{{ $employee->official_number }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Home Address</td>
                                        <td>{{ $employee->home_address }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Joining Date</td>
                                        <td>{{ $employee->joining_date }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Expiry Date</td>
                                        <td>{{ $employee->expiry_date }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Status</td>
                                        <td>@if($employee->active) Active @else Inactive @endif</td>
                                    </tr>

                                    <tr>
                                        <td style="font-weight: 700">Emergency Contact Name</td>
                                        <td>{{ $employee->ename }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Emergency Contact Number</td>
                                        <td>{{ $employee->ephone }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 700">Emergency Contact Relation</td>
                                        <td>{{ $employee->erelation }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-3 text-center">
                                <img src="{{ asset('storage/'. $employee->qrimage) }}" alt="" style="height: 200px;margin-left: auto; margin-right: auto">
                                <button type="button" class="btn btn-success mt-2"><a href="{{ route('qrdownload', $employee->id) }}">Download</a></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center mt-5">
                                @if(\App\Http\Helpers\RoleCheck::roleCheckByLoggedInUser(auth()->id()) == "admin")
                                    <button type="button" class="btn btn-warning"><a href="{{ route('employee.edit', $employee->id) }}">Edit</a></button>
                                @else
                                    <button type="button" class="btn btn-info"><a href="{{ route('user.edit', auth()->id()) }}">Change Password</a></button>
                                @endif
                                <form action="{{ route('employee.destroy', $employee->id) }}" method="POST" style="display:inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
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
                            <th scope="col">Remarks</th>

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




                                     <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                          +

                                       </button>

                                        <!-- Modal -->


                                            <!-- <a href="#" data-toggle="tooltip" title="{{$item->remarks}}">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">Comment</button>


                                                 <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Comment</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                               {{$item->remarks}}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                            </div>
                                                            </div>
                                                        </div>
                                                        </div>

                                              </a> -->
                                             <a href="#" data-toggle="tooltip" title="{{$item->remarks}}"  >

                                             <i class="fas fa-comment"></i>
                                             </a>


                                                <!-- Generated markup by the plugin -->
                                                <div class="tooltip bs-tooltip-top" role="tooltip">
                                                <div class="arrow"></div>
                                                <div class="tooltip-inner"  >
                                                 <div class="modal-body">
                                                    {{$item->remarks}}
                                                  </div>
                                                </div>
                                                </div>





                                                <!-- Generated markup by the plugin
                                                <div class="tooltip bs-tooltip-top" role="tooltip">
                                                <div class="arrow"></div>
                                                <div class="tooltip-inner">



                                                </div>
                                                </div> -->


                                        <form action= "{{ url ('store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            @if(session('status'))
                                               <div class= "alert alert-success">{{session('status')}}</div>
                                            @endif
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Comments</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>


                                            <div class="modal-body">


                                                <input type="text" name="remarks" style="width:100%;height:100px" placeholder="Write Comments" value="{{$item->remarks}}" >


                                            </div>



                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>

                                            </div>
                                        </div>
                                        </div>
                                     </form>
                                    </td>


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
