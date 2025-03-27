<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;

class TableController extends Controller
{
    public function table(string $model) {}

    public function getMedia($model, $id, $attribute, $multiple = false)
    {
        $object = $model::findOrFail($id);
        if (! $object->$attribute) {
            $filePath = public_path('/images/person.jpeg');
            $media = response()->file($filePath);

            return $media;
        }

        return $object?->$attribute;
    }
}
