<?php

return [
    'components' => [
        'builder' => [
            'actions' => [
                'clone' => [
                    'label' => 'نسخ',
                ],
                'add' => [
                    'label' => 'إضافة إلى :label',
                ],
                'add_between' => [
                    'label' => 'إضافة بين',
                ],
                'delete' => [
                    'label' => 'حذف',
                ],
                'reorder' => [
                    'label' => 'نقل',
                ],
                'edit' => [
                    'label' => 'تعديل',
                ],
                'collapse' => [
                    'label' => 'طي',
                ],
                'expand' => [
                    'label' => 'توسيع',
                ],
                'collapse_all' => [
                    'label' => 'طي الكل',
                ],
                'expand_all' => [
                    'label' => 'توسيع الكل',
                ],
            ],
        ],
        'checkbox_list' => [
            'actions' => [
                'deselect_all' => [
                    'label' => 'إلغاء تحديد الكل',
                ],
                'select_all' => [
                    'label' => 'تحديد الكل',
                ],
            ],
        ],
        'file_upload' => [
            'editor' => [
                'actions' => [
                    'cancel' => [
                        'label' => 'إلغاء',
                    ],
                    'drag_crop' => [
                        'label' => 'وضع السحب "السحب للقص"',
                    ],
                    'drag_move' => [
                        'label' => 'وضع السحب "السحب للتحريك"',
                    ],
                    'flip_horizontal' => [
                        'label' => 'قلب الصورة أفقياً',
                    ],
                    'flip_vertical' => [
                        'label' => 'قلب الصورة عمودياً',
                    ],
                    'move_down' => [
                        'label' => 'تحريك لأسفل',
                    ],
                    'move_left' => 'تحريك لليسار',
                    'move_right' => [
                        'label' => 'تحريك لليمين',
                    ],
                    'move_up' => [
                        'label' => 'تحريك لأعلى',
                    ],
                    'reset' => [
                        'label' => 'إعادة تعيين',
                    ],
                    'rotate_left' => [
                        'label' => 'تدوير لليسار',
                    ],
                    'rotate_right' => [
                        'label' => 'تدوير لليمين',
                    ],
                    'save' => [
                        'label' => 'حفظ',
                    ],
                    'zoom_100' => [
                        'label' => 'تكبير إلى 100%',
                    ],
                    'zoom_in' => [
                        'label' => 'تكبير',
                    ],
                    'zoom_out' => [
                        'label' => 'تصغير',
                    ],
                ],
                'fields' => [
                    'height' => [
                        'label' => 'الارتفاع',
                        'unit' => 'px',
                    ],
                    'rotation' => [
                        'label' => 'الدوران',
                        'unit' => 'deg',
                    ],
                    'width' => [
                        'label' => 'العرض',
                        'unit' => 'px',
                    ],
                    'x' => [
                        'label' => 'X',
                        'unit' => 'px',
                    ],
                    'y' => [
                        'label' => 'Y',
                        'unit' => 'px',
                    ],
                ],
                'aspect_ratios' => [
                    'label' => 'نسب العرض إلى الارتفاع',
                    'no_fixed' => [
                        'label' => 'حر',
                    ],
                ],
            ],
        ],
        'key_value' => [
            'actions' => [
                'add' => [
                    'label' => 'إضافة صف',
                ],
                'delete' => [
                    'label' => 'حذف صف',
                ],
                'reorder' => [
                    'label' => 'إعادة ترتيب الصف',
                ],
            ],
            'fields' => [
                'key' => [
                    'label' => 'المفتاح',
                ],
                'value' => [
                    'label' => 'القيمة',
                ],
            ],
        ],
        'markdown_editor' => [
            'toolbar_buttons' => [
                'attach_files' => 'إرفاق ملفات',
                'blockquote' => 'اقتباس',
                'bold' => 'عريض',
                'bullet_list' => 'قائمة نقطية',
                'code_block' => 'كود',
                'heading' => 'عنوان',
                'italic' => 'مائل',
                'link' => 'رابط',
                'ordered_list' => 'قائمة مرقمة',
                'redo' => 'إعادة',
                'strike' => 'خط في المنتصف',
                'table' => 'جدول',
                'undo' => 'تراجع',
            ],
        ],
        'repeater' => [
            'actions' => [
                'add' => [
                    'label' => 'إضافة إلى :label',
                ],
                'add_between' => [
                    'label' => 'إضافة بين',
                ],
                'delete' => [
                    'label' => 'حذف',
                ],
                'clone' => [
                    'label' => 'نسخ',
                ],
                'reorder' => [
                    'label' => 'نقل',
                ],
                'collapse' => [
                    'label' => 'طي',
                ],
                'expand' => [
                    'label' => 'توسيع',
                ],
                'collapse_all' => [
                    'label' => 'طي الكل',
                ],
                'expand_all' => [
                    'label' => 'توسيع الكل',
                ],
            ],
        ],
        'rich_editor' => [
            'dialogs' => [
                'link' => [
                    'actions' => [
                        'link' => [
                            'label' => 'ربط',
                        ],
                        'unlink' => [
                            'label' => 'فك الربط',
                        ],
                    ],
                    'label' => 'الرابط',
                    'placeholder' => 'أدخل رابط',
                ],
            ],
            'toolbar_buttons' => [
                'attach_files' => 'إرفاق ملفات',
                'blockquote' => 'اقتباس',
                'bold' => 'عريض',
                'bullet_list' => 'قائمة نقطية',
                'code_block' => 'كود',
                'h1' => 'عنوان',
                'h2' => 'عنوان',
                'h3' => 'عنوان',
                'italic' => 'مائل',
                'link' => 'رابط',
                'ordered_list' => 'قائمة مرقمة',
                'redo' => 'إعادة',
                'strike' => 'خط في المنتصف',
                'underline' => 'خط سفلي',
            ],
        ],
        'select' => [
            'actions' => [
                'create_option' => [
                    'modal' => [
                        'heading' => 'إنشاء',
                        'actions' => [
                            'create' => [
                                'label' => 'إنشاء',
                            ],
                            'create_another' => [
                                'label' => 'إنشاء وإنشاء آخر',
                            ],
                        ],
                    ],
                ],
                'edit_option' => [
                    'modal' => [
                        'heading' => 'تعديل',
                        'actions' => [
                            'save' => [
                                'label' => 'حفظ',
                            ],
                        ],
                    ],
                ],
            ],
            'boolean' => [
                'true' => 'نعم',
                'false' => 'لا',
            ],
            'loading_message' => 'جاري التحميل...',
            'max_items_message' => 'يمكن تحديد :count عنصر فقط.',
            'no_search_results_message' => 'لا توجد خيارات تطابق البحث الخاص بك.',
            'placeholder' => 'اختر خيار',
            'searching_message' => 'جاري البحث...',
            'search_prompt' => 'ابدأ الكتابة للبحث...',
        ],
        'tags_input' => [
            'placeholder' => 'أضف علامة واضغط Enter',
        ],
        'text_input' => [
            'actions' => [
                'hide_password' => [
                    'label' => 'إخفاء كلمة المرور',
                ],
                'show_password' => [
                    'label' => 'إظهار كلمة المرور',
                ],
            ],
        ],
        'toggle' => [
            'boolean' => [
                'true' => 'نعم',
                'false' => 'لا',
            ],
        ],
        'wizard' => [
            'actions' => [
                'previous_step' => [
                    'label' => 'السابق',
                ],
                'next_step' => [
                    'label' => 'التالي',
                ],
            ],
        ],
    ],
    'fields' => [
        'bulk_select_page' => [
            'label' => 'تحديد/إلغاء تحديد جميع العناصر للعمليات المجمعة.',
        ],
        'bulk_select_record' => [
            'label' => 'تحديد/إلغاء تحديد العنصر :key للعمليات المجمعة.',
        ],
        'search' => [
            'label' => 'بحث',
        ],
    ],
    'messages' => [
        'max_items' => 'يمكن تحديد :count عنصر فقط.',
    ],
    'sections' => [
        'collapsible' => [
            'actions' => [
                'collapse' => [
                    'label' => 'طي',
                ],
                'expand' => [
                    'label' => 'توسيع',
                ],
            ],
        ],
    ],
    'validation' => [
        'messages' => [
            'array' => 'يجب أن يكون الحقل مصفوفة.',
            'boolean' => 'يجب أن يكون الحقل صحيح أو خطأ.',
            'date' => 'يجب أن يكون الحقل تاريخاً صالحاً.',
            'email' => 'يجب أن يكون الحقل عنوان بريد إلكتروني صالحاً.',
            'integer' => 'يجب أن يكون الحقل رقماً صحيحاً.',
            'max' => [
                'array' => 'يجب ألا يحتوي الحقل على أكثر من :max عنصر.',
                'file' => 'يجب ألا يكون الحقل أكبر من :max كيلوبايت.',
                'numeric' => 'يجب ألا يكون الحقل أكبر من :max.',
                'string' => 'يجب ألا يكون الحقل أكبر من :max حرف.',
            ],
            'min' => [
                'array' => 'يجب أن يحتوي الحقل على :min عنصر على الأقل.',
                'file' => 'يجب أن يكون الحقل :min كيلوبايت على الأقل.',
                'numeric' => 'يجب أن يكون الحقل :min على الأقل.',
                'string' => 'يجب أن يكون الحقل :min حرف على الأقل.',
            ],
            'numeric' => 'يجب أن يكون الحقل رقماً.',
            'required' => 'هذا الحقل مطلوب.',
            'required_if' => 'هذا الحقل مطلوب عندما :other يكون :value.',
            'required_unless' => 'هذا الحقل مطلوب ما لم يكن :other في :values.',
            'required_with' => 'هذا الحقل مطلوب عندما :values موجود.',
            'required_with_all' => 'هذا الحقل مطلوب عندما :values موجودة.',
            'required_without' => 'هذا الحقل مطلوب عندما :values غير موجود.',
            'required_without_all' => 'هذا الحقل مطلوب عندما لا يوجد أي من :values.',
            'same' => 'يجب أن يطابق الحقل :other.',
            'string' => 'يجب أن يكون الحقل نصاً.',
            'unique' => 'تم أخذ الحقل بالفعل.',
            'url' => 'يجب أن يكون الحقل رابطاً صالحاً.',
        ],
    ],
];

