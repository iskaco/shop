<?php

namespace App\Actions\Activities;

use App\Actions\BaseAction;
use App\Models\Activity;
use App\Models\Permission;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ActivityStore extends BaseAction
{
    public const ACTION_STR = 'App\\Http\\Controllers\\Admins\\{singularName}Controller@{actionName}';

    public function execute(array $data) 
    {
        $newActivity = null;

        $validator = Validator::make($data, ActivityValidationRules::storeRules());
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        try {
            DB::beginTransaction();
            $permission = Permission::create(['name' => $data['name'], 'guard_name' => 'admin']);
            $newActivity = Activity::create(
                array_merge($data, ['permission_id' => $permission->id])
            );
            DB::commit();
        } catch (Exception $exp) {
            DB::rollBack();
        }

        return $newActivity;
    }
}
