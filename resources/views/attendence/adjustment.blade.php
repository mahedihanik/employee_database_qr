<?php
  $infoSet = json_decode($data);
  $dateSlice = explode('-',$infoSet->date);
  $finalDateFormat = $dateSlice[2].'-'.date('m', strtotime($dateSlice[1])).'-'.$dateSlice[0];
//  echo "<pre>";
//  print_r($infoSet);
//  die();
?>
<style>
    .swal2-confirm.swal2-styled:focus{box-shadow:none;}
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ url('attendance_adjustment_update') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="account_no">Account No</label>
                                            <input type="number" id="account_no_id" class="form-control" name="account_no" value="{{ $infoSet->acc_no }}" readonly>
                                        </div>
                                        <div class="col">
                                            <label for="employee_name">Employee Name</label>
                                            <input type="text" class="form-control" name="employee_name" value="{{ $infoSet->name }}" readonly>
                                        </div>
                                        <div class="col">
                                            <label for="date">Date</label>
                                            <input id="entryDate" type="date" class="form-control" name="date" value="{{$finalDateFormat}}" readonly>
                                        </div>

                                    </div>

                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="date">Clock in</label>
                                            <input type="time" class="form-control" name="clock_in" value="{{$infoSet->clock_in}}" >
                                        </div>
                                        <div class="col">
                                            <label for="date">Clock out</label>
                                            <input type="time" class="form-control" name="clock_out" value="{{$infoSet->clock_out}}" >
                                        </div>
                                        <div class="col">
                                            <label for="late">Late</label>
                                            <input type="text" class="form-control" name="late" value="{{$infoSet->late}}" readonly>
                                        </div>
                                        <div class="col">
                                            <label for="early">Early</label>
                                            <input type="text" class="form-control" name="early" value="{{$infoSet->early}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="absent">Absent</label>
                                            <input type="text" class="form-control" name="absent" value="{{$infoSet->absent}}">
                                        </div>
                                        <div class="col">
                                            <label for="work_time">Work Time</label>
                                            <input type="text" class="form-control" name="work_time" value="{{$infoSet->work_time}}" readonly>
                                        </div>
                                        <div class="col">
                                            <label for="date">NDays</label>
                                            <input type="text" class="form-control" name="n_days" value="{{$infoSet->NDays}}" readonly>
                                        </div>
                                        <div class="col">
                                            <label for="date">ATT_Time</label>
                                            <input type="text" class="form-control" name="att_time" value="{{$infoSet->att_time}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="early">Work From Home ( WFH ) : </label>
                                            <input class="form-control ml-3" type="radio" value="Yes" name="wfh" id="wfh_yes" {{$infoSet->wfh=='Yes'?'checked':''}}>
                                            <label class="form-check-label" for="wfh_yes">
                                                Yes
                                            </label>
                                            <input class="form-control ml-3" type="radio" value="No" name="wfh" id="wfh_no" {{$infoSet->wfh=='No'?'checked':''}}>
                                            <label class="form-check-label" for="wfh_no">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="early">Weekend Adjustment : </label>
                                            <input class="form-control ml-5" type="radio" value="Yes" name="weekAdj" id="weekAdj_yes" {{$infoSet->weekend_adj=='Yes'?'checked':''}}>
                                            <label class="form-check-label" for="weekAdj_yes">
                                                Yes
                                            </label>
                                            <input class="form-control ml-3" type="radio" value="No" name="weekAdj" id="weekAdj_no" {{$infoSet->weekend_adj=='No'?'checked':''}}>
                                            <label class="form-check-label" for="weekAdj_no">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="early">Leave Adjustment : </label>
                                            <input class="form-control" style="margin-left: 4.6rem" type="radio" value="Yes" name="leaveAdj" id="leaveAdj_yes" {{$infoSet->leave_adj=='Yes'?'checked':''}}>
                                            <label class="form-check-label" for="leaveAdj_yes">
                                                Yes
                                            </label>
                                            <input class="form-control ml-3" type="radio" value="No" name="leaveAdj" id="leaveAdj_no" {{$infoSet->leave_adj=='No'?'checked':''}}>
                                            <label class="form-check-label" for="leaveAdj_no">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <button type="submit" class="btn btn-success">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>

            $('#weekAdj_yes').click(function(e) {
                Swal.fire({
                    title: "Please enter the date",
                    html:'<input type="date" id="weekend_date_adjust" class="form-control" autofocus>',
                    showCancelButton: true,
                    confirmButtonColor: "#17A2B8",
                    confirmButtonText: "Adjust",
                    cancelButtonText: "Cancel",
                    cancelButtonColor: "#DC3545",
                    buttonsStyling: true,
                }).then(function (e){
                    if(e.value === true){

                        let weekend_date_adjust_new = $("#weekend_date_adjust").val();
                        let weekend_date_adjust_employee_acc_no = $("#account_no_id").val();
                        let en_date = $("#entryDate").val();
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                        $.ajax({
                            url:"/weekend_attendance_adjustment/",
                            type:"POST",
                            data:{
                                weekend_acc_no:weekend_date_adjust_employee_acc_no,
                                weekend_adj_date_new:weekend_date_adjust_new,
                                entry_date:en_date,
                                _token: CSRF_TOKEN
                            },
                            cache: false,
                                    success: function(response) {
                                        swal.fire(
                                            "Success!",
                                            "Your Adjustment has been saved!",
                                            "success"
                                        )
                                    },
                                    failure: function (response) {
                                        swal.fire(
                                            "Internal Error",
                                            "Oops, your Adjustment was not saved.", // had a missing comma
                                            "error"
                                        )
                                    }
                        })
                    }
                })
            });

            $('#leaveAdj_yes').click(function(e) {
                Swal.fire({
                    title: "Please select an option",
                    html:'' +
                        '<input class="form-control" type="radio" value="fullDay" name="leaveDaySplitAdj">' +' '+
                        '<label>Full Day</label>' +' '+ '<input class="form-control" style="margin-left: 2rem" type="radio" value="halfDay" name="leaveDaySplitAdj">' + ' ' +'<label>Half Day</label>',
                    showCancelButton: true,
                    confirmButtonColor: "#17A2B8",
                    confirmButtonText: "Adjust",
                    cancelButtonText: "Cancel",
                    cancelButtonColor: "#DC3545",
                    buttonsStyling: true,
                }).then(function (e){
                    if(e.value === true){

                        let leaveDaySplitAdj = $("input[name='leaveDaySplitAdj']:checked").val();
                        let weekend_leave_adjust_employee_acc_no = $("#account_no_id").val();
                        let en_date = $("#entryDate").val();
                        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url:"/leave_adjustment/",
                            type:"POST",
                            data:{
                                leaveDaySplitAdj_param:leaveDaySplitAdj,
                                weekend_leave_adjust_employee_acc_no_param:weekend_leave_adjust_employee_acc_no,
                                entry_date_param:en_date,
                                _token: CSRF_TOKEN
                            },
                            cache: false,
                            success: function(response) {
                                swal.fire(
                                    "Success!",
                                    "Your Adjustment has been saved!",
                                    "success"
                                )
                            },
                            failure: function (response) {
                                swal.fire(
                                    "Internal Error",
                                    "Oops, your Adjustment was not saved.", // had a missing comma
                                    "error"
                                )
                            }
                        })
                    }
                })
            });
        </script>
    @endsection
</x-app-layout>
