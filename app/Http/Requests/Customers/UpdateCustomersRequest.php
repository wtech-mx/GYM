<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateCustomersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        Gate::authorize('app.users.edit');
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
            'username' => ['required', 'string', 'max:191'],
            'gender' => ['string'],
            'mobile' => ['string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers,email,'],
            'date_birth',
            'joining_date' => ['required'],
        ];
    }
}
