<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Actions\Products\ProductDestroy;
use App\Actions\Products\ProductIndex;
use App\Actions\Products\ProductShow;
use App\Actions\Products\ProductStore;
use App\Actions\Products\ProductUpdate;
use App\Http\Requests\Admins\Products\ProductDestroyRequest;
use App\Http\Requests\Admins\Products\ProductStoreRequest;
use App\Http\Requests\Admins\Products\ProductUpdateRequest;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        return $this->makeInertiaTableResponse(Product::class, Product::query());
    }
    public function show($id){

    }
    public function store(){

    }
    public function update($id){

    }
    public function destroy($id){

    }
}
