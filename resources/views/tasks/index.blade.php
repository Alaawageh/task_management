<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="sm:p-8 bg-white shadow sm:rounded-lg">

                <x-primary-button onclick="window.location.href='{{ route('tasks.create') }}'">
                    {{ __('Add New Task') }}
                </x-primary-button>

                <form action="{{route('tasks.search')}}" method="post" class="py-4">
                    @csrf
                    <input type="text" name="keyword" placeholder="Search By..">
                    <select name="priority">
                        <option value="">Select Priority</option>
                        @foreach (\App\Enums\PriorityEnum::Labels() as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    <select name="status">
                        <option value="">Select Status</option>
                        @foreach (\App\Enums\StatusEnum::Labels() as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="inline-flex items-center py-2.5 px-3 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>{{__('Search')}}
                    </button>
                </form>
                <!-- start table -->
                <div class="table-responsive py-2">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Start_Date</th>
                            <th>End_Date</th>
                            <th width="9%">Status</th>
                            <th>Priority</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($tasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->start_date->format('Y-m-d') }}</td>
                                <td>{{ $task->end_date->format('Y-m-d') }}</td>
                                <td>       
                                    <x-task-status :status="$task->status" />
                                </td>
                                <td>{{ App\Enums\PriorityEnum::Labels()[$task->priority] }}</td>
                                <td>
                                    {{-- @can('delete',$task) --}}
                                    <a href="#"
                                        class="btn btn-danger btn-sm"
                                        data-toggle="modal"
                                        data-target="#delete{{ $task->id }}">{{__('Delete')}}
                                    </a>
                                    {{-- @endcan --}}

                                    
                                    <x-info-button  onclick="window.location.href='{{ route('tasks.edit', $task->id) }}'">
                                        {{ __('Edit') }}
                                    </x-info-button>
                                    
                                    
                                    {{-- @can('saveStatus',$task) --}}
                                    <a href="#"
                                        class="btn btn-success btn-sm"
                                        data-toggle="modal"
                                        data-target="#edit{{ $task->id }}">{{__('Change Status')}}
                                    </a>
                                    {{-- @endcan --}}
                                    {{-- @can('view',$task) --}}
                                    <button class="btn btn-sm btn-info" onclick="window.location.href='{{ route('task.show_details', $task->id) }}'">
                                        {{ __('Show Details') }}
                                    </button> 
                                    {{-- @endcan --}}
                                    
                                </td>
                            </tr>
                            <!-- Start Modal Delete -->
                            <x-modal-component id="delete{{ $task->id }}" labelId="exampleModalLabel">
                                <form method="post" action="{{ route('tasks.destroy',$task->id) }}" class="p-6">
                                    @csrf
                                    @method('delete')
                        
                                    <h2 class="text-lg px-3 font-medium text-gray-900">
                                        {{ __('Are you sure you want to delete this task?') }}
                                    </h2>
                        
                                    <div class="mt-6 flex justify-end py-3 px-3">
                                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{__('Cancel')}}</button>

                                        <x-danger-button class="ml-3">
                                            {{ __('Delete') }}
                                        </x-danger-button>
                                    </div>
                                </form>
                            </x-modal-component>
                            <!-- End Modal Delete -->
                            <!-- Start Modal Change Status -->
                            <x-modal-component id="edit{{ $task->id }}" labelId="exampleModalLabel">
                                @include('tasks.changeStatus')
                            </x-modal-component>
                            <!-- End Modal Change Status -->
                            @empty
                            <tr>
                                <td colspan="9" class="text-center">You have no tasks.</td>
                            </tr>
                            @endforelse
                            
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $tasks->links() }}
                    </div>
                </div>
                <!-- end table -->
            </div>
        </div>
    </div>
</x-app-layout>