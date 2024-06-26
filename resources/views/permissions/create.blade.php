<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permissions') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="p-4 rounded">
                    <h1>Add new Permission</h1>
                    <div class="lead">
                    </div>
                    <div class="container mt-4">
                        <form method="POST" action="{{ route('permissions.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input value="{{ old('name') }}" 
                                    type="text" 
                                    class="form-control" 
                                    name="name" 
                                    placeholder="Name" required>
            
                                @if ($errors->has('name'))
                                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
            
                            <button type="submit" class="btn btn-primary">Save permission</button>
                            <a href="{{ route('permissions.index') }}" class="btn btn-default">Back</a>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>