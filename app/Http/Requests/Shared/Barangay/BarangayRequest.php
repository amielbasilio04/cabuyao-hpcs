<?php

namespace App\Http\Requests\Shared\Barangay;

use Illuminate\Foundation\Http\FormRequest;

class BarangayRequest extends FormRequest
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
            'name' => ['required', 'unique:barangays'],
            'lat' => 'required',
            'long' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Barangay name has already been taken',
        ];
    }
}
