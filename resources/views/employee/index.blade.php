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
                    <table class="table table-striped" id="employee-table" style="width:100%">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Employee Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Office Email</th>
                            <th scope="col">Office Phone</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if(!empty($employees))
                            @foreach ($employees as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->employee_id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->official_email }}</td>
                                    <td>{{ $item->official_number }}</td>
                                    <td>@if($item->active) Active @else Inactive @endif</td>
                                    <td>
                                        <a href="{{ route('employee.show', $item->id) }}" class="mr-1"><i class="fas fa-eye"></i></a>
                                        @if(\App\Http\Helpers\RoleCheck::roleCheckByLoggedInUser(auth()->id()) == 'admin')

                                            <a href="{{ route('employee.edit', $item->id) }}" class="mr-1"><i class="fas fa-edit"></i></a>

                                            <form action="{{ route('employee.destroy', $item->id) }}" method="POST" style="display:inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="border:none; background:transparent; padding: 0px;display:inline-block" ><i class="fas fa-trash"></i></button>
                                            </form>

                                        @endif
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
                $('#employee-table').DataTable();
            });
        </script>
    @endsection
</x-app-layout>
