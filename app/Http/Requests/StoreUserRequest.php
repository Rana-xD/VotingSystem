<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'username' => 'required|string|min:5|max:255',
            'role' => 'required|string|min:5|max:255',
            'shareholder_name' => 'nullable|string|min:5|max:255',
            'security' => 'nullable|number',
            'postal_code' => 'nullable|number|min:5',
            'address1' => 'nullable|string|min:5|max:255',
            'address2' => 'nullable|string|min:5|max:255',
        ];
    }
}
