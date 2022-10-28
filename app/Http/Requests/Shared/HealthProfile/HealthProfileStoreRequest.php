<?php

namespace App\Http\Requests\Shared\HealthProfile;

use Illuminate\Foundation\Http\FormRequest;

class HealthProfileStoreRequest extends FormRequest
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
            'resident_id' => 'required',
            'family_history_id' => 'sometimes',
            'health_issue_id' => 'required',
            'guardian' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'relationship' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'resident_id.required' => 'The resident field is required',
            'family_history_id.required' =>  'The family history field is required',
            'health_issue_id.required' =>  'The health issue field is required',
        ];
    }
}
