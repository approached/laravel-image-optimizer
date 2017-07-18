<?php

return [
    /*
     |--------------------------------------------------------------------------
     | Options for image transforming
     |--------------------------------------------------------------------------
     |
     | for the Bin path, you can easily find it with the following command in your shell:
     | which optipng
     |
     */
    'options' => [
        'ignore_errors' => false,

        // png
        'optipng_bin'     => '/usr/bin/optipng',
        'optipng_options' => ['-i0', '-o2', '-quiet'],

        'pngquant_bin'     => env('PNGQUANT', '/usr/bin/pngquant'),
        'pngquant_options' => ['--force', '--ext=.png'],

        'pngcrush_bin'     => '/usr/bin/pngcrush',
        'pngcrush_options' => ['-reduce', '-q', '-ow'],

        'pngout_bin'     => '/usr/bin/pngout',
        'pngout_options' => ['-s3', '-q', '-y'],

        // gif
        'gifsicle_bin'     => env('GIFSICLE', '/usr/bin/gifsicle'),
        'gifsicle_options' => ['-b', '-O5'],

        // jpg
        'jpegoptim_bin'     => env('JPEGOPTIM', '/usr/bin/jpegoptim'),
        'jpegoptim_options' => ['--strip-all'],

        'jpegtran_bin'     => '/usr/bin/jpegtran',
        'jpegtran_options' => ['-optimize', '-progressive'],

        // http://www.advancemame.it/doc-advpng.html
        'advpng_bin'     => '/usr/bin/advpng',
        'advpng_options' => ['-z', '-4', '-q'],
    ],

    /*
     |--------------------------------------------------------------------------
     | Transformer for image
     |--------------------------------------------------------------------------
     |
     | You can chose which transformer to be used
     |
     */
    'transform_handler' => [
        'png'  => 'pngquant',
        'jpg'  => 'jpegoptim',
        'jpeg' => 'jpegoptim',
        'gif'  => 'gifsicle',
    ],

    /*
     |--------------------------------------------------------------------------
     | Log file
     |--------------------------------------------------------------------------
     |
     | Only for image optimize errors
     |
     */
    'log_file' => storage_path().'/logs/image_optimize.log',
];
