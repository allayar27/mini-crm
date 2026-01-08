<?php

namespace App\Http\Requests;

use App\Enums\LeadStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LeadStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required','string', 'min:3'],
            // 'phone' => ['required','string', 'min:7', Rule::unique('leads', 'phone'), 'phone:UZ'],
            'phone' => ['required','string', 'min:7', Rule::unique('leads', 'phone')],
            'status' => ['required', Rule::enum(LeadStatus::class)],
            'note' => ['nullable']
        ];
    }

    public function messages(): array
    {
        return [
            'phone.required' => 'Телефон обязателен.',
            'phone.unique' => 'Этот номер телефона уже используется.',
            'phone.min' => 'Введите корректный номер телефона',
            // 'phone.phone' => 'Введите корректный номер телефона (пример: +998901234567)',
        ];
    }
}
