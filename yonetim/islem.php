<?php
	include_once("../config/baglan.php");
	include_once(KOK_YONETIM."assets/fonksiyon.php");
	
	class ajaxpost extends yonetim {
		function __construct(){
			parent::__construct();
		}
	}

	$ajaxs = new ajaxpost;
 
// ajax isleleri
    switch($_GET['islem']):
        case 'tasarimguncelle'://tasatim guncelle
            if($_POST):
                $bolum = $_POST['bolum'];
				$tercih = $_POST['tercih'];
				
				$ajaxs -> sorgum("UPDATE tasarim SET $bolum='$tercih'",0);	
            else:
                header('Location:'.URL);
            endif;
		break;
		case 'sablonguncelle'://sablonguncelle
			if($_POST):
				$baslik = htmlspecialchars(strip_tags($_POST['baslik']));
				$icerik = htmlspecialchars(strip_tags($_POST['icerik']));
				$hidden = $_POST['hidden'];

				if($ajaxs -> sorgum("UPDATE mail_sablonlar SET baslik='$baslik',icerik='$icerik' WHERE id='$hidden'",3)):
					echo 'ok';
				else:
					echo 'no';
				endif;
			else:
				header('Location:'.URL);
			endif;
		break;
		case 'sablonsil'://sablonsil
			if($_POST):
				$secilenid = $_POST['secilenid'];

				if($ajaxs -> sorgum("DELETE FROM mail_sablonlar WHERE id='$secilenid'",3)):
					echo 'ok';
				else:
					echo 'no';
				endif;
			else:
				header('Location:'.URL);
			endif;
		break;
		case 'sablonekleme'://sablonsil
			if($_POST):
				$baslik = $_POST['baslik'];
				$icerik = $_POST['icerik'];

				if($ajaxs -> sorgum("INSERT INTO mail_sablonlar (baslik,icerik) VALUES ('$baslik','$icerik')",3)):
					echo 'ok';
				else:
					echo 'no';
				endif;
			else:
				header('Location:'.URL);
			endif;
		break;
    endswitch;
 
?>