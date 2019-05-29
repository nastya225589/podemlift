<?php

namespace Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Resizer;
use Illuminate\Support\Str;

class Image extends Model
{

    protected $fillable = [
        'parent_id', 'size', 'path', 'url', 'alt'
    ];

    public static function storeImage($image, $ext, $alt = '', $width = null, $height = null)
    {
        $name = Str::random(36) . '.' . $ext;
        $path = "images/{$name}";

        if ($ext == 'svg') {
            $size = "";
        } else if ($width || $height) {
            $size = "{$width}x{$height}";
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

    public static function default()
    {
        return new self([
            'url' => '/images/default.png'
        ]);
    }

    public function size($width = null, $height = null)
    {
        $size = "{$width}x{$height}";
        $variant = $this->variants->where('size', $size)->first();
        if ($variant)
            return $variant;

        $path = Storage::disk('public')->path('');
        $file = str_replace($path, '', $this->path);

        if (!Storage::disk('public')->exists($file))
            return self::default();

        $image = Storage::disk('public')->get($file);
        $image = $this->resize($image, $width, $height);
        $attributes = self::storeImage($image, pathinfo($file, PATHINFO_EXTENSION), '', $width, $height);
        self::where('id', $attributes['id'])->update(['parent_id' => $this->id]);

        return $this->variants()->where('size', $size)->first();
    }

    public function variants()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function resize($image, $width = null, $height = null) {

        if ($width && $height)
            return Resizer::make($image)->fit($width, $height)->encode();

        return Resizer::make($image)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->encode();
    }
}
