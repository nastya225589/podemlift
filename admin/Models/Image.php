<?php

namespace Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{

    protected $fillable = [
        'parent_id', 'size', 'path', 'url', 'alt'
    ];

    public static function storeImage($image, $ext, $alt = '')
    {
        $name = str_random(36) . '.' . $ext;
        $path = "images/{$name}";

        if ($ext == 'svg') {
            $size = "";
        } else {
            $im = imagecreatefromstring($image);
            $width = imagesx($im);
            $height = imagesy($im);
            $size = "{$width}x{$height}";
        }

        Storage::disk('public')->put($path, $image);

        $url = str_replace(env('APP_URL'), '', Storage::disk('public')->url($path));
        $path = str_replace(Storage::disk('public')->path(''), '', Storage::disk('public')->path($path));

        $imageModel = new self([
            'url' => $url,
            'path' => $path,
            'size' => $size,
            'alt' => $alt
        ]);

        if ($imageModel->save())
            return $imageModel->getAttributes();
        else
            return null;
    }
}
