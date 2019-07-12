<?php
/*
 * Set specific configuration variables here
 */
return [

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    | Avatar use Intervention Image library to process image.
    | Meanwhile, Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */
    'driver'    => 'gd',

    // Initial generator class
    'generator' => \Laravolt\Avatar\Generator\DefaultGenerator::class,

    // Whether all characters supplied must be replaced with their closest ASCII counterparts
    'ascii'    => false,

    // Image shape: circle or square
    'shape' => 'square',

    // Image width, in pixel
    'width'    => 75,

    // Image height, in pixel
    'height'   => 75,

    // Number of characters used as initials. If name consists of single word, the first N character will be used
    'chars'    => 1,

    // font size
    'fontSize' => 60,

    // convert initial letter in uppercase
    'uppercase' => true,

    // Fonts used to render text.
    // If contains more than one fonts, randomly selected based on name supplied
    'fonts'    => [__DIR__.'/../fonts/OpenSans-Bold.ttf', __DIR__.'/../fonts/rockwell.ttf'],

    // List of foreground colors to be used, randomly selected based on name supplied
    'foregrounds'   => [
        '#333',
    ],

    // List of background colors to be used, randomly selected based on name supplied
    'backgrounds'   => [
        '#00f078',
    ],

    'border'    => [
        'size'  => 1,
        'color' => 'foreground',
    ],
];
