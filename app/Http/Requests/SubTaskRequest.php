<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'task_id' => 'required|exists:tasks,id',
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|string|in:todo,ongoing,done,canceled',
            'priority' => 'required|integer|in:0,1,2,3,4',
            'due_date' => 'nullable|date',
        ];
    }
}
