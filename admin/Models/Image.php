<?php

namespace Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
//    use SoftDeletes;

    protected $fillable = [
        'parent_id', 'size', 'path', 'url', 'alt'
    ];

    public static function storeImage($image, $alt = '')
    {
        $info = new \finfo(FILEINFO_MIME);
        $mime = $info->buffer($image);
        $ext = preg_match('~/(\w+);~', $mime, $m) ? $m[1] : 'jpg';
        $name = str_random(36) . '.' . $ext;
        $path = "images/{$name}";

        $im = imagecreatefromstring($image);
        $width = imagesx($im);
        $height = imagesy($im);

        Storage::disk('public')->put($path, $image);

        $url = str_replace(env('APP_URL'), '', Storage::disk('public')->url($path));
        $path = str_replace(Storage::disk('public')->path(''), '', Storage::disk('public')->path($path));

        $imageModel = new self([
            'url' => $url,
            'path' => $path,
            'size' => "{$width}x{$height}",
            'alt' => $alt
        ]);

        if ($imageModel->save())
            return $imageModel->getAttributes();
        else
            return null;
    }
}
