<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class CustomerController extends Controller
{
    //
    public function signin()
    {
        return Inertia::render('web/SigninView');
    }

    public function signup()
    {
        return Inertia::render('web/SignupView');
    }
}
