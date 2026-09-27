<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check(); // Only allow authenticated users to make donations
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'amount' => 'required|numeric|min:1|max:1000000', // Maximum 1 million
            'association_id' => 'required|exists:associations,id',
        ];
    }

    public function messages(): array
    {
        return [
            'amount.required' => __('messages.amount_required'),
            'amount.min' => __('messages.amount_min'),
            'amount.max' => __('messages.amount_max'),
            'association_id.required' => __('messages.association_required'),
            'association_id.exists' => __('messages.association_invalid'),
        ];
    }
}
