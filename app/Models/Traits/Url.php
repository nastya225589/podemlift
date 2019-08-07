<?php

namespace App\Models\Traits;

use App\Models\Redirect;

trait Url
{
    use Slug;

    public static function bootUrl()
    {
        static::saving(function($model)
        {
            if (array_diff(['url', 'slug', 'parent_id'], $model->columns()))
                return;

            $newUrl = $model->fullUrl();

            if ($newUrl != $model->url) {
                if ($model->id && $model->url)
                    Redirect::firstOrCreate([
                        'from' => $model->url,
                        'model' => static::class,
                        'model_id' => $model->id
                    ]);

                $model->url = $newUrl;
            }
        });

        static::saved(function($model) {
            if (array_diff(['url', 'slug', 'parent_id'], $model->columns()))
                return;

            if (count($model->childrens))
                foreach ($model->childrens as $children)
                    if ($children->url != $children->fullUrl())
                        $children->save();
        });
    }

    public function fullUrl()
    {
        $url = '/' . trim($this->slug, '/');
        $parent = $this->parent;
        while ($parent) {
            $slug = trim($parent->slug, '/');
            if (!empty($slug))
                $url = '/' . $slug . $url;
            $parent = $parent->parent;
        }

        return $url;
    }
}
