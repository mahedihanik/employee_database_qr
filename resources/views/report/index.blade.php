
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Report') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5">
                                    <div class="form-row pb-8">
                                        <div class="col">
                                            <label for="date">Please Select Date Range :</label>
                                            <div id="reportRange" style="background: #fff; cursor: pointer; padding: 6px 10px; border: 1px solid #ccc; border-radius: 5px; width: 80%">
                                                <i class="fa fa-calendar ml-1"></i>&nbsp;
                                                <span></span> <i class="fa fa-caret-down"></i>
                                            </div>
                                        </div>

                                    </div>
{{--                                    <button type="submit" class="btn btn-success">Generate Report</button>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')

        <script type="text/javascript">

            $(function() {

                let start = moment().subtract(29, 'days');
                let end = moment();

                function dateRanger(start, end) {

                    $('#reportRange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                    let startDateParam = start.format('YYYY-MM-D');
                    let endDateParam = end.format('YYYY-MM-D');
                    const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        url:"/generate_employees_report/",
                        type:"POST",
                        data:{
                            emp_startDateParam:startDateParam,
                            emp_endDateParam:endDateParam,
                            _token: CSRF_TOKEN
                        },
                        cache: false,
                        success: function(response) {

                            let filename = response.substring(response.lastIndexOf('/')+1);
                            let link = document.createElement('a');
                            link.href = window.location.origin+'/'+'reportPdf'+'/'+filename;
                            link.download = "employees_report.pdf";
                            link.click();

                        },
                        failure: function (response) {
                            swal.fire(
                                "Internal Error",
                                "Oops, Missing Something.",
                                "error"
                            )
                        }
                    })
                }

                $('#reportRange').daterangepicker({
                    startDate: start,
                    endDate: end,
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    }
                }, dateRanger);

                dateRanger(start, end);

            });
        </script>
    @endsection
</x-app-layout>
