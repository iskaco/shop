<?php

namespace App\Actions\Admins;

use App\Actions\BaseAction;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class AdminUpdate extends BaseAction
{
    public function execute(string $id, array $data) /* return value */
    {
        $admin = Admin::findOrFail($id);
        DB::beginTransaction();
        $admin->update($data);
        /* if ($data['roles'])
            $admin->syncRoles($data['roles']); */

        /* if ($data['profile_image'])
        {
            $admin->clearMediaCollection('Admins.Profiles');
            $admin->addMedia($data['profile_image'])->toMediaCollection('Admins.Profiles');
        }
 */
        DB::commit();
        return $admin;
    }
}
