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
    'product' => [
        'destroy' => [
            'title' => 'Are you sure you want to delete this record?',
            'ok' => 'Product deleted successfully.',
            'error' => 'Error deleting product',
            'not_found' => 'Product not found',
        ],
        'store' => [
            'ok' => 'Product created successfully.',
            'error' => 'Error creating product',
        ],
    ],
    'category' => [
        'destroy' => [
            'title' => 'Are you sure you want to delete this record?',
            'ok' => 'Category deleted successfully.',
            'error' => 'Error deleting category',
            'not_found' => 'Category not found',
        ],
        'store' => [
            'ok' => 'Category created successfully.',
            'error' => 'Error creating category',
        ],
    ],
];
