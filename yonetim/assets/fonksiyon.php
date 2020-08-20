<?php 
	ob_start();
	
	class yonetim extends PDO
	{
		function __construct() {
			parent::__construct("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8",DB_USER,DB_PASS);
		}
		private $veriler=array();	
		function DahilEt($dosyalar= array()) {
			foreach ($dosyalar as $key => $deger):
				include_once(KOK_YONETIM."assets/".$key.".php");
				$this->$deger= new $deger;
				// include_once("assets/fonksiyon2.php");
				// $yonetim2=new yonetim2
			endforeach;
		}
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
		function SayfaNavi($link,$anaMetin,$cocukMetin) {
			echo '<span><a href="'.URL_YONETIM.'control.php?sayfa='.$link.'">'.$anaMetin.'</a> / <a href="#">'.$cocukMetin.'</a></span>';
		} // Breadcrumb
		function UrlCek() {
			$urlAl=$this->prepare("SELECT url FROM ayarlar");
			$urlAl->execute();
			$sorguson=$urlAl->fetch();

			return $sorguson["url"];
		} // Breadcrumb URL çekiyor
	//-------------------------------------SITE AYAR
		function siteayar() {
				
				$sonuc=self::sorgum("SELECT * FROM ayarlar",1);
				
				if ($_POST) :
				
				$title=htmlspecialchars($_POST["title"]);
				$metatitle=htmlspecialchars($_POST["metatitle"]);
				$metadesc=htmlspecialchars($_POST["metadesc"]);
				$metakey=htmlspecialchars($_POST["metakey"]);
				$metaaut=htmlspecialchars($_POST["metaaut"]);
				$metaown=htmlspecialchars($_POST["metaown"]);
				$metacopy=htmlspecialchars($_POST["metacopy"]);
				$logoyazi=htmlspecialchars($_POST["logoyazi"]);
				$face=htmlspecialchars($_POST["face"]);
				$twit=htmlspecialchars($_POST["twit"]);
				$inst=htmlspecialchars($_POST["inst"]);
				$telno=htmlspecialchars($_POST["telno"]);
				$adres=htmlspecialchars($_POST["adres"]);
				$mailadres=htmlspecialchars($_POST["mailadres"]);
				$url=htmlspecialchars($_POST["url"]);
				
				$slogan_tr=htmlspecialchars($_POST["slogan_tr"]);
				$slogan_en=htmlspecialchars($_POST["slogan_en"]);
				
			
				
				$refsayfaUstbas_tr=htmlspecialchars($_POST["refsayfaUstbas_tr"]);
				$refsayfaUstbas_en=htmlspecialchars($_POST["refsayfaUstbas_en"]);
				$refsayfabas_tr=htmlspecialchars($_POST["refsayfabas_tr"]);
				$refsayfabas_en=htmlspecialchars($_POST["refsayfabas_en"]);
				
				
				$filosayfaUstbas_tr=htmlspecialchars($_POST["filosayfaUstbas_tr"]);
				$filosayfaUstbas_en=htmlspecialchars($_POST["filosayfaUstbas_en"]);		
				$filosayfabas_tr=htmlspecialchars($_POST["filosayfabas_tr"]);
				$filosayfabas_en=htmlspecialchars($_POST["filosayfabas_en"]);
				
				$yorumsayfaUstbas_tr=htmlspecialchars($_POST["yorumsayfaUstbas_tr"]);
				$yorumsayfaUstbas_en=htmlspecialchars($_POST["yorumsayfaUstbas_en"]);		
				$yorumsayfabas_tr=htmlspecialchars($_POST["yorumsayfabas_tr"]);
				$yorumsayfabas_en=htmlspecialchars($_POST["yorumsayfabas_en"]);
				
				
				$iletisimsayfaUstbas_tr=htmlspecialchars($_POST["iletisimsayfaUstbas_tr"]);
				$iletisimsayfaUstbas_en=htmlspecialchars($_POST["iletisimsayfaUstbas_en"]);		
				$iletisimsayfabas_tr=htmlspecialchars($_POST["iletisimsayfabas_tr"]);
				$iletisimsayfabas_en=htmlspecialchars($_POST["iletisimsayfabas_en"]);
				
				$hizmetlersayfaUstbas_tr=htmlspecialchars($_POST["hizmetlersayfaUstbas_tr"]);
				$hizmetlersayfaUstbas_en=htmlspecialchars($_POST["hizmetlersayfaUstbas_en"]);		
				$hizmetlersayfabas_tr=htmlspecialchars($_POST["hizmetlersayfabas_tr"]);
				$hizmetlersayfabas_en=htmlspecialchars($_POST["hizmetlersayfabas_en"]);
				
				$mesajtercih=htmlspecialchars($_POST["mesajtercih"]);
				$haritabilgi=htmlspecialchars($_POST["haritabilgi"]);
				$footer=htmlspecialchars($_POST["footer"]);
				
				
				// burda bunların boş ve doluluk kontrolü yapıbilir.
				
				
				$guncelleme=$this->prepare("update ayarlar set title=?,metatitle=?,metadesc=?,metakey=?,metaauthor=?,metaowner=?,metacopy=?,logoyazisi=?,face=?,twit=?,ints=?,telefonno=?,adres=?,mailadres=?,slogan_tr=?,slogan_en=?,referansUstBaslik_tr=?,referansUstBaslik_en=?,referansbaslik_tr=?,referansbaslik_en=?,filoUstBaslik_tr=?,filoUstBaslik_en=?,filobaslik_tr=?,filobaslik_en=?,yorumUstBaslik_tr=?,yorumUstBaslik_en=?,yorumbaslik_tr=?,yorumbaslik_en=?,iletisimUstBaslik_tr=?,iletisimUstBaslik_en=?,iletisimbaslik_tr=?,iletisimbaslik_en=?,hizmetlerUstBaslik_tr=?,hizmetlerUstBaslik_en=?,hizmetlerbaslik_tr=?,hizmetlerbaslik_en=?,mesajtercih=?,haritabilgi=?,footer=?,url=?");
				
				$guncelleme->bindParam(1,$title,PDO::PARAM_STR);
				$guncelleme->bindParam(2,$metatitle,PDO::PARAM_STR);
				$guncelleme->bindParam(3,$metadesc,PDO::PARAM_STR);
				$guncelleme->bindParam(4,$metakey,PDO::PARAM_STR);
				$guncelleme->bindParam(5,$metaaut,PDO::PARAM_STR);
				$guncelleme->bindParam(6,$metaown,PDO::PARAM_STR);
				$guncelleme->bindParam(7,$metacopy,PDO::PARAM_STR);
				$guncelleme->bindParam(8,$logoyazi,PDO::PARAM_STR);
				$guncelleme->bindParam(9,$face,PDO::PARAM_STR);
				$guncelleme->bindParam(10,$twit,PDO::PARAM_STR);
				$guncelleme->bindParam(11,$inst,PDO::PARAM_STR);
				$guncelleme->bindParam(12,$telno,PDO::PARAM_STR);
				$guncelleme->bindParam(13,$adres,PDO::PARAM_STR);
				$guncelleme->bindParam(14,$mailadres,PDO::PARAM_STR);
				
				$guncelleme->bindParam(15,$slogan_tr,PDO::PARAM_STR);
				$guncelleme->bindParam(16,$slogan_en,PDO::PARAM_STR);
				
				$guncelleme->bindParam(17,$refsayfaUstbas_tr,PDO::PARAM_STR);
				$guncelleme->bindParam(18,$refsayfaUstbas_en,PDO::PARAM_STR);		
				$guncelleme->bindParam(19,$refsayfabas_tr,PDO::PARAM_STR);
				$guncelleme->bindParam(20,$refsayfabas_en,PDO::PARAM_STR);
				
				
				$guncelleme->bindParam(21,$filosayfaUstbas_tr,PDO::PARAM_STR);
				$guncelleme->bindParam(22,$filosayfaUstbas_en,PDO::PARAM_STR);		
				$guncelleme->bindParam(23,$filosayfabas_tr,PDO::PARAM_STR);
				$guncelleme->bindParam(24,$filosayfabas_en,PDO::PARAM_STR);
				
				$guncelleme->bindParam(25,$yorumsayfaUstbas_tr,PDO::PARAM_STR);
				$guncelleme->bindParam(26,$yorumsayfaUstbas_en,PDO::PARAM_STR);		
				$guncelleme->bindParam(27,$yorumsayfabas_tr,PDO::PARAM_STR);
				$guncelleme->bindParam(28,$yorumsayfabas_en,PDO::PARAM_STR);
				
				$guncelleme->bindParam(29,$iletisimsayfaUstbas_tr,PDO::PARAM_STR);
				$guncelleme->bindParam(30,$iletisimsayfaUstbas_en,PDO::PARAM_STR);		
				$guncelleme->bindParam(31,$iletisimsayfabas_tr,PDO::PARAM_STR);
				$guncelleme->bindParam(32,$iletisimsayfabas_en,PDO::PARAM_STR);
				
				$guncelleme->bindParam(33,$hizmetlersayfaUstbas_tr,PDO::PARAM_STR);
				$guncelleme->bindParam(34,$hizmetlersayfaUstbas_en,PDO::PARAM_STR);		
				$guncelleme->bindParam(35,$hizmetlersayfabas_tr,PDO::PARAM_STR);
				$guncelleme->bindParam(36,$hizmetlersayfabas_en,PDO::PARAM_STR);
				
			
				$guncelleme->bindParam(37,$mesajtercih,PDO::PARAM_INT);
				$guncelleme->bindParam(38,$haritabilgi,PDO::PARAM_STR);	
				$guncelleme->bindParam(39,$footer,PDO::PARAM_STR);	
				$guncelleme->bindParam(40,$url,PDO::PARAM_STR);		
				$guncelleme->execute();
			
				?><script> BilgiPenceresi("control.php?sayfa=siteayar","BAŞARILI","Site ayarları başarıyla güncellendi","success"); </script> <?php
				
			
			else:
				?>
			
			<form action="control.php?sayfa=siteayar" method="post">
								<div class="row">
								<div class="col-lg-9 mx-auto mt-2">
									<h3 class="text-dark">SİTE AYARLARI </h3>
									
									</div>
									
									
									
										<!-- ************* -->
									
									<div class="col-lg-9 mx-auto   hafifgri  ">                                
											<div class="row ">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont"> Site Url</span>
												</div>                                            
												<div class="col-lg-9 p-1">
											<input type="text" name="url" class="form-control"  value="<?php echo $sonuc["url"]; ?>" />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								
									<div class="col-lg-9 mx-auto  hafifgri ">
									
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">Title</span>
												</div>                                            
												<div class="col-lg-9 p-1">
				<input type="text" name="title" class="form-control" value="<?php echo $sonuc["title"]; ?>"  />
												</div>
											
											</div>
									
									</div>
									
									
									
									
									<!-- ************* -->
									
									<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont"> Meta Title</span>
												</div>                                            
												<div class="col-lg-9 p-1">
											<input type="text" name="metatitle" class="form-control"  value="<?php echo $sonuc["metatitle"]; ?>" />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								
								<!-- ************* -->
									
									<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">Sayfa açıklama</span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="metadesc" class="form-control" value="<?php echo $sonuc["metadesc"]; ?>"  />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								<!-- ************* -->
									
									<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">Anahtar kelimeler</span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="metakey" class="form-control" value="<?php echo $sonuc["metakey"]; ?>"  />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								
								<!-- ************* -->
									
									<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">Yapımcı</span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="metaaut" class="form-control"  value="<?php echo $sonuc["metaauthor"]; ?>" />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								
								<!-- ************* -->
									
									<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">Firma</span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="metaown" class="form-control"  value="<?php echo $sonuc["metaowner"]; ?>" />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								<!-- ************* -->
									
									<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">Copyright</span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="metacopy" class="form-control" value="<?php echo $sonuc["metacopy"]; ?>"  />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								<!-- ************* -->
									
									<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">Logo yazısı</span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="logoyazi" class="form-control" value="<?php echo $sonuc["logoyazisi"]; ?>"  />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								<!-- ************* -->
									
									<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">Twitter</span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="twit" class="form-control" value="<?php echo $sonuc["twit"]; ?>"  />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								<!-- ************* -->
									
									<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont" >Facebook</span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="face" class="form-control" value="<?php echo $sonuc["face"]; ?>"  />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								<!-- ************* -->
									
									<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">İnstagram</span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="inst" class="form-control"  value="<?php echo $sonuc["ints"]; ?>" />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								<!-- ************* -->
									
									<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">Telefon Numarası</span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="telno" class="form-control" value="<?php echo $sonuc["telefonno"]; ?>"  />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">Adres</span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="adres" class="form-control" value="<?php echo $sonuc["adres"]; ?>"  />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								
								<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">Mail Adresi</span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="mailadres" class="form-control"  value="<?php echo $sonuc["mailadres"]; ?>" />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">Slogan - <span class="text-danger">TR</span></span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="slogan_tr" class="form-control" value="<?php echo $sonuc["slogan_tr"]; ?>" />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								
								
										<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">Slogan - <span class="text-primary">EN</span></span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="slogan_en" class="form-control" value="<?php echo $sonuc["slogan_en"]; ?>" />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								
								
									<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">Referans üst Başlık - <span class="text-danger">TR</span></span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="refsayfaUstbas_tr" class="form-control" value="<?php echo $sonuc["referansUstBaslik_tr"]; ?>"  />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								
									<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">Referans üst Başlık - <span class="text-primary">EN</span></span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="refsayfaUstbas_en" class="form-control" value="<?php echo $sonuc["referansUstBaslik_en"]; ?>"  />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								
								
								<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">Referans Başlık - <span class="text-danger">TR</span></span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="refsayfabas_tr" class="form-control" value="<?php echo $sonuc["referansbaslik_tr"]; ?>"  />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								
									<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">Referans Başlık - <span class="text-primary">EN</span></span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="refsayfabas_en" class="form-control" value="<?php echo $sonuc["referansbaslik_en"]; ?>"  />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								
								
								<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">Filo üst Başlık - <span class="text-danger">TR</span></span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="filosayfaUstbas_tr" class="form-control" value="<?php echo $sonuc["filoUstBaslik_tr"]; ?>"  />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								
								
								<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">Filo üst Başlık - <span class="text-primary">EN</span></span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="filosayfaUstbas_en" class="form-control" value="<?php echo $sonuc["filoUstBaslik_en"]; ?>"  />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								
								<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">Filo Başlık - <span class="text-danger">TR</span></span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="filosayfabas_tr" class="form-control" value="<?php echo $sonuc["filobaslik_tr"]; ?>"  />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								
								<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">Filo Başlık - <span class="text-primary">EN</span></span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="filosayfabas_en" class="form-control" value="<?php echo $sonuc["filobaslik_en"]; ?>"  />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								
								<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">Yorum üst Başlık - <span class="text-danger">TR</span></span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="yorumsayfaUstbas_tr" class="form-control" value="<?php echo $sonuc["yorumUstBaslik_tr"]; ?>"  />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								
									<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">Yorum üst Başlık - <span class="text-primary">EN</span></span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="yorumsayfaUstbas_en" class="form-control" value="<?php echo $sonuc["yorumUstBaslik_en"]; ?>"  />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								
								
								<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">Yorum Başlık - <span class="text-danger">TR</span></span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="yorumsayfabas_tr" class="form-control" value="<?php echo $sonuc["yorumbaslik_tr"]; ?>"  />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								
								<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">Yorum Başlık - <span class="text-primary">EN</span></span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="yorumsayfabas_en" class="form-control" value="<?php echo $sonuc["yorumbaslik_en"]; ?>"  />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								
								
									<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">İletişim üst Başlık - <span class="text-danger">TR</span></span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="iletisimsayfaUstbas_tr" class="form-control"  value="<?php echo $sonuc["iletisimUstBaslik_tr"]; ?>" />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								
									<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">İletişim üst Başlık - <span class="text-primary">EN</span></span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="iletisimsayfaUstbas_en" class="form-control"  value="<?php echo $sonuc["iletisimUstBaslik_en"]; ?>" />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								
								
								<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">İletişim Başlık - <span class="text-danger">TR</span></span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="iletisimsayfabas_tr" class="form-control"  value="<?php echo $sonuc["iletisimbaslik_tr"]; ?>" />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								
									<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">İletişim Başlık - <span class="text-primary">EN</span></span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="iletisimsayfabas_en" class="form-control"  value="<?php echo $sonuc["iletisimbaslik_en"]; ?>" />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								
								
								
								<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">Hizmetler üst Başlık - <span class="text-danger">TR</span></span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="hizmetlersayfaUstbas_tr" class="form-control"  value="<?php echo $sonuc["hizmetlerUstBaslik_tr"]; ?>" />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								
								<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">Hizmetler üst Başlık - <span class="text-primary">EN</span></span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="hizmetlersayfaUstbas_en" class="form-control"  value="<?php echo $sonuc["hizmetlerUstBaslik_en"]; ?>" />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								
								
									<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">Hizmetler Başlık - <span class="text-danger">TR</span></span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="hizmetlersayfabas_tr" class="form-control"  value="<?php echo $sonuc["hizmetlerbaslik_tr"]; ?>" />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
									<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">Hizmetler Başlık - <span class="text-primary">EN</span></span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="hizmetlersayfabas_en" class="form-control"  value="<?php echo $sonuc["hizmetlerbaslik_en"]; ?>" />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								
										<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">Harita Bilgisi</span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="haritabilgi" class="form-control"  value="<?php echo $sonuc["haritabilgi"]; ?>" />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								
											<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">Footer Bilgisi</span>
												</div>                                            
												<div class="col-lg-9 p-1">
												<input type="text" name="footer" class="form-control"  value="<?php echo $sonuc["footer"]; ?>" />
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								
								
								
									<div class="col-lg-9 mx-auto  hafifgri">                                
											<div class="row">
												<div class="col-lg-3 border-right pt-3 text-left">
											<span id="siteayarfont">Mesaj Tercih</span>
												</div>                                            
												<div class="col-lg-9 p-1">
													<div class="row">
													
													<div class="col-lg-4 pt-1 text-danger border-right">
												
												
													
												Sadece Mail                                          
										<input type="radio" name="mesajtercih" value="1" class="mt-2 ml-2" <?php echo ($sonuc["mesajtercih"]==1) ? "checked='checked'": ""; ?>   />
													</div>
													
													<div class="col-lg-4 pt-1 text-danger border-right">
											Hem mail hem mesaj 
										<input type="radio" name="mesajtercih" value="2" class="mt-2 ml-2" <?php echo ($sonuc["mesajtercih"]==2) ? "checked='checked'": ""; ?>/>
													</div>
													<div class="col-lg-4 pt-1 text-danger">
											Sadece Mesaj
										<input type="radio" name="mesajtercih" value="3" class="mt-2 ml-2" <?php echo ($sonuc["mesajtercih"]==3) ? "checked='checked'": ""; ?>/>
													
													</div>
													</div>
												
												
												

												
												
										
												</div>                                        
											</div>                                
									</div>
								<!-- ************* -->
								
								
								
								
								<div class="col-lg-9 mx-auto mt-2 border-bottom">
									<input type="submit" name="buton" class="btn btn-primary m-1" value="GÜNCELLE" />                                
									</div>
								
								</div>
							
						
						
						
						
						
						
						</form>
			
			
							<?php
			
			
							endif;	
		} // site ayar
	//-------------------------------------KULLANICI AYAR
		function sifrele($veri) {		
			return base64_encode(gzdeflate(gzcompress(serialize($veri))));	
		} // şifrele
		function coz($veri) {
			return unserialize(gzuncompress(gzinflate(base64_decode($veri))));
		} // çöz
		function kuladial() {
		
			$cookid=$_COOKIE["kulbilgi"];
			
			$cozduk=self::coz($cookid);
			
			$sorgusonuc=self::sorgum("select * from yonetim where id=$cozduk",1);
			
			return $sorgusonuc["kulad"];
			
		} // kullanıcı adını alıyoru
		function giriskontrol($kulad,$sifre) {
		
			$sifrelihal=md5(sha1(md5($sifre)));
			
			$sor=$this->prepare("select * from yonetim where kulad='$kulad' and sifre='$sifrelihal'");
			$sor->execute();
			
			if ($sor->rowCount()==0) :
			
			
			echo '	<div class="container-fluid bg-white">
				<div class="alert alert-white border border-dark mt-5 col-md-5 mx-auto p-3 text-danger font-14 font-weight-bold"><img src="'.IMG_YONETIM.'load.gif" class="mr-3">BİLGİLER HATALI ! YÖNLENDİRİLİYOR...</div>
				</div>';
			
			
				header("refresh:2,url=index.php");
				
			else:
			$gelendeger=$sor->fetch();
			$sor=$this->prepare("update yonetim set aktif=1 where kulad='$kulad' and sifre='$sifrelihal'");
			$sor->execute();
			
			echo '	<div class="container-fluid bg-white">
				<div class="alert alert-white border border-dark mt-5 col-md-5 mx-auto p-3 text-success font-14 font-weight-bold"><img src="'.IMG_YONETIM.'load.gif" style="height:30px; width:30px;" class="mr-3 text-success">GİRİŞ YAPILIYOR. LÜTFEN BEKLEYİN</div>
				</div>';
			
		
			header("refresh:2,url=control.php");
			
			// coookie
			$id=self::sifrele($gelendeger["id"]);
			setcookie("kulbilgi",$id, time() + 60*60*24);		
				
			
			endif;		
			
		} // giriş kontrol
		function cikis() {
		
			$cookid=$_COOKIE["kulbilgi"];
			
			$cozduk=self::coz($cookid);		
			
			self::sorgum("update yonetim set aktif=0 where id=$cozduk",0);
			
			setcookie("kulbilgi",$cookid, time() - 5);		
			
			header("Location:index.php");
			
		} // çıkış 
		function kontrolet($sayfa) {
	
	
			if (isset($_COOKIE["kulbilgi"])) :
			
			
					if ($sayfa=="ind") : header("Location:control.php"); endif;		
			
			
			else:
			
					if ($sayfa=="cot") : header("Location:index.php"); endif;
			
			
			endif;
		
			
		} // cookie kontrol
	//-------------------------------------İNTRO AYAR
		function introayar() {	
			
			echo '<div class="row text-center">
			<div class="col-lg-12 border-bottom  "><h4 class="float-left mt-3 text-dark mb-2">
			<a href="control.php?sayfa=introresimekle" class="ti-plus bg-dark p-1 text-white mr-2 mt-3"></a>
			İNTRO RESİMLERİ</h4></div>';
			
			$introbilgiler=self::sorgum("select * from intro",2);
			
			while ($sonbilgi=$introbilgiler->fetch(PDO::FETCH_ASSOC)) :
	
			echo '<div class="col-lg-4">
			
					<div class="row  p-1 m-1">
						<div class="col-lg-12">
						<img src="'.URL.$sonbilgi["resimyol"].'">
						<kbd class="bg-white p-2" style="position:absolute; bottom:10px; right:10px;">
						
							<a href="control.php?sayfa=introresimguncelle&id='.$sonbilgi["id"].'" class="ti-reload m-2 text-success" style="font-size:20px;"></a>'; ?>			          
            				
			<a onclick="silmedenSor('control.php?sayfa=introresimsil&id=<?php echo $sonbilgi["id"]; ?>'); return false"  class="ti-trash m-2 text-danger" style="font-size:20px;"></a>
								
							<?php	echo'
						</kbd>
						
						
						</div>
						
				</div>		
						
			</div>';
			
			endwhile;
			
			echo '</div>';
			
		} // mevcut introlar getiriliyor
		function introresimekleme() {
			
			echo '<div class="row text-center">
			<div class="col-lg-12 ">
			';
			
			if ($_POST) :
			// ilk dosyanın boş olup olmamasın bakıcaz
			// dosyanın boyutuna bakıcaz
			// dosyanın uzantısına bakıcaz
			// mutlu son
			
			
			
			if ($_FILES["dosya"]["name"]=="") :
			
			?><script> BilgiPenceresi("control.php?sayfa=introresimekle","BAŞARISIZ","Dosya Yüklenmedi.Boş olamaz","warning"); </script> <?php	
			
					else: // boş dğeilse
					
					$boyut=1024*1024*1;
					
							if ($_FILES["dosya"]["size"] > $boyut) :
							
							?><script> BilgiPenceresi("control.php?sayfa=introresimekle","BAŞARISIZ","Dosya boyutu çok fazla","warning"); </script> <?php	
							
														
								else: // boyutta bir problem yok ise
									
									$izinverilen=array("image/png","image/jpeg");
									
									if (!in_array($_FILES["dosya"]["type"],$izinverilen)) :
									
			?><script> BilgiPenceresi("control.php?sayfa=introresimekle","BAŞARISIZ","İzin verilen uzantı değil","warning"); </script> <?php		
									
																
											else: // artık herşey tamam
																			
		
									 $uzanti=explode(".",$_FILES["dosya"]["name"]);
									 $randdeger=md5(mt_rand(0,9995454));									
									 $yeniisim =$randdeger.".".end($uzanti);
											
							$dosyaminyolu='../img/carousel/'.$yeniisim;
								
											
			move_uploaded_file($_FILES["dosya"]["tmp_name"],$dosyaminyolu);
		
		
		
				?><script> BilgiPenceresi("control.php?sayfa=introayar","BAŞARILI","DOSYA BAŞARIYLA YÜKLENDİ","success"); </script> <?php	
		
					
											
								
								// dosya yüklendikten sonra veritabanınada bu kaydı eklemem lazım
								
							 $dosyaminyolu2=str_replace('../','',$dosyaminyolu);
								
			$kayitekle=self::sorgum("insert into intro (resimyol) VALUES('$dosyaminyolu2')",0);
											
											
											
											endif;
									
								
								
							
							
							endif;
			
			
			
			
			endif;
			
			
			
			else:
			
			?>
                     
            
            <div class="col-lg-12 hafifgri p-2 text-left"><?php $this->SayfaNavi("introayar","İntrolar","İntro Ekle"); ?></div>
            <div class="col-lg-4 mx-auto mt-2">
            	<div class="card card-bordered">
                	<div class="card-body hafifgri card-bordered">
                    <h5 class="title border-bottom border">İntro resim yükleme formu<hr /></h5>
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                    				<p class="card-text"><input type="file" name="dosya" /></p>
                                    <input type="submit" name="buton" value="YÜKLE" class="btn btn-primary mb-1" />
                    
                    </form>
                    
                
			<p class="card-text text-left text-danger border-top">
            * İzin verilen formatlar : jpg-png<br />
            * İzin verilen max.boyut : 5 MB     
            </p>
            
            </div>
            </div>
            </div>
            
            
            <?php
			
			
			endif;
			 echo '</div></div></div>';
			
		} // Yeni intro ekleme
		function introsil() {
		
			$introid=$_GET["id"];
		
			$verial=self::sorgum("select * from intro where id=$introid",1);
			
				echo '<div class="row text-center">
				<div class="col-lg-12">';
				
				
				// dosyayı silme işlemi		
				unlink("../".$verial["resimyol"]);		
				// veritabanı veri silme
				self::sorgum("delete from intro where id=$introid",0);	
				
				
				?><script> BilgiPenceresi("control.php?sayfa=introayar","BAŞARILI","Silme İşlemi Başarılı","success"); </script> <?php	
					

				
		} // intro resim silme
		function introresimguncelleme() {
		
			$gelenintroid=$_GET["id"];
			
			echo '<div class="row text-center">
			<div class="col-lg-12">
			';
			
			if ($_POST) :
			// ilk dosyanın boş olup olmamasın bakıcaz
			// dosyanın boyutuna bakıcaz
			// dosyanın uzantısına bakıcaz
			// mutlu son
			
			$formdangelenid=$_POST["introid"];
			
			if ($_FILES["dosya"]["name"]=="") :	
			
			
			?><script> BilgiPenceresi("control.php?sayfa=introayar","BAŞARISIZ","Dosya Yüklenmedi.Boş olamaz","warning"); </script> <?php	
			
					else: // boş dğeilse
					
					
							if ($_FILES["dosya"]["size"]> (1024*1024*5)) :
							
					?><script> BilgiPenceresi("control.php?sayfa=introayar","BAŞARISIZ","Dosya boyutu çok fazla","warning"); </script> <?php	
								
								else: // boyutta bir problem yok ise
								
								
									$izinverilen=array("image/png","image/jpeg");
									
											if (!in_array($_FILES["dosya"]["type"],$izinverilen)) :
													
			?><script> BilgiPenceresi("control.php?sayfa=introayar","BAŞARISIZ","İzin verilen uzantı değil","warning"); </script> <?php			
											
											else: // artık herşey tamam
											
											
			// dbden mevcut veriyi çektik ve dosyayı sildik.					
			$resimyolunabak=self::sorgum("select * from intro where id=$gelenintroid",1);
			$dbgelenyol='../'.$resimyolunabak["resimyol"];				
			unlink($dbgelenyol);				
			// dbden mevcut veriyi çektik ve dosyayı sildik.
			$dosyaminyolu='../img/carousel/'.$_FILES["dosya"]["name"];	
		    move_uploaded_file($_FILES["dosya"]["tmp_name"],$dosyaminyolu);
		
		
			$dosyaminyolu2=str_replace('../','',$dosyaminyolu);								
			self::sorgum("update intro set resimyol='$dosyaminyolu2' where id=$gelenintroid",0);			
	
				?><script> BilgiPenceresi("control.php?sayfa=introayar","BAŞARILI","DOSYA BAŞARIYLA GÜNCELLENDİ","success"); </script> <?php	
	
							endif;	
							
							
							endif;
			
			
			endif;
			
			
			
			else:
			?>
  			<div class="col-lg-12 hafifgri p-2 text-left"><?php $this->SayfaNavi("introayar","İntrolar","İntro Güncelle"); ?></div>
            <div class="col-lg-4 mx-auto mt-2">
            	<div class="card card-bordered">
                	<div class="card-body  hafifgri card-bordered">
                    <h5 class="title border-bottom">İntro resim Güncelleme formu<hr /></h5>
                    <form action="" method="post" enctype="multipart/form-data">
                    				<p class="card-text"><input type="file" name="dosya" /></p>
                                    <p class="card-text"><input type="hidden" name="introid" value="<?php echo $gelenintroid; ?>" /></p>
                <input type="submit" name="buton" value="GÜNCELLE" class="btn btn-primary mb-1" />
                 
                    </form>
                    
                
			<p class="card-text text-left text-danger border-top">
            * İzin verilen formatlar : jpg-png<br />
            * İzin verilen max.boyut : 5 MB     
            </p>
            
            </div>
            </div>
            </div>
            
            
            <?php
			
			
			endif;
			 echo '</div></div></div>';
			
		} // intro güncelleme	
	//-------------------------------------FİLO AYAR
		function aracfilo() {
			
			echo '<div class="row text-center">
			<div class="col-lg-12 border-bottom"><h4 class="float-left mt-3 text-dark mb-2"><a href="control.php?sayfa=aracfiloekle" class="ti-plus bg-dark p-1 text-white mr-2 mt-3" ></a>ARAÇ FİLO RESİMLERİ</h4>
			
			</div>';
			
			$introbilgiler=self::sorgum("select * from filomuz",2);
			
			while ($sonbilgi=$introbilgiler->fetch(PDO::FETCH_ASSOC)) :
			
			echo '<div class="col-lg-4">
			
					<div class="row  p-1 m-1">
						<div class="col-lg-12">
						<img src="'.URL.$sonbilgi["resimyol"].'">
						
			<kbd class="bg-white p-2" style="position:absolute; bottom:10px; right:10px;">
						
						<a href="control.php?sayfa=aracfiloguncelle&id='.$sonbilgi["id"].'" class="ti-reload m-2 text-success" style="font-size:20px;"></a>'; ?>          
            				
			<a onclick="silmedenSor('control.php?sayfa=aracfilosil&id=<?php echo $sonbilgi["id"]; ?>'); return false"  class="ti-trash m-2 text-danger" style="font-size:20px;"></a>
								
							<?php	echo'
						</kbd>
						
						
						</div>
						
			
						
				</div>		
						
			</div>';
			
			endwhile;
			
			echo '</div>';
			
		} // mevcut filo araçlar getiriliyor
		function aracfiloekleme() {
			
			echo '<div class="row text-center">
			<div class="col-lg-12">
			';
			
			if ($_POST) :			
			
			if ($_FILES["dosya"]["name"]=="") :
			
						
			?><script> BilgiPenceresi("control.php?sayfa=aracfiloekle","BAŞARISIZ","Dosya Yüklenmedi.Boş olamaz","warning"); </script> <?php	
			

			
					else: // boş dğeilse
					
					
							if ($_FILES["dosya"]["size"]> (1024*1024*5)) :					
							
				?><script> BilgiPenceresi("control.php?sayfa=aracfiloekle","BAŞARISIZ","Dosya boyutu çok fazla","warning"); </script> <?php	
								
								else: // boyutta bir problem yok ise
								
								
									$izinverilen=array("image/png","image/jpeg");
									
											if (!in_array($_FILES["dosya"]["type"],$izinverilen)) :
				?><script> BilgiPenceresi("control.php?sayfa=aracfiloekle","BAŞARISIZ","İzin verilen uzantı değil","warning"); </script> <?php														
		
											
											else: // artık herşey tamam
											
									 $uzanti=explode(".",$_FILES["dosya"]["name"]);
									 $randdeger=md5(mt_rand(0,9995454));									
									 $yeniisim =$randdeger.".".end($uzanti);
									 $dosyaminyolu='../img/filo/'.$yeniisim;
								     move_uploaded_file($_FILES["dosya"]["tmp_name"],$dosyaminyolu);
		
					?><script> BilgiPenceresi("control.php?sayfa=aracfilo","BAŞARILI","DOSYA BAŞARIYLA YÜKLENDİ","success"); </script> <?php					// dosya yüklendikten sonra veritabanınada bu kaydı eklemem lazım
								
							$dosyaminyolu2=str_replace('../','',$dosyaminyolu);								
			     			self::sorgum("insert into filomuz (resimyol) VALUES('$dosyaminyolu2')",0);
											endif;
							endif;
					endif;
					else:
					?>
			
 					<div class="col-lg-12 hafifgri p-2 text-left"><?php $this->SayfaNavi("aracfilo","Araç Filosu","Araç Ekle"); ?></div> 
            
            		<div class="col-lg-4 mx-auto mt-2">
            	<div class="card card-bordered">
                	<div class="card-body  hafifgri card-bordered">
                    <h5 class="title border-bottom">Araç Filo resim yükleme formu<hr /></h5>
                    <form action="" method="post" enctype="multipart/form-data">
                   	<p class="card-text"><input type="file" name="dosya" /></p>
                  <input type="submit" name="buton" value="YÜKLE" class="btn btn-primary mb-1" />
                    </form>
                
				<p class="card-text text-left text-danger border-top">
				* İzin verilen formatlar : jpg-png<br />
				* İzin verilen max.boyut : 5 MB     
				</p>            
				</div>
				</div>
				</div>
				<?php
				endif;
				echo '</div></div></div>';
			
		} // Yeni araç ekleme
		function aracfilosil() {
		
			$introid=$_GET["id"];
			
			$verial=self::sorgum("select * from filomuz where id=$introid",1);
			
				echo '<div class="row text-center">
				<div class="col-lg-12">';
				
				
				// dosyayı silme işlemi		
				unlink("../".$verial["resimyol"]);		
				// veritabanı veri silme
				self::sorgum("delete from filomuz where id=$introid",0);		
			?><script> BilgiPenceresi("control.php?sayfa=aracfilo","BAŞARILI","SİLME BAŞARILI","success"); </script> <?php			
		} // araç resim silme
		function aracfiloguncelleme() {
		
			$gelenintroid=$_GET["id"];
			
			echo '<div class="row text-center">
			<div class="col-lg-12">';			
			if ($_POST) :		
			
			$formdangelenid=$_POST["introid"];
			
			if ($_FILES["dosya"]["name"]=="") :
			?><script> BilgiPenceresi("control.php?sayfa=aracfilo","BAŞARISIZ","Dosya Yüklenmedi.Boş olamaz","warning"); </script> <?php				
			
					else: 				
					
							if ($_FILES["dosya"]["size"]> (1024*1024*5)) :
			?><script> BilgiPenceresi("control.php?sayfa=aracfilo","BAŞARISIZ","Dosya boyutu çok fazla","warning"); </script> <?php								
							
								else: 
								
								
									$izinverilen=array("image/png","image/jpeg");
									
											if (!in_array($_FILES["dosya"]["type"],$izinverilen)) :
			?><script> BilgiPenceresi("control.php?sayfa=aracfilo","BAŞARISIZ","İzin verilen uzantı değil","warning"); </script> <?php	
											
											else: 											
											
			// dbden mevcut veriyi çektik ve dosyayı sildik.					
			$resimyolunabak=self::sorgum("select * from filomuz where id=$gelenintroid",1);
			$dbgelenyol='../'.$resimyolunabak["resimyol"];				
			unlink($dbgelenyol);				
			// dbden mevcut veriyi çektik ve dosyayı sildik.
											
			$dosyaminyolu='../img/filo/'.$_FILES["dosya"]["name"];	
		    move_uploaded_file($_FILES["dosya"]["tmp_name"],$dosyaminyolu);
		
			$dosyaminyolu2=str_replace('../','',$dosyaminyolu);								
			self::sorgum("update filomuz set resimyol='$dosyaminyolu2' where id=$gelenintroid",0);
			?><script> BilgiPenceresi("control.php?sayfa=aracfilo","BAŞARILI","DOSYA BAŞARIYLA GÜNCELLENDİ","success"); </script> <?php								
											endif;
							
							endif;
			
			endif;
			
			
			else:
			?>
     			<div class="col-lg-12 hafifgri p-2 text-left"><?php $this->SayfaNavi("aracfilo","Araç Filosu","Araç Güncelle"); ?></div>         
            <div class="col-lg-4 mx-auto mt-2">
            	<div class="card card-bordered">
                	<div class="card-body  hafifgri card-bordered">
                    <h5 class="title border-bottom">Araç Filo resim Güncelleme formu<hr /></h5>
                    <form action="" method="post" enctype="multipart/form-data">
                    	<p class="card-text"><input type="file" name="dosya" /></p>
                        <p class="card-text"><input type="hidden" name="introid" value="<?php echo $gelenintroid; ?>" /></p>
                 <input type="submit" name="buton" value="GÜNCELLE" class="btn btn-primary mb-1" />                
                    </form>
                
			<p class="card-text text-left text-danger border-top">
            * İzin verilen formatlar : jpg-png<br />
            * İzin verilen max.boyut : 5 MB     
            </p>
            
            </div>
            </div>
            </div>
            
            
            <?php
			
			
			endif;
			 echo '</div></div></div>';
			
		} // araç güncelleme		
	//-------------------------------------GELEN MAİLLER AYAR
		private function mailgetir($veriler) {
			$sor=$this->prepare("select * from $veriler[0] where durum=$veriler[1]");
			$sor->execute();
			return $sor;	
			
		} // mailim sorgusu		
		function gelenmesajlar() {
		
			echo '<div class="row">
					<div class="col-lg-12 mt-2">
						<div class="card">
							<div class="card-body">
							<ul class="nav nav-tabs" id="myTab" role="tablist">
							
							
							<li class="nav-item">
			<a class="nav-link active" id="gelen-tab" data-toggle="tab" href="#gelen" role="tab" aria-control="gelen" aria-selected="true"><kbd>'.self::mailgetir(array("gelenmail",0))->rowCount().'</kbd> Gelen Mesajlar</a>
					</li>
					
					
								<li class="nav-item">
			<a class="nav-link" id="okunmus-tab" data-toggle="tab" href="#okunmus" role="tab" aria-control="okunmus" aria-selected="false"><kbd>'.self::mailgetir(array("gelenmail",1))->rowCount().'</kbd> Okunmuş Mesajlar</a>
					</li>
					
								<li class="nav-item">
			<a class="nav-link" id="arsiv-tab" data-toggle="tab" href="#arsiv" role="tab" aria-control="arsiv" aria-selected="false"><kbd>'.self::mailgetir(array("gelenmail",2))->rowCount().'</kbd> Arşivlenmiş mesajlar</a>
					</li>						
							
							</ul>
							
					<div class="tab-content mt-3" id="benimTab">
					
					
			<div class="tab-pane fade show active" id="gelen" role="tabpanel" aria-labelledby="gelen-tab">';
		
			$sonuc=self::mailgetir(array("gelenmail",0));
		
			if ($sonuc->rowCount()!=0) :
		
					while ($sonucson=$sonuc->fetch(PDO::FETCH_ASSOC)) :
					
					echo '<div class="row">
					<div class="col-lg-12 bg-light mt-2 font-weight-bold" style="border-radius:5px; border:1px solid #eeeeee;">
								<div class="row border-bottom">
								
										<div class="col-lg-1 p-1">Ad & Ünvan</div>
										<div class="col-lg-2 p-1 text-primary">'.$sonucson["ad"].'</div>
										<div class="col-lg-1 p-1">Mail Adresi</div>
										<div class="col-lg-2 p-1 text-primary">'.$sonucson["mailadres"].'</div>
										<div class="col-lg-1 p-1">Konu</div>
										<div class="col-lg-2 p-1 text-primary">'.$sonucson["konu"].'</div>
										<div class="col-lg-1 p-1">Tarih</div>
										<div class="col-lg-1 p-1 text-primary">'.$sonucson["zaman"].'</div>
										<div class="col-lg-1 p-1">
									<a href="control.php?sayfa=mesajoku&id='.$sonucson["id"].'">	<i class="fa fa-folder-open border-right pr-2 text-dark" style="font-size:20px;"></i></a>
										
										<a href="control.php?sayfa=mesajarsivle&id='.$sonucson["id"].'"><i class="fa fa-share border-right pr-2 text-dark" style="font-size:20px;"></i></a>
										
									<a href="control.php?sayfa=mesajsil&id='.$sonucson["id"].'">	<i class="fa fa-close  pr-2 text-dark" style="font-size:20px;"></i></a>
										
										</div>
						
					</div>
					</div>
					</div>';				
					endwhile;			
					
			else:
			
			echo '<div class="alert alert-info">Gelen Mesaj Yok</div>';	
			endif;
		
			echo'</div>					
			<div class="tab-pane fade" id="okunmus" role="tabpanel" aria-labelledby="okunmus-tab">';
		
			$sonuc=self::mailgetir(array("gelenmail",1));
		
			if ($sonuc->rowCount()!=0) :
		
					while ($sonucson=$sonuc->fetch(PDO::FETCH_ASSOC)) :
					
					echo '<div class="row">
					<div class="col-lg-12 bg-light mt-2 font-weight-bold" style="border-radius:5px; border:1px solid #eeeeee;">
								<div class="row border-bottom">
								
										<div class="col-lg-1 p-1">Ad & Ünvan</div>
										<div class="col-lg-2 p-1 text-primary">'.$sonucson["ad"].'</div>
										<div class="col-lg-1 p-1">Mail Adresi</div>
										<div class="col-lg-2 p-1 text-primary">'.$sonucson["mailadres"].'</div>
										<div class="col-lg-1 p-1">Konu</div>
										<div class="col-lg-2 p-1 text-primary">'.$sonucson["konu"].'</div>
										<div class="col-lg-1 p-1">Tarih</div>
										<div class="col-lg-1 p-1 text-primary">'.$sonucson["zaman"].'</div>
										<div class="col-lg-1 p-1">
									<a href="control.php?sayfa=mesajoku&id='.$sonucson["id"].'">	<i class="fa fa-folder-open border-right pr-2 text-dark" style="font-size:20px;"></i></a>
										
										<a href="control.php?sayfa=mesajarsivle&id='.$sonucson["id"].'"><i class="fa fa-share border-right pr-2 text-dark" style="font-size:20px;"></i></a>
										
									<a href="control.php?sayfa=mesajsil&id='.$sonucson["id"].'">	<i class="fa fa-close  pr-2 text-dark" style="font-size:20px;"></i></a>
										</div>
						
					</div>
					</div>
					</div>';				
					endwhile;			
			else:		
			echo '<div class="alert alert-info">Okunmuş mesaj yok</div>';		
		
		
			endif;
		
		
			echo'</div>
							
			<div class="tab-pane fade" id="arsiv" role="tabpanel" aria-labelledby="arsiv-tab">';
		
			$sonuc=self::mailgetir(array("gelenmail",2));
		
			if ($sonuc->rowCount()!=0) :
		
					while ($sonucson=$sonuc->fetch(PDO::FETCH_ASSOC)) :
					
					echo '<div class="row">
					<div class="col-lg-12 bg-light mt-2 font-weight-bold" style="border-radius:5px; border:1px solid #eeeeee;">
								<div class="row border-bottom">
								
										<div class="col-lg-1 p-1">Ad & Ünvan</div>
										<div class="col-lg-2 p-1 text-primary">'.$sonucson["ad"].'</div>
										<div class="col-lg-1 p-1">Mail Adresi</div>
										<div class="col-lg-2 p-1 text-primary">'.$sonucson["mailadres"].'</div>
										<div class="col-lg-1 p-1">Konu</div>
										<div class="col-lg-2 p-1 text-primary">'.$sonucson["konu"].'</div>
										<div class="col-lg-1 p-1">Tarih</div>
										<div class="col-lg-1 p-1 text-primary">'.$sonucson["zaman"].'</div>
										<div class="col-lg-1 p-1">
									<a href="control.php?sayfa=mesajoku&id='.$sonucson["id"].'">	<i class="fa fa-folder-open border-right pr-2 text-dark" style="font-size:20px;"></i></a>
										
										<a href="control.php?sayfa=mesajarsivle&id='.$sonucson["id"].'"><i class="fa fa-close border-right pr-2 text-dark" style="font-size:20px;"></i></a>'; ?>          
								
			<a onclick="silmedenSor('control.php?sayfa=mesajsil&id=<?php echo $sonucson["id"]; ?>'); return false"  class="ti-trash m-2 text-dark" style="font-size:20px;"></a>
									
								<?php	echo'</div>					
					</div>
					</div>
					</div>';				
					endwhile;		
					
			else:
			
			echo '<div class="alert alert-info">Arşivlenmiş Mesaj Yok</div>';
		
			endif;
		
			echo'</div></div></div></div></div></div>';	
		} // gelen mesajlar iskelet
		function mesajdetay($id) {
		
			$mesajbilgi=self::sorgum("select * from gelenmail where id=$id",1);
		
			echo '<div class="row m-2">
				<div class="col-lg-12 bg-light mt-2 font-weight-bold" style="border-radius:5px; border:1px solid #eeeeee;">
							<div class="row border-bottom">							
									<div class="col-lg-1 p-1">Ad & Ünvan</div>
									<div class="col-lg-2 p-1 text-primary">'.$mesajbilgi["ad"].'</div>
									<div class="col-lg-1 p-1">Mail Adresi</div>
									<div class="col-lg-2 p-1 text-primary">'.$mesajbilgi["mailadres"].'</div>
									<div class="col-lg-1 p-1">Konu</div>
									<div class="col-lg-2 p-1 text-primary">'.$mesajbilgi["konu"].'</div>
									<div class="col-lg-1 p-1">Tarih</div>
									<div class="col-lg-1 p-1 text-primary">'.$mesajbilgi["zaman"].'</div>
									<div class="col-lg-1 p-1 text-right">
															
									<a href="control.php?sayfa=mesajarsivle&id='.$mesajbilgi["id"].'"><i class="fa fa-share border-right pr-2 text-dark" style="font-size:20px;"></i></a>
									
								<a href="control.php?sayfa=mesajsil&id='.$mesajbilgi["id"].'">	<i class="fa fa-close  pr-2 text-dark" style="font-size:20px;"></i></a>									
																		
									</div>								
									
									</div>
									<div class="row text-left p-2">
										<div class="col-lg-12">
										'.$mesajbilgi["mesaj"].'
										</div>									
									</div>					
				
				</div>
				</div>				
				</div>';
				
		
			if ($mesajbilgi["durum"]!=2) :
			self::sorgum("update gelenmail set durum=1 where id=$id",0);
			
			endif;
		} // mesaj detay
		function mesajarsivle($id) {
		
			echo '<div class="row m-2">
			<div class="col-lg-12  mt-2 " style="border-radius:5px; border:1px solid #eeeeee;">	</div></div>';
							
			?><script> BilgiPenceresi("control.php?sayfa=gelenmesaj","BAŞARILI","MESAJ ARŞİVLENDİ","success"); </script> <?php				
			
			self::sorgum("update gelenmail set durum=2 where id=$id",0);		
		} // mesaj arşiv
		function mesajsil($id) {		
		
				echo '<div class="row m-2">
			<div class="col-lg-12  mt-2 " style="border-radius:5px; border:1px solid #eeeeee;"></div></div>';
							
			?><script> BilgiPenceresi("control.php?sayfa=gelenmesaj","BAŞARILI","MESAJ SİLİNDİ","success"); </script> <?php				
			self::sorgum("delete from gelenmail where id=$id",0);
	
		
		} // mesaj sil	
	

	 
	
}



?>