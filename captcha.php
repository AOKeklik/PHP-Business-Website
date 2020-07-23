<?php
   session_start();

// kullanicinin boot olmadigini anlamak icin rastgele uretilen 6 hanelik kodu girmesini isteriz
   $codes = substr(md5(mt_rand(0,9999999)), 0, 6);
   $_SESSION['codes'] = $codes;

   header('Content-type: image/png');

   $image = imagecreate(90,36);//size
   $background = imagecolorallocate($image, rand(0,225),rand(0,225),rand(0,225));//bg-color
   $color = imagecolorallocate($image, 47,47,42);//text-color

   $color_point = imagecolorallocate($image, rand(0,225),rand(0,225),rand(0,225));
   for($i = 0; $i < 500; $i++):
      //$color_point = imagecolorallocate($image, rand(0,225),rand(0,225),rand(0,225));
      imagesetpixel($image, rand()%100, rand()%50, $color_point);//renkli noktalar ekler
   endfor;

   $color_line = imagecolorallocate($image, rand(0,225),rand(0,225),rand(0,225));//herseferinde cizgiler farkli bir renk
   for($i = 0; $i < 10; $i++):
      //$color_line = imagecolorallocate($image, rand(0,225),rand(0,225),rand(0,225));//her seferinde cizgiler birbirnden farkli renklerde
      imageline($image, 0, rand()%95, 200, rand()%95, $color_line);//renkli noktalar ekler
   endfor;
   
   imagestring($image, 20,17,10, $codes, $color);
   imagepng($image);
   imagedestroy($image);




?>