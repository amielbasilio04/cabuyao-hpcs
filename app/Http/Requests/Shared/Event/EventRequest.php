<?php

namespace App\Http\Requests\Shared\Event;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'name' => 'required|sometimes|unique:events,name',
            'description' => 'required|sometimes',
            'location' => 'required|sometimes',
            'organizer' => 'required|sometimes',
            'contact' => 'required|sometimes',
            'time_start' => 'required|sometimes',
            'time_end' => 'required|sometimes'
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'The event name is already been taken',
        ];
    }
}
