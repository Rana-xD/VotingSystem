<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMeetingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|min:5|max:255',
            'company_name' => 'string|min:5,max:255|nullable',
            'logo' => 'string|nullable',
            'date_of_meeting' => 'date|nullable',
            'expired_date' => 'date|different:date_of_meeting|nullable',
            'location' => 'string|nullable',
            'document' => 'json|nullable',
            'content' => 'string',
        ];
    }
}
