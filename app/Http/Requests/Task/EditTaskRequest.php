<?php

namespace App\Http\Requests\Task;

use App\Enums\PriorityEnum;
use Illuminate\Foundation\Http\FormRequest;

class EditTaskRequest extends FormRequest
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
            'title' => 'string|max:255',
            'description' => 'nullable|string|max:2048',
            'priority' => 'in:' . implode(',', [
                PriorityEnum::Low,
                PriorityEnum::Middle,
                PriorityEnum::High,
            ]),
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }
}
