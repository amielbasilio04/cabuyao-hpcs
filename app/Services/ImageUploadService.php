<?php 

namespace App\Services;

use App\Models\All\TmpImage;

class ImageUploadService {


    public function handleImageUpload($model, $images, $collection, $action)
    {
        $image_filename = [];
        $uploaded_images = [];

            $action == "update" ?  $model->clearMediaCollection($collection) : "";

            foreach($images as $img):  // loop array of images

                $image_filename[]= $img;

                // 
               $uploaded_images[] = $model
                                    ->addMedia(storage_path('/app/public/tmp/'. $img))
                                    ->toMediaCollection($collection)
                                    ->getUrl('card'); // move the image from the storage disk to the new media disk

            endforeach;


            TmpImage::whereIn('filename', $image_filename)->delete(); // get the tmp image from the db & remove it

            return $uploaded_images;

    }
}