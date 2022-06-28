<x-app-layout>
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
                                            <div class="card-header" style="font-size: larger;text-align: left">Clock In</div>
                                            <div class="card-body">
                                                <h5 class="card-title" style="font-size: xxx-large">{{date('h:i A' ,strtotime($cardsArr['clock_in']))}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="shadow card bg-light mb-3 rounded" style="max-width: 18rem;text-align: center">
                                            <div class="card-header" style="font-size: larger;text-align: left">Clock Out</div>
                                            <div class="card-body">
                                                <h5 class="card-title" style="font-size: xxx-large">{{date('h:i A' ,strtotime($cardsArr['clock_out']))}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="shadow card bg-light mb-3 rounded" style="max-width: 18rem;text-align: center">
                                            <div class="card-header" style="font-size: larger;text-align: left">Work Time</div>
                                            <div class="card-body">
                                                <h5 class="card-title" style="font-size: xxx-large">{{$cardsArr['working_hours'].' '.'H'}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="shadow card bg-light mb-3 rounded" style="max-width: 18rem;text-align: center">
                                            <div class="card-header" style="font-size: larger;text-align: left">Late</div>
                                            <div class="card-body">
                                                <h5 class="card-title" style="font-size: xxx-large">{{$cardsArr['late'].' '.'H'}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-row pb-8">
                                    <div class="col">
                                        <img class="mt-5" src="{{asset('images/default-preview-qr.svg')}}">
                                        <a href="#" class="btn btn-success" style="margin-left: 11rem">Download</a>

                                    </div>
                                    <div class="col">
                                        <canvas id="myChart1" class="mt-5"></canvas>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-row pb-8">
                                    <div class="col">
                                        <canvas id="myChart"  height="150" class="mt-5"></canvas>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{asset('js/dashboardPieChart.js?v=7.0.5')}}"></script>
        <script src="{{asset('js/dashboardBarChart.js?v=7.0.5')}}"></script>
    @endsection
</x-app-layout>
