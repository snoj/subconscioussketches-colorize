#!/usr/bin/php
<?php

$byteArray = unpack("L*",file_get_contents('./ColoringPage06.jpg'));
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

for($wi = 0; $wi < 2550; $wi++) {
  for($hi = 0; $hi < 3300; $hi++) {
    $progress_p = floor(($progress_i/$progress_c) * 100);
    if($progress_p % 10 == 0 && $progress_p != $last_percent) {
      imagepng($img, "./fill-finished.png");
      $last_percent = $progress_p;
    }

    $progress_line = "                                                                                                                         \r".
                      (($progress_i/$progress_c) * 100). "%";
    fwrite(STDERR, $progress_line);
    
    $new_colorat_ref = imagecolorat($img, $wi, $hi);
    $new_colorat = imagecolorsforindex($img, $new_colorat_ref);
    if(sprintf("%02x%02x%02x", $new_colorat["red"], $new_colorat["green"], $new_colorat["blue"]) != "ffffff") {
      $progress_i++;
      continue;
    }
    
    $offset = ($wi * $hi) % $arrlength;
    if($offset == 0){
      $offset = 1;
    }

    $rgba = unpack('C*', pack('L', $byteArray[$offset]));
    $colra = imagecolorallocate($img, $rgba[1], $rgba[2], $rgba[3]);
    $colorat_ref = imagecolorat($img_ori, $wi, $hi);
    $colorat = imagecolorsforindex($img_ori, $colorat_ref);

    if($colorat["red"] > 0)
      imagefill($img, $wi, $hi, $colra);

    $progress_i++;
  }
}

echo "\n";
imagepng($img, "./fill-finished.png");