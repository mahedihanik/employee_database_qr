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
                                        <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                                            <div class="card-header">Clock In</div>
                                            <div class="card-body">
                                                <h5 class="card-title">Secondary card title</h5>
                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                                            <div class="card-header">Clock Out</div>
                                            <div class="card-body">
                                                <h5 class="card-title">Secondary card title</h5>
                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                                            <div class="card-header">Work Time</div>
                                            <div class="card-body">
                                                <h5 class="card-title">Secondary card title</h5>
                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                                            <div class="card-header">Leave</div>
                                            <div class="card-body">
                                                <h5 class="card-title">Secondary card title</h5>
                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-row pb-8">
                                    <div class="col">

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
