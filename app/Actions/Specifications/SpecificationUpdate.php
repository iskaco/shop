<?php

namespace App\Actions\Specifications;

use App\Actions\BaseAction;
use App\Models\Specification;
use Illuminate\Support\Facades\DB;

class SpecificationUpdate extends BaseAction
{
    public function execute(string $id,array $data) /* return value */
    {
        $specification = Specification::findOrFail($id);
        DB::beginTransaction();
        $specification->update($data);
        DB::commit();
        return $specification;
    }
}
