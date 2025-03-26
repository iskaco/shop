<?php

namespace App\Isap\Framework\Rules;

use Carbon\Carbon;
use Closure;
use Exception;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class RouteActionRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (substr_count($value, '@') > 1) {
            $fail('The action must contain exactly one @ .');
        }

        list($class, $method) = explode('@', $value);

        if (class_exists($class)) {
            if (!method_exists($class, $method)) {
                $fail('The action method('.$method.') does not exist.');
            }
        } else {
            $fail('The action class('.$class.') does not exist.');
        }

    }
}
