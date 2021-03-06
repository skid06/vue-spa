<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required|min:3",
            "status" => "required|min:4",
            "contact_name" => "required|min:3",
            "contact_phone" => "required|min:10",
            "website" => "required|url",
            "cost" => "required|numeric"
        ];
    }
}
