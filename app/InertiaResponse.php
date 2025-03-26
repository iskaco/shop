<?php

namespace App;

use App\Isap\Actions\ActionType;
use App\Isap\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Inertia\Inertia;

trait InertiaResponse
{
    //
    public function makeInertiaTableResponse(string $model, Builder $query)
    {
        $model_resource = $this->getModelResource($model);
        //dd($model_resource::table());
        return Inertia('TableView', ['table' => $model_resource::table(), 'rows' => $this->getData($query)]);
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

    private function getData($query)
    {

        if (request('search')) {
            $query->where('email', 'LIKE', '%' . request('search') . '%');
        }

        if (request()->has(['sort_field', 'sort_direction'])) {
            $query->orderBy(request('sort_field'), request('sort_direction'));
        }

        return $query->paginate(request('perPage', 10))->withQueryString();
    }

    private function getModelResource($model)
    {
        return 'App\Isap\Resources\\' . explode("\\", $model)[2] . 'Resource';
    }
}
