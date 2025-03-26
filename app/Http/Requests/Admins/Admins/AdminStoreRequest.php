<?php

namespace App\Http\Requests\Admins\Admins;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class AdminStoreRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'admins.store';
    }

    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'min:3', 'max:100', Rule::unique('admins')->where(function ($query) {
                $query->whereNull('deleted_at');
            })],
            'email' => ['nullable', 'email', 'min:3', 'max:100', Rule::unique('admins')->where(function ($query) {
                $query->whereNull('deleted_at');
            })],
            'mobile' => ['nullable', 'string', 'max:15', Rule::unique('admins')->where(function ($query) {
                $query->whereNull('deleted_at');
            })],
            'password' => ['string', 'min:6', 'max:15', 'confirmed'],
            'first_name' => ['string', 'min:2', 'max:50'],
            'last_name' => ['string', 'min:2', 'max:50'],
            'enable' => ['boolean'],
            'profile_image' => ['nullable', 'mimes:jpg,png,jpeg', 'image', 'max:2024'],
            'roles' => ['nullable', 'array'],

        ];
    }
}
