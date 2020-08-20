<?php 
	session_start();
	include_once("../../config/baglan.php");
	include_once(KOK."lib/mailkontrol.php");
	$mailsinifim= new mailkontrol();
	//---- TERCİHİ ALIYORUM
	switch ($_GET["islem"]):
		case "arayuz";
			if($_POST):	
				$isim=htmlspecialchars(strip_tags($_POST["isim"]));
				$mailadres=htmlspecialchars(strip_tags($_POST["mail"]));
				$konu=htmlspecialchars(strip_tags($_POST["konu"]));
				$mesaj=htmlspecialchars(strip_tags($_POST["mesaj"]));
				$guvenlik=htmlspecialchars(strip_tags($_POST["guvenlik"]));
				$token=htmlspecialchars(strip_tags($_POST["token"]));
			
			
				if ($token != $_SESSION["token"]):
					echo '<div class="alert alert-danger text-center mx-auto">SİSTEMSEL HATA</div>';
				elseif($guvenlik != $_SESSION["kod"]):
					echo '<div class="alert alert-danger text-center mx-auto">Güvenlik kodunu yanlış girdiniz</div>';
				else:
					unset($_SESSION["token"]);
			
					$zaman=date("d.m.Y")."/".date("H:i");
					$tercihgeldi = $mailsinifim -> sorgum("select mesajtercih from ayarlar",1);
			
					switch($tercihgeldi["mesajtercih"]):
						case 1:			
							if($mailsinifim->mailgonder(NULL,$konu,$mesaj,array("mailadresi" =>$mailadres,"ad" =>$isim))):
								echo '<div class="alert alert-success text-center mx-auto">Mesaj başarıyla alındı.<br>TEŞEKKÜR EDERİZ</div>';
							else:
								echo '<div class="alert alert-danger text-center mx-auto">Mail gönderilemedi.<br>DAHA SONRA TEKRAR DENEYİNİZ</div>';	
							endif;
						break;
						case 2:
							$mailsinifim->mailgonder(NULL,$konu,$mesaj,array("mailadresi" =>$mailadres,"ad" =>$isim));
							$mailsinifim->Eklemesorgum("gelenmail", array("ad","mailadres","konu","mesaj","zaman"),array($isim,$mailadres,$konu,$mesaj,$zaman));

							echo '<div class="alert alert-success text-center mx-auto">Mesaj başarıyla alındı.<br>TEŞEKKÜR EDERİZ</div>';		
						break;
						case 3:
							$mailsinifim->Eklemesorgum("gelenmail",array("ad","mailadres","konu","mesaj","zaman"),array($isim,$mailadres,$konu,$mesaj,$zaman));

							echo '<div class="alert alert-success text-center mx-auto">Mesaj başarıyla alındı.<br>TEŞEKKÜR EDERİZ</div>';		
						break;
					endswitch;
				endif;
			endif;
		break;
		case "panel":
				$mailler=$_POST["mailler"];
				$mailbaslik=$_POST["mailler"];
				$mailicerik=$_POST["mail"];
				
				$sonmailler= explode("\r",$mailler);
				
				if (count($sonmailler)>1):
					if (in_array(null,$sonmailler) || in_array('',array_map('trim',$sonmailler))):
						array_pop($sonmailler);			
					endif;	
				endif;
			
				if($mailsinifim->mailgonder($sonmailler,$mailbaslik,$mailicerik,NULL)):
					echo "ok";
				else:
					echo "hata";
				endif;
		break;
	endswitch;










?>