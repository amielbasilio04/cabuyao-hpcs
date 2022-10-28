<?php

namespace App\Http\Requests\Shared\Resident;

use Illuminate\Foundation\Http\FormRequest;

class ResidentStoreRequest extends FormRequest
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
            'fname' => 'required',
            'mname' => 'required',
            'lname' => 'required',
            'suffix' => 'required',
            'gender' => 'required',
            'birthdate' => 'required',
            'address' => 'required',
            'barangay_id' => 'required|sometimes',
            'contact' => 'required',
            'email' => 'required|unique:users,email',
        ];
    }
}
