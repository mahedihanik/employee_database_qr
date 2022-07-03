<?php
//$infoSet = json_decode($data);
//$dateSlice = explode('-',$infoSet->date);
//$finalDateFormat = $dateSlice[2].'-'.date('m', strtotime($dateSlice[1])).'-'.$dateSlice[0];
//  echo "<pre>";
//  print_r($infoSet);
//  die();
?>
<style>
    .swal2-confirm.swal2-styled:focus{box-shadow:none;}
    .select2-selection__rendered {
        line-height: 34px !important;
    }
    .select2-container .select2-selection--single {
        height: 38px !important;
    }
    .select2-selection__arrow {
        height: 37px !important;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Attendance Adjustment') }}
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
                                            <input type="number" id="account_no_id" class="form-control" name="account_no" value="" readonly>
                                        </div>
                                        <div class="col">
                                            <label for="employee_name">Employee Name</label>
                                            <select id="adjustmentSelect" class="js-example-basic-single" style="width: 100%" name="employeeNameSelect">
                                                <option value="">Select Employee Name</option>
                                                @foreach($empNameList as $emp)
                                                    <option value="{{$emp['employee_id']}}">{{$emp['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="date">Date</label>
                                            <input id="entryDateTab" type="date" class="form-control" name="date" value="{{$todayDate}}">
                                        </div>

                                    </div>

                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="date">Clock in</label>
                                            <input id="clock_in_tab" type="time" class="form-control" name="clock_in" value="" >
                                        </div>
                                        <div class="col">
                                            <label for="date">Clock out</label>
                                            <input id="clock_out_tab" type="time" class="form-control" name="clock_out" value="" >
                                        </div>
                                        <div class="col">
                                            <label for="late">Late</label>
                                            <input id="late_tab" type="text" class="form-control" name="late" value="" readonly>
                                        </div>
                                        <div class="col">
                                            <label for="early">Early</label>
                                            <input id="early_tab" type="text" class="form-control" name="early" value="" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="absent">Absent</label>
                                            <input id="absent_tab" type="text" class="form-control" name="absent" value="">
                                        </div>
{{--                                        <div class="col">--}}
{{--                                            <label for="work_time">Work Time</label>--}}
{{--                                            <input id="work_time_tab" type="text" class="form-control" name="work_time" value="" readonly>--}}
{{--                                        </div>--}}
                                        <div class="col">
                                            <label for="date">NDays</label>
                                            <input id="NDays_tab" type="text" class="form-control" name="n_days" value="" readonly>
                                        </div>
                                        <div class="col">
                                            <label for="date">ATT_Time</label>
                                            <input id="att_time_tab" type="text" class="form-control" name="att_time" value="" readonly>
                                        </div>
                                    </div>
                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="absent">Remarks</label>
                                            <textarea id="remarks_tab" class="form-control" name="re_marks" rows="3"></textarea>
                                        </div>
                                        {{--                                        <div class="col">--}}
                                        {{--                                            <label for="work_time">Work Time</label>--}}
                                        {{--                                            <input type="text" class="form-control" name="work_time" value="{{$infoSet->work_time}}" readonly>--}}
                                        {{--                                        </div>--}}
                                    </div>
                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="early">Work From Home ( WFH ) : </label>
                                            <input class="form-control ml-3" type="radio" value="Yes" name="wfh" id="wfh_yes_tab">
                                            <label class="form-check-label" for="wfh_yes">
                                                Yes
                                            </label>
                                            <input class="form-control ml-3" type="radio" value="No" name="wfh" id="wfh_no_tab">
                                            <label class="form-check-label" for="wfh_no">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="early">Weekend Adjustment : </label>
                                            <input class="form-control ml-5" type="radio" value="Yes" name="weekAdj" id="weekAdj_yes_tab">
                                            <label class="form-check-label" for="weekAdj_yes">
                                                Yes
                                            </label>
                                            <input class="form-control ml-3" type="radio" value="No" name="weekAdj" id="weekAdj_no_tab">
                                            <label class="form-check-label" for="weekAdj_no">
                                                No
                                            </label>
                                            <span id="weekAdj_date_show_side" class="badge badge-danger ml-3 d-none"></span>
                                        </div>
                                    </div>
                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="early">Leave Adjustment : </label>
                                            <input class="form-control" style="margin-left: 4.6rem" type="radio" value="Yes" name="leaveAdj" id="leaveAdj_yes_tab">
                                            <label class="form-check-label" for="leaveAdj_yes">
                                                Yes
                                            </label>
                                            <input class="form-control ml-3" type="radio" value="No" name="leaveAdj" id="leaveAdj_no_tab">
                                            <label class="form-check-label" for="leaveAdj_no">
                                                No
                                            </label>
                                            <span id="leaveAdj_show_side" class="badge badge-danger ml-3 d-none"></span>
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
                                    <button id="update_button_tab" type="submit" class="btn btn-success d-none">Update</button>
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

            $('.js-example-basic-single').select2();
            $("#entryDateTab").change(function(){
                let employee_name = $(".select2-selection__rendered").text();
                let employee_id = $("#adjustmentSelect").val();
                if(employee_name === 'Select Employee Name' || employee_name === null){
                            swal.fire(
                                "User Error",
                                "Oops, Please Select an Employee Name.",
                                "error"
                            )
                }
                else
                {
                    let employeeNameTabForm = employee_name;
                    let employeeIdTabForm = employee_id;
                    let entryDateTabForm = $("#entryDateTab").val();
                    const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        url:"/get_attendance_adjustment_tab/",
                        type:"POST",
                        data:{
                            employeeIdTabFormParam:employeeIdTabForm,
                            employeeNameTabFormParam:employeeNameTabForm,
                            entryDateTabFormParam:entryDateTabForm,
                            _token: CSRF_TOKEN
                        },
                        cache: false,
                        success: function(response) {
                            $("#account_no_id").val(response.ac_no);
                            $("#clock_in_tab").val(response.clock_in);
                            $("#clock_out_tab").val(response.clock_out);
                            $("#late_tab").val(response.late);
                            $("#early_tab").val(response.early);
                            $("#absent_tab").val(response.absent === '0' ? 'No' : 'Yes');
                            $("#work_time_tab").val(response.work_time);
                            $("#NDays_tab").val(response.ndays);
                            $("#remarks_tab").val(response.remarks);
                            $("#att_time_tab").val(response.att_time);
                            let dayCheckSplit = (response.leave_adjustment === 1) ? 'Full Day Leave' : 'Half Day Leave';
                            (response.wfh === 0 ? $("#wfh_no_tab").attr('checked',true):$("#wfh_yes_tab").attr('checked',true));
                            (response.weekend_adjustment === 0 ? $("#weekAdj_no_tab").attr('checked',true):$("#weekAdj_yes_tab").attr('checked',true)+$("#weekAdj_date_show_side").removeClass('d-none').html("Weekend Adjustment Date : "+response.weekend_adjustment_date));
                            (response.leave_adjustment === 0 ? $("#leaveAdj_no_tab").attr('checked',true):$("#leaveAdj_yes_tab").attr('checked',true)+$("#leaveAdj_show_side").removeClass('d-none').html("Leave Adjustment : "+dayCheckSplit));
                            $("#update_button_tab").removeClass('d-none');
                            console.log(response);

                        },
                        failure: function (response) {
                            swal.fire(
                                "Internal Error",
                                "Oops, Missing Something.",
                                "error"
                            )
                        }
                    })
                    $('#weekAdj_yes_tab').click(function(e) {
                        $('input[name=wfh][value="No"]').prop('checked', true);
                        $('input[name=leaveAdj][value="No"]').prop('checked', true);
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
                                let en_date = $("#entryDateTab").val();
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

                    $('#leaveAdj_yes_tab').click(function(e) {
                        $('input[name=wfh][value="No"]').prop('checked', true);
                        $('input[name=weekAdj][value="No"]').prop('checked', true);
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
                                let en_date = $("#entryDateTab").val();
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
                    $('#wfh_yes_tab').click(function(e) {
                        $('input[name=leaveAdj][value="No"]').prop('checked', true);
                        $('input[name=weekAdj][value="No"]').prop('checked', true);
                    });
                }

            });



        </script>
    @endsection
</x-app-layout>
