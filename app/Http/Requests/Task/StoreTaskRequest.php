<?php

namespace App\Http\Requests\Task;

use App\Enums\PriorityEnum;
use App\Enums\StatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2048',
            'priority' => 'required|in:' . implode(',', [
                PriorityEnum::Low,
                PriorityEnum::Middle,
                PriorityEnum::High,
            ]),
            'start_date' => 'required|date|date_format:Y-m-d',
            'end_date' => 'required|date|date_format:Y-m-d',

        ];
    }
}
