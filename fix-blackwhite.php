#!/usr/bin/php
<?php
$img_ori = imagecreatefromjpeg('./ColoringPage06.jpg');
$img = imagecreatetruecolor(2550, 3300);
$progress_i = 0;
$progress_c = 2550 * 3300;
$progress_p = 0;
$last_percent = 0;
$color_black = imagecolorallocatealpha($img_ori, 0, 0, 0, 0);
$color_white = imagecolorallocatealpha($img_ori, 0xff, 0xff, 0xff, 0);
for ($i = 0; $i < $progress_c; $i++) {
    $wi = floor($i / 3300);
    $hi = $i % 3300;

    $colorat_ref = imagecolorat($img_ori, $wi, $hi);
    $colorat = imagecolorsforindex($img_ori, $colorat_ref);
    if (min($colorat['red'], $colorat['green'], $colorat['blue']) > 40) {
        imagesetpixel($img, $wi, $hi, $color_white);
    } else {
        imagesetpixel($img, $wi, $hi, $color_black);
    }

    if($i  % ($progress_c / 10) == 0) {
      echo "\r" . round($i / $progress_c * 100 , 2) . "% complete";
    }
}
echo "\r" . round($i / $progress_c * 100 , 2) . "% complete";

imagepng($img, './fix-canvas.png');
echo "\r\nfinished";