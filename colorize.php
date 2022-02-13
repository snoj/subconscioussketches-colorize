#!/usr/bin/php
<?php

ini_set('memory_limit', '1G');

$byteArray = unpack('L*', file_get_contents('./ColoringPage06.jpg'));
$arrlength = count($byteArray);

$img = imagecreatefrompng('./fix-canvas.png');
$img_ori = imagecreatefrompng('./fix-canvas.png');
imagealphablending($img, true);
imagesavealpha($img, true);

$colors = [];

$progress_i = 0;
$progress_c = 2550 * 3300;
$progress_p = 0;
$last_percent = 0;

for ($i = 0; $i < $progress_c; $i++) {
    $wi = floor($i / 3300);
    $hi = $i % 3300;

    $new_colorat_ref = imagecolorat($img, $wi, $hi);
    $new_colorat = imagecolorsforindex($img, $new_colorat_ref);
    if($i  % ($progress_c / 10) == 0) {
      echo "\r" . round($i / $progress_c * 100 , 2) . "% complete";
    }
    
    if (
        sprintf(
            '%02x%02x%02x',
            $new_colorat['red'],
            $new_colorat['green'],
            $new_colorat['blue']
        ) != 'ffffff'
    ) {
        continue;
    }

    $offset = $wi * $hi % $arrlength;
    if ($offset == 0) {
        $offset = 1;
    }

    $rgba = unpack('C*', pack('L', $byteArray[$offset]));
    $colra = imagecolorallocate($img, $rgba[1], $rgba[2], $rgba[3]);
    $colorat_ref = imagecolorat($img_ori, $wi, $hi);
    $colorat = imagecolorsforindex($img_ori, $colorat_ref);

    if ($colorat['red'] > 0) {
        imagefill($img, $wi, $hi, $colra);
    }
}
echo "\r" . round($i / $progress_c * 100 , 2) . "% complete";
imagepng($img, './fill-finished.png');
echo "\nfinished";
