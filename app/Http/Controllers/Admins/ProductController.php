<?php

namespace App\Http\Controllers\Admins;

use App\Actions\Products\ProductAttributesUpdate;
use App\Actions\Products\ProductDestroy;
use App\Actions\Products\ProductSpecificationsUpdate;
use App\Actions\Products\ProductStore;
use App\Actions\Products\ProductUpdate;
use App\Actions\Products\ProductVariantsUpdate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\Products\ProductAttributesUpdateRequest;
use App\Http\Requests\Admins\Products\ProductDestroyRequest;
use App\Http\Requests\Admins\Products\ProductSpecificationsUpdateRequest;
use App\Http\Requests\Admins\Products\ProductStoreRequest;
use App\Http\Requests\Admins\Products\ProductUpdateRequest;
use App\Http\Requests\Admins\Products\ProductVariantsUpdateRequest;
use App\Isap\Actions\ActionType;
use App\Models\Product;
use stdClass;

class ProductController extends Controller
{
    public function index()
    {
        // dd(request()->cookie('locale'));

        return $this->makeInertiaTableResponse(Product::class, Product::query());
    }

    public function create()
    {
        return $this->makeInertiaFormResponse(Product::class, [], ActionType::STORE);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return $this->makeInertiaFormResponse(Product::class, $product->toFrontendArray(), ActionType::SHOW);
    }

    public function store(ProductStoreRequest $request, ProductStore $action)
    {
        try {
            if ($action->execute($request->validated()) == null) {
                toast_error(__('messages.product.store.error'));
            } else {
                toast_success(__('messages.product.store.ok'));

                return redirect()->route('admin.products');
            }

            // return $this->makeInertiaTableResponse(Product::class, Product::query());
        } catch (\Throwable $th) {
            // dd($th);
            toast_error(__('messages.product.store.error').$th->getMessage());
        }
    }

    public function edit(string $id)
    {
        // dd(Product::findOrFail($id)->load(['attributes_id'])->toFrontendArray());

        return $this->makeInertiaFormResponse(Product::class, Product::findOrFail($id)->load(['attributes_id'])->toFrontendArray(), ActionType::UPDATE);
    }

    public function update(ProductUpdateRequest $request, ProductUpdate $action, string $id)
    {
        try {
            if (! $action->execute($id, $request->validated())) {
                toast_error(__('messages.product.update.error'));
            } else {
                toast_success(__('messages.product.update.ok'));

                return redirect()->route('admin.products');
            }

            // return $this->makeInertiaTableResponse(Product::class, Product::query());
        } catch (\Throwable $th) {
            toast_error(__('messages.product.update.error').$th->getMessage());
        }
    }

    public function destroy(ProductDestroyRequest $request, ProductDestroy $action, $id)
    {
        try {
            $error_message = $action->execute($id);
            if (! $error_message) {
                toast_success(__('messages.product.destroy.ok'));
            } else {
                toast_error($error_message);
            }
        } catch (\Throwable $th) {
            toast_error(__('messages.product.destroy.error'));
        }

        return redirect()->route('admin.products');

        //        return $this->makeInertiaTableResponse(Product::class, Product::query());
    }

    public function specifications($id)
    {
        $product = Product::findOrFail($id);
        $specification = $this->createDataForSpecifiactionForm($product);
        $category = $product?->category;
        $category_sepecification = $category?->specifications;
        $components_array = $this->createComponentArrayOfSpecifications($category_sepecification);

        // dd($specification);
        return $this->InertiaResponse($this->createDynamicResourceForm($components_array, ActionType::UPDATE, __('resources.product.specifications', ['label' => $product?->name]), 'product.specifications.update'), $specification);
    }

    public function updateSpecifications(ProductSpecificationsUpdateRequest $request, ProductSpecificationsUpdate $action, $id)
    {
        $action->execute($request->validated(), $id);
        toast_success(__('messages.product.specification.update.ok'));

        return redirect()->route('admin.products');

    }

    public function attributes($id)
    {
        $product = Product::findOrFail($id);
        $attribute = $this->createDataForAttributeForm($product);
        // dd($attribute);
        $component_array = $this->createComponentArrayOfAttributes($product->attributes_id);

        return $this->InertiaResponse($this->createDynamicResourceForm($component_array, ActionType::UPDATE, __('resources.product.attributes', ['label' => $product?->name]), 'product.attributes.update'), $attribute);
    }

