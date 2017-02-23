<?php

namespace Approached\LaravelImageOptimizer;

use ImageOptimizer\OptimizerFactory;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageOptimizer extends OptimizerFactory
{
    private $extensions = [
        'image/gif' => 'gif',
        'image/jpeg' => 'jpg',
        'image/pjpeg' => 'jpg',
        'image/png' => 'png',
        'image/x-png' => 'png',
    ];

    /**
     * Opitimize a image.
     *
     * @param $filepath
     * @throws \Exception
     */
    public function optimizeImage($filepath)
    {
        $fileExtension = $this->extensions[mime_content_type($filepath)];

        $transformHandler = config('imageoptimizer.transform_handler');

        if (!isset($transformHandler[$fileExtension])) {
            throw new \Exception('TransformHandler for file extension: "' . $fileExtension . '" was not found');
        }

        $this->get($transformHandler[$fileExtension])->optimize($filepath);
    }

    /**
     * Opitimize a image from a UploadedFile.
     *
     * @param UploadedFile $image
     *
     * @throws \Exception
     */
    public function optimizeUploadedImageFile(UploadedFile $image)
    {
        $this->optimizeImage($image->getRealPath());
    }

    /**
     * Get extension from a file.
     *
     * @param $filepath
     *
     * @throws \Exception
     *
     * @return string
     */
    private function getFileExtensionFromFilepath($filepath)
    {
        $fileExtension = pathinfo($filepath, PATHINFO_EXTENSION);

        if (empty($fileExtension)) {
            throw new \Exception('File extension not found');
        }

        return $fileExtension;
    }
}
