<x-app-layout>
    <style>
        #myChart1{

            /*width:200px !important;*/
            height:400px !important;

        }
        .verticalLine {
            border-left: 2px solid rgba(0,0,0,.1);
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-row pb-8">
                                    <div class="col">
                                        <div class="shadow card bg-light mb-3 rounded" style="max-width: 18rem;text-align: center">
                                            <div class="card-header" style="font-size: larger;text-align: left">Clock In
                                                <hr>
                                                <span class="badge badge-info" style="font-size: small;text-align: left">22-Jun-2022</span>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title" style="font-size: xxx-large">{{date('h:i A' ,strtotime($cardsArr['clock_in']))}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="shadow card bg-light mb-3 rounded" style="max-width: 18rem;text-align: center">
                                            <div class="card-header" style="font-size: larger;text-align: left">Clock Out
                                                <hr>
                                                <span class="badge badge-info" style="font-size: small;text-align: left">22-Jun-2022</span>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title" style="font-size: xxx-large">{{date('h:i A' ,strtotime($cardsArr['clock_out']))}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="shadow card bg-light mb-3 rounded" style="max-width: 18rem;text-align: center">
                                            <div class="card-header" style="font-size: larger;text-align: left">Work Time
                                                <hr>
                                                <span class="badge badge-info" style="font-size: small;text-align: left">22-Jun-2022</span>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title" style="font-size: xxx-large">{{$cardsArr['working_hours'].' '.'H'}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="shadow card bg-light mb-3 rounded" style="max-width: 18rem;text-align: center">
                                            <div class="card-header" style="font-size: larger;text-align: left">Late
                                                <hr>
                                                <span class="badge badge-info" style="font-size: small;text-align: left">22-Jun-2022</span>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title" style="font-size: xxx-large">{{$cardsArr['late'].' '.'H'}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-row pb-8">
                                    <div class="col">
                                        <img height="360px" width="360px" style="margin-left: 6rem" src="{{asset('images/default-preview-qr.svg')}}">
                                        <a href="#" class="btn btn-success" style="margin-left: 14rem">Download</a>

                                    </div>
                                    <div class="verticalLine mt-4"></div>
                                    <div class="col">
                                        <canvas id="pieChart" class="mt-1"></canvas>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-row pb-8">
                                    <div class="col">
                                        <canvas id="barChart"  height="150" class="mt-5"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')

        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
        <script src="{{asset('js/dashboardPieChart.js?v=7.0.5')}}"></script>
        <script src="{{asset('js/dashboardBarChart.js?v=7.0.5')}}"></script>

    @endsection
</x-app-layout>
