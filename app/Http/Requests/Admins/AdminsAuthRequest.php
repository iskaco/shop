<?php

namespace App\Http\Requests\Admins;

use App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;

class AdminsAuthRequest extends FormRequest
{
    protected $action = '';

    public function authorize(): bool
    {
        try {
            /*$admin_user = Admin::findOrFail(auth('admin')->user()->id);
            if ($admin_user->hasRole('super_admin'))
                return true;
            if ($admin_user->roles->first()?->hasPermissionTo($this->action)) // $admin_user->can($this->action))
                return true;
            return false;*/
            // TODO add authorise
            if (auth('admin')->check()) {
                return true;
            }

            return false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string'],
        ];
    }
}
