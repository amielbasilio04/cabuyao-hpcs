<?php

namespace App\Http\Requests\Admin\Barangay;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BarangayAdminUpdateRequest extends FormRequest
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
        ];
    }
}
