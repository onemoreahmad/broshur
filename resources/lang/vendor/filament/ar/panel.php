<?php

return [
    'auth' => [
        'login' => [
            'title' => 'تسجيل الدخول',
            'heading' => 'تسجيل الدخول',
            'actions' => [
                'register' => [
                    'before' => 'أو',
                    'label' => 'إنشاء حساب جديد',
                ],
                'request_password_reset' => [
                    'label' => 'نسيت كلمة المرور؟',
                ],
            ],
            'form' => [
                'email' => [
                    'label' => 'البريد الإلكتروني',
                ],
                'password' => [
                    'label' => 'كلمة المرور',
                ],
                'remember' => [
                    'label' => 'تذكرني',
                ],
                'actions' => [
                    'authenticate' => [
                        'label' => 'تسجيل الدخول',
                    ],
                ],
            ],
            'notifications' => [
                'throttled' => [
                    'title' => 'محاولات تسجيل دخول كثيرة جداً',
                    'body' => 'يرجى المحاولة مرة أخرى بعد :seconds ثانية.',
                ],
            ],
        ],
    ],
    'pages' => [
        'dashboard' => [
            'title' => 'لوحة التحكم',
        ],
    ],
    'resources' => [
        'pages' => [
            'create_record' => [
                'title' => 'إنشاء :label',
            ],
            'edit_record' => [
                'title' => 'تعديل :label',
            ],
            'list_records' => [
                'title' => ':label',
            ],
            'view_record' => [
                'title' => 'عرض :label',
            ],
        ],
    ],
    'widgets' => [
        'account' => [
            'actions' => [
                'logout' => [
                    'label' => 'تسجيل الخروج',
                ],
            ],
        ],
    ],
];

