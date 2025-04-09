<?php

namespace App\Actions\Specifications;

use App\Actions\BaseAction;
use App\Models\Specification;


class SpecificationStore extends BaseAction
{
    public function execute(array $data) /* return value */
    {
        $specification = Specification::create($data);

        return $specification;
    }
}
