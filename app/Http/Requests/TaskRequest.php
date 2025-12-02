<?php

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
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
            "title" => [
                "required",
                "string",
                "max:200"
            ],
            "deadline" => [
                "nullable",
                "date"
            ],
            "assigned_user_id" => [
                "required",
                Rule::exists("users", "id")
            ],
            "status" => [
                "nullable",
                Rule::in([
                    Task::STATUS_OPEN,
                    Task::STATUS_IN_PROGRESS,
                    Task::STATUS_DONE
                ])
            ]
        ];
    }

    public function getTaskPayload()
    {
        return collect($this->validated())
            ->merge([
                "status" => $this->status ?? Task::STATUS_OPEN
            ])
            ->toArray();
    }
}
