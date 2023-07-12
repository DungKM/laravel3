<?php

namespace App\Traits;

use App\Models\Image as ModelsImage;
use Image;

trait HandleImageTrait
{
    protected $path = 'upload/';

    public function veryfy($request)
    {
        return $request->has('image');
    }

    public function saveImage($request)
    {
        if ($this->veryfy($request)) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save($this->path . $name);
            return $name;
        }
    }
    public function updateImage($request, $currentImage)
    {
        if ($this->veryfy($request)) {
            $this->deleteImage($currentImage);
            return $this->saveImage($request);
        }
        return $currentImage;
    }
    public function deleteImage($imageName)
    {
        if ($imageName && file_exists($this->path . $imageName)) {
            unlink($this->path . $imageName);
            $image = ModelsImage::where('url', $imageName)->first();
            if ($image) {
                $image->delete();
            }
        }
    }
}