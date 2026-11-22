<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MembershipPaymentRequest extends FormRequest
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
            'membership_id' => 'required|exists:user_memberships,id',
            'photo' => 'required|image|max:2048',
            'payment_for' => 'required',
            'payment_period' => 'nullable'
        ];
    }
}
