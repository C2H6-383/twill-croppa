<?php

/*
|-----------------------------------------------------------------------------
| CONFIGURATION FOR THE TWILL-CROPPA INTEGRATION
|
| The following configuration rules are used to further fine-tune the 
| integration of twill and croppa provided by this package.
|-----------------------------------------------------------------------------
*/

return [

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
