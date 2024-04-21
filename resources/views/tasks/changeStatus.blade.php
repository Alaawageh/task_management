<form method="post" action="{{ route('task.save_status', $task->id) }}" class="p-6">
    @csrf
    @method('put')
    <div class="px-3 py-3">
        <x-input-label for="status" :value="__('status')" />
        <select id="status" name="status" class="mt-1 block w-full">
            @foreach (\App\Enums\StatusEnum::Labels() as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->status->get('status')" class="mt-2" />
    </div>

    <div class="mt-6 flex justify-end py-3 px-3">
        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{ __('Cancel') }}</button>
        <x-primary-button class="ml-3">
            {{ __('Save') }}
        </x-primary-button>
    </div>
</form>