<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Actions\Admins\AdminDestroy;
use App\Actions\Admins\AdminIndex;
use App\Actions\Admins\AdminLogin;
use App\Actions\Admins\AdminShow;
use App\Actions\Admins\AdminStore;
use App\Actions\Admins\AdminUpdate;
use App\Http\Requests\Admins\Admins\AdminDestroyRequest;
use App\Http\Requests\Admins\Admins\AdminStoreRequest;
use App\Http\Requests\Admins\Admins\AdminUpdateRequest;
use App\Http\Requests\Auth\AdminLoginRequest;
use App\Isap\Actions\ActionType;
use App\Models\Admin;
use App\Models\Role;
use Exception;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // ... your controller methods here
    public function index()
    {
        return $this->makeInertiaTableResponse(Admin::class, Admin::query());
    }

    public function create()
    {
        return $this->makeInertiaFormResponse(Admin::class, [], ActionType::STORE);
    }

    public function store(AdminStoreRequest $request, AdminStore $action)
    {
        try {

            $admin = $action->execute($request->validated());
            if ($admin)
            {
                toast_success(__('messages.admin.store.ok'));
                return $this->makeInertiaTableResponse(Admin::class, Admin::query());
            }

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(string $admin , AdminUpdateRequest $request, AdminUpdate $action)
    {
        try {
            $admin = $action->execute($admin, $request->validated());
            if($admin)
            {
                toast_success(__('messages.admin.update.ok'));
                return $this->makeInertiaTableResponse(Admin::class, Admin::query());
            }
        } catch (\Throwable $th) {
            toast_error(__('messages.admin.update.error').$th->getMessage());
        }

    }

    public function show(string $id)
    {
        $admin = Admin::with('roles')->findOrFail($id);
        $roles = collect($admin->roles->toArray())->map(function($role) {
            $role['name'] = Role::find($role['id'])->translated_name;
            return $role;
        });
        $admin->setRelation('roles', $roles);
        return $this->makeInertiaFormResponse(Admin::class, $admin, ActionType::SHOW);
    }

    public function edit(string $id)
    {
        try {
            $admin = Admin::with('roles')->findOrFail($id);
            $roles = collect($admin->roles->toArray())->map(function($role) {
                $role['name'] = Role::find($role['id'])->translated_name;
            return $role;
        });
        $admin->setRelation('roles', $roles);
        return $this->makeInertiaFormResponse(Admin::class, $admin, ActionType::UPDATE);
        } catch (\Throwable $th) {
            toast_error(__('messages.admin.update.error').$th->getMessage());
        }
    }

    public function destroy(string $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        return redirect()->back();
    }

    public function authenticate(AdminLoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard', absolute: false));
    }

    public function logout()
    {
        auth('admin')->logout();
        Session::flush();
        Session::put('success', 'You are logout sucessfully');
        return redirect()->intended(route('admin.login'));
    }
}
