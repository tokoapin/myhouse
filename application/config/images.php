<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| image
| -------------------------------------------------------------------------
| defined Image Manipulation
| note: the library path of ImageMagick or NetPBM
|
*/

/*
 * Please modified library_path for Windows or Linux, example:
 * Linux: /usr/bin/
 * Windows: C://ImageMagic/bin/
 */

$config['library_path'] = "/usr/bin";

$config['gd2'] = array(
    "image_library" => "GD2",
);

$config['ImageMagick'] = array(
    "image_library" => "ImageMagick",
    "library_path" => $config['library_path'],
);

$config['NetPBM'] = array(
    "image_library" => "NetPBM",
    "library_path" => $config['library_path'],
);

$config['image_size'] = array(
    "sale" => array("512x512", "256x256", "128x128", "64x64")
);
