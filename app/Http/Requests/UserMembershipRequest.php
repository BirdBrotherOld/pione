<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserMembershipRequest extends FormRequest
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
            'ktp_num' => 'required',
            'born_location' => 'required|string',
            'born_date' => 'required|date|before:today',
            'nickname' => 'required|string',
            'gender' => 'required',
            'religion' => 'required',
            'size' => 'required',
            'address' => 'required|string',
            'city' => 'nullable',
            'province' => 'nullable',
            'police_num' => 'required',
            'type' => 'required',
            'color' => 'required',
            'year_production' => 'required',
            'chapter_id' => 'required|exists:chapters,id',
            'photo_car' => 'image',
            'photo_identity' => 'image',
            'photo_license' => 'image',
            'vehicle_tax' => 'nullable|date',
            'alias' => 'nullable',
            'id_member' => 'nullable',
        ];
    }
}
