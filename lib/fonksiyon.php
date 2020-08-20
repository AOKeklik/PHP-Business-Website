<?php
	class kurumsal extends PDO
	{
	//----------------------------CONSTRUCTOR
		function __construct() {
			
			parent::__construct("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8",DB_USER,DB_PASS);

			$ayarcek=$this->prepare("SELECT * FROM ayarlar");
			$ayarcek->execute();
			$sorguson=$ayarcek->fetch();

			$this->normaltitle=$sorguson["title"];
			$this->metatitle=$sorguson["metatitle"];
			$this->metadesc=$sorguson["metadesc"];
			$this->metakey=$sorguson["metakey"];
			$this->metaout=$sorguson["metaauthor"];
			$this->metaown=$sorguson["metaowner"];
			$this->metacopy=$sorguson["metacopy"];
			$this->logoyazi=$sorguson["logoyazisi"];
			$this->tvit=$sorguson["twit"];
			$this->face=$sorguson["face"];
			$this->ints=$sorguson["ints"];
			$this->telno=$sorguson["telefonno"];
			$this->mailadres=$sorguson["mailadres"];
			$this->normaladres=$sorguson["adres"];	
			$this->haritabilgi=$sorguson["haritabilgi"];
			$this->footer=$sorguson["footer"];
			$this->URL=$sorguson["url"];

			if (@$_SESSION["dil"]=="tr") :
				$this->slogan=$sorguson["slogan_tr"];
				//------------------------------------------------
				$this->referansbaslik=$sorguson["referansbaslik_tr"];	
				$this->referansUstbaslik=$sorguson["referansUstBaslik_tr"];
				//------------------------------------------------
				$this->filobaslik=$sorguson["filobaslik_tr"];
				$this->filoUstBaslik=$sorguson["filoUstBaslik_tr"];
				//------------------------------------------------
				
				$this->yorumbaslik=$sorguson["yorumbaslik_tr"];
				$this->yorumUstBaslik=$sorguson["yorumUstBaslik_tr"];
				//------------------------------------------------
				
				$this->iletisimbaslik=$sorguson["iletisimbaslik_tr"];
				$this->iletisimUstBaslik=$sorguson["iletisimUstBaslik_tr"];
				
				//------------------------------------------------
				$this->hizmetlerbaslik=$sorguson["hizmetlerbaslik_tr"];
				$this->hizmetlerUstBaslik=$sorguson["hizmetlerUstBaslik_tr"];
				//------------------------------------------------
				$this->videobaslik=$sorguson["videoaltbaslik_tr"];	
				$this->videoUstbaslik=$sorguson["videoustbaslik_tr"];
				//------------------------------------------------
				
				//------------------------------------------------
				$this->haberlerMetin=$sorguson["haberler_tr"];

				//------------------------------------------------
				
				$this->adresBilgi="ADRESİMİZ";
				$this->telefonBilgi="TELEFON NUMARAMIZ";
				$this->adbilgi="Adınız";
				$this->mailBilgi="Mail Adresiniz";
				$this->konuBilgi="Mesaj Konusu";	
				$this->guvenlikBilgi="Güvenlik kodunu girin";
				$this->butonBilgi="Gönder";
			elseif (@$_SESSION["dil"]=="en") :
				$this->slogan=$sorguson["slogan_en"];
				//------------------------------------------------
				
				$this->referansbaslik=$sorguson["referansbaslik_en"];
				$this->referansUstbaslik=$sorguson["referansUstBaslik_en"];
				//------------------------------------------------
				$this->filobaslik=$sorguson["filobaslik_en"];
				$this->filoUstBaslik=$sorguson["filoUstBaslik_en"];
				//------------------------------------------------	
				$this->yorumbaslik=$sorguson["yorumbaslik_en"];
				$this->yorumUstBaslik=$sorguson["yorumUstBaslik_en"];
				//------------------------------------------------
				
				$this->iletisimbaslik=$sorguson["iletisimbaslik_en"];
				$this->iletisimUstBaslik=$sorguson["iletisimUstBaslik_en"];
				//------------------------------------------------
				$this->hizmetlerbaslik=$sorguson["hizmetlerbaslik_en"];
				$this->hizmetlerUstBaslik=$sorguson["hizmetlerUstBaslik_en"];
				//------------------------------------------------
				
					//------------------------------------------------
				$this->videobaslik=$sorguson["videoaltbaslik_en"];	
				$this->videoUstbaslik=$sorguson["videoustbaslik_en"];
				//------------------------------------------------
				
				//------------------------------------------------
				$this->haberlerMetin=$sorguson["haberler_en"];

				//------------------------------------------------
				
				$this->adresBilgi="ADDRESS";
				$this->telefonBilgi="PHONE NUMBER";
				$this->adbilgi="Your name";
				$this->mailBilgi="Your e-mail address";
				$this->konuBilgi="Message Subject";
				$this->butonBilgi="Send";
				$this->guvenlikBilgi="Enter security code";
			endif;
		} // ayarlar geliyor
		function sorgum($sorgu, $tercih=0) {
			$al = $this -> prepare($sorgu);
			$sonuc = $al -> execute();	
			
			if($tercih == 1):
				return $al -> fetch();
			elseif($tercih == 2):
				return $al;
			elseif($tercih == 3):
				return 	$sonuc;	
			endif;
		} // genel sorgum	
		function Eklemesorgum($tabloadi, array $sutunadi, array $veriler){
			$sonsutunlar = join(',', $sutunadi);
			$bilinmeyen = '';
			for($i = 0; $i < count($sutunadi); $i++):
				$bilinmeyen .= "?,";
			endfor;
			$bilinmeyen = rtrim($bilinmeyen,',');
			$kaydet = $this->prepare("INSERT INTO $tabloadi ($sonsutunlar) VALUES ($bilinmeyen)");
			$kaydet -> execute($veriler);
		} // genel sorgum
	//----------------------------BOLUMLER
		function introbak() {
			$introal=$this->sorgum("select * from intro",2);
			
			while ($sonucum=$introal->fetch(PDO::FETCH_ASSOC)) :
				echo '<div class="item" style="background-image:url('.URL.$sonucum["resimyol"].');"></div>';
			endwhile;
		} // intro
		function hakkimizda() {
			$introal=$this->sorgum("select * from hakkimizda",1);
			
			echo '<section id="hakkimizda" class="wow fadeInUp">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 hakkimizda-img">
							<img src="'.URL.$introal["resim"].'"  alt="'.URL.$introal["resim"].'-Hakkında"/>
						</div>
						<div class="col-lg-6 content">
							<h2>'.$introal["baslik_".$_SESSION["dil"]].'</h2>
							<h3>'.$introal["icerik_".$_SESSION["dil"]].'</h3>
						</div>
					</div>
				</div>
			</section>';
		} // hakkimizda bölümü
		function hizmetler($baslik=false) {
			$introal=$this->sorgum("select * from hizmetler",2);
				
			echo '<div class="section-header">
				<h2>'.$this->hizmetlerUstBaslik.'</h2>
				<p>'.$baslik.'</p>
			</div>
			<div class="row">';
			
			while($sonucum=$introal->fetch(PDO::FETCH_ASSOC)):
				echo '<div class="col-lg-6">
					<div class="box wow fadeInTop">
						<div class="icon"><i class="fa fa-certificate"></i></div>
							<h4 class="title"><a href="#">'.$sonucum["baslik_".$_SESSION["dil"]].'</a></h4>
							<p class="description">'.$sonucum["icerik_".$_SESSION["dil"]].'</p>
						</div>  
					</div>';	
			endwhile;
			echo'</div>';
		} // hizmetler bölümü
		function referans($baslik=false) {
			$introal=$this->sorgum("select * from referanslar",2);
			
			echo '<div class="section-header">
				<h2>'.$this->referansUstbaslik.'</h2>
				<p>'.$baslik.'</p>
			</div>
			<div class="owl-carousel clients-carousel">';
			
			while ($sonucum=$introal->fetch(PDO::FETCH_ASSOC)) :
				echo '<img src="'.URL.$sonucum["resimyol"].'" alt="Referans-'.$sonucum["id"].'" />';
			endwhile;
			
			echo '</div>';
		} // referanslar
		function filomuz() {
			$introal=$this->sorgum("select * from filomuz",2);
			
			echo '<section id="filo" class="wow fadeInUp">
				<div class="container">
					<div class="section-header">
						<h2>'.$this->filoUstBaslik.'</h2>
						<p>';  echo $this->filobaslik; echo '</p>
					</div>
				</div>
				<div class="container-fluid">
					<div class="row no-gutters">';
						while ($sonucum=$introal->fetch(PDO::FETCH_ASSOC)) :
							echo'<div class="col-lg-3 col-md-4">         
								<div class="filo-item wow fadeInUp">            
									<a href="'.URL.$sonucum["resimyol"].'" class="filo-popup">
										<img src="'.URL.$sonucum["resimyol"].'" alt="Referans-'.$sonucum["id"].'" />
										<div class="filo-overlay"></div>
									</a>
								</div>
							</div>';
						endwhile;
			echo'</div></div></section>';
		} // filomuz
		function yorumlar($baslik=false) {
			$introal=$this->sorgum("select * from yorumlar",2);
			
			echo '<div class="section-header">
				<h2>'.$this->yorumUstBaslik.'</h2>
				<p>'.$baslik.'</p>
			</div>
			<div class="owl-carousel testimonials-carousel">';
				while ($sonucum=$introal->fetch(PDO::FETCH_ASSOC)) :
					echo'<div class="testimonial-item">
						<p>
							<img src="'.IMG.'sol.png" class="quote-sign-left" />
							'.$sonucum["icerik"].'
							<img src="'.IMG.'sag.png" class="quote-sign-right" />
						</p>
						<img src="'.IMG.'yorum.jpg" class="testimonial-img" alt="Müşteri Yorum-'.$sonucum["id"].'" />
						<h3>'.$sonucum["isim"].'</h3>
					</div>';
				endwhile;
			echo'</div>';
		} // yorumlar
		function linkler() {
			$gelen=$this->sorgum("SELECT hiztercih,videotercih FROM tasarim",1);
			
			$arama=$this->prepare("SELECT * FROM linkler WHERE ad_tr LIKE ? OR ad_tr LIKE ?");
			$arama->execute(array('hizmet%','video%'));
			
			while ($d=$arama->fetch()) :	
				$this->linkidleri[]=$d["id"];	
			endwhile;
			
			$linkal=$this->sorgum("SELECT * FROM linkler ORDER BY siralama ASC;",2);
			
			$sayi=0;
			
			while ($linkson=$linkal->fetch(PDO::FETCH_ASSOC)):
				if ($sayi==0):
					echo '<li class="menu-active"><a href="#'.$linkson["etiket"].'">'.$linkson["ad_".$_SESSION["dil"]].'</a></li>';
					$sayi=1;
				else:
					if($linkson["id"]==$this->linkidleri[0]):
						if ($gelen["hiztercih"]==0):						
							echo '<li><a href="#'.$linkson["etiket"].'">'.$linkson["ad_".$_SESSION["dil"]].'</a></li>';
						else:
							continue; // bunun yazıldığı yerden döngü başa döndürülür.
						endif;
					elseif($linkson["id"]==$this->linkidleri[1]):
						if ($gelen["videotercih"]==0):						
							echo '<li><a href="#'.$linkson["etiket"].'">'.$linkson["ad_".$_SESSION["dil"]].'</a></li>';
						else:
							continue; // bunun yazıldığı yerden döngü başa döndürülür.
						endif;	
					else:
						echo '<li><a href="#'.$linkson["etiket"].'">'.$linkson["ad_".$_SESSION["dil"]].'</a></li>';
					endif;
				endif;
			endwhile;
		} // link yönetimi
		function videolar() {
			$videoal=$this->sorgum("SELECT * FROM videolar WHERE durum=1 ORDER BY siralama ASC;",2);
			
			echo '<div class="container">
				<div class="section-header">
					<h2>'.$this->videoUstbaslik.'</h2>
					<p>';  echo $this->videobaslik; echo '</p>
				</div>	
			</div>
			<div class="container">
				<div class="row no-gutters">';
					while ($sonucum=$videoal->fetch(PDO::FETCH_ASSOC)) :
						echo'<div class="col-lg-4 col-md-4 p-1"> 
							<div class="embed-responsive embed-responsive-16by9">
								<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$sonucum["link"].'" allowfullscreen></iframe> 
							</div>
						</div>';
					endwhile;
			echo'</div></div>';
		} // videolar
		function haberler($baslik=false) {
			$introal=$this->sorgum("SELECT * FROM haberler",2);
			
			echo'<div class="container wow fadeInUp">
				<div class="row mt-2  pt-3  border-secondary  border-bottom" >
					<div class="col-lg-3 col-md-3 text-right "><h5 >'.$baslik.'</h5></div>
					<div class="col-lg-9 col-md-9 text-info text-left" id="news-container1">
						<ul style="list-style-type:none;">';
							while($sonucum=$introal->fetch(PDO::FETCH_ASSOC)):
								echo '<li>'.$sonucum["icerik_".$_SESSION["dil"]].' | '.$sonucum["tarih"].'</li>';
							endwhile;	   
						echo'</ul>
					</div>
				</div>
			</div>';
		} // haberler bölümü
	}





?>