<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="p-4 rounded">
                    <h1>Edit user</h1>
                    <div class="lead">
                    </div>
                    <div class="container mt-4">
                        <form method="POST" action="{{ route('users.update', $user->id)}}">
                            @method('patch')
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input value="{{ $user->name }}" 
                                    type="text" 
                                    class="form-control" 
                                    name="name" 
                                    required>

                                @if ($errors->has('name'))
                                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input value="{{ $user->email }}"
                                    type="email" 
                                    class="form-control" 
                                    name="email" 
                                    required>
                                @if ($errors->has('email'))
                                    <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Email</label>
                                <input type="password" 
                                    class="form-control" 
                                    name="password"
                                    value="{{ $user->password }}" 
                                    required>
                                @if ($errors->has('password'))
                                    <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-control" name="role" required>
                                    <option value="">Select role</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ in_array($role->name, $userRole) ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('role'))
                                    <span class="text-danger text-left">{{ $errors->first('role') }}</span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Save user</button>
                            <a href="{{ route('users.index') }}" class="btn btn-default">Back</a>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>