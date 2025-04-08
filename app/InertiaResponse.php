<?php

namespace App;

use App\Isap\Actions\ActionType;
use App\Isap\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;
use Inertia\Inertia;

trait InertiaResponse
{
    //
    public function makeInertiaTableResponse(string $model, Builder $query)
    {
        $model_resource = $this->getModelResource($model);
        //dd($model_resource::table());
        return Inertia('TableView', ['table' => $model_resource::table(), 'rows' => $this->getData($query, $model)]);
    }

    public function makeInertiaFormResponse($model, $data, ActionType $action_type)
    {
        $model_resource = $this->getModelResource($model);
        return Inertia('FormView', ['form' => $model_resource::form($action_type), 'data' => $data]);
    }

    public function makeInertiaErrorResponse($error)
    {
        /**
         * We must implement this feature in the future.
         */
        return $error;
    }

    private function getData($query, $model)
    {
        $serchable = method_exists($model, 'getSerchable') ? $model::getSerchable() : ['name'];
        if (request('search')) {
            $search = request('search');
            $query->where(function ($q) use ($search, $model, $serchable) {
                foreach ($serchable as $field) {
                    // Check if the field actually exists in the database table
                    if (Schema::hasColumn(app($model)->getTable(), $field)) {
                        $q->orWhere($field, 'LIKE', "%{$search}%");
                    } else {
                        //Log::warning("Searchable field '$field' does not exist in table " . $model->getTable()); // Optional logging for debugging
                    }
                }
            });
        }

        if (request()->has(['sort_field', 'sort_direction'])) {
            $query->orderBy(request('sort_field'), request('sort_direction'));
        }
        $resource = false; //$this->checkResource($model);
        return  $resource ?   $resource::collection($query->paginate(request('perPage', 10))->withQueryString()) : $query->paginate(request('perPage', 10))->withQueryString();
    }

    private function getModelResource($model)
    {
        return 'App\Isap\Resources\\' . explode("\\", $model)[2] . 'Resource';
    }
    private function checkResource($model)
    {
        $resource_path = 'App\Http\Resources\Admin\\' . explode("\\", $model)[2] . 'Resource';
        if (class_exists($resource_path)) {
            return $resource_path;
        }
        return false;
    }
}
