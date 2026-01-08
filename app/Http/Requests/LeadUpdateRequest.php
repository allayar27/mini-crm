<?php

namespace App\Http\Requests;

use App\Enums\LeadStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LeadUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'full_name' => ['sometimes','string'],
            'phone' => ['sometimes', 'min:7', Rule::unique('leads', 'phone')->ignore($this->route('lead'))],
            'status' => ['sometimes', Rule::enum(LeadStatus::class)],
            'note' => ['nullable']
        ];
    }

    public function messages(): array
    {
        return [
            'phone.unique' => 'Этот номер телефона уже используется.',
            'phone.min' => 'Введите корректный номер телефона.',
        ];
    }
}
