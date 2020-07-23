<?php
    include_once('../config/baglan.php');
    include_once(YONETIM.'assets/functions.php');
    $Yonetim = new Yonetim();
 
// ajax isleleri
    switch($_GET['islem']):
    /* dene */
        case 'dene':
            if($_POST):
                $bolum = $_POST['bolum'];
                $tercih = $_POST['tercih'];

                $tasarimupdate = $connect -> prepare("UPDATE tasarim SET $bolum='$tercih'");
                $tasarimupdate -> execute();

            else:
                echo 'Hata..';
            endif;
        break;
    /* kullanici guncelle */
        case 'kullaniciguncelle':
            $hidden = $_POST['hidden'];
            $name = htmlspecialchars($_POST['name']);
            $authority = (int)htmlspecialchars($_POST['authority']);

            $yonetim = $connect -> prepare("SHOW COLUMNS FROM yonetim WHERE FIELD NOT IN ('id','name','password','active','authority')");
            $yonetim -> execute();
            
            foreach($yonetim as $yonet):
                  ${$yonet[0]} = $Yonetim->checkboxcontrol(htmlspecialchars($yonet[0]));
            endforeach;
            

            $update = $connect -> prepare(
                "UPDATE yonetim SET name='$name',authority='$authority',ayar='$ayar',siteayar='$siteayar',mailayar='$mailayar',bakim='$bakim',link='$link',
                istatistik='$istatistik',yonetimm='$yonetimm',tasarim='$tasarim',intro='$intro',haber='$haber',hakkimizda='$hakkimizda',hizmet='$hizmet',
                referans='$referans',filo='$filo',yorum='$yorum',video='$video',mesaj='$mesaj',bulten='$bulten' WHERE id='$hidden'");
            $update -> execute(); 
        break;
    endswitch;
 
?>