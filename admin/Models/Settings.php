<?php

namespace Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $settings;
    protected $fillable = [
        'name', 'label', 'group', 'type', 'sort', 'value'
    ];

    public $logFields = [
        'name', 'label', 'group', 'type', 'sort', 'value'
    ];

    public $timestamps = false;

    public function getAttribute($key)
    {
        $return = parent::getAttribute($key);
        if ($return === null) {
            if (!$this->settings)
                $this->settings = self::all()->mapWithKeys(function ($model) {
                    return [$model->name => $model->value];
                });
            if (isset($this->settings[$key]))
                $return = $this->settings[$key];
        }
        return $return;
    }
}
