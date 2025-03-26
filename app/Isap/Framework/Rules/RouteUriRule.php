<?php

namespace App\Isap\Framework\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class RouteUriRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (preg_match('/[^a-zA-Z0-9\/\-_{}]/', $value)) {
            $fail('The route contains some invalid characters.');
        }

        if ($value === '/') {
            $fail('The route could not be / .');
        }

        if (is_numeric(substr($value, 1, 1))) {
            $fail('The route must be started with numbers.');
        }

    }
}
