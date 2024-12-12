<?php

use Illuminate\Support\Facades\Storage;

function uploadImage($image, $folder)
{
    $path = createFolderIfNotExist($folder);
    return getImagePath($image, $path);
}

function getImagePath($image, $path)
{
    $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
    $image->storeAs('public/' . $path, $image_name);

    return 'storage/' . $path . "/" . $image_name;
}

function createFolderIfNotExist($folder): string
{
    $path = 'assets/' . $folder;

    if (!Storage::exists('public/' . $path)) {
        Storage::disk('public')->makeDirectory($path);
    }

    return $path;
}
