<?php

/*
|-----------------------------------------------------------------------------
| PRECONFIGURATION FOR CROPPA
|
| All other configuration options are available from the bkwld/croppa package. 
| Use the 'vendor:publish --tag=croppa-config' command to publish this config file.
|-----------------------------------------------------------------------------
*/

return [

    /*
     * The PHP memory limit used by the script to generate thumbnails. Some
     * images require a lot of memory to perform the resize, so you may increase
     * this memory limit.
     */
    'memory_limit' => '512M',

    /*
     * The jpeg quality of generated images. The difference between 100 and 95
     * usually cuts the file size in half. Going down to 70 looks ok on photos
     * and will reduce filesize by more than another half but on vector files
     * there is noticeable aliasing.
     *
     * @var integer
     */
    'quality' => 85,

    /*
     * If the source image is smaller than the requested size, allow Croppa to
     * scale up the image. This will reduce in quality loss.
     *
     * @var boolean
     */
    'upsize' => true,
];
