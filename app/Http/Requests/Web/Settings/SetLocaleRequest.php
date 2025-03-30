<?php

namespace App\Http\Requests\Web\Settings;

use App\Rules\Locale;
use Illuminate\Foundation\Http\FormRequest;

class SetLocaleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'locale' => ['required', new Locale],
        ];
    }
}
