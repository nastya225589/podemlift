<?php

namespace App\Models\Traits;

trait Sort
{
    public static function bootSort()
    {
        static::creating(function($model) {
            if (!in_array('sort', $model->columns()))
                return;

            $max = static::when(in_array('parent_id', $model->columns()), function ($q) use ($model) {
                return $q->where('parent_id', $model->parent_id);
            })->max('sort');

            $model->sort = $max === null ? 0 : $max + 1;
        });
    }

    public function scopeSorted($query)
    {
        return $query->orderBy('sort');
    }
}
