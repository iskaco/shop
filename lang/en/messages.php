<?php

return [
    'admin' => [
        'destroy' => [
            'title' => 'Are you sure you want to delete this record?',
            'ok' => 'Admin deleted successfully.',
            'error' => 'Error deleting admin',
            'not_found' => 'Admin not found',
        ],
        'store' => [
            'ok' => 'Admin created successfully.',
            'error' => 'Error creating admin',
        ],
        'login' => [
            'ok' => 'Login successful.',
            'error' => 'Error logging in',
        ],
    ],
    'customer' => [
        'store' => [
            'ok' => 'Your account has been created successfully. Welcome!',
            'error' => 'There was an error creating your account. Please try again.',
        ],
        'update' => [
            'ok' => 'Your account has been updated successfully.',
            'error' => 'There was an error updating your account. Please try again.',
        ],
        'login' => [
            'ok' => 'Login successful. Welcome back!',
            'error' => 'Error logging in. Please check your credentials and try again.',
        ],
    ],
    'cart' => [
        'checkout' => [
            'ok' => 'Checkout completed successfully. Thank you for your purchase!',
            'error' => 'There was an error during checkout. Please try again.',
        ],
    ],
    'order' => [
        'store' => [
            'ok' => 'Your order has been placed successfully. Thank you for your purchase!',
            'error' => 'There was an error placing your order. Please try again.',
        ],
    ],
    'product' => [
        'destroy' => [
            'title' => 'Are you sure you want to delete this record?',
            'ok' => 'Product deleted successfully.',
            'error' => 'Error deleting product',
            'not_found' => 'Product not found',
            'has_order' => 'Cannot delete product with existing orders',
        ],
        'store' => [
            'ok' => 'Product created successfully.',
            'error' => 'Error creating product',
        ],
        'update' => [
            'ok' => 'Product updated successfully.',
            'error' => 'Error updating product',
        ],
        'specification' => [
            'update' => [
                'ok' => 'Product specifications updated successfully.',
                'error' => 'Error updating product specifications',
            ],
        ],
    ],
    'category' => [
        'destroy' => [
            'title' => 'Are you sure you want to delete this record?',
            'ok' => 'Category deleted successfully.',
            'error' => 'Error deleting category',
            'not_found' => 'Category not found',
            'has_product' => 'Cannot delete category with existing products',
            'has_children' => 'Cannot delete category with subcategories',

        ],
        'store' => [
            'ok' => 'Category created successfully.',
            'error' => 'Error creating category',
        ],
        'update' => [
            'ok' => 'Category updated successfully.',
            'error' => 'Error updating category',
        ],
        'products' => [
            'error' => 'Error retrieving products. Please try again later.',
        ],
    ],
    'brand' => [
        'destroy' => [
            'title' => 'Are you sure you want to delete this record?',
            'ok' => 'Brand deleted successfully.',
            'error' => 'Error deleting brand',
            'not_found' => 'Brand not found',
            'has_product' => 'Cannot delete brand with existing products',

        ],
        'store' => [
            'ok' => 'Brand created successfully.',
            'error' => 'Error creating brand',
        ],
        'update' => [
            'ok' => 'Brand updated successfully.',
            'error' => 'Error updating brand',
        ],
    ],
    'specification' => [
        'destroy' => [
            'title' => 'Are you sure you want to delete this record?',
            'ok' => 'Specification deleted successfully.',
            'error' => 'Error deleting specification',
            'not_found' => 'Specification not found',
            'has_product' => 'Cannot delete specification with existing products',

        ],
        'store' => [
            'ok' => 'Specification created successfully.',
            'error' => 'Error creating specification',
        ],
        'update' => [
            'ok' => 'Specification updated successfully.',
            'error' => 'Error updating specification',
        ],
    ],
    'vendor' => [
        'destroy' => [
            'title' => 'Are you sure you want to delete this record?',
            'ok' => 'Vendor deleted successfully.',
            'error' => 'Error deleting vendor',
            'not_found' => 'Vendor not found',
            'has_product' => 'Cannot delete vendor with existing products',
        ],
        'store' => [
            'ok' => 'Vendor created successfully.',
            'error' => 'Error creating vendor',
        ],
        'update' => [
            'ok' => 'Vendor updated successfully.',
            'error' => 'Error updating vendor',
        ],
    ],
    'attribute' => [
        'destroy' => [
            'title' => 'Are you sure you want to delete this record?',
            'ok' => 'Attribute deleted successfully.',
            'error' => 'Error deleting attribute',
            'not_found' => 'Attribute not found',
            'has_product' => 'Cannot delete attribute with existing products',
        ],
        'store' => [
            'ok' => 'Attribute created successfully.',
            'error' => 'Error creating attribute',
        ],
        'update' => [
            'ok' => 'Attribute updated successfully.',
            'error' => 'Error updating attribute',
        ],
    ],
];
