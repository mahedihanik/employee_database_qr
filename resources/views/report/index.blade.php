
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
                                            <label for="date">Date</label>
                                            <input id="entryDateTab" type="date" class="form-control" name="date" value="">
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
    @endsection
</x-app-layout>
