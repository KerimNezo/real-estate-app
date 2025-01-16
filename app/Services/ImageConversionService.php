<?php

namespace App\Services;

use Intervention\Image\Laravel\Facades\Image;

class ImageConversionService
{
    /**
     * Convert an image to WebP and upload it to the given media collection.
     *
     * @param \Illuminate\Http\UploadedFile|string $image
     * @param \Spatie\MediaLibrary\HasMedia $model
     * @param string $collection
     * @return void
     */
    public function convertAndUpload($image, $model, $collection)
    {
        // Convert the image to WebP format
        $webpFilePath = $this->convertToWebp($image->getRealPath());

        // Upload the WebP image to the specified media collection
        $model->addMedia($webpFilePath)->toMediaCollection($collection);
    }

    /**
     * Convert the given image to WebP format and return the temporary file path.
     *
     * @param string $path
     * @return string
     */
    protected function convertToWebp($path)
    {
        $image = Image::read($path)->toWebp(); // Adjust quality as needed

        // Save the WebP image to a temporary location
        $webpTempPath = sys_get_temp_dir() . '/' . uniqid() . '.webp';
        $image->save($webpTempPath);

        return $webpTempPath;
    }
}
