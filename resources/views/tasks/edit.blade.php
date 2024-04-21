<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Task') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="p-10 text-gray-900">
                    <form method="post" action="{{ route('tasks.update', $task->id) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('PUT') 
                        <div class="space-y-6">
                            <div class="flex gap-6">
                                <div class="flex-1">
                                    <x-input-label for="title" :value="__('title')" />
                                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" value="{{ $task->title }}" />
                                    <x-input-error :messages="$errors->title->get('title')" class="mt-2" />
                                </div>
           
                                <div>
                                    <x-input-label for="priority" :value="__('Priority')" />
                                    <select id="priority" name="priority" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                        @foreach (\App\Enums\PriorityEnum::Labels() as $key => $value)
                                            <option value="{{ $key }}" {{ (isset($task) && $task->priority == $key) ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->priority->get('priority')" class="mt-2" />
                                </div>
                                <div class="flex-1">
                                    <x-input-label for="start_date" :value="__('Start Date')" />
                                    <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full"  value="{{ $task->start_date->format('Y-m-d') }}"/>
                                    <x-input-error :messages="$errors->start_date->get('start_date')" class="mt-2" />
                                </div>
                            
                                <div class="flex-1">
                                    <x-input-label for="end_date" :value="__('End Date')" />
                                    <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full" value="{{ $task->end_date->format('Y-m-d') }}"/>
                                    <x-input-error :messages="$errors->end_date->get('end_date')" class="mt-2" />
                                </div>
                            </div>
                                <div>
                                    <x-input-label for="description" :value="__('Description')" />
                                    <textarea id="description" rows="4" name="description" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ $task->description }}</textarea>
                                    <x-input-error :messages="$errors->description->get('description')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="users" :value="__('Assigned To')" />
                                    <select name="users[]" id="users" multiple class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ $task->users->contains($user->id) ? 'selected' : '' }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>

                                    <x-input-error :messages="$errors->users->get('users')" class="mt-2" />
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Update') }}</x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
