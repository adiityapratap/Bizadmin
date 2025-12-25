<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Compress image to a given quality
 * Supported: JPG, PNG, GIF
 *
 * @param string $source      Full path of original file
 * @param string $destination Full path to save compressed file
 * @param int    $quality     JPEG quality (10–90)
 * @param bool   $forceJPG    Convert PNG to JPG (reduces size a lot)
 * @return bool
 */
function compress_image($source, $destination, $quality = 70, $forceJPG = TRUE)
{
    if (!file_exists($source)) {
        return false;
    }

    $info = getimagesize($source);
    $mime = $info['mime'];

    switch ($mime) {
        case 'image/jpeg':
            $image = imagecreatefromjpeg($source);
            imagejpeg($image, $destination, $quality);
            break;

        case 'image/png':
            $image = imagecreatefrompng($source);

            if ($forceJPG) {
                // Convert PNG → JPG for huge size reduction
                $bg = imagecreatetruecolor(imagesx($image), imagesy($image));
                $white = imagecolorallocate($bg, 255, 255, 255);
                imagefill($bg, 0, 0, $white);
                imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
                imagejpeg($bg, $destination, $quality);
                imagedestroy($bg);
            } else {
                // Reduce PNG quality (not very effective)
                imagepng($image, $destination, 6);
            }
            break;

        case 'image/gif':
            $image = imagecreatefromgif($source);
            imagejpeg($image, $destination, $quality);
            break;

        default:
            return false;
    }

    imagedestroy($image);
    return true;
}

/**
 * Compress image to a target size (KB)
 *
 * @param string $source
 * @param string $destination
 * @param int $targetKB
 * @return bool
 */
function compress_to_size($source, $destination, $targetKB = 900)
{
    $quality = 90;

    do {
        compress_image($source, $destination, $quality);
        $filesizeKB = filesize($destination) / 1024;
        $quality -= 5;

        if ($quality <= 10) break;

    } while ($filesizeKB > $targetKB);

    return true;
}
