@php
use App\Enums\StatusEnum;
@endphp

<div class="task-status">
    @switch($status)
        @case(StatusEnum::Pending)
            <div class="flex justify-between mb-1">
                <span class="text-base font-medium text-red-700 dark:text-white">Pending</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700">
                <div class="bg-red-600 h-1.5 rounded-full" style="width: 15%"></div>
            </div>
  
            @break
        @case(StatusEnum::in_progress)
            <div class="flex justify-between mb-1">
                <span class="text-base font-medium text-blue-700 dark:text-white">Processing</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700">
                <div class="bg-blue-600 h-1.5 rounded-full" style="width: 70%"></div>
            </div>
            @break
        @case(StatusEnum::Done)
            <div class="flex justify-between mb-1">
                <span class="text-base font-medium text-green-700 dark:text-white">Done</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700">
                <div class="bg-green-600 h-1.5 rounded-full" style="width: 100%"></div>
            </div>
            @break
        @default
            <span class="badge bg-secondary text-white">Unknown</span>
    @endswitch
</div>
