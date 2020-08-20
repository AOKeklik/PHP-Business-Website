<?php 


	class yonetim2 extends yonetim 
	{
		function __construct() {
			parent::__construct();//vt baglantisi icin
		}
		protected $tercihArray=array("Açık","Kapalı");
	//-----------------REFERANSLAR
		function referanslarhepsi(){
		
	
			echo '<div class="row text-center">
			<div class="col-lg-12 border-bottom "><h4 class="float-left mt-3 text-dark mb-1">
			<a href="control.php?sayfa=refekle" class="ti-plus bg-dark p-1 text-white mr-2 mt-3" ></a>
			REFERANSLAR</h4></div>';
			
			$introbilgiler=self::sorgum("select * from referanslar",2);
			
			while ($sonbilgi=$introbilgiler->fetch(PDO::FETCH_ASSOC)) :
			
			echo '<div class="col-lg-2 ">
			
					<div class="row card-bordered p-1 m-1 hafifgri">
					
						<div class="col-lg-12">
						<img src="'.URL.$sonbilgi["resimyol"].'">'; ?>        
            				
			<a onclick="silmedenSor('control.php?sayfa=refsil&id=<?php echo $sonbilgi["id"]; ?>'); return false"  class="fa fa-trash m-2 text-danger" style="font-size:20px;"></a>
								
							<?php	echo'</div>						
				</div>		
						
			</div>';
			
			endwhile;
			
			echo '</div>';
			
		} // mevcut referanslar
		function refekleme(){
			
			echo '<div class="row text-center">
			<div class="col-lg-12">';
			
			if ($_POST) :
			
			
			if ($_FILES["dosya"]["name"]=="") :
			?><script> BilgiPenceresi("control.php?sayfa=ref","BAŞARISIZ","Dosya Yüklenmedi.Boş olamaz","warning"); </script> <?php		

			
					else: // boş dğeilse
					
					
							if ($_FILES["dosya"]["size"]> (1024*1024*5)) :
				?><script> BilgiPenceresi("control.php?sayfa=ref","BAŞARISIZ","Dosya boyutu çok fazla","warning"); </script> <?php									
							
								else: // boyutta bir problem yok ise
								
								
									$izinverilen=array("image/png","image/jpeg");
									
											if (!in_array($_FILES["dosya"]["type"],$izinverilen)) :
				?><script> BilgiPenceresi("control.php?sayfa=ref","BAŞARISIZ","İzin verilen uzantı değil","warning"); </script> <?php														
									
											else: // artık herşey tamam
											
									 $uzanti=explode(".",$_FILES["dosya"]["name"]);
									 $randdeger=md5(mt_rand(0,9995454));									
									 $yeniisim =$randdeger.".".end($uzanti);		
											
											
											
							$dosyaminyolu='../img/referans/'.$yeniisim;
								
											
				move_uploaded_file($_FILES["dosya"]["tmp_name"],$dosyaminyolu);
				?><script> BilgiPenceresi("control.php?sayfa=ref","BAŞARILI","DOSYA BAŞARIYLA YÜKLENDİ","success"); </script> <?php			
							$dosyaminyolu2=str_replace('../','',$dosyaminyolu);
								
						self::sorgum("insert into referanslar (resimyol) VALUES('$dosyaminyolu2')",0);
											
											endif;
							
							endif;
					endif;
			
				else:
				?>
             		<div class="col-lg-12 hafifgri p-2 text-left"><?php $this->SayfaNavi("ref","Referanslar","Referans Ekle"); ?></div>           
            
            
            	<div class="col-lg-4 mx-auto mt-2">
            	<div class="card card-bordered">
                	<div class="card-body  hafifgri card-bordered">
                    <h5 class="title border-bottom">Referans ekleme formu<hr /></h5>
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
			
		} // referanslar ekleme
		function refsil(){
			$refid=$_GET["id"];
		
			$verial=self::sorgum("select * from referanslar where id=$refid",1);
		
			echo '<div class="row text-center">
			<div class="col-lg-12">';
			
			
			// dosyayı silme işlemi		
			unlink("../".$verial["resimyol"]);		
			// veritabanı veri silme
			self::sorgum("delete from referanslar where id=$refid",0);		
			?><script> BilgiPenceresi("control.php?sayfa=ref","BAŞARILI","SİLME BAŞARILI","success"); </script> <?php		
		
		} // referanslar silme
	//---------- MÜŞTERİ YORUMLARI
		function yorumlarhepsi(){
			
			echo '<div class="row text-center">
			<div class="col-lg-12 border-bottom"><h4 class="float-left mt-3 text-dark mb-1">
			<a href="control.php?sayfa=yorumlarekle" class="ti-plus bg-dark p-1 text-white mr-2 mt-3" ></a>
			MÜŞTERİ YORUMLARI</h4>
			</div>';
			
			$introbilgiler=self::sorgum("select * from yorumlar",2);
			
			while ($sonbilgi=$introbilgiler->fetch(PDO::FETCH_ASSOC)) :
			
			echo '<div class="col-lg-3">
			
					<div class="row card-bordered p-1 m-1 hafifgri" style="border-radius:10px;">
					
					
					
						<div class="col-lg-9 pt-1 text-left">
						<h5>İsim : '.$sonbilgi["isim"].'</h5>
						</div>
						
						<div class="col-lg-3 text-right p-2">
						<a href="control.php?sayfa=yorumlarguncelle&id='.$sonbilgi["id"].'" class="ti-reload text-success" style="font-size:20px;"></a>'; ?>          
            				
			<a onclick="silmedenSor('control.php?sayfa=yorumlarsil&id=<?php echo $sonbilgi["id"]; ?>'); return false"  class="ti-trash text-danger pl-1" style="font-size:20px;"></a>
								
							<?php	echo'
						</div>
						
						<div class="col-lg-12 border-top text-secondary text-left bg-white">
						'.$sonbilgi["icerik"].'
						</div>
						
					
						
				</div>		
						
			</div>';
			
			endwhile;
			
			echo '</div>';
			
		} // yorumlar geliyor
		function yorumlarekleme(){
			?> <div class="col-lg-12 hafifgri p-2 text-left"><?php $this->SayfaNavi("yorumlar","Müşteri yorumları","Yorum Ekle"); ?></div>  
			
			<?php echo '<div class="row text-center">
			<div class="col-lg-12 border-bottom"><h3 class="mt-3 text-dark">YORUM EKLE</h3>
			</div>';
			
	
			if (!$_POST):	
	
 
			
			echo '<div class="col-lg-6 mx-auto">
			
					<div class="row card-bordered p-1 m-1 hafifgri">
					
						<div class="col-lg-2 pt-2">
						Müşteri İsmi
						</div>
						
						<div class="col-lg-10 p-2">
						<form action="" method="post">
						<input type="text" name="isim" class="form-control">
						</div>
						
					
						
						<div class="col-lg-12 border-top p-2">
						Mesaj
						</div>
						<div class="col-lg-12 border-top p-2">
						<textarea name="mesaj" rows="5" class="form-control" id="editor9"></textarea>
						'; ?>
						
					
                      <script>
        		ClassicEditor
            .create( document.querySelector( '#editor9' ) )
            .catch( error => {
                console.error( error );
            } );
    		</script>
                    
               
                    	
				<?php
						
					echo'
						</div>
						
						<div class="col-lg-12 border-top p-2">
						<input type="submit" name="buton" value="YORUM EKLE" class="btn btn-primary">
						</form>
						</div>
						
					
						
				</div>		
						
			</div>';
			else:
			
			$isim=htmlspecialchars($_POST["isim"]);
			$mesaj=$_POST["mesaj"];
			
					if ($isim=="" && $mesaj=="") :
						
			?><script> BilgiPenceresi("control.php?sayfa=yorumlar","BAŞARISIZ","VERİLER BOŞ OLAMAZ","warning"); </script> <?php			
								else:
				self::sorgum("insert into yorumlar (icerik,isim) VALUES('$mesaj','$isim')",0);	
			?><script> BilgiPenceresi("control.php?sayfa=yorumlar","BAŞARILI","YORUM BAŞARIYLA EKLENDİ","success"); </script> <?php		
					endif;
			endif;
			echo '</div>';
			
		} // yorum ekle
		function yorumlarguncelleme(){
		
		
				?> <div class="col-lg-12 hafifgri p-2 text-left"><?php $this->SayfaNavi("yorumlar","Müşteri yorumları","Yorum Güncelle"); ?></div>  	
		
			<?php
			echo '<div class="row text-center">
			<div class="col-lg-12 border-bottom"><h3 class="mt-3 text-dark">YORUM GÜNCELLE</h3>
			</div>';
	
			$kayitid=$_GET["id"];
		
			$kayitbilgial=self::sorgum("select * from yorumlar where id=$kayitid",1);	
			
	
			if (!$_POST):	
			
			echo '<div class="col-lg-6 mx-auto">
			
					<div class="row card-bordered p-1 m-1 hafifgri">
					
						<div class="col-lg-2 pt-2">
							Müşteri İsmi
						</div>
						
						<div class="col-lg-10 p-2">
						<form action="" method="post">
						<input type="text" name="isim" class="form-control" value="'.$kayitbilgial["isim"].'">
						</div>
						
					
						
						<div class="col-lg-12 border-top p-2">
						İçerik
						</div>
						<div class="col-lg-12 border-top p-2">
						<textarea name="mesaj" rows="5" class="form-control" id="editor8">'.$kayitbilgial["icerik"].'</textarea>
						'; ?>
						
					
                      <script>
        		ClassicEditor
            .create( document.querySelector( '#editor8' ) )
            .catch( error => {
                console.error( error );
            } );
    		</script>
                    
                    
                    	
				<?php
						
					echo'
						</div>
						
						<div class="col-lg-12 border-top p-2">
						<input type="hidden" name="kayitidsi" value="'.$kayitid.'">
						<input type="submit" name="buton" value="YORUM GÜNCELLE" class="btn btn-primary">
						</form>
						</div>
						
					
						
				</div>		
						
			</div>';
			
			
			
			else:
			
			$isim=htmlspecialchars($_POST["isim"]);
			$mesaj=$_POST["mesaj"];
			$kayitidsi=htmlspecialchars($_POST["kayitidsi"]);
			
					if ($isim=="" && $mesaj=="") :
						
			?><script> BilgiPenceresi("control.php?sayfa=yorumlar","BAŞARISIZ","VERİLER BOŞ OLAMAZ","warning"); </script> <?php						
			
							else:							
							
				self::sorgum("update yorumlar set icerik='$mesaj',isim='$isim' where id=$kayitidsi",0);	
			?><script> BilgiPenceresi("control.php?sayfa=yorumlar","BAŞARILI","GÜNCELLEME BAŞARILI","success"); </script> <?php	
			
					
					endif;
			
			endif;			
			echo '</div>';
			
		} // yorum güncelle
		function yorumlarsil (){	
	
			$kayitid=$_GET["id"];
		
			echo '<div class="row text-center">
			<div class="col-lg-12">';
			
			self::sorgum("delete from yorumlar where id=$kayitid",0);		
			?><script> BilgiPenceresi("control.php?sayfa=yorumlar","BAŞARILI","SİLME BAŞARILI","success"); </script> <?php	
		} // yorum sil
	//---------- MAİL AYARLAR	
		function mailayar(){
		
			$sonuc=self::sorgum("select * from gelenmailayar",1);
		
			if ($_POST) :
		
			$host=htmlspecialchars($_POST["host"]);
			$mailadres=htmlspecialchars($_POST["mailadres"]);
			$sifre=htmlspecialchars($_POST["sifre"]);
			$port=htmlspecialchars($_POST["port"]);
			$alicimail=htmlspecialchars($_POST["alicimail"]);
	
		
			$guncelleme=$this->prepare("update gelenmailayar set host=?,mailadres=?,sifre=?,port=?,aliciadres=?");
		
			$guncelleme->bindParam(1,$host,PDO::PARAM_STR);
			$guncelleme->bindParam(2,$mailadres,PDO::PARAM_STR);
			$guncelleme->bindParam(3,$sifre,PDO::PARAM_STR);
			$guncelleme->bindParam(4,$port,PDO::PARAM_STR);
			$guncelleme->bindParam(5,$alicimail,PDO::PARAM_STR);
			$guncelleme->execute();
	
			?><script> BilgiPenceresi("control.php?sayfa=mailayar","BAŞARILI","Mail ayarları başarıyla güncellendi","success"); </script> <?php		

		
			else:
			?>
        
        	<form action="control.php?sayfa=mailayar" method="post">
                   			<div class="row text-center">
                            
                            <div class="col-lg-5 mx-auto border border-dark hafifgri">
                            
                           	 <div class="col-lg-12 mx-auto mt-2">
                                <h3 class="text-dark">MAİL AYARLARI</h3>
                                
                                </div>
                            
                            	<div class="col-lg-12 mx-auto mt-2 border">
                                
                               			<div class="row">
                                        	<div class="col-lg-3 border-right pt-3 text-left">
                                          <span id="siteayarfont">Host</span>
                                            </div>                                            
                                            <div class="col-lg-9 p-1">
         	<input type="text" name="host" class="form-control" value="<?php echo $sonuc["host"]; ?>"  />
                                            </div>
                                        
                                        </div>
                                
                                </div>
                                <!-- ************* -->
                                
                                <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-3 border-right pt-3 text-left">
                                          <span id="siteayarfont"> Mail Adres</span>
                                            </div>                                            
                                            <div class="col-lg-9 p-1">
                                           <input type="text" name="mailadres" class="form-control"  value="<?php echo $sonuc["mailadres"]; ?>" />
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->
                             
                              <!-- ************* -->
                                
                                <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-3 border-right pt-3 text-left">
                                          <span id="siteayarfont">Host Şifre</span>
                                            </div>                                            
                                            <div class="col-lg-9 p-1">
                                            <input type="text" name="sifre" class="form-control" value="<?php echo $sonuc["sifre"]; ?>"  />
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->
                              <!-- ************* -->
                                
                                <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-3 border-right pt-3 text-left">
                                          <span id="siteayarfont">Port</span>
                                            </div>                                            
                                            <div class="col-lg-9 p-1">
                                            <input type="text" name="port" class="form-control" value="<?php echo $sonuc["port"]; ?>"  />
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->   
                             
                             <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-3 border-right pt-3 text-left">
                                          <span id="siteayarfont">Alıcı Mail</span>
                                            </div>                                            
                                            <div class="col-lg-9 p-1">
                                            <input type="text" name="alicimail" class="form-control" value="<?php echo $sonuc["aliciadres"]; ?>"  />
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->                       
                              
                             
                             
                            
                            <div class="col-lg-12 mx-auto mt-2 ">
                                <input type="submit" name="buton" class="btn btn-primary m-1" value="GÜNCELLE" />                                
                                </div>
                                
                                
                                 </div>
                            
                            </div>
                        
                    
                    
                    
                    
                    
                    
                    </form>
        
        
        		<?php
		
		
				endif;	
		} // mail ayar
	//---------- KULLANICI AYARLAR	
		function ayarlar(){
			$id=self::coz($_COOKIE["kulbilgi"]);
		
			$sonuc=self::sorgum("select * from yonetim where id=$id",1);
		
		
		
					if ($_POST) :
					
					@$kulad=htmlspecialchars($_POST["kulad"]);
					@$eskisif=htmlspecialchars($_POST["sifre"]);
					@$yenisif=htmlspecialchars($_POST["yenisifre"]);
					@$yenisif2=htmlspecialchars($_POST["yenisifre2"]);
					
					// ilk yazılan eski şifre şifreleme algoritmamıza göre şifrelenerek db ile karışılaştırılacak
					// girilen yeni şifrelelerin birbiriyle aynı olup olmamasını kontrol edeceğiz
					
					
					if (empty($kulad) || empty($eskisif) || empty($yenisif) || empty($yenisif2)) :
				?><script> BilgiPenceresi("control.php?sayfa=ayarlar","BAŞARISIZ","HİÇBİR ALAN BOŞ GEÇİLEMEZ","warning"); </script> <?php		
				
					else:
		
		
		
						$sifrelihal=md5(sha1(md5($eskisif)));
						
						if ($sonuc["sifre"]!=$sifrelihal) :
					?><script> BilgiPenceresi("control.php?sayfa=ayarlar","BAŞARISIZ","ESKİ ŞİFRE HATALI GİRİLDİ","warning"); </script> <?php			
						
						else:
						
										if ($yenisif!=$yenisif2) :
				?><script> BilgiPenceresi("control.php?sayfa=ayarlar","BAŞARISIZ","YENİ ŞİFRELER UYUMSUZ","warning"); </script> <?php				
										else:
						
						$yenisifson=md5(sha1(md5($yenisif)));
	
		
					$guncelleme=$this->prepare("update yonetim set kulad=?,sifre=? where id=$id");
					
					$guncelleme->bindParam(1,$kulad,PDO::PARAM_STR);
					$guncelleme->bindParam(2,$yenisifson,PDO::PARAM_STR);		
					$guncelleme->execute();
	
					?><script> BilgiPenceresi("control.php?sayfa=ayarlar","BAŞARILI","BİLGİLER BAŞARIYLA GÜNCELLENDİ","success"); </script> <?php			
						
						endif;
		
				endif;
		
		
		
				endif;
		
		
		
				else:
				?>
        
        		<form action="control.php?sayfa=ayarlar" method="post">
                   			<div class="row text-center">
                            
                            <div class="col-lg-5 mx-auto">
                            
                           	 <div class="col-lg-12 mx-auto mt-2">
                                <h3 class="text-dark">KULLANICI AYARLARI</h3>
                                
                                </div>
                            
                            	<div class="col-lg-12 mx-auto mt-2 border">
                                
                               			<div class="row">
                                        	<div class="col-lg-4 border-right pt-3 text-left">
                                          <span id="siteayarfont">Kullanıcı Adı</span>
                                            </div>                                            
                                            <div class="col-lg-8 p-1">
         		<input type="text" name="kulad" class="form-control" value="<?php echo $sonuc["kulad"]; ?>"  />
                                            </div>
                                        
                                        </div>
                                
                                </div>
                                <!-- ************* -->
                                
                                <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-4 border-right pt-3 text-left">
                                          <span id="siteayarfont">Şifre</span>
                                            </div>                                            
                                            <div class="col-lg-8 p-1">
                                           <input type="password" name="sifre" class="form-control"  />
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->
                             
                              <!-- ************* -->
                                
                                <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-4 border-right pt-3 text-left">
                                          <span id="siteayarfont">Yeni Şifre</span>
                                            </div>                                            
                                            <div class="col-lg-8 p-1">
                                            <input type="password" name="yenisifre" class="form-control"  />
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->
                              <!-- ************* -->
                                
                                <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-4 border-right pt-3 text-left">
                                          <span id="siteayarfont">Yeni Şifre Tekrar</span>
                                            </div>                                            
                                            <div class="col-lg-8 p-1">
                                            <input type="password" name="yenisifre2" class="form-control"  />
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->                         
                              
                             
                             
                            
                            <div class="col-lg-12 mx-auto mt-2 ">
                                <input type="submit" name="buton" class="btn btn-primary m-1" value="DEĞİŞTİR" />                                
                                </div>
                                
                                
                                 </div>
                            
                            </div>
                    
                    
                    
                    </form>
        
        
        			<?php		
		
				endif;	
		
		} // kullanıcı  ayarları
	//---------- KULLANICI EKLEME VE SİLME	
		function CheckBoxDuzenle($name){
			if (isset($_POST[$name])) :
			return 1;
			
			else:
			
			return 0;
			
			endif;
		}
		function CheckKontrol ($isim,$mevcutyetki){
	
			if ($mevcutyetki==1) :
			
			echo '<input type="checkbox" name="'.$isim.'" id="check" checked="checked" />';
			
			else:
			echo '<input type="checkbox" name="'.$isim.'" id="check"/>';
			
			endif;
		}
		function kullistele(){
		
			$al=self::sorgum("select * from yonetim",2);	
		
			echo '<div class="row text-center ">
					<div class="col-lg-6 mt-5 mx-auto">
						<div class="card">
							<div class="card-body ">
								<h4 class="header-title text-dark">
						<a href="control.php?sayfa=yonekle" class="ti-plus bg-dark p-1 text-white mr-2 mt-3"></a>		
								
								KULLANICILAR</h4>
										<div class="single-table hafifgri">
											<div class="table-responsive">
											<table class="table text-center border ">
												<thead >
												<tr class="bg-secondary text-white">
												<th scope="col" class="border-right">Ad</th>
												<th scope="col" class="border-right">Genel Yetki</th>
												<th scope="col">İşlem</th>												
												</tr>
												</thead>
												<tbody>';
												
												
											while ($yonson=$al->fetch(PDO::FETCH_ASSOC)) :
											
											echo '<tr>
										<th scope="row" class="border-right">'.$yonson["kulad"].'</th>
										<th scope="row" class="border-right">';
										
										switch ($yonson["genelYetki"]) :
										
										case "1":
										echo "<span class='text-success'>Tam Yetki</span>";
										break;
										case "2":
										echo "<span class='text-danger'>Editör Yetki</span>";
										break;
										case "3":
										echo "<span class='text-primary'>Üye Yetki</span>";
										break;
										
										
										
										endswitch;
										
										
										
										
										
										echo'</th>
								<th scope="row">
								<a href="control.php?sayfa=yoneticiguncelle&id='.$yonson["id"].'" class="ti-reload text-success" id="guncelleBtn">
								</a>'; ?>          
            				
				<a onclick="silmedenSor('control.php?sayfa=yonsil&id=<?php echo $yonson["id"]; ?>'); return false"><i class="ti-trash text-danger" style="font-size:20px;"></i></a>
								
							<?php	echo'</th>
													</tr>';
											
											endwhile;	
												
													
																									
												
												echo'</tbody>
												</table>
					</div></div></div></div></div>';
		
		} // yoneticiler hepsi	
		function yonsil($id){
			echo '<div class="row m-2">
				<div class="col-lg-12  mt-2 " style="border-radius:5px; border:1px solid #eeeeee;"></div></div>';
				
				?><script> BilgiPenceresi("control.php?sayfa=kulayar","BAŞARILI","YÖNETİCİ  SİLİNDİ","success"); </script> <?php	self::sorgum("delete from yonetim where id=$id",0);
		} // yonetici sil
		function yonekle(){	
		
			if ($_POST) :
			
			$kulad=htmlspecialchars($_POST["kulad"]);
			$yenisif=htmlspecialchars($_POST["yenisifre"]);
			$yenisif2=htmlspecialchars($_POST["yenisifre2"]);
			
			$genelYetki=htmlspecialchars($_POST["genelYetki"]);
			
			$introYetki=$this->CheckBoxDuzenle("introYetki");		
			$aracYetki=$this->CheckBoxDuzenle("aracYetki");
			$videoYetki=$this->CheckBoxDuzenle("videoYetki");
			$hakkimizYetki=$this->CheckBoxDuzenle("hakkimizYetki");
			$hizmetlerYetki=$this->CheckBoxDuzenle("hizmetlerYetki");
			$referansYetki=$this->CheckBoxDuzenle("referansYetki");
			$tasarimYetki=$this->CheckBoxDuzenle("tasarimYetki");
			$yorumYetki=$this->CheckBoxDuzenle("yorumYetki");
			$mesajYetki=$this->CheckBoxDuzenle("mesajYetki");
			$bultenYetki=$this->CheckBoxDuzenle("bultenYetki");
			$haberYetki=$this->CheckBoxDuzenle("haberYetki");
			$yoneticiYetki=$this->CheckBoxDuzenle("yoneticiYetki");
			$ayarYetki=$this->CheckBoxDuzenle("ayarYetki");
		
				
		
				if (empty($kulad) ||  empty($yenisif) || empty($yenisif2)) :
			?><script> BilgiPenceresi("control.php?sayfa=yonekle","BAŞARISIZ","HİÇBİR ALAN BOŞ GEÇİLEMEZ","warning"); </script> <?php		
			
			else:
						if ($yenisif!=$yenisif2) :
						
			?><script> BilgiPenceresi("control.php?sayfa=yonekle","BAŞARISIZ","YENİ ŞİFRELER UYUMSUZ","warning"); </script> <?php					
						else:
						
						$yenisifson=md5(sha1(md5($yenisif)));
	
		
			$ekle=$this->prepare("insert into yonetim (kulad,sifre,genelYetki,introYetki,aracYetki,videoYetki,hakkimizYetki,hizmetlerYetki,referansYetki,tasarimYetki,yorumYetki,mesajYetki,bultenYetki,haberYetki,yoneticiYetki,ayarYetki) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		
			$ekle->bindParam(1,$kulad,PDO::PARAM_STR);
			$ekle->bindParam(2,$yenisifson,PDO::PARAM_STR);			
			$ekle->bindParam(3,$genelYetki,PDO::PARAM_INT);
			$ekle->bindParam(4,$introYetki,PDO::PARAM_INT);	
			$ekle->bindParam(5,$aracYetki,PDO::PARAM_INT);	
			$ekle->bindParam(6,$videoYetki,PDO::PARAM_INT);	
			$ekle->bindParam(7,$hakkimizYetki,PDO::PARAM_INT);	
			$ekle->bindParam(8,$hizmetlerYetki,PDO::PARAM_INT);	
			$ekle->bindParam(9,$referansYetki,PDO::PARAM_INT);	
			$ekle->bindParam(10,$tasarimYetki,PDO::PARAM_INT);	
			$ekle->bindParam(11,$yorumYetki,PDO::PARAM_INT);	
			$ekle->bindParam(12,$mesajYetki,PDO::PARAM_INT);	
			$ekle->bindParam(13,$bultenYetki,PDO::PARAM_INT);	
			$ekle->bindParam(14,$haberYetki,PDO::PARAM_INT);	
			$ekle->bindParam(15,$yoneticiYetki,PDO::PARAM_INT);	
			$ekle->bindParam(16,$ayarYetki,PDO::PARAM_INT);					
			$ekle->execute();
							
			?><script> BilgiPenceresi("control.php?sayfa=kulayar","BAŞARILI","YÖNETİCİ EKLENDİ","success"); </script> <?php	
		
						endif;
		
			endif;
		
			else:
			?>
        
 			<div class="col-lg-12 hafifgri p-2 text-left"><?php $this->SayfaNavi("kulayar","Yönetici ayarları","Yönetici Ekle"); ?></div>  	
		
	
        
        	<form action="control.php?sayfa=yonekle" method="post">
                   			<div class="row text-center">
                            
                            <div class="col-lg-5 mx-auto hafifgri mt-2">
                            
                           	 <div class="col-lg-12 mx-auto mt-2">
                                <h3 class="text-dark">YÖNETİCİ EKLE</h3>
                                
                                </div>
                            
                            	<div class="col-lg-12 mx-auto mt-2 border">
                                
                               			<div class="row">
                                        	<div class="col-lg-5 border-right pt-3 text-left">
                                          <span id="siteayarfont">Kullanıcı Adı</span>
                                            </div>                                            
                                            <div class="col-lg-7 p-1">
         	<input type="text" name="kulad" class="form-control"  />
                                            </div>
                                        
                                        </div>
                                
                                </div>
                                <!-- ************* -->
                       
                                
                                <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-5 border-right pt-3 text-left">
                                          <span id="siteayarfont">Yeni Şifre</span>
                                            </div>                                            
                                            <div class="col-lg-7 p-1">
                                            <input type="password" name="yenisifre" class="form-control"  />
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->
                              <!-- ************* -->
                                
                                <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-5 border-right pt-3 text-left">
                                          <span id="siteayarfont">Yeni Şifre (Tekrar)</span>
                                            </div>                                            
                                            <div class="col-lg-7 p-1">
                                            <input type="password" name="yenisifre2" class="form-control"  />
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->     
                             
                                         <!-- ************* -->
                       
                                
                                <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-5 border-right pt-3 text-left">
                                          <span id="siteayarfont">Genel Yetki</span>
                                            </div>                                            
                                            <div class="col-lg-7 p-1">
                                           <select name="genelYetki" class="form-control">
                                           <option value="1">Tam Yetki</option>
                                    		<option value="2">Editör Yetki</option>
                                            <option value="3">Üye Yetki</option>
                                           </select>
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->    
                             
                             
                                           <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-5 border-right pt-3 text-left">
                                          <span id="siteayarfont">İntro Yetki</span>
                                            </div>                                            
                                            <div class="col-lg-7 pt-2 mt-2 text-left">
                                        <input type="checkbox" name="introYetki" id="check" />
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->   
                             
                                        <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-5 border-right pt-3 text-left">
                                          <span id="siteayarfont">Araç Yetki</span>
                                            </div>                                            
                                            <div class="col-lg-7 pt-2 mt-2 text-left">
                                        <input type="checkbox" name="aracYetki" id="check" />
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->   
                             
                                              <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-5 border-right pt-3 text-left">
                                          <span id="siteayarfont">Video Yetki</span>
                                            </div>                                            
                                            <div class="col-lg-7 pt-2 mt-2 text-left">
                                        <input type="checkbox" name="videoYetki" id="check" />
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->   
                             
                                              <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-5 border-right pt-3 text-left">
                                          <span id="siteayarfont">Hakkımızda Yetki</span>
                                            </div>                                            
                                            <div class="col-lg-7 pt-2 mt-2 text-left">
                                        <input type="checkbox" name="hakkimizYetki" id="check" />
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->   
                             
                                              <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-5 border-right pt-3 text-left">
                                          <span id="siteayarfont">Hizmetler Yetki</span>
                                            </div>                                            
                                            <div class="col-lg-7 pt-2 mt-2 text-left">
                                        <input type="checkbox" name="hizmetlerYetki" id="check" />
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->   
                             
                                              <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-5 border-right pt-3 text-left">
                                          <span id="siteayarfont">Referanslar Yetki</span>
                                            </div>                                            
                                            <div class="col-lg-7 pt-2 mt-2 text-left">
                                        <input type="checkbox" name="referansYetki" id="check" />
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->   
                             
                                              <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-5 border-right pt-3 text-left">
                                          <span id="siteayarfont">Tasarım Yetki</span>
                                            </div>                                            
                                            <div class="col-lg-7 pt-2 mt-2 text-left">
                                        <input type="checkbox" name="tasarimYetki" id="check" />
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->   
                             
                                              <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-5 border-right pt-3 text-left">
                                          <span id="siteayarfont">Yorum Yetki</span>
                                            </div>                                            
                                            <div class="col-lg-7 pt-2 mt-2 text-left">
                                        <input type="checkbox" name="yorumYetki" id="check" />
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->   
                             
                                              <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-5 border-right pt-3 text-left">
                                          <span id="siteayarfont">Gelen Mesaj Yetki</span>
                                            </div>                                            
                                            <div class="col-lg-7 pt-2 mt-2 text-left">
                                        <input type="checkbox" name="mesajYetki" id="check" />
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->   
                             
                                              <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-5 border-right pt-3 text-left">
                                          <span id="siteayarfont">Bülten Yetki</span>
                                            </div>                                            
                                            <div class="col-lg-7 pt-2 mt-2 text-left">
                                        <input type="checkbox" name="bultenYetki" id="check" />
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->   
                             
                                              <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-5 border-right pt-3 text-left">
                                          <span id="siteayarfont">Haberler Yetki</span>
                                            </div>                                            
                                            <div class="col-lg-7 pt-2 mt-2 text-left">
                                        <input type="checkbox" name="haberYetki" id="check" />
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->   
                             
                                 <!-- ************* -->   
                             
                                              <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-5 border-right pt-3 text-left">
                                          <span id="siteayarfont">Yönetici Yetki</span>
                                            </div>                                            
                                            <div class="col-lg-7 pt-2 mt-2 text-left">
                                        <input type="checkbox" name="yoneticiYetki" id="check" />
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->   
                             
                                 <!-- ************* -->   
                             
                                              <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-5 border-right pt-3 text-left">
                                          <span id="siteayarfont">Ayar Yetki</span>
                                            </div>                                            
                                            <div class="col-lg-7 pt-2 mt-2 text-left">
                                        <input type="checkbox" name="ayarYetki" id="check" />
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->   
                             
                                  
                              
                             
                             
                            
                            <div class="col-lg-12 mx-auto mt-2 ">
                   <input type="submit" name="buton" class="btn btn-primary m-1" value="Yönetici Ekle" />                                
                                </div>
                                
                                
                                 </div>
                            
                            </div>
                    </form>
        
        
        		<?php
		
		
				endif;
		} // yonetici ekle
		function yonGuncelle(){	
		
			if ($_POST) :
			
			$kulad=htmlspecialchars($_POST["kulad"]);
			$yonid=htmlspecialchars($_POST["yonid"]);				
			$genelYetki=htmlspecialchars($_POST["genelYetki"]);		
			$introYetki=$this->CheckBoxDuzenle("introYetki");		
			$aracYetki=$this->CheckBoxDuzenle("aracYetki");
			$videoYetki=$this->CheckBoxDuzenle("videoYetki");
			$hakkimizYetki=$this->CheckBoxDuzenle("hakkimizYetki");
			$hizmetlerYetki=$this->CheckBoxDuzenle("hizmetlerYetki");
			$referansYetki=$this->CheckBoxDuzenle("referansYetki");
			$tasarimYetki=$this->CheckBoxDuzenle("tasarimYetki");
			$yorumYetki=$this->CheckBoxDuzenle("yorumYetki");
			$mesajYetki=$this->CheckBoxDuzenle("mesajYetki");
			$bultenYetki=$this->CheckBoxDuzenle("bultenYetki");
			$haberYetki=$this->CheckBoxDuzenle("haberYetki");
			$yoneticiYetki=$this->CheckBoxDuzenle("yoneticiYetki");
			$ayarYetki=$this->CheckBoxDuzenle("ayarYetki");
			
				
		
			if (empty($kulad)) :
			?><script> BilgiPenceresi("control.php?sayfa=yonekle","BAŞARISIZ","HİÇBİR ALAN BOŞ GEÇİLEMEZ","warning"); </script> <?php		
			
			else:
	
		
			$ekle=$this->prepare("update yonetim set 
			kulad=?,	
			genelYetki=?,
			introYetki=?,
			aracYetki=?,
			videoYetki=?,
			hakkimizYetki=?,
			hizmetlerYetki=?,
			referansYetki=?,
			tasarimYetki=?,
			yorumYetki=?,
			mesajYetki=?,
			bultenYetki=?,
			haberYetki=?,
			yoneticiYetki=?,
			ayarYetki=? where id=".$yonid);
		
			$ekle->bindParam(1,$kulad,PDO::PARAM_STR);		
			$ekle->bindParam(2,$genelYetki,PDO::PARAM_INT);
			$ekle->bindParam(3,$introYetki,PDO::PARAM_INT);	
			$ekle->bindParam(4,$aracYetki,PDO::PARAM_INT);	
			$ekle->bindParam(5,$videoYetki,PDO::PARAM_INT);	
			$ekle->bindParam(6,$hakkimizYetki,PDO::PARAM_INT);	
			$ekle->bindParam(7,$hizmetlerYetki,PDO::PARAM_INT);	
			$ekle->bindParam(8,$referansYetki,PDO::PARAM_INT);	
			$ekle->bindParam(9,$tasarimYetki,PDO::PARAM_INT);	
			$ekle->bindParam(10,$yorumYetki,PDO::PARAM_INT);	
			$ekle->bindParam(11,$mesajYetki,PDO::PARAM_INT);	
			$ekle->bindParam(12,$bultenYetki,PDO::PARAM_INT);	
			$ekle->bindParam(13,$haberYetki,PDO::PARAM_INT);	
			$ekle->bindParam(14,$yoneticiYetki,PDO::PARAM_INT);	
			$ekle->bindParam(15,$ayarYetki,PDO::PARAM_INT);					
			$ekle->execute();
		
			?><script> BilgiPenceresi("control.php?sayfa=kulayar","BAŞARILI","YÖNETİCİ EKLENDİ","success"); </script> <?php	
		

		
			endif;
		
			else:
				$al=self::sorgum("select * from yonetim where id=".$_GET["id"],2);	
				$yonson=$al->fetch(PDO::FETCH_ASSOC);
		
			?>
        
 			<div class="col-lg-12 hafifgri p-2 text-left" ><?php $this->SayfaNavi("kulayar","Yönetici ayarları","Yönetici Güncelle"); ?></div>  	
		
	
        
        	<form action="control.php?sayfa=yoneticiguncelle" method="post">
                   			<div class="row text-center">
                            
                            <div class="col-lg-5 mx-auto hafifgri mt-2">
                            
                           	 <div class="col-lg-12 mx-auto mt-2">
                                <h3 class="text-dark">YÖNETİCİ GÜNCELLE</h3>
                                
                                </div>
                            
                            	<div class="col-lg-12 mx-auto mt-2 border">
                                
                               			<div class="row">
                                        	<div class="col-lg-5 border-right pt-3 text-left">
                                          <span id="siteayarfont">Kullanıcı Adı</span>
                                            </div>                                            
                                            <div class="col-lg-7 p-1">
         	<input type="text" name="kulad" class="form-control" value="<?php  echo $yonson["kulad"]; ?>"  />
                                            </div>
                                        
                                        </div>
                                
                                </div>
                                <!-- ************* -->
                       
                                
                                  <!-- ************* -->
                       
                                
                                <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-5 border-right pt-3 text-left">
                                          <span id="siteayarfont">Genel Yetki</span>
                                            </div>                                            
                                            <div class="col-lg-7 p-1">
                                           <select name="genelYetki" class="form-control"> <?php
										   
										   
				$yetkiler=array(1 => "Tam Yetki",2 => "Editör Yetki",3 => "Üye Yetki");
				
				foreach ($yetkiler as $key => $deger):
				
					if ($yonson["genelYetki"]==$key):
					
					echo '<option value="'.$key.'" selected="selected">'.$deger.'</option>';
					
					else:
						echo '<option value="'.$key.'">'.$deger.'</option>';
					endif;
				
				endforeach;
										   
										   
										   ?>
                                 
                                           </select>
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->    
                             
                             
                                           <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-5 border-right pt-3 text-left">
                                          <span id="siteayarfont">İntro Yetki</span>
                                            </div>                                            
                                            <div class="col-lg-7 pt-2 mt-2 text-left">
                                            
  						 <?php $this->CheckKontrol("introYetki",$yonson["introYetki"]); ?>                                        

                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->   
                             
                                        <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-5 border-right pt-3 text-left">
                                          <span id="siteayarfont">Araç Yetki</span>
                                            </div>                                            
                                            <div class="col-lg-7 pt-2 mt-2 text-left">
               	<?php $this->CheckKontrol("aracYetki",$yonson["aracYetki"]); ?>    
                                            
                                   
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->   
                             
                                              <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-5 border-right pt-3 text-left">
                                          <span id="siteayarfont">Video Yetki</span>
                                            </div>                                            
                                            <div class="col-lg-7 pt-2 mt-2 text-left">
                              <?php $this->CheckKontrol("videoYetki",$yonson["videoYetki"]); ?>                     
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->   
                             
                                              <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-5 border-right pt-3 text-left">
                                          <span id="siteayarfont">Hakkımızda Yetki</span>
                                            </div>                                            
                                       
                                            <div class="col-lg-7 pt-2 mt-2 text-left">
                            <?php $this->CheckKontrol("hakkimizYetki",$yonson["hakkimizYetki"]); ?>
                    
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->   
                             
                                              <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-5 border-right pt-3 text-left">
                                          <span id="siteayarfont">Hizmetler Yetki</span>
                                            </div>                                            
                                            <div class="col-lg-7 pt-2 mt-2 text-left">
                       <?php $this->CheckKontrol("hizmetlerYetki",$yonson["hizmetlerYetki"]); ?>              
                            
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->   
                             
                                              <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-5 border-right pt-3 text-left">
                                          <span id="siteayarfont">Referanslar Yetki</span>
                                            </div>                                            
                                            <div class="col-lg-7 pt-2 mt-2 text-left">
                               <?php $this->CheckKontrol("referansYetki",$yonson["referansYetki"]); ?>                 
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->   
                             
                                              <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-5 border-right pt-3 text-left">
                                          <span id="siteayarfont">Tasarım Yetki</span>
                                            </div>                                            
                                            <div class="col-lg-7 pt-2 mt-2 text-left">
                              <?php $this->CheckKontrol("tasarimYetki",$yonson["tasarimYetki"]); ?>               
                              
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->   
                             
                                              <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-5 border-right pt-3 text-left">
                                          <span id="siteayarfont">Yorum Yetki</span>
                                            </div>                                            
                                            <div class="col-lg-7 pt-2 mt-2 text-left">
                                         <?php $this->CheckKontrol("yorumYetki",$yonson["yorumYetki"]); ?>      
                                  
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->   
                             
                                              <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-5 border-right pt-3 text-left">
                                          <span id="siteayarfont">Gelen Mesaj Yetki</span>
                                            </div>                                            
                                            <div class="col-lg-7 pt-2 mt-2 text-left">
                              <?php $this->CheckKontrol("mesajYetki",$yonson["mesajYetki"]); ?>
                                    
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->   
                             
                                              <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-5 border-right pt-3 text-left">
                                          <span id="siteayarfont">Bülten Yetki</span>
                                            </div>                                            
                                            <div class="col-lg-7 pt-2 mt-2 text-left">
                        <?php $this->CheckKontrol("bultenYetki",$yonson["bultenYetki"]); ?>
                                      
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->   
                             
                                              <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-5 border-right pt-3 text-left">
                                          <span id="siteayarfont">Haberler Yetki</span>
                                            </div>                                            
                                            <div class="col-lg-7 pt-2 mt-2 text-left">
                   <?php $this->CheckKontrol("haberYetki",$yonson["haberYetki"]); ?>
               
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->   
                             
                                 <!-- ************* -->   
                             
                                              <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-5 border-right pt-3 text-left">
                                          <span id="siteayarfont">Yönetici Yetki</span>
                                            </div>                                            
                                            <div class="col-lg-7 pt-2 mt-2 text-left">
              		<?php $this->CheckKontrol("yoneticiYetki",$yonson["yoneticiYetki"]); ?>
                              
                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->   
                             
                                 <!-- ************* -->   
                             
                                              <div class="col-lg-12 mx-auto  border">                                
                               			<div class="row">
                                        	<div class="col-lg-5 border-right pt-3 text-left">
                                          <span id="siteayarfont">Ayar Yetki</span>
                                            </div>                                            
                                            <div class="col-lg-7 pt-2 mt-2 text-left">
            		  <?php $this->CheckKontrol("ayarYetki",$yonson["ayarYetki"]); ?>

                                            </div>                                        
                                        </div>                                
                                </div>
                             <!-- ************* -->   
                             
                        
                             
                            
                            <div class="col-lg-12 mx-auto mt-2 ">
                 	<input type="hidden" name="yonid" value="<?php echo $yonson["id"]; ?>" />
                   <input type="submit" name="buton" class="btn btn-primary m-1" value="Yönetici Güncelle" />                                
                                </div>
                                
                                
                                 </div>
                            
                            </div>
                    </form>
        
        
        		<?php
		
		
				endif;
		} // yonetici GÜNCELLE
	//-----------------HAKKIMIZDA	
		function hakkimizda() {
			
			echo '<div class="row text-center">
			<div class="col-lg-12 border-bottom"><h4 class=" mt-3 text-dark float-left">HAKKIMIZDA AYARLARI</h4></div>';
			if (!$_POST) :
			
			$sonbilgi=self::sorgum("select * from hakkimizda",1);
			
			echo '<div class="col-lg-6 mx-auto">
			
					<div class="row card-bordered p-1 m-1">
					
					
						<div class="col-lg-3 border-bottom bg-light" id="hakkimizdayazilar">
						Resim
						</div>
						
						<div class="col-lg-9 border-bottom">
						<img src="'.URL.$sonbilgi["resim"].'"><br>
						<form action="" method="post" enctype="multipart/form-data">
						<input type="file" name="dosya">
						</div>
						
						
						<div class="col-lg-3 border-bottom bg-light pt-3" id="hakkimizdayazilarn">
						TR - Başlık
						</div>
						
						<div class="col-lg-9 border-bottom">
						<input type="text" name="baslik_tr" class="form-control m-2" value="'.$sonbilgi["baslik_tr"].'">
						
						</div>
						
						<div class="col-lg-3 border-bottom bg-light pt-3" id="hakkimizdayazilarn">
						EN -Başlık
						</div>
						
						<div class="col-lg-9 border-bottom">
						<input type="text" name="baslik_en" class="form-control m-2" value="'.$sonbilgi["baslik_en"].'">
						
						</div>
						
						<div class="col-lg-3 bg-light" id="hakkimizdayazilar">
						TR - İçerik
						</div>
						
						<div class="col-lg-9">
						<textarea name="icerik_tr" class="form-control m-2" rows="8" id="editor1" >'.$sonbilgi["icerik_tr"].'</textarea>'; ?>
						
					
                      <script>
        	ClassicEditor
            	.create( document.querySelector( '#editor1' ) )
            	.catch( error => {
                console.error( error );
            } );
    		</script>
                    
                    
                    	
				<?php
						
					echo'</div>
						
							<div class="col-lg-3 bg-light" id="hakkimizdayazilar">
						EN - İçerik
						</div>
						
						<div class="col-lg-9 mt-5">
						<textarea name="icerik_en" class="form-control m-2" rows="8" id="editor2">'.$sonbilgi["icerik_en"].'</textarea>'; ?>
						
					
                      <script>
        		ClassicEditor
            	.create( document.querySelector( '#editor2' ) )
            	.catch( error => {
            	    console.error( error );
            	} );
   			 </script>
                    
                    
                    	
				<?php
						
					echo'</div>
						<div class="col-lg-12 border-top">
						<input type="submit" name="guncel" value="GÜNCELLE" class="btn btn-primary m-2">
						</form>
						</div>
						</div>';
						
						else:
						
						$baslik_tr=htmlspecialchars($_POST["baslik_tr"]);
						$icerik_tr=$_POST["icerik_tr"];
						$baslik_en=htmlspecialchars($_POST["baslik_en"]);
						$icerik_en=$_POST["icerik_en"];
						/// form baısldıysa
						
						if (@$_FILES["dosya"]["name"]!="") :		
	
			
								
					
							if ($_FILES["dosya"]["size"]< (1024*1024*5)) :	
							
											
														
																
																
								
									$izinverilen=array("image/png","image/jpeg");
									
									if (in_array($_FILES["dosya"]["type"],$izinverilen)) :
													
																	
																			
							$dosyaminyolu='../img/'.$_FILES["dosya"]["name"];
								
											
						move_uploaded_file($_FILES["dosya"]["tmp_name"],$dosyaminyolu);
									
											
								
															
							$veritabaniicin=str_replace('../','',$dosyaminyolu);
						
						
							
						
								endif;					
							endif;	
							
						endif;
						
						
						if (@$_FILES["dosya"]["name"]!="") :		
					self::sorgum("update hakkimizda set baslik_tr='$baslik_tr',baslik_en='$baslik_en',icerik_tr='$icerik_tr',icerik_en='$icerik_en',resim='$veritabaniicin'",0);

							?><script> BilgiPenceresi("control.php?sayfa=hakkimiz","BAŞARILI","GÜNCELLEME BAŞARILI","success"); </script> <?php

					else:
						
				self::sorgum("update hakkimizda set baslik_tr='$baslik_tr',baslik_en='$baslik_en',icerik_tr='$icerik_tr',icerik_en='$icerik_en'",0);

				?><script> BilgiPenceresi("control.php?sayfa=hakkimiz","BAŞARILI","GÜNCELLEME BAŞARILI","success"); </script> <?php

				
						endif;	
						
					echo '</div>';	
						
			
				endif; // en ana if
		} // hakkımızda ayar bölümü
	//-----------------HİZMETLERİMİZ	
		function hizmetlerhepsi(){
			
			echo '<div class="row text-center">
			<div class="col-lg-12 border-bottom"><h4 class="float-left mt-3 text-dark mb-2">
			<a href="control.php?sayfa=hizmetekle" class="ti-plus bg-dark p-1 text-white mr-2 mt-3" ></a>
			HİZMETLERİMİZ</h4>
			</div>';
			
			$introbilgiler=self::sorgum("select * from hizmetler",2);
			
			while ($sonbilgi=$introbilgiler->fetch(PDO::FETCH_ASSOC)) :
			
			echo '<div class="col-lg-6">
			
					<div class="row card-bordered p-1 m-1 hafifgri">
						<div class="col-lg-10 pt-1 pb-1 ">
						<h5>'.$sonbilgi["baslik_tr"].' - '.$sonbilgi["baslik_en"].'</h5>
						</div>
						
						<div class="col-lg-2 text-right">
						<a href="control.php?sayfa=hizmetguncelle&id='.$sonbilgi["id"].'" class="ti-reload text-success" style="font-size:20px;"></a>
						
							<a href="control.php?sayfa=hizmetsil&id='.$sonbilgi["id"].'" class="ti-trash text-danger pl-2" style="font-size:20px;"></a>
						</div>
						
						<div class="col-lg-12 border-top text-secondary text-left bg-white">
						'.$sonbilgi["icerik_tr"].'
						</div>
						
						<div class="col-lg-12 border-top text-secondary text-left bg-white">
						'.$sonbilgi["icerik_en"].'
						</div>
						
					
						
				</div>		
						
			</div>';
			
			endwhile;
			
			echo '</div>';
			
		} // hizmetler geliyor
		function hizmetekleme(){
		
				?>
        
 				<div class="col-lg-12 hafifgri p-2 text-left"><?php $this->SayfaNavi("hizmetler","Hizmetlerimiz","Hizmet Ekle"); ?></div>
        
        
        		<?php
		
					
			echo '<div class="row text-center">
			
			<div class="col-lg-12 border-bottom"><h3 class="mt-3 text-dark">HİZMET EKLE</h3>
			</div>';			
	
				if (!$_POST):
	
	
			
			echo '<div class="col-lg-6 mx-auto">
			
					<div class="row card-bordered p-1 m-1 hafifgri">
					
						<div class="col-lg-2 pt-3">
						TR - Başlık
						</div>
						
						<div class="col-lg-10 p-2">
						<form action="" method="post">
						<input type="text" name="baslik_tr" class="form-control">
						</div>
						
						
						<div class="col-lg-2 pt-3">
						EN - Başlık
						</div>
						
						<div class="col-lg-10 p-2">
						
						<input type="text" name="baslik_en" class="form-control" >
						</div>
						
						
					
						
						<div class="col-lg-12 border-top p-2">
						TR - İçerik
						</div>
						<div class="col-lg-12 border-top p-2">
						<textarea name="icerik_tr" rows="5" class="form-control" id="editor3"></textarea>
						'; ?>
						
					
                      <script>
        			ClassicEditor
            		.create( document.querySelector( '#editor3' ) )
           			 .catch( error => {
                		console.error( error );
           			 } );
    			</script>
                    
                    
                    	
				<?php
						
					echo'
						
						
						</div>
						
							<div class="col-lg-12 border-top p-2">
						EN - İçerik
						</div>
						<div class="col-lg-12 border-top p-2">
						<textarea name="icerik_en" rows="5" class="form-control" id="editor4"></textarea>
						'; ?>
						
					
                      <script>
        			ClassicEditor
            		.create( document.querySelector( '#editor4' ) )
            		.catch( error => {
                console.error( error );
            		} );
    			</script>
                    
                    
                    	
				<?php
						
					echo'					
						</div>
						
						<div class="col-lg-12 border-top p-2">
						<input type="submit" name="buton" value="HİZMET EKLE" class="btn btn-primary">
						</form>
						</div>
						
					
						
				</div>		
						
				</div>';
			
			
			
				else:
			
				$baslik_tr=htmlspecialchars($_POST["baslik_tr"]);
				$icerik_tr=$_POST["icerik_tr"];
			
				$icerik_en=$_POST["icerik_en"];
				$baslik_en=htmlspecialchars($_POST["baslik_en"]);
			
				if ($baslik_tr=="" && $icerik_tr=="" && $icerik_en=="" && $baslik_en=="") :
						
				?><script> BilgiPenceresi("control.php?sayfa=hizmetler","BAŞARISIZ","VERİLER BOŞ OLAMAZ","warning"); </script> <?php

				else:							
							
				self::sorgum("insert into hizmetler (baslik_tr,baslik_en,icerik_tr,icerik_en) VALUES('$baslik_tr','$baslik_en','$icerik_tr','$icerik_en')",0);	
				?><script> BilgiPenceresi("control.php?sayfa=hizmetler","BAŞARILI","EKLEME BAŞARILI","success"); </script> <?php				
					endif;	
				endif;	
			
				echo '</div>';
			
		} // hizmet ekle
		function hizmetguncelleme(){
		
			?>
		 	<div class="col-lg-12 hafifgri p-2 text-left"><?php $this->SayfaNavi("hizmetler","Hizmetlerimiz","Hizmet güncelle"); ?></div>
			
			<?php echo '<div class="row text-center">
			<div class="col-lg-12 border-bottom"><h3 class="mt-3 text-dark">HİZMET GÜNCELLE</h3>
			</div>';
			
	
		
			$kayitid=$_GET["id"];
		
			$kayitbilgial=self::sorgum("select * from hizmetler where id=$kayitid",1);	
			
	
			if (!$_POST):
	
	
			
			echo '<div class="col-lg-6 mx-auto">
			
					<div class="row card-bordered p-1 m-1 hafifgri">
					
						<div class="col-lg-2 pt-3">
						TR - Başlık
						</div>
						
						<div class="col-lg-10 p-2">
						<form action="" method="post">
						<input type="text" name="baslik_tr" class="form-control" value="'.$kayitbilgial["baslik_tr"].'">
						</div>
						
						
						<div class="col-lg-2 pt-3">
						EN - Başlık
						</div>
						
						<div class="col-lg-10 p-2">
						
						<input type="text" name="baslik_en" class="form-control" value="'.$kayitbilgial["baslik_en"].'">
						</div>
						
						
					
						
						<div class="col-lg-12 border-top p-2">
						TR - İçerik
						</div>
						<div class="col-lg-12 border-top p-2">
						<textarea name="icerik_tr" rows="5" class="form-control" id="editor5">'.$kayitbilgial["icerik_tr"].'</textarea>'; ?>
						
					
                      <script>
        		ClassicEditor
            	.create( document.querySelector( '#editor5' ) )
            	.catch( error => {
                console.error( error );
           	 	} );
    			</script>
                    
                    
                    	
				<?php
						
					echo'
						</div>
						
							<div class="col-lg-12 border-top p-2">
						EN - İçerik
						</div>
						<div class="col-lg-12 border-top p-2">
						<textarea name="icerik_en" rows="5" class="form-control" id="editor6">'.$kayitbilgial["icerik_en"].'</textarea>'; ?>
						
					
                      <script>
        		ClassicEditor
            		.create( document.querySelector( '#editor6' ) )
            		.catch( error => {
                	console.error( error );
            		} );
    			</script>
                    
                    
                    	
				<?php
						
					echo'
						</div>
						
						
						
						
						
						<div class="col-lg-12 border-top p-2">
						<input type="hidden" name="kayitidsi" value="'.$kayitid.'">
						<input type="submit" name="buton" value="HİZMET GÜNCELLE" class="btn btn-primary">
						</form>
						</div>
						
					
						
				</div>		
						
				</div>';
			
			
			
				else:
			
				$baslik_tr=htmlspecialchars($_POST["baslik_tr"]);
				$icerik_tr=$_POST["icerik_tr"];
			
				$icerik_en=$_POST["icerik_en"];
				$baslik_en=htmlspecialchars($_POST["baslik_en"]);
				
				$kayitidsi=htmlspecialchars($_POST["kayitidsi"]);
				
					if ($baslik_tr=="" && $icerik_tr=="" && $icerik_en=="" && $baslik_en=="") :
					
				?><script> BilgiPenceresi("control.php?sayfa=hizmetler","BAŞARISIZ","VERİLER BOŞ OLAMAZ","warning"); </script> <?php	
							else:
							
							
				self::sorgum("update hizmetler set baslik_tr='$baslik_tr',baslik_en='$baslik_en',icerik_tr='$icerik_tr',icerik_en='$icerik_en' where id=$kayitidsi",0);	
				?><script> BilgiPenceresi("control.php?sayfa=hizmetler","BAŞARILI","GÜNCELLEME BAŞARILI","success"); </script> <?php	
					endif;
			
				endif;			
				echo '</div>';			
		} // hizmet güncelle
		function hizmetsil(){		
	
			$kayitid=$_GET["id"];		
			self::sorgum("delete from hizmetler where id=$kayitid",0);		
			?><script> BilgiPenceresi("control.php?sayfa=hizmetler","BAŞARILI","SİLME BAŞARILI","success"); </script> <?php			
		} // hizmet sil
	//-----------------TASARIM YÖNETİM
		private function tasarimGetir($gelenTercih,$radioName,$id1,$id2){	
			echo '<div class="switch-field">';	
			foreach($this->tercihArray as $key => $value):
				if ($gelenTercih==$key):	
					echo '<input type="radio" id="radio-'.$id1.'" name="'.$radioName.'" data-value="'.$radioName.'" value="'.$key.'" checked/> <label for="radio-'.$id1.'">'.$value.'</label>';	
				else:	
					echo '<input type="radio" id="radio-'.$id2.'" name="'.$radioName.'" data-value="'.$radioName.'" value="'.$key.'" /> <label for="radio-'.$id2.'">'.$value.'</label>';
				endif;		
			endforeach;
			echo '</div>';
		}  // Tasarım getir
		function tasarimYonetim(){
			echo '<div class="row text-center">
				<div class="col-lg-12 border-bottom "><h3 class="float-left mt-3 text-dark mb-2">TASARIM YÖNETİMİ</h3></div>';	
			$kayitbilgial=self::sorgum("select * from tasarim",1);	
			
			if(!$_POST):
				echo '<div id="tasarim" class="col-lg-4 mx-auto">
					<div class="row card-bordered p-1 m-1 hafifgri">
						<div class="col-lg-12  p-2 text-info border-bottom" ><h4>AKTİF & PASİF YÖNETİMİ</h4>
					</div>
					<div class="col-lg-6 pt-3 border-right text-danger border-bottom text-right">HİZMETLER</div>
					<div class="col-lg-6 p-2 border-bottom">';
							self::tasarimGetir($kayitbilgial["hiztercih"],"hiztercih",1,2);
					echo'</div>
					<div class="col-lg-6 pt-3 border-right text-danger border-bottom text-right">REFERANSLAR</div>
					<div class="col-lg-6 p-2 border-bottom">';
						self::tasarimGetir($kayitbilgial["reftercih"],"reftercih",3,4);						
					echo'</div>
					<div class="col-lg-6 pt-3 border-right text-danger border-bottom  text-right">MÜŞTERİ YORUMLARI</div>
					<div class="col-lg-6 p-2 border-bottom">';						
						self::tasarimGetir($kayitbilgial["yorumtercih"],"yorumtercih",5,6);							
					echo'</div>					
					<div class="col-lg-6 pt-3 border-right text-danger border-bottom text-right">VİDEOLAR</div>
					<div class="col-lg-6 p-2 border-bottom">';
						self::tasarimGetir($kayitbilgial["videotercih"],"videotercih",7,8);		
					echo'</div>
					<div class="col-lg-6 pt-3 border-right text-danger text-right ">BÜLTEN</div>
					<div class="col-lg-6 p-2">';
						self::tasarimGetir($kayitbilgial["bultentercih"],"bultentercih",9,10);		
					echo'</div>
					<div class="col-lg-6 pt-3 border-right text-danger text-right ">HABERLER</div>
					<div class="col-lg-6 p-2">';
						self::tasarimGetir($kayitbilgial["habertercih"],"habertercih",11,12);		
					echo'</div>
					<div class="col-lg-12 border-top p-2">
						<input type="hidden" name="kayitidsi" value="'.$kayitbilgial["id"].'">
					</div>
				</div></div>';	

				$tasarimbilgial=self::sorgum("select * from tasarimbolumler order by siralama asc;",2);	
			
				echo '<div class="col-lg-4 mx-auto hafifgri">
					<table class="table table-striped mt-1 table-bordered">
						<tbody>
							<tr>
								<td colspan="3" class=" text-info "><h4>BÖLÜM SIRALAMASI</h4></td>
							</tr>';
				while ($bolumson=$tasarimbilgial->fetch(PDO::FETCH_ASSOC)):	
					echo '<tr>
						<td>'.$bolumson["ad"].'</td>
						<td>'.$bolumson["siralama"].'</td>
						<td><a href="control.php?sayfa=tasarimguncelle&id='.$bolumson["id"].'" class="ti-reload text-success" style="font-size:20px;"></a></td>			
					</tr>';
				endwhile;
					
				echo'</tbody></table></div></div>';				
			endif;
			//-- TASARIM BOLUMLERİ ALANI
		}  //Tasarım yönetim
		function tasarimguncelleme(){
			$linklerebak=parent::sorgum("select * from tasarimbolumler",2);
			
			echo '<div class="row text-center">
				<div class="col-lg-12 border-bottom"><h3 class="mt-3 text-dark">BÖLÜM GÜNCELLE</h3>
			</div>';
			
			$kayitid=$_GET["id"];
		
			$kayitbilgial=parent::sorgum("select * from tasarimbolumler where id=$kayitid",1);	
			
			if(!$_POST):
				echo '<div class="col-lg-7 mx-auto">
					div class="row card-bordered p-1 m-1 hafifgri">
						<div class="col-lg-4 pt-3 border-bottom border-right p-2 text-danger">İLGİLİ BÖLÜM</div>
						<div class="col-lg-8 p-2 border-bottom text-left">
							<b>'.$kayitbilgial["ad"].'</b>
						</div>
						<div class="col-lg-4 pt-3 border-right text-danger">
							<form action="" method="post">
							Bölüm Sırası : <b>'.$kayitbilgial["siralama"].'</b>
						</div>
						<div class="col-lg-8 p-2">
							<select name="gideceksira"  class="form-control p-2" >';
								while ($sonbilgi=$linklerebak->fetch(PDO::FETCH_ASSOC)):
									if($sonbilgi["siralama"]!=$kayitbilgial["siralama"]):
										echo '<option value="'.$sonbilgi["siralama"].'">'.$sonbilgi["siralama"].'-'.$sonbilgi["ad"].'</option>';
									endif;
								endwhile;
							echo'</select>						
						</div>
			
						<div class="col-lg-12 border-top p-2">
							<input type="hidden" name="kayitidsi" value="'.$kayitid.'">
							<input type="hidden" name="mevcutsira" value="'.$kayitbilgial["siralama"].'">
							<input type="submit" name="buton" value="BÖLÜM GÜNCELLE" class="btn btn-primary">
							</form>
						</div>
					</div>		
				</div>';
			else:			
				$gideceksira=htmlspecialchars($_POST["gideceksira"]);
				$mevcutsira=htmlspecialchars($_POST["mevcutsira"]);
				$kayitidsi=htmlspecialchars($_POST["kayitidsi"]);
			
				if($gideceksira==""):
					?><script> BilgiPenceresi("control.php?sayfa=tas","BAŞARISIZ","VERİLER BOŞ OLAMAZ","warning"); </script> <?php			
				else:
					parent::sorgum("update tasarimbolumler set siralama=$mevcutsira where siralama=$gideceksira",0);									
					// burada sıralar yer değiştiriyor. 			
					parent::sorgum("update tasarimbolumler set siralama=$gideceksira where id=$kayitidsi",0);	
					?><script> BilgiPenceresi("control.php?sayfa=tas","BAŞARILI","GÜNCELLEME BAŞARILI","success"); </script> <?php		
				endif;
			endif;
			echo '</div>';			
		}  //bölüm güncelle		
	//-----------------BAKIM/YEDEK
		function bakim(){
			echo '<div class="row text-center">
				<div class="col-lg-12 text-center">';
				
			if ($_POST) :
				$tablolar=self::sorgum("SHOW TABLES",2);

				while ($tabloson=$tablolar->fetch(PDO::FETCH_ASSOC)) :
					$this->query("REPAIR TABLE ".$tabloson["Tables_in_kurumsal"]);
					$this->query("OPTIMIZE TABLE ".$tabloson["Tables_in_kurumsal"]);
					echo '<div class="alert alert-success mt-1 col-lg-3 mx-auto"><b>'.$tabloson["Tables_in_kurumsal"]." </b> tablosuna işlem yapıldı.</div>";
				endwhile;
			
				echo '</div>';
				$zaman=date('d/m/Y - H:i');
				$tablolar=self::sorgum("update ayarlar set bakimzaman='$zaman'",0);	
			else: ?>
				<div class="col-lg-4 mx-auto mt-2 ">
					<div class="card card-bordered hafifgri">
						<div class="card-body">
							<h5 class="title border-bottom">VERİTABANI BAKIM</h5>
								<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" >
									<input type="submit" name="buton" value="BAKIMI BAŞLAT" class="btn btn-primary mb-1" />
								</form> <?php
									$zamanbak=self::sorgum("select bakimzaman from ayarlar",1);	
									echo '<div class="alert alert-warning mt-1 mx-auto"> En son bakım : <b>'.$zamanbak["bakimzaman"].'</b></div>';  
						?> </div>
					</div>
				</div><?php
			endif;
				echo '</div>';
		} // bakım işlemleri
		function yedek(){
			echo '<div class="row text-center">
				<div class="col-lg-12 text-center">';
				
			if ($_POST) :
				$this -> yedekal();

				echo '</div>';	
			else: ?>
				<div class="col-lg-4 mx-auto mt-2 ">
					<div class="card card-bordered hafifgri">
						<div class="card-body">
							<h5 class="title border-bottom">VERİTABANI YEDEK</h5>
								<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" >
									<input type="submit" name="buton" value="YEDEK AL" class="btn btn-primary mb-1" />
								</form> <?php
									$zamanbak=self::sorgum("select yedekzaman from ayarlar",1);	
									echo '<div class="alert alert-warning mt-1 mx-auto">En son yedek : <b>'.$zamanbak["yedekzaman"].'</b></div>';  
						?> </div>
					</div>
				</div><?php
			endif;
				echo '</div>';
		} // bakım işlemleri
		function yedekal(){
			$tables=array();
			$result=self::sorgum("SHOW TABLES",2);

			while ($tabloson=$result->fetch(PDO::FETCH_ASSOC)) :	
				$tables[]=$tabloson["Tables_in_kurumsal"];
			endwhile;
			// karakter seti tanımla
			// veritabanlarının içine tek tek gir
			// veritabanlarının verilerini tek tek al
			$return="SET NAMES utf8;";
			
			foreach ($tables as $tablo):
				$veriler=self::sorgum("SELECT * FROM $tablo",2);
				$numColumns=$veriler->columnCount();

				$return.="DROP TABLE IF EXISTS $tablo;";
				
				$olustur=self::sorgum("SHOW CREATE TABLE $tablo",2);
				$sonuc=$olustur->fetch(PDO::FETCH_ASSOC);
				$return.="\n\n".$sonuc["Create Table"].";\n\n";
			
				for ($i=0; $i<$numColumns; $i++):
					while($row=$veriler->fetch(PDO::FETCH_NUM)):
						$return.="INSERT INTO $tablo VALUES(";
							for ($a=0; $a<$numColumns; $a++):	
								if(isset($row[$a])):  $return.='"'.$row[$a].'"'; else: $return.='""'; endif;	
								if ($a<($numColumns-1)): $return.=',';  endif;				 
							endfor;
						$return.=");\n";
					endwhile;
				endfor;
				$return.="\n\n\n";
			endforeach;
			
			$dosyaolustur=fopen('assets/DbYedekleri/yedek-'.date('d.m.Y').'.sql','w+');
			fwrite($dosyaolustur,$return);
			fclose($dosyaolustur);
			
			$zaman=date('d/m/Y - H:i');
			self::sorgum("update ayarlar set yedekzaman='$zaman'",0);	
			echo '<div class="alert alert-success mt-1  mx-auto">YEDEK BAŞARIYLA ALINDI.</div>';
			header('');
		} // YEDEK İÇİN İŞLEM YAPANA FONKSİYON
	//-----------------HABERLER	
		function haberler(){
			echo '<div class="row text-center">
				<div class="col-lg-12 border-bottom"><h4 class="float-left mt-3 text-dark mb-2">
					<a href="control.php?sayfa=haberekle" class="ti-plus bg-dark p-1 text-white mr-2 mt-3" ></a>
					HABER VE DUYURULAR
				</h4></div>';
			
			$introbilgiler=self::sorgum("select * from haberler",2);
			
			while($sonbilgi=$introbilgiler->fetch(PDO::FETCH_ASSOC)):
				echo '<div class="col-lg-6">
					<div class="row card-bordered p-1 m-1 hafifgri">
						<div class="col-lg-10 pt-1 pb-1 text-left text-danger">
							<b class="text-dark"> TARİH : </b>  '.$sonbilgi["tarih"].'					
						</div>
						<div class="col-lg-2 text-right">
							<a href="control.php?sayfa=haberguncelle&id='.$sonbilgi["id"].'" class="ti-reload text-success" style="font-size:20px;"></a>'; ?>          
            				<a onclick="silmedenSor('control.php?sayfa=habersil&id=<?php echo $sonbilgi["id"]; ?>'); return false"  class="ti-trash text-danger pl-2" style="font-size:20px;"></a>	
						<?php echo '</div>
						<div class="col-lg-12 border-top text-secondary text-left bg-white"><b class="text-dark">TR :</b> 
							'.$sonbilgi["icerik_tr"].'
						</div>
						<div class="col-lg-12 border-top text-secondary text-left bg-white"><b class="text-dark">EN :</b> 
							'.$sonbilgi["icerik_en"].'
						</div>
					</div>		
				</div>';
			endwhile;
			
			echo '</div>';
			
		} // haberler geliyor
		function haberekleme(){
			?><div class="col-lg-12 hafifgri p-2 text-left"><?php $this->SayfaNavi("haberler","Haberler","Haber  ekle"); ?></div><?php
			echo '<div class="row text-center">
				<div class="col-lg-12 border-bottom"><h3 class="mt-3 text-dark">HABER EKLE</h3>
			</div>';
			
			if (!$_POST):
				echo '<div class="col-lg-6 mx-auto">
					<div class="row card-bordered p-1 m-1 hafifgri">
						<div class="col-lg-12 border-top p-2">
							<form action="" method="post">
							TR - İçerik
						</div>
						<div class="col-lg-12 border-top p-2">
							<textarea name="icerik_tr" rows="5" class="form-control"></textarea>
						</div>
						<div class="col-lg-12 border-top p-2">EN - İçerik</div>
						<div class="col-lg-12 border-top p-2">
							<textarea name="icerik_en" rows="5" class="form-control"></textarea>
						</div>
						<div class="col-lg-12 border-top p-2">
							<input type="submit" name="buton" value="HABER EKLE" class="btn btn-primary">
							</form>
						</div>
					</div>		
				</div>';
			else:
				$icerik_tr=htmlspecialchars($_POST["icerik_tr"]);			
				$icerik_en=htmlspecialchars($_POST["icerik_en"]);
			
				if ($icerik_tr=="" && $icerik_en=="") :			
					?><script> BilgiPenceresi("control.php?sayfa=haberler","BAŞARISIZ","VERİLER BOŞ OLAMAZ","warning"); </script> <?php					
				else:
					self::sorgum("insert into haberler (icerik_tr,icerik_en) VALUES('$icerik_tr','$icerik_en')",0);	
					?><script> BilgiPenceresi("control.php?sayfa=haberler","BAŞARILI","EKLEME BAŞARILI","success"); </script> <?php	
				endif;
			endif;			
			echo '</div>';
		} // hizmet ekle
		function haberguncelleme(){		
		
				?>
		 	<div class="col-lg-12 hafifgri p-2 text-left"><?php $this->SayfaNavi("haberler","Haberler","Haber  güncelle"); ?></div>
			
			<?php		
			
			echo '<div class="row text-center">
			<div class="col-lg-12 border-bottom"><h3 class="mt-3 text-dark">HABER GÜNCELLE</h3>
			</div>';
			
	
		
			$kayitid=$_GET["id"];
		
			$kayitbilgial=self::sorgum("select * from haberler where id=$kayitid",1);	
			
	
			if (!$_POST):
	
			
			echo '<div class="col-lg-6 mx-auto">
			
					<div class="row card-bordered p-1 m-1 hafifgri">
						
						<div class="col-lg-12 border-top p-2">
						<form action="" method="post">
						TR - İçerik
						</div>
						<div class="col-lg-12 border-top p-2">
						<textarea name="icerik_tr" rows="5" class="form-control">'.$kayitbilgial["icerik_tr"].'</textarea>
						</div>
						
							<div class="col-lg-12 border-top p-2">
						EN - İçerik
						</div>
						<div class="col-lg-12 border-top p-2">
						<textarea name="icerik_en" rows="5" class="form-control">'.$kayitbilgial["icerik_en"].'</textarea>
						</div>
						
						<div class="col-lg-12 border-top p-2">
						<input type="hidden" name="kayitidsi" value="'.$kayitid.'">
						<input type="submit" name="buton" value="HABER GÜNCELLE" class="btn btn-primary">
						</form>
						</div>
				</div>		
						
			</div>';	
			
			
			else:
			
		
			$icerik_tr=htmlspecialchars($_POST["icerik_tr"]);			
			$icerik_en=htmlspecialchars($_POST["icerik_en"]);
		
			
			$kayitidsi=htmlspecialchars($_POST["kayitidsi"]);
			
					if ($icerik_tr=="" && $icerik_en=="") :
						
						
							echo '<div class="col-lg-6 mx-auto">
				<div class="alert alert-danger mt-5">VERİLER BOŞ OLAMAZ<div>
				
				<div>';		
			
			header("refresh:2,url=control.php?sayfa=haberler");	
			
							else:
							
							
			self::sorgum("update haberler set icerik_tr='$icerik_tr',icerik_en='$icerik_en',tarih=CURRENT_TIMESTAMP() where id=$kayitidsi",0);	
	
			echo '<div class="col-lg-6 mx-auto">
				<div class="alert alert-success mt-5">GÜNCELLEME BAŞARILI<div>
				
				<div>';		
			
			header("refresh:2,url=control.php?sayfa=haberler");	
					
					
					endif;
					
			
			
			endif;
			
			
			
			echo '</div>';
			
		} // haber güncelle
		function habersil(){		
			$kayitid=$_GET["id"];			
			self::sorgum("delete from haberler where id=$kayitid",0);		
			?><script> BilgiPenceresi("control.php?sayfa=haberler","BAŞARILI","SİLME BAŞARILI","success"); </script> <?php			
		} // haber sil		

	
}


?>