<?php

namespace App\Models;

class Page extends BaseModel
{
    protected $guarded = ['redirects'];

    protected $attributes = [
        'fields' => '{}'
    ];

    protected $casts = [
        'published' => 'boolean',
        'fields' => 'array'
    ];

    public $logFields = [
        'name',
        'published',
        'parent_id',
        'sort',
        'slug',
        'content',
        'fields',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

    public function formFields()
    {
        $fields = [
            [
                'name' => 'name',
                'type' => 'input',
                'label' => 'Название'
            ],
            [
                'name' => 'published',
                'type' => 'checkbox',
                'label' => 'Опубликован'
            ],
            [
                'name' => 'slug',
                'type' => 'input',
                'label' => 'Url (если пусто, то сгенерируется автоматически)'
            ],
            [
                'name' => 'in_menu',
                'type' => 'checkbox',
                'label' => 'Выводить в меню'
            ],
            [
                'name' => 'name_in_menu',
                'type' => 'input',
                'label' => 'Название в меню (если не пусто, то соответствует названию)'
            ],
            [
                'name' => 'redirects',
                'type' => 'redirects',
                'label' => 'Редиректы'
            ]
        ];

        if (isset($_GET['admin'])) {
            $fields = array_merge($fields, [
                [
                    'name' => 'behavior',
                    'type' => 'input',
                    'label' => 'Behavior'
                ]
            ]);
        }

        if ($this->behavior == 'files') {
            $fields = array_merge($fields, [
                [
                    'name' => 'fields[files]',
                    'type' => 'files',
                    'label' => 'Файлы'
                ]
            ]);
        }

        if ($this->parent && $this->parent->behavior == 'info') {
            $fields = array_merge($fields, [
                [
                    'name' => 'fields[icon]',
                    'type' => 'image',
                    'label' => 'Иконка'
                ]
            ]);
        }

        if ($this->behavior == 'main') {
            $fields = array_merge($fields, [
                [
                    'name' => 'fields[main_image]',
                    'type' => 'image',
                    'label' => 'Основное изображение (1920x600)'
                ],
                [
                    'name' => 'fields[main_image_text]',
                    'type' => 'input',
                    'label' => 'Текст основного изображения'
                ],
                [
                    'name' => 'fields[about_company]',
                    'type' => 'gallery',
                    'label' => 'О компании'
                ],
                [
                    'name' => 'fields[content_title]',
                    'type' => 'input',
                    'label' => 'Заголовок текста'
                ],
            ]);
        }

        if ($this->behavior == 'contacts') {
            $fields = array_merge($fields, [
                [
                    'name' => 'fields[requisites]',
                    'type' => 'requisites',
                    'label' => 'Реквизиты'
                ],
                [
                    'name' => 'fields[addresses]',
                    'type' => 'addresses',
                    'label' => 'Адреса региональных офисов'
                ]
            ]);
        }

        if ($this->behavior == 'question-answer') {
            $fields = array_merge($fields, [
                [
                    'name' => 'fields[QA]',
                    'type' => 'QA',
                    'label' => 'Блоки с вопросами'
                ]
            ]);
        }

        if ($this->behavior == 'about' || $this->behavior == 'production') {
            $fields = array_merge($fields, [
                [
                    'name' => 'fields[imageBlock]',
                    'type' => 'imageBlock',
                    'label' => 'Блоки с картинками'
                ]
            ]);
        }

        if ($this->behavior == 'about') {
            $fields = array_merge($fields, [
                [
                    'name' => 'fields[icons]',
                    'type' => 'icons',
                    'label' => 'Основные направления'
                ],
                [
                    'name' => 'fields[iconsInline]',
                    'type' => 'iconsInline',
                    'label' => 'При обращении вы получаете бесплатно'
                ],
                [
                    'name' => 'fields[advantages]',
                    'type' => 'advantages',
                    'label' => 'Наши преимущества'
                ]
            ]);
        }

        $fields = array_merge($fields, [
            [
                'name' => 'content',
                'type' => 'editor',
                'label' => 'Текст'
            ],
            'meta_title',
            'meta_description',
            'meta_keywords',
        ]);

        return $fields;
    }

    public function getAttribute($key)
    {
        $return = parent::getAttribute($key);
        if ($return === null && isset($this->fields[$key])) {
            $return = $this->fields[$key];
        }

        return $return;
    }

    public function validatorRules($data)
    {
        $rules = parent::validatorRules($data);
        return array_merge($rules, [
            'parent_id' => 'nullable|integer|exists:pages,id'
        ]);
    }

    public function image($imageName)
    {
        return Image::findOrNew($this->$imageName);
    }

    public function firstImage($default = '')
    {
        if (!empty($this->image)) {
            return $this->image;
        }

        if (!empty($this->images) && $this->images->first()->image) {
            return $this->images->first()->image;
        }

        return $default;
    }

    public function collection($fieldName)
    {
        $data = json_decode($this->$fieldName);
        return collect($data);
    }
}
