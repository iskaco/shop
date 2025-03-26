<?php

namespace App\Isap\Utils;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class DataUtil
{
    public function getSelectOptions(Builder $query, string $keyColumn, string $valueColumn): array
    {

        return $query->select('id','name')->get()->map(function($row) use($keyColumn,$valueColumn){
            return [
                'id' =>  $row?->$keyColumn,
                'name' => $row?->$valueColumn
            ];
        } )->toArray();
    }


    public function getOptionsForModel(Model $model, string $keyColumn, string $valueColumn, array $whereConditions = []): array
    {
        $query = $model::query();

        foreach ($whereConditions as $column => $value) {
            $query->where($column, $value);
        }
        return $this->getSelectOptions($query, $keyColumn, $valueColumn);
    }
}
