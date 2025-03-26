<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;

class FormController extends Controller
{
    public function form(string $model) {}
    public function getMedia($model,$id,$attribute,$multiple=false)
    {
        $object = $model::findOrFail($id);
        return $object?->$attribute;
    }

}
