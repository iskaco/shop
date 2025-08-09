<?php

namespace App\Actions\AttributeValues;

use App\Actions\BaseAction;
use App\Models\AttributeValue;


class AttributeValueDestroy extends BaseAction
{
    public function execute(string $id) /* return value */
    {
        try {
            //code...
            $attribute_value = AttributeValue::findOrFail($id);
            $attribute_value->delete();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return false;
    }
}
