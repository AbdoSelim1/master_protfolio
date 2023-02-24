<?php

namespace App\services\ManegMedia;


use Illuminate\Http\Request;


trait UploadMedia
{
    public function uploadMuiltpaleMedia(Request $request, string $collection = "projects")
    {
        foreach ($request->safe()->images as $image) {
            $this->addMedia($image['filename'])->toMediaCollection($collection);
        }
        return $this;
    }
}
