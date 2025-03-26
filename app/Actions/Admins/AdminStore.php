<?php

namespace App\Actions\Admins;

use App\Actions\BaseAction;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class AdminStore extends BaseAction
{
    public function execute($data) /* return value */
    {
        DB::beginTransaction();
        $admin = Admin::create($data);
        if ($data['roles'])
            foreach ($data['roles'] as $role) {
                $admin->assignRole(Role::findOrFail($role['id']));
        }
        if ($data['profile_image'])
            $admin->addMedia($data['profile_image'])->toMediaCollection('Admins.Profiles');
        DB::commit();
        return $admin;
    }
}
