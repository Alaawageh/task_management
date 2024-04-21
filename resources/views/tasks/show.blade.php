<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Show Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="p-10 text-gray-900">
                  <div class="py-6">
                    <div class="flex gap-6 justify-between">
                        <div>
                            <p class="text-xl font-bold py-3">{{ $task->title }}</p>
                            <p class="text-sm py-2">{{ $task->description }}</p>

                            <x-task-status :status="$task->status"/>
                            <h2 class="text-lg font-bold py-3">Users:</h2>
                            <div class="flex table-row">
                                @foreach($task->users as $user)
                                <span class="inline-block px-3 bg-gray-200">{{ $user->name }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <p class="text-lg font-bold py-2">From Date: {{ $task->start_date->format('Y-m-d') }}</p>
                            <p class="text-sm">To Date: {{ $task->end_date->format('Y-m-d') }}</p>
                            <p class="text-sm">Created Task By: {{ $task->createdBy->name }}</p>
                            
                        </div>
                    </div>
                    <div class="w-2/3 py-3">
                        <div class="relative right-0">
                            <x-tabs>
                            
                            </x-tabs>
                            <div data-tab-content="" class="px-5">
                                <div class="block opacity-100" id="commentsContent" role="tabpanel">
                                    @include('tasks.details.taskComment')
                                </div>
                                <div class="hidden opacity-0" id="attachmentsContent" role="tabpanel">
                                    @include('tasks.details.taskAttachment')
                                </div>
                            </div>
                        </div>
                        {{-- <div class="relative right-0">
                          <ul
                            class="custom-tabs relative flex flex-wrap p-1 list-none rounded-xl bg-blue-gray-50/60"
                            data-tabs="tabs"
                            role="list">
                            <li class="z-30 flex-auto text-center">
                                <a
                                class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg cursor-pointer text-slate-700 bg-inherit"
                                data-tab-target="comments"
                                role="tab"
                                aria-selected="true"
                                aria-controls="comments"
                                >
                                    <span class="ml-1">Comments</span>
                                </a>
                            </li>
                            <li class="z-30 flex-auto text-center">
                                <a
                                class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg cursor-pointer text-slate-700 bg-inherit"
                                data-tab-target="attachments"
                                role="tab"
                                aria-selected="false"
                                aria-controls="attachments"
                                >
                                    <span class="ml-1">Attachments</span>
                                </a>
                            </li>
                          </ul>
                            <div data-tab-content="" class="px-5">
                                <div class="block opacity-100" id="commentsContent" role="tabpanel">
                                    <div class="mt-1 text-left">
                                        <p class="text-xl font-bold py-3">Comments</p>
                                        @forelse ($task->comments as $comment)
                                        <div class="flex gap-6 justify-between">
                                            <div>
                                                <p class="text-sm font-bold py-3">{{ $comment->content }}</p>
                                                <p class="text-sm">Posted by: {{ $comment->user->name }}</p>
                                            </div>
                                            <div class="text-right flex-shrink-0">
                                                <p class="text-sm font-bold py-3">{{ $comment->created_at->format('Y-m-d') }}</p>
                                                @can('delete',$comment)
                                                <form method="POST" action="{{route('comments.destroy', $comment)}}">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" value="{{$comment->id}}" class="btn btn-sm btn-danger">
                                                        {{__('Delete')}}
                                                    </button>
                                                </form>
                                                @endcan
                                            </div>
                                        </div>
                                        @empty
                                            <p>No comments yet.</p>
                                        @endforelse
                                    
                                    </div>
                                    <div class="mt-1 text-left py-6">
                                        <p class="text-sm font-bold">Add Comment</p>
                                        <form action="{{ route('comments.store') }}" method="post" class="mt-6 space-y-6">
                                            @csrf
                                            <input type="hidden" name="task_id" value="{{ $task->id }}" />
                                            <x-input-label for="content" :value="__('Comment')" />
                                            <textarea id="content" name="content" class="mt-1 block w-full"></textarea>
                                            <x-input-error :messages="$errors->content->get('content')" class="mt-2" />
                                            <x-primary-button>{{ __('Submit') }}</x-primary-button>
                                        </form>
                                    </div>
                                </div>
                                <div class="hidden opacity-0" id="attachmentsContent" role="tabpanel">
                                    <div class="mt-1 text-left">
                                        <p class="text-xl font-bold py-3">Attachments</p>
                                        @forelse ($task->attachments as $attachment)
                                        @if (Str::contains($attachment->file,'.pdf'))
                                        <div class="flex gap-6 justify-between">
                                            <div>
                                                <img alt="file" src="#" class="w-0">
                                                <a href="{{ asset($attachment->file) }}" target="_blank" class="p-3">
                                                    Click To show file
                                                </a>
                                            </div>
                                        </div>   
                                        @else
                                        <div class="flex gap-6 justify-between">
                                            <div>
                                                <img src="{{ asset($attachment->file) }}" class="w-60 h-40">
                                                <a href="{{ asset($attachment->file) }}" download>Download</a>
                                                @can('delete',$attachment)
                                                <form method="POST" action="{{route('attachments.destroy', $attachment)}}">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" value="{{$attachment->id}}" class="btn btn-sm btn-danger">
                                                        {{__('Delete')}}
                                                    </button>
                                                </form>
                                                @endcan
                                            </div>
                                        </div>
                                        @endif
                                        @empty
                                            <p>No Attachments yet.</p>
                                        @endforelse
                                    
                                    </div>
                                    <div class="mt-1 text-left py-6">
                                        <p class="text-sm font-bold">Add attachment</p>
                                        <form action="{{ route('attachments.store') }}" method="post" class="mt-6 space-y-6" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="task_id" value="{{ $task->id }}" />
                                            <x-file-input id="file" label="Upload File" name="file" />
                                            <x-input-error :messages="$errors->file->get('file')" class="mt-2" />
                                            <x-primary-button>{{ __('Submit') }}</x-primary-button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>