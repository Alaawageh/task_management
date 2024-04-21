<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="p-4 rounded">
                    <h1>Add new Role</h1>
                    <div class="lead">
                    </div>
                    <div class="container mt-4">
                        <form method="POST" action="{{ route('roles.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input value="{{ old('name') }}" 
                                    type="text" 
                                    class="form-control" 
                                    name="name" 
                                    placeholder="Name" required>
                            </div>
                            
                            <label for="permissions" class="form-label">Assign Permissions</label>
            
                            <table class="table table-striped">
                                <thead>
                                    <th scope="col" width="1%"><input type="checkbox" name="all_permission"></th>
                                    <th scope="col" width="20%">Name</th>
                                    <th scope="col" width="1%">Guard</th> 
                                </thead>
            
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>
                                            <input type="checkbox" 
                                            name="permission[{{ $permission->name }}]"
                                            value="{{ $permission->name }}"
                                            class='permission'>
                                        </td>
                                        <td>{{ $permission->name }}</td>
                                        <td>{{ $permission->guard_name }}</td>
                                    </tr>
                                @endforeach
                            </table>
            
                            <button type="submit" class="btn btn-primary">Save Role</button>
                            <a href="{{ route('roles.index') }}" class="btn btn-default">Back</a>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>