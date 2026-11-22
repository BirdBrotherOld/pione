<?php

namespace App\Http\Requests;

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
        $event = 'nullable';
        if ($this->is_comingsoon == 0) {
            $event = 'required';
        }

        return [
            'name' => 'required',
            'description' => 'nullable',
            'rundown' => 'nullable',
            'category' => 'nullable',
            'photos' => 'required|image',
            'location' => 'required',
            'price' => 'required|numeric',
            'start_date' => $event . '|date|before:end_date',
            'end_date' => $event . '|date|after:start_date',
            'chapter_id' => 'required|exists:chapters,id',
            'is_comingsoon' => 'boolean'
        ];
    }
}
