<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Actions\Permissions\PermissionDestroy;
use App\Actions\Permissions\PermissionIndex;
use App\Actions\Permissions\PermissionShow;
use App\Actions\Permissions\PermissionStore;
use App\Actions\Permissions\PermissionUpdate;
use App\Http\Requests\Admins\Permissions\PermissionDestroyRequest;
use App\Http\Requests\Admins\Permissions\PermissionStoreRequest;
use App\Http\Requests\Admins\Permissions\PermissionUpdateRequest;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {}
}
