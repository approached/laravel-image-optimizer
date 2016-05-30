<?php

return [

    /*
     |--------------------------------------------------------------------------
     | Options for image transforming
     |--------------------------------------------------------------------------
     |
     | Bin path you can check easy with follow command in a shell:
     | which optipng
     |
     */
    'options' => [
        'ignore_errors' => false,

        'optipng_bin'     => '/usr/bin/optipng',
        'optipng_options' => ['-i0', '-o2', '-quiet'],

        'pngquant_bin'     => '/usr/bin/pngquant',
        'pngquant_options' => ['--force'],

        'pngcrush_bin'     => '/usr/bin/pngcrush',
        'pngcrush_options' => ['-reduce', '-q', '-ow'],

//    'pngout_bin' => '/usr/bin/pngout',
//    'pngout_options' => ['-s3', '-q', '-y'],

        'gifsicle_bin'     => '/usr/bin/gifsicle',
        'gifsicle_options' => ['-b', '-O5'],

        'jpegoptim_bin'     => '/usr/bin/jpegoptim',
        'jpegoptim_options' => ['--strip-all', '--all-progressive'],

//    'jpegtran_bin' => '/usr/bin/jpegtran',
//    'jpegtran_options' => ['-optimize', '-progressive'],

//    'advpng_bin' => '/usr/bin/advpng',
//    'advpng_options' => ['-z', '-4', '-q'],
    ],


    /*
     |--------------------------------------------------------------------------
     | Transformer for image
     |--------------------------------------------------------------------------
     |
     | You can choice which tranformer you will use
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
