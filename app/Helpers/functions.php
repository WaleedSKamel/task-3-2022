<?php


use Illuminate\Support\Facades\Storage;

if (!function_exists('getAvatar')) {
    function getAvatar($path): string
    {
        return !empty($path) ? asset('storage/' . $path) : asset('assets/media/svg/avatars/blank.svg');
    }
}
if (!function_exists('menuRoute')) {
    function menuRoute($route, $type = 'route', $tagType = 'ul'): string
    {
        if ($tagType == 'ul') {
            if ($type == 'route') {
                return Route::currentRouteName() == $route ? 'active' : '';
            } else {
                return Request::is($route) ? 'menu-open' : '';
            }

        } else {
            return Request::is($route) ? 'active' : '';
        }

    }
}

# validateImage
if (!function_exists('validationImage')) {
    function validationImage($extension = null, $type = null): array
    {
        if ($extension == null) {
            return ['image', 'mimes:jpg,jpeg,png,bmp'];
        } else {
            return [$type, 'mimes:' . $extension];
        }
    }
}

if (!function_exists('deleteSingleFile')) {
    function deleteSingleFile($file)
    {
        Storage::has($file) ? Storage::delete($file) : '';
    }
}
if (!function_exists('uploadFile')) {
    function uploadFile($data)
    {
        if (request()->hasFile($data['file']) && $data['upload_type'] == 'single') {
            Storage::has($data['delete_file']) ? Storage::delete($data['delete_file']) : '';
            return request()->file($data['file'])->store($data['path']);
        }
    }
}
