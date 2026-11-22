<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventEditRequest extends FormRequest
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

            'name' => 'required',
            'description' => 'nullable',
            'rundown' => 'nullable',
            'category' => 'nullable',
            'photos' => 'image|mimes:png,jpg,jpeg',
            'location' => 'required',
            'price' => 'required|numeric',
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date',
            'chapter_id' => 'required|exists:chapters,id',
        ];
    }
}
