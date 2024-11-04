<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'event_id' => 'integer|required', #exists:events,id
            'event_date' => 'date|required',
            'ticket_adult_price' => 'integer|required',
            'ticket_adult_quantity' => 'integer|required',
            'ticket_kid_price' => 'integer|required',
            'ticket_kid_quantity' => 'integer|required',
        ];
    }
}
