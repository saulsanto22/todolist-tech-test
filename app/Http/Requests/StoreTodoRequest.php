<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {return true; }

   public function rules(): array {
        return [
            'title' => 'required|string|max:255',
            'assignee' => 'nullable|string|max:255',
            'due_date' => 'required|date|after_or_equal:today',
            'time_tracked' => 'nullable|integer|min:0',
            'status' => 'nullable|in:pending,open,in_progress,completed',
            'priority' => 'required|in:low,medium,high',
        ];
    }
    public function messages(): array {
        return ['due_date.after_or_equal'=>'Due date cannot be in the past.'];
    }
}