    public function updateAttributes(ProductAttributesUpdateRequest $request, ProductAttributesUpdate $action, string $id)
    {
        try {
            $action->execute($request->validated(), $id);
            toast_success(__('messages.product.attribute.update.ok'));

            return redirect()->route('admin.products');
        } catch (\Throwable $th) {
            // throw $th;
            // dd($th);
            toast_error(__('messages.product.attribute.update.error'));

        }
    }

    public function variants($id)
    {
        $product = Product::findOrFail($id);
        $variant = $this->createDataForVariantForm($product);
        // dd($attribute);
        $component_array = $this->createComponentArrayOfVariant($product?->variants);

        return $this->InertiaResponse($this->createDynamicResourceForm($component_array, ActionType::UPDATE, __('resources.product.variants', ['label' => $product?->name]), 'product.variants.update'), $variant);

    }

    public function updateVariants(ProductVariantsUpdateRequest $request, ProductVariantsUpdate $action, $id)
    {
        dd($request->validated());
    }

    // ==== Private Methods
    private function createComponentArrayOfVariant($variants): array
    {
        $variant_list = [];
        foreach ($variants as $variant) {
            $variant_list[] = [
                'name' => 'price_factor_'.$variant?->id,
                'title' => __('resources.product_variant.price_factor').'_'.$variant?->sku,
                'input_type' => 'text',
            ];
            $variant_list[] = [
                'name' => 'stock_'.$variant?->id,
                'title' => __('resources.product_variant.stock').'_'.$variant?->sku,
                'input_type' => 'number',
            ];
            $variant_list[] = [
                'name' => 'stock_zone'.$variant?->id,
                'title' => __('resources.product_variant.stock_zone').'_'.$variant?->sku,
                'input_type' => 'text',
            ];
            $variant_list[] = [
                'name' => 'barcode_'.$variant?->id,
                'title' => __('resources.product_variant.barcode').'_'.$variant?->sku,
                'input_type' => 'text',
            ];
        }

        return $variant_list;
    }

    private function createDataForVariantForm(Product $product)
    {
        $variant_list = new stdClass;
        $variant_list->id = $product?->id;
        foreach ($product?->variants as $variant) {
            // $variant_list->{'sku_'.$variant?->id} = $variant?->sku;
            $variant_list->{'price_factor_'.$variant?->id} = $variant?->price_factor;
            $variant_list->{'stock_'.$variant?->id} = $variant?->stock;
            $variant_list->{'stock_zone_'.$variant?->id} = $variant?->stock_zome;
            $variant_list->{'barcode_'.$variant?->id} = $variant?->barcode;
        }

        return $variant_list;
    }

    private function createDataForAttributeForm(Product $product)
    {

        $attribute_list = new stdClass;
        $attribute_list->id = $product->id;
        $attribute_value_stack = [];
        foreach ($product?->variants as $vriant) {
            foreach ($vriant->variant_values as $variant_value) {
                if (! in_array($variant_value?->attribute_value?->id, $attribute_value_stack)) {
                    $attribute_list->{$variant_value?->attribute_value?->attribute?->id}[] = ['id' => $variant_value?->attribute_value?->id, 'name' => $variant_value?->attribute_value?->value];
                    array_push($attribute_value_stack, $variant_value?->attribute_value?->id);
                }
            }
        }

        return $attribute_list;
    }

    private function createComponentArrayOfAttributes($attributes): array
    {
        $attribute_list = [];
        foreach ($attributes as $attribute) {
            $attribute_list[] = [
                'name' => $attribute->id,
                'title' => $attribute->name,
                'input_type' => 'select',
                'src' => $this->getAttributeValues($attribute),
                'multiple' => true,
            ];
        }

        return $attribute_list;
    }

    private function getAttributeValues($attribute)
    {
        $attribute_list = [];
        foreach ($attribute?->attribute_values as $value) {
            $attribute_list[] = [
                'id' => $value->id,
                'name' => $value->value,
            ]; // code...
        }

        return $attribute_list;

    }

    private function createDataForSpecifiactionForm(Product $product)
    {
        $specification_list = new stdClass;
        $specification_list->id = $product->id;
        foreach ($product?->specifications as $specification) {
            $specification_list->{$specification?->id} = $specification?->pivot?->value;
            // $specification_list[] = $temp;
        }

        return $specification_list;
    }

    private function createComponentArrayOfSpecifications($specifications): array
    {
        $specification = [];
        foreach ($specifications as $spec) {
            $specification[] = [
                'name' => $spec->id,
                'title' => $spec->name,
                'input_type' => $spec->input_type,
                'src' => $spec->possible_values,
                'multiple' => false,
            ];
        }

        return $specification;
    }
}
