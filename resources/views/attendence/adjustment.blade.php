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
                                <form action="" method="POST" onSubmit = "return checkPassword(this)">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="account_no">Account No</label>
                                            <input type="number" id="account_no_id" class="form-control" name="account_no" value="{{ $infoSet->acc_no }}" >
                                        </div>
                                        <div class="col">
                                            <label for="employee_name">Employee Name</label>
                                            <input type="text" class="form-control" name="employee_name" value="{{ $infoSet->name }}" >
                                        </div>
                                        <div class="col">
                                            <label for="date">Date</label>
                                            <input type="date" class="form-control" name="date" value="{{$finalDateFormat}}" >
                                        </div>
                                        <div class="col">
                                            <label for="att_time">ATT_Time</label>
                                            <input type="text" class="form-control" name="att_time" value="" >
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
                                            <label for="absent">Absent</label>
                                            <input type="text" class="form-control" name="absent">
                                        </div>
                                        <div class="col">
                                            <label for="work_time">Work Time</label>
                                            <input type="text" class="form-control" name="work_time">
                                        </div>
                                    </div>
                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="date">NDays</label>
                                            <input type="text" class="form-control" name="n_days" value="" >
                                        </div>
                                        <div class="col">
                                            <label for="late">Late</label>
                                            <input type="text" class="form-control" name="late" value="" >
                                        </div>
                                        <div class="col">
                                            <label for="early">Early</label>
                                            <input type="text" class="form-control" name="early" value="" >
                                        </div>
                                    </div>
                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="early">Work From Home ( WFH ) : </label>
                                            <input class="form-control ml-3" type="radio" value="Yes" name="wfh" id="wfh_yes">
                                            <label class="form-check-label" for="wfh_yes">
                                                Yes
                                            </label>
                                            <input class="form-control ml-3" type="radio" value="No" name="wfh" id="wfh_no">
                                            <label class="form-check-label" for="wfh_no">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="early">Weekend Adjustment : </label>
                                            <input class="form-control ml-5" type="radio" value="Yes" name="weekAdj" id="weekAdj_yes">
                                            <label class="form-check-label" for="weekAdj_yes">
                                                Yes
                                            </label>
                                            <input class="form-control ml-3" type="radio" value="No" name="weekAdj" id="weekAdj_no">
                                            <label class="form-check-label" for="weekAdj_no">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="early">Leave Adjustment : </label>
                                            <input class="form-control" style="margin-left: 4.6rem" type="radio" value="Yes" name="leaveAdj" id="leaveAdj_yes">
                                            <label class="form-check-label" for="leaveAdj_yes">
                                                Yes
                                            </label>
                                            <input class="form-control ml-3" type="radio" value="No" name="leaveAdj" id="leaveAdj_no">
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
                                    <button type="submit" class="btn btn-primary">Save</button>
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

            function checkPassword(form) {
                let password = form.password.value;
                let confirmPassword = form.confirmPassword.value;
                if (password === ''){
                    $("#confirmPasswordError").html("");
                    $("#passwordError").html("Please enter the Password !");
                    return false;
                }
                else if (confirmPassword === ''){
                    $("#passwordError").html("");
                    $("#confirmPasswordError").html("Please enter the Confirm Password !");
                    return false;
                }
                else if (password !== confirmPassword) {
                    $("#confirmPasswordError").html("Password did not match, please try again !");
                    return false;
                }
                else{
                    return true;
                }
            }
            $('#wfh_yes').click(function(e) {
                Swal.fire({
                    title: "Please enter the date",
                    html:'<input type="date" id="wfh_date_adjust" class="form-control" autofocus>',
                    showCancelButton: true,
                    confirmButtonColor: "#17A2B8",
                    confirmButtonText: "Adjust",
                    cancelButtonText: "Cancel",
                    cancelButtonColor: "#DC3545",
                    buttonsStyling: true,
                }).then(function (e){
                    if(e.value === true){

                        let wfh_date_adjust_new = $("#wfh_date_adjust").val();
                        let wfh_date_adjust_employee_acc_no = $("#account_no_id").val();
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                        $.ajax({
                            url:"/wfh_attendance_adjustment/",
                            type:"POST",
                            data:{
                                wfh_acc_no:wfh_date_adjust_employee_acc_no,
                                Wfh_adj_date_new:wfh_date_adjust_new,
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
            // var CustomerKey = 1234;//your customer key value.
            // swal({
            //     title: "Add Note",
            //     input: "textarea",
            //     showCancelButton: true,
            //     confirmButtonColor: "#1FAB45",
            //     confirmButtonText: "Save",
            //     cancelButtonText: "Cancel",
            //     buttonsStyling: true
            // }).then(function () {
            //         $.ajax({
            //             type: "POST",
            //             url: "YourPhpFile.php",
            //             data: { 'CustomerKey': CustomerKey},
            //             cache: false,
            //             success: function(response) {
            //                 swal(
            //                     "Sccess!",
            //                     "Your note has been saved!",
            //                     "success"
            //                 )
            //             },
            //             failure: function (response) {
            //                 swal(
            //                     "Internal Error",
            //                     "Oops, your note was not saved.", // had a missing comma
            //                     "error"
            //                 )
            //             }
            //         });
            //     },
            //     function (dismiss) {
            //         if (dismiss === "cancel") {
            //             swal(
            //                 "Cancelled",
            //                 "Canceled Note",
            //                 "error"
            //             )
            //         }
            //     })


        </script>
    @endsection
</x-app-layout>
