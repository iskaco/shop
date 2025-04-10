<?php

namespace App\Http\Requests\Admins\Products;

use App\Http\Requests\Admins\AdminsAuthRequest;
use App\Models\Specification;
use Illuminate\Foundation\Http\FormRequest;

use function PHPUnit\Framework\isNumeric;

class ProductSpecificationsUpdateRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'products.specifications.update';
    }

    public function rules(): array
    {
        return [
            'specifications' => 'array',
        ];
    }

    public function prepareForValidation(): void
    {
        $specifications = [];
        foreach ($this->all() as $key => $value) {
            if (is_numeric($key) && $value !== null) {
                $specifications[] = ['specification_id' => $key, 'value' => $value];
            }
        }
        $this->merge(['specifications' => $specifications]);
    }
}
