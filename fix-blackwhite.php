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
for($wi = 0; $wi < 2550; $wi++) {
  for($hi = 0; $hi < 3300; $hi++) {
    $progress_p = floor(($progress_i/$progress_c) * 100);
    $progress_line = "                                                                                                                         \r".
                      (($progress_i/$progress_c) * 100). "%";
    fwrite(STDERR, $progress_line);

    $colorat_ref = imagecolorat($img_ori, $wi, $hi);
    $colorat = imagecolorsforindex($img_ori, $colorat_ref);

    if(min($colorat["red"], $colorat["green"], $colorat["blue"]) > 40)
      imagesetpixel($img, $wi, $hi, $color_white);
    else
      imagesetpixel($img, $wi, $hi, $color_black);

    if($progress_p % 10 == 0 && $progress_p != $last_percent) {
      imagepng($img, "./fix-canvas.png");
      $last_percent = $progress_p;
    }

    $progress_i++;
  }
}
echo "\n";
imagepng($img, "./fix-canvas.png");
