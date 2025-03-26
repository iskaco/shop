<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Actions\Menus\MenuDestroy;
use App\Actions\Menus\MenuIndex;
use App\Actions\Menus\MenuShow;
use App\Actions\Menus\MenuStore;
use App\Actions\Menus\MenuUpdate;
use App\Http\Requests\Admins\Menus\MenuDestroyRequest;
use App\Http\Requests\Admins\Menus\MenuStoreRequest;
use App\Http\Requests\Admins\Menus\MenuUpdateRequest;
use App\Models\Menu;

class MenuController extends Controller
{
    // ... your controller methods here
    public function index(MenuIndex $action)
    {
        $this->makeInertiaTableResponse($action->execute(), Menu::class);
    }
}
