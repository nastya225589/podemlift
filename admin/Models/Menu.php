<?php

namespace Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';

    protected $fillable = [
        'name', 'published', 'parent_id', 'sort', 'page_id', 'url'
    ];

    public $logFields = [
        'name', 'published', 'parent_id', 'sort', 'page_id', 'url'
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
                'name' => 'parent_id',
                'type' => 'select',
                'label' => 'Родительская страница',
                'options' => self::where('id', '!=', $this->id)->get()->pluck('name', 'id')->prepend('', '')->toArray()
            ],
            [
                'name' => 'sort',
                'type' => 'input',
                'label' => 'Сортировка'
            ],
            [
                'name' => 'page_id',
                'type' => 'select',
                'label' => 'Страница',
                'options' => Page::pluck('name', 'id')->prepend('', '')->toArray()
            ],
            [
                'name' => 'url',
                'type' => 'input',
                'label' => 'Url'
            ],
        ];

        return $fields;
    }

    public function validatorRules($data)
    {
        return [
            'name' => 'required|string|max:255'
        ];
    }

    public function childrens()
    {
        return $this->hasMany('Admin\Models\Menu', 'parent_id', 'id')->sortAsc();
    }

    public function getUrl()
    {
        if ($this->page_id)
            return Page::getUrl($this->page_id);

        return $this->url;
    }

    public function setSortAttribute($value)
    {
        $this->attributes['sort'] = (int)$value;
    }

    public function scopeSortAsc($query)
    {
        if ($this->orderBy)
            return $query->orderBy('sort', 'asc');

        return $query;
    }
}
