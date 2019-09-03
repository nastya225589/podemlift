<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Log extends Model
{
    protected $table = 'log';

    protected $attributes = [
        'data' => '[]'
    ];

    protected $fillable = [
        'user_id',
        'model',
        'model_id',
        'data'
    ];

    protected $casts = [
        'data' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function getResourceName()
    {
        $class = $this->model;
        $model = $class::where(['id' => $this->model_id])->first();
        if ($model && $model->name) {
            return $model->name;
        }

        return "{$this->model}:{$this->model_id}";
    }

    public static function toArrayRecursive($data)
    {
        foreach ($data as $attribute => $value) {
            $data[$attribute] = self::tryJson($value);
            if (is_array($data[$attribute])) {
                $data[$attribute] = self::toArrayRecursive($data[$attribute]);
            }
        }

        return $data;
    }

    public static function tryJson($data)
    {
        if (is_string($data) &&
            ($decoded = json_decode($data)) &&
            json_last_error() === JSON_ERROR_NONE &&
            (is_array($decoded) || is_object($decoded))) {
            return (array) $decoded;
        }

        return is_object($data) ? (array) $data : $data;
    }

    public static function compare($old, $new)
    {
        $before = $after = [];

        foreach ($old as $ko => $vo) {
            if (isset($new[$ko]) && $new[$ko] == $old[$ko]) {
                continue;
            }

            if ($vo) {
                $before[$ko] = (string) $vo;
                $after[$ko] = isset($new[$ko]) ? (string) $new[$ko] : '' /* deleted if not set */;
            }
        }

        foreach ($new as $kn => $vn) {
            if (isset($old[$kn]) && $old[$kn] == $new[$kn]) {
                continue;
            }

            if ($vn) {
                $after[$kn] = (string) $vn;
                $before[$kn] = isset($old[$kn]) ? (string) $old[$kn] : '' /* created if not set */;
            }
        }

        $out = [];
        $keys = array_keys($before);
        foreach ($keys as $key) {
            $out[$key] = ['before' => $before[$key], 'after' => $after[$key]];
        }

        return $out;
    }

    public static function model($new)
    {
        $class = get_class($new);
        $old = $class::where(['id' => $new->id])->first();
        if (!$old || !Auth::id()) {
            return;
        }

        $oldAttributes = self::toArrayRecursive($old->getAttributes());
        $oldAttributes = array_dot($oldAttributes);
        $newAttributes = self::toArrayRecursive($new->getAttributes());
        $newAttributes = array_dot($newAttributes);

        $data = self::compare($oldAttributes, $newAttributes);

        if (!count($data)) {
            return;
        }

        $log = new self();
        $log->fill([
            'user_id' => Auth::id(),
            'model' => $class,
            'model_id' => $new->id,
            'data' => $data
        ]);

        $log->save();
    }
}
