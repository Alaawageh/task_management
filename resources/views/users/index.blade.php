
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="sm:p-8 bg-white shadow sm:rounded-lg">
                
                <x-primary-button onclick="window.location.href='{{ route('users.create') }}'">
                    {{ __('Add New User') }}
                </x-primary-button>                
                
                <div class="mt-2">
                </div>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col" width="1%">#</th>
                        <th scope="col" width="15%">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col" width="10%">Roles</th>
                        <th scope="col" colspan="3">Actions</th>    
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach($user->roles as $role)
                                        <span class="badge bg-primary">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                
                            
                                <td><a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm">Edit</a></td>
                                <td>
                                    {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex">
                    {!! $users->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>