
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permissions') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="sm:p-8 bg-white shadow sm:rounded-lg">
                
                <x-primary-button onclick="window.location.href='{{ route('permissions.create') }}'">
                    {{ __('Add New') }}
                </x-primary-button>                
                
                <div class="mt-2">
                </div>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col" width="3%">Name</th>
                        <th scope="col">Guard</th> 
                        <th scope="col" colspan="9" width="15%"></th> 
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->guard_name }}</td>
                                <td>
                                    <x-info-button onclick="window.location.href='{{ route('permissions.edit', $permission->id) }}'">
                                        {{ __('Edit') }}
                                    </x-info-button>
                                    {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                    {!! Form::close() !!}
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex">
                    {!! $permissions->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>