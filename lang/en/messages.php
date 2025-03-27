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
        'destroy' => ['title' => 'Are you sure you want to delete this record?',
            'ok' => 'Product deleted successfully.',
            'error' => 'Error deleting product',
            'not_found' => 'Product not found',
        ],
        'store' => [
            'ok' => 'Product created successfully.',
            'error' => 'Error creating product',
        ],
    ],
];
