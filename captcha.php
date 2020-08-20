<?php

session_start();


$kod=substr(md5(mt_rand(0,9999999)),0,6);

$_SESSION["kod"]=$kod;

header('Content-type: image/png');


$resim= imagecreate(100,50);

$arka_renk=imagecolorallocate($resim,234,236,25);
$yazi_renk=imagecolorallocate($resim,47,47,42);

//$nokta_renk=imagecolorallocate($resim,32,32,29);
$nokta_renk=imagecolorallocate($resim,rand(0,225),rand(0,225),rand(0,225));
for ($i=0; $i<250; $i++):

	imagesetpixel($resim,rand()%100,rand()%50,$nokta_renk);


endfor;

//$cizgi_renk=imagecolorallocate($resim,64,64,64);

for ($i=0; $i<10; $i++):
$cizgi_renk=imagecolorallocate($resim,rand(0,225),rand(0,225),rand(0,225));
	imageline($resim,0,rand()%95,200,rand()%95,$cizgi_renk);


endfor;

imagestring($resim,35,20,20,$kod,$yazi_renk);
imagepng($resim);
imagedestroy($resim);

?>