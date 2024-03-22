<?php

return [

    /*
    |-----------------------------------------------------------------------------
    | CONFIGURATION FOR CROPPA
    |
    | All other configuration options are available from the bkwld/croppa package. 
    | Use the vendor:publish artisan command to publish this config file.
    |-----------------------------------------------------------------------------
    */

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

    /*
    |-----------------------------------------------------------------------------
    | CONFIGURATION FOR THE TWILL-CROPPA INTEGRATION
    |
    | The following configuration rules are used to further fine-tune the 
    | integration of twill and croppa provided by this package.
    |-----------------------------------------------------------------------------
    */

    /*
    * If there is no lqip image sizing provied when generating the LQIP image URL, 
    * the following size will be used for with and height.
    *
    * @var integer
    */

    'lqip_dimension' => 30,

    /*
    * The JPEG quality when requesting a LQIP image. 
    * Higher values will increase the image quality, but result in larger files and
    * slower LQIP responses.
    *
    * @var integer
    */

    'lqip_quality' => 25,

    /*
    * The path of the storage location of the twill media files 
    * for appending it to the application base url.
    *
    * @var string
    */
    'media_files_path' => 'storage/uploads/',
];
