<?php

if (!function_exists('add_controller_ns')) {
    function add_controller_ns($route) {
        $controller = explode('@', $route)[0];
        if (file_exists(app_path("Http/Controllers/Admin/{$controller}.php")))
            return '\App\Http\Controllers\Admin\\' . $route;

        return '\Admin\Controllers\\' . $route;
    }
}

if (!function_exists('field_value')) {
    function field_value($model, $field) {
        $name = is_string($field) ? $field : $field['name'];
        if (preg_match('/\[(\w+)\]\[(\w+)\]/', $name, $m))
            $value = $model->{$m[1]}->{$m[2]} ?? '';
        elseif (preg_match('/\[(\w+)\]/', $name, $m))
            $value = $model->{$m[1]};
        else
            $value = $model->{$name};

        return $value;
    }
}

if (!function_exists('field_label')) {
    function field_label($field) {
        if (is_string($field))
            $label = title_case(str_replace('_', ' ', $field));
        else
            $label = $field['label'] ?? title_case(str_replace('_', ' ', $field['name']));

        return $label;
    }
}

if (!function_exists('multi_name')) {
    function multi_name($field) {
        $name = is_string($field) ? $field : $field['name'];
        if (preg_match('/\[(\w+)\]/', $name, $m))
            return $m[1];

        if (preg_match('/(\w+)\[\]/', $name, $m))
            return $m[1];

        return $name;
    }
}

if (!function_exists('image')) {
    function image($id) {
        return \App\Models\Image::findOrNew((int)$id);
    }
}

if (! function_exists('resize')) {
    function resize($imageUrl, $width = null, $height = null, $byMaxSide = true) {

        if ($width && $height)
            $dir = $width . 'x' .$height;
        elseif ($width && !$height)
            $dir = $width . 'x';
        elseif (!$width && $height)
            $dir = 'x' .$height;
        else
            throw new ErrorException('Width or height required.');

        $imagePath = preg_replace('~^/?storage/~', '', $imageUrl);
        $resizedPath = dirname($imagePath) . "/{$dir}/" . basename($imagePath);

        if (!Storage::disk('public')->exists($resizedPath)) {

            if (Storage::disk('public')->exists($imagePath))
                $image = Storage::disk('public')->get($imagePath);
            elseif (Storage::disk('local')->exists($imagePath))
                $image = Storage::disk('local')->get($imagePath);
            else
                return $imageUrl;

            if ($width && $height) {
                if ($byMaxSide) {
                    if (Image::make($image)->width() > Image::make($image)->height())
                        $resized = Image::make($image)->widen($width)->encode();
                    else
                        $resized = Image::make($image)->heighten($height)->encode();
                } else {
                    $resized = Image::make($image)->fit($width, $height)->encode();
                }
            } else
                $resized = Image::make($image)->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                })->encode();

            Storage::disk('public')->put($resizedPath, $resized);
        }

        return 'storage/' .  $resizedPath;
    }
}

if (! function_exists('heightByWidth')) {
    function heightByWidth($imageUrl, $width, $default = null) {

        $imagePath = preg_replace('~^/?storage/~', '', $imageUrl);

        $height = $default ?: $width;

        if (Storage::disk('public')->exists($imagePath)) {
            $image = Storage::disk('public')->get($imagePath);
            $origWidth = Image::make($image)->width();
            $origHeight = Image::make($image)->height();
            $height = $origHeight / $origWidth * $width;
        }

        return $height;
    }
}

if (! function_exists('imageSize')) {
    function imageSize($imageUrl) {

        $imagePath = preg_replace('~^/?storage/~', '', $imageUrl);

        if (Storage::disk('public')->exists($imagePath)) {
            $image = Storage::disk('public')->get($imagePath);
            $origWidth = Image::make($image)->width();
            $origHeight = Image::make($image)->height();

            return [$origWidth, $origHeight];
        }

        return [100, 100];
    }
}

if (! function_exists('getParamIs')) {
    function getParamIs($param, $value) {
        return request()->get($param) == $value;
    }
}

if (! function_exists('selected')) {
    function selected($param, $value) {
        return getParamIs($param, $value) ? 'selected' : '';
    }
}
