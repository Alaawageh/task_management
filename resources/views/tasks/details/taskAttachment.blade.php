<div class="mt-1 text-left">
    <p class="text-xl font-bold py-3">Attachments</p>
        @forelse ($task->attachments as $attachment)
        <div class="flex gap-4">
            @if (Str::contains($attachment->file,'.pdf'))
                <div class="grid grid-cols-5 gap-4">
                    <img alt="file" src="#" class="h-auto py-3 max-w-full rounded-lg">
                    <a href="{{ asset($attachment->file) }}" target="_blank" class="p-3">
                        Click To show file
                    </a>
                </div>
            @else
                <div class="grid grid-cols-5 gap-4">
                    
                    <img src="{{ asset($attachment->file) }}" class="h-auto py-3 max-w-full rounded-lg">
                    
                </div>
                <div class="text-right flex-shrink-0">
                    <a href="{{ asset($attachment->file) }}" class="text-right" download>Download</a>
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
            @endif
        </div>   
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