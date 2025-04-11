<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class CustomerController extends Controller
{
    //
    public function signin() {}

    public function signup()
    {
        return Inertia::render('web/SignupView');
    }
}
