<?php

return [
    'admin' => [
        'destroy' => [
            'title' => 'آیا مطمئن هستید که می‌خواهید این رکورد را حذف کنید؟',
            'ok' => 'مدیر با موفقیت حذف شد.',
            'error' => 'خطا در حذف مدیر',
            'not_found' => 'مدیر یافت نشد',
        ],
        'store' => [
            'ok' => 'مدیر با موفقیت ایجاد شد.',
            'error' => 'خطا در ایجاد مدیر',
        ],
        'update' => [
            'ok' => 'اطلاعات با موفقیت به‌روزرسانی شد!',
            'error' => 'خطا در به‌روزرسانی اطلاعات!',
        ],
        'login' => [
            'ok' => 'ورود با موفقیت انجام شد.',
            'error' => 'خطا در ورود',
        ],
    ],
    'customer' => [
        'store' => [
            'ok' => 'حساب کاربری شما با موفقیت ایجاد شد. خوش آمدید!',
            'error' => 'خطا در ایجاد حساب کاربری. لطفاً دوباره تلاش کنید.',
        ],
        'update' => [
            'ok' => 'حساب کاربری شما با موفقیت به‌روزرسانی شد.',
            'error' => 'خطا در به‌روزرسانی حساب کاربری. لطفاً دوباره تلاش کنید.',
        ],
        'login' => [
            'ok' => 'ورود با موفقیت انجام شد. خوش آمدید!',
            'error' => 'خطا در ورود. لطفاً اطلاعات خود را بررسی کرده و دوباره تلاش کنید.',
        ],
    ],
    'cart' => [
        'checkout' => [
            'ok' => 'تسویه حساب با موفقیت انجام شد. از خرید شما متشکریم!',
            'error' => 'خطا در هنگام تسویه حساب. لطفاً دوباره تلاش کنید.',
        ],
    ],
    'order' => [
        'store' => [
            'ok' => 'سفارش شما با موفقیت ثبت شد. از خرید شما متشکریم!',
            'error' => 'خطا در ثبت سفارش. لطفاً دوباره تلاش کنید.',
        ],
    ],
    'product' => [
        'destroy' => [
            'title' => 'آیا مطمئن هستید که می‌خواهید این محصول را حذف کنید؟',
            'ok' => 'محصول با موفقیت حذف شد.',
            'error' => 'خطا در حذف محصول',
            'not_found' => 'محصول یافت نشد',
            'has_order' => 'امکان حذف محصول با سفارشات موجود وجود ندارد',
        ],
        'store' => [
            'ok' => 'محصول با موفقیت ایجاد شد.',
            'error' => 'خطا در ایجاد محصول',
        ],
        'update' => [
            'exception' => [
                'attributes' => 'خطا در همگام‌سازی ویژگی‌ها!',
            ],
            'ok' => 'محصول با موفقیت به‌روزرسانی شد.',
            'error' => 'خطا در به‌روزرسانی محصول',
        ],
        'attribute' => [
            'update' => [
                'ok' => 'ویژگی‌های محصول با موفقیت به‌روزرسانی شد.',
                'error' => 'خطا در به‌روزرسانی ویژگی‌های محصول',
            ],
        ],
        'specification' => [
            'update' => [
                'ok' => 'مشخصات محصول با موفقیت به‌روزرسانی شد.',
                'error' => 'خطا در به‌روزرسانی مشخصات محصول',
            ],
        ],
        'variant' => [
            'update' => [
                'ok' => 'تنوع محصول با موفقیت به‌روزرسانی شد.',
                'error' => 'خطا در به‌روزرسانی تنوع محصول',
            ],
        ],
    ],

    'category' => [
        'destroy' => [
            'title' => 'آیا مطمئن هستید که می‌خواهید این رکورد را حذف کنید؟',
            'ok' => 'دسته‌بندی با موفقیت حذف شد.',
            'error' => 'خطا در حذف دسته‌بندی',
            'not_found' => 'دسته‌بندی یافت نشد',
            'has_product' => 'امکان حذف دسته‌بندی با محصولات موجود وجود ندارد',
            'has_children' => 'امکان حذف دسته‌بندی با زیردسته‌ها وجود ندارد',

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
