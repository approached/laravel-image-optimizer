<?php namespace Approached\LaravelImageOptimizer;

class ImageOptimizer
{

    private $pngOptimzer;
    private $jpgOptimzer;

    public function __construct()
    {
        $factory = new \ImageOptimizer\OptimizerFactory(array(
            'optipng_bin' => config('imageoptimizer.optipng_path'),
            'jpegoptim_bin' => config('imageoptimizer.jpegoptim_path'),
            'ignore_errors' => config('imageoptimizer.ignore_errors')
        ));

        $this->pngOptimzer = $factory->get('optipng');
        $this->jpgOptimzer = $factory->get('jpegoptim');
    }

    public function optimizeImage($filepath, $fileExtension = null)
    {
        if (is_null($fileExtension)) {
            $fileExtension = pathinfo($filepath, PATHINFO_EXTENSION);

            if (empty($fileExtension)) {
                throw new \Exception('File extension not found');
            }
            $fileExtension = strtolower($fileExtension);
        }

        if ($fileExtension == 'jpg') {
            return $this->optimizeJPG($filepath);
        } elseif ($fileExtension == 'png') {
            return $this->optimizePNG($filepath);
        } else {
            return false;
        }
    }

    public function optimizeJPG($filepath)
    {
        $this->jpgOptimzer->optimize($filepath);

        return true;
    }

    public function optimizePNG($filepath)
    {
        $this->pngOptimzer->optimize($filepath);

        return true;
    }
}