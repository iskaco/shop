<?php

namespace App\Http\Requests\Admins\Admins;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class AdminUpdateRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'admins.update';
    }

    public function rules(): array
    {
        return [
            'email' => ['nullable', 'email', 'min:3', 'max:100', Rule::unique('admins')->where(function ($query) {
                $query->whereNull('deleted_at');
            })->ignore($this->route('admin'))],
            'mobile' => ['nullable', 'string', 'max:15', Rule::unique('admins')->where(function ($query) {
                $query->whereNull('deleted_at');
            })->ignore($this->route('admin'))],
            'password' => ['nullable', 'string', 'min:6', 'max:15', 'confirmed'],
            'first_name' => ['string', 'min:2', 'max:50'],
            'last_name' => ['string', 'min:2', 'max:50'],
            'enable' => ['boolean'],
            'profile_image' => ['nullable', 'mimes:jpg,png,jpeg', 'image', 'max:300'],
            'roles' => ['nullable', 'array'],
        ];
    }
}
