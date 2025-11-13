<?php

return [
    'columns' => [
        'text' => [
            'actions' => [
                'collapse_list' => 'إظهار :count أقل',
                'expand_list' => 'إظهار :count أكثر',
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
            'placeholder' => 'بحث',
            'indicator' => 'بحث',
        ],
    ],
    'summary' => [
        'heading' => 'ملخص',
        'subheadings' => [
            'all' => 'جميع :label',
            'group' => ':group ملخص',
            'page' => 'هذه الصفحة',
        ],
        'summarizers' => [
            'average' => [
                'label' => 'متوسط',
            ],
            'count' => [
                'label' => 'عدد',
            ],
            'sum' => [
                'label' => 'مجموع',
            ],
        ],
    ],
    'actions' => [
        'disable_reordering' => [
            'label' => 'إنهاء إعادة ترتيب السجلات',
        ],
        'enable_reordering' => [
            'label' => 'بدء إعادة ترتيب السجلات',
        ],
        'filter' => [
            'label' => 'تصفية',
            'modal' => [
                'heading' => 'تصفية',
                'actions' => [
                    'apply' => [
                        'label' => 'تطبيق',
                    ],
                    'reset' => [
                        'label' => 'إعادة تعيين',
                    ],
                ],
            ],
        ],
        'group' => [
            'label' => 'مجموعة',
        ],
        'open_bulk_actions' => [
            'label' => 'فتح الإجراءات',
        ],
        'toggle_columns' => [
            'label' => 'تبديل الأعمدة',
        ],
    ],
    'empty' => [
        'heading' => 'لم يتم العثور على سجلات',
        'description' => 'قم بإنشاء :model للبدء.',
    ],
    'filters' => [
        'actions' => [
            'apply' => [
                'label' => 'تطبيق التصفية',
            ],
            'remove' => [
                'label' => 'إزالة التصفية',
            ],
            'remove_all' => [
                'label' => 'إزالة جميع التصفيات',
            ],
            'reset' => [
                'label' => 'إعادة تعيين',
            ],
        ],
        'heading' => 'التصفيات',
        'indicator' => 'التصفيات النشطة',
        'multi_select' => [
            'placeholder' => 'الكل',
        ],
        'select' => [
            'placeholder' => 'الكل',
        ],
        'trashed' => [
            'label' => 'السجلات المحذوفة',
            'only_trashed' => 'السجلات المحذوفة فقط',
            'with_trashed' => 'مع السجلات المحذوفة',
            'without_trashed' => 'بدون السجلات المحذوفة',
        ],
    ],
    'grouping' => [
        'fields' => [
            'group' => [
                'label' => 'التجميع حسب',
                'placeholder' => 'التجميع حسب',
            ],
            'direction' => [
                'label' => 'اتجاه التجميع',
                'options' => [
                    'asc' => 'تصاعدي',
                    'desc' => 'تنازلي',
                ],
            ],
        ],
    ],
    'reorder_indicator' => 'اسحب وأفلت السجلات للترتيب.',
    'selection_indicator' => [
        'selected_count' => 'تم تحديد سجل واحد|تم تحديد :count سجلات',
        'actions' => [
            'select_all' => [
                'label' => 'تحديد كل :count',
            ],
            'deselect_all' => [
                'label' => 'إلغاء تحديد الكل',
            ],
        ],
    ],
    'sorting' => [
        'fields' => [
            'column' => [
                'label' => 'الترتيب حسب',
            ],
            'direction' => [
                'label' => 'اتجاه الترتيب',
                'options' => [
                    'asc' => 'تصاعدي',
                    'desc' => 'تنازلي',
                ],
            ],
        ],
    ],
];

