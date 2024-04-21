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