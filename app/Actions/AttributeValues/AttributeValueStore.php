<?php

namespace App\Actions\AttributeValues;

use App\Actions\BaseAction;
use App\Models\AttributeValue;

class AttributeValueStore extends BaseAction
{
    public function execute(array $data) /* return value */
    {
        return AttributeValue::create($data);
    }
}
