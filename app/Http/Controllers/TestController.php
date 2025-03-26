<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Inertia\Inertia;
use stdClass;

class TestController extends Controller
{
    function index()
    {
        $userCols = Schema::getColumnListing('users');
        $cols = [];
        foreach ($userCols as $key => $value) {
            $col = new stdClass();
            $col->id = $key;
            $col->name = $value;
            $col->title = ucfirst($value);
            $col->sortable = true;
            array_push($cols, $col);
        }

        $rows = User::query();

        if (request('search')) {
            $rows->where('email', 'LIKE', '%' . request('search') . '%');
        }

        if (request()->has(['sort_field', 'sort_direction'])) {
            $rows->orderBy(request('sort_field'), request('sort_direction'));
        }

        return Inertia('TestView', ['cols' => $cols, 'rows' => $rows->paginate(request('perPage', 10))->withQueryString(), 'filters' => request()->all(['search', 'sort_field', 'sort_direction', 'perPage'])]);
    }
}
