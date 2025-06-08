<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Actions\PaymentMethods\PaymentMethodDestroy;
use App\Actions\PaymentMethods\PaymentMethodIndex;
use App\Actions\PaymentMethods\PaymentMethodShow;
use App\Actions\PaymentMethods\PaymentMethodStore;
use App\Actions\PaymentMethods\PaymentMethodUpdate;
use App\Http\Requests\Admins\PaymentMethods\PaymentMethodDestroyRequest;
use App\Http\Requests\Admins\PaymentMethods\PaymentMethodStoreRequest;
use App\Http\Requests\Admins\PaymentMethods\PaymentMethodUpdateRequest;
use App\Models\PaymentMethod;
use App\Isap\Actions\ActionType;


class PaymentMethodController extends Controller
{
    public function index(){
        return $this->makeInertiaTableResponse(PaymentMethod::class, PaymentMethod::query());

    }
    public function show($id){
        $object = PaymentMethod::findOrFail($id);

        return $this->makeInertiaFormResponse(PaymentMethod::class, $object->toFrontendArray(), ActionType::SHOW);

    }

    public function create(){
        return $this->makeInertiaFormResponse(PaymentMethod::class, [], ActionType::STORE);
    }

    public function store(){

    }
    public function update($id){

    }
    public function destroy($id){

    }
}
