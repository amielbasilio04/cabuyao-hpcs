<?php

namespace App\Http\Requests\Shared\Event;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EventUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'barangay_id' => 'required|sometimes',
            'name' => ['required', 'sometimes', Rule::unique('events')->ignore($this->event)],
            'description' => 'required|sometimes',
            'location' => 'required|sometimes',
            'organizer' => 'required|sometimes',
            'contact' => 'required|sometimes',
            'time_start' => 'required|sometimes',
            'time_end' => 'required|sometimes'
        ];
    }
}
