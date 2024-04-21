
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="sm:p-8 bg-white shadow sm:rounded-lg">
                
                <x-primary-button onclick="window.location.href='{{ route('roles.create') }}'">
                    {{ __('Add New Role') }}
                </x-primary-button>                
                
                <div class="mt-2">
                </div>

                <table class="table table-bordered">
                    <tr>
                    <th width="1%">No</th>
                    <th>Name</th>
                    <th width="15%" colspan="9">Action</th>
                    </tr>
                    @foreach ($roles as $key => $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            <x-info-button onclick="window.location.href='{{ route('roles.edit', $role->id) }}'">
                                {{ __('Edit') }}
                            </x-info-button>
                            {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                </table>

                <div class="d-flex">
                    {!! $roles->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>