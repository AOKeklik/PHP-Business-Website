<?php 
include_once("../config/baglan.php");	
include_once(KOK_YONETIM."assets/fonksiyon.php");	
$yonetim=new yonetim; 
$yonetim->DahilEt(array("fonksiyon2"=>"yonetim2","fonksiyon3"=>"yonetim3","yetkikontrol"=>"yetkiKontrol"));
$yonetim->kontrolet("cot");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  	<meta charset="utf-8">
   	<title>Udemy Nakliyat-Yönetim Paneli</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="<?=IMG_YONETIM?>icon/favicon.png">
    <link rel="stylesheet" href="<?=URL_YONETIM?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=URL_YONETIM?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=URL_YONETIM?>assets/css/themify-icons.css">
    <link rel="stylesheet" href="<?=URL_YONETIM?>assets/css/metisMenu.css">
    <link rel="stylesheet" href="<?=URL_YONETIM?>assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?=URL_YONETIM?>assets/css/slicknav.min.css">    
    <link rel="stylesheet" href="<?=URL_YONETIM?>assets/css/typography.css">
    <link rel="stylesheet" href="<?=URL_YONETIM?>assets/css/default-css.css">
    <link rel="stylesheet" href="<?=URL_YONETIM?>assets/css/styles.css">
    <link rel="stylesheet" href="<?=URL_YONETIM?>assets/css/responsive.css">   
    <script src="<?=URL_YONETIM?>assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://cdn.ckeditor.com/ckeditor5/12.3.1/classic/ckeditor.js"></script>
 	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script type="text/javascript"> 
  		function BilgiPenceresi(linkAdres,sonucbaslik,sonucmetin,sonuctur){
			swal(sonucbaslik, sonucmetin, sonuctur,{
  				buttons: {
    				catch: {
      					text: "KAPAT",
      					value: "tamam",
    				}
  				},
			})
			.then((value) =>{
				if(value=="tamam"){
   					window.location.href =  linkAdres;
  				}		
  			})
		}
		function silmedenSor(gidilecekLink){
			swal({
  				title: "Silmek istediğine emin misin?",
  				text: "Silinen kayıt geri alınamaz.",
  				icon: "warning",
  				buttons: true,
  				dangerMode: true,
			})
			.then((willDelete) => {
  				if(willDelete){
     				window.location.href =  gidilecekLink; 
  				}else{
    				swal({title:"Silme işleminden vazgeçtiniz", icon: "warning",});
  				}
			})
		}
		$(document).ready(function(){
			/* SABLON DUZENLE COMPONENTINI OLUSTR */
			// $('#kapsayicidividdegeri select').on('click', function(){
			$('select[name="sablonduzen"]').on('change',function(){
				var secilenid = $(this).val();
				var secilenbaslik = $(this).children('option:selected').attr('data-baslik')
				var secilenicerik = $(this).children('option:selected').attr('data-icerik')

				if(secilenid == 0){
					$('#sablonduzenle').html('')
				}else{
					$('#sablonduzenle').hide().html(`<div class="row">
						<div class="col-xl-8 col-lg-8 col-md-8 mx-auto col-sm-12 m-3">
							<form id="formguncelle">
								<input type="text" name="baslik" class="form-control p-2" value="${secilenbaslik}" />
								<textarea name="icerik" rows="7" class="form-control p-2 mb-1 mt-1">${secilenicerik}</textarea>
								<input id="hidden" type="hidden" name="hidden" value="${secilenid}" />
								<input id="sablonguncellebtn" type="button" class="btn btn-primary m-2" value="GUNCELLE">
								<input data-id="${secilenid}" id="sablonsilbtn" type="button" class="btn btn-danger" value="SIL">
							</form>
						</div>
					</div>`).fadeIn('slow')
				}
			})
			/* SABLON GUNCELLEME ISLEMI */
			$(document).on('click','#sablonguncellebtn', function(){
				$.ajax({
					type: 'POST',
					url: '<?=URL_YONETIM?>islem.php?islem=sablonguncelle',
					data: $('#formguncelle').serialize(),
					success: function(results){
						if(results == 'ok'){
							$('#sablonduzenle').html('<div class="alert alert-info mt-3">Sablonunuz Basariyla Guncellendi..</div>')
							.delay('2000')
							.fadeOut('3000',function(){
								$('#sablonduzenle').html('')
							})
						}else{
							$('#sablonduzenle').html('<div class="alert alert-danger mt-3">Sablonunuz Guncellenirken Bir Hata Olustu..</div>')
						}
					}
				})
			})
			/* SABLON SILME ISLEMI */
			$(document).on('click','#sablonsilbtn', function(){
				var secilenid = $(this).attr('data-id')

				$.post('<?=URL_YONETIM?>islem.php?islem=sablonsil',{'secilenid':secilenid},function(results){
					if(results == 'ok'){
						$('#sablonduzenle').html('<div class="alert alert-info mt-3">Sablonunuz Basariyla Silindi..</div>')
						.delay('2000')
						.fadeOut('3000',function(){
							$('#sablonduzenle').html('')
						})
					}else{
						$('#sablonduzenle').html('<div class="alert alert-danger mt-3">Sablonunuz Silinirken Bir Hata Olustu..</div>')
					}
				})
			})
			/* SABLON EKLEME COMPONENTINI OLSTUR */
			$(document).on('click','#sablonekle',function(){
				$('#sablonduzenle').hide().html(`<div class="row">
						<div class="col-xl-8 col-lg-8 col-md-8 mx-auto col-sm-12 m-3">
							<form id="sabloneklemeformu">
								<input type="text" name="baslik" class="form-control p-2" placeholder="BIR BASLIK GIRINIZ.." />
								<textarea name="icerik" rows="7" class="form-control p-2 mb-1 mt-1" placeholder="BIR ICERIK GIRINIZ.."></textarea>
								<input id="sabloneklebtn" type="button" class="btn btn-primary m-2" value="EKLE">
							</form>
						</div>
					</div>`).fadeIn('slow')
			})
			/* SABLON EKLEME ISLEMI */
			$(document).on('click','#sabloneklebtn',function(){
				$.ajax({
					type: 'POST',
					url: '<?=URL_YONETIM?>islem.php?islem=sablonekleme',
					data: $('#sabloneklemeformu').serialize(),
					success: function(donenveri){
						if(donenveri == 'ok'){
							$('#sablonduzenle').html('<div class="alert alert-info mt-3">Sablonunuz Basariyla Eklendi..</div>')
							.delay('2000')
							.fadeOut('3000',function(){
								$('#sablonduzenle').html('')
							})
						}else{
							$('#sablonduzenle').html('<div class="alert alert-danger mt-3">Sablonunuz Eklenirken Bir Hata Olustu..</div>')
						}
					}
				})
			})
			/* SABLON SECIM COMPONENTINI OLSTUR */
			$('select[name="sablonsec"]').on('change',function(){
				var secilenid = $(this).val()
				var secilenbaslik = $(this).children('option:selected').attr('data-baslik')
				var secilenicerik = $(this).children('option:selected').attr('data-icerik')

				if(secilenid == 0){
					$('input[name="baslik"]').val('')
					$('textarea[name="mail"]').val('')
				}else{
					$('input[name="baslik"]').val(secilenbaslik)
					$('textarea[name="mail"]').val(secilenicerik) 
				}
			})
		})
	</script>
</head>
<body>
	<div class="page-container">
       	<div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="control.php"><img src="<?=IMG_YONETIM?>logo/logo.png" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <?php  $yonetim->yetkiKontrol->LinkKontrol(); ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- SİDEBAR BİTİYOR -->
       	<div class="main-content">
            <div class="header-area">
                <div class="row align-items-center bizimolcu">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 clearfix">
                        <div class="user-profile pull-right bizimolcu">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user mr-2"></i><?php  echo $yonetim->kuladial(); ?> <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                            	<a class="dropdown-item" href="control.php?sayfa=ayarlar">Ayarlar</a>                          
                                <a class="dropdown-item" href="control.php?sayfa=cikis">Çıkış</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- gizleme gösterme ve kullanıcı butonu bitiyor -->
            <div class="main-content-inner">
               	<div class="row">
					<div class="col-lg-12 mt-2 bg-white text-center" style="min-height:500px;"><?php 	  
						@$sayfa=$_GET["sayfa"];
						
						switch ($sayfa):
							case "siteayar":					  
							$yonetim->siteayar();					  
							break;					  
							case "cikis":					  
							$yonetim->cikis();					  
							break;
						//-------------------------------	
							case "introayar":
							$yonetim->yetkiKontrol->BolumKontrol("introYetki");
							$yonetim->introayar();				  
							break;
							case "introresimguncelle":
							$yonetim->yetkiKontrol->BolumKontrol("introYetki");			  						  
							$yonetim->introresimguncelleme();					  
							break;
							case "introresimsil":		
							$yonetim->yetkiKontrol->BolumKontrol("introYetki");			  				  
							$yonetim->introsil();					  
							break;
							case "introresimekle":
							$yonetim->yetkiKontrol->BolumKontrol("introYetki");			  						  
							$yonetim->introresimekleme();					  
							break;					 
						//-------------------------------
							case "aracfilo":		
							$yonetim->yetkiKontrol->BolumKontrol("aracYetki");			  				  
							$yonetim->aracfilo();					  
							break;
							case "aracfiloguncelle":
							$yonetim->yetkiKontrol->BolumKontrol("aracYetki");					  
							$yonetim->aracfiloguncelleme();					  
							break;
							case "aracfilosil":
							$yonetim->yetkiKontrol->BolumKontrol("aracYetki");					  
							$yonetim->aracfilosil();					  
							break;
							case "aracfiloekle":
							$yonetim->yetkiKontrol->BolumKontrol("aracYetki");					  
							$yonetim->aracfiloekleme();					  
							break;
						//-------------------------------
							case "hakkimiz":
							$yonetim->yetkiKontrol->BolumKontrol("hakkimizYetki");					  
							$yonetim->yonetim2->hakkimizda();					  
							break;
						//-------------------------------
							case "hizmetler":	
							$yonetim->yetkiKontrol->BolumKontrol("hizmetlerYetki");
							$yonetim->yonetim2->hizmetlerhepsi();					  
							break;
							case "hizmetguncelle":
							$yonetim->yetkiKontrol->BolumKontrol("hizmetlerYetki");					  
							$yonetim->yonetim2->hizmetguncelleme();					  
							break;
							case "hizmetsil":	
							$yonetim->yetkiKontrol->BolumKontrol("hizmetlerYetki");				  
							$yonetim->yonetim2->hizmetsil();					  
							break;
							case "hizmetekle":
							$yonetim->yetkiKontrol->BolumKontrol("hizmetlerYetki");					  
							$yonetim->yonetim2->hizmetekleme();					  
							break;
						//-------------------------------					  
							case "ref":
							$yonetim->yetkiKontrol->BolumKontrol("referansYetki");						  
							$yonetim->yonetim2->referanslarhepsi();					  
							break;					  		  
							case "refsil":
							$yonetim->yetkiKontrol->BolumKontrol("referansYetki");					  
							$yonetim->yonetim2->refsil();					  
							break;
							case "refekle":
							$yonetim->yetkiKontrol->BolumKontrol("referansYetki");					  
							$yonetim->yonetim2->refekleme();					  
							break;
						//-------------------------------		
							case "yorumlar":
							$yonetim->yetkiKontrol->BolumKontrol("yorumYetki");					  
							$yonetim->yonetim2->yorumlarhepsi();					  
							break;
							case "yorumlarguncelle":
							$yonetim->yetkiKontrol->BolumKontrol("yorumYetki");					  
							$yonetim->yonetim2->yorumlarguncelleme();					  
							break;
							case "yorumlarsil":
							$yonetim->yetkiKontrol->BolumKontrol("yorumYetki");					  
							$yonetim->yonetim2->yorumlarsil();					  
							break;
							case "yorumlarekle":
							$yonetim->yetkiKontrol->BolumKontrol("yorumYetki");					  
							$yonetim->yonetim2->yorumlarekleme();					  
							break;
						//-------------------------------	
							case "gelenmesaj":
							$yonetim->yetkiKontrol->BolumKontrol("mesajYetki");					  
							$yonetim->gelenmesajlar();					  
							break;
							case "mesajoku":
							$yonetim->yetkiKontrol->BolumKontrol("mesajYetki");					  
							$yonetim->mesajdetay($_GET["id"]);					  
							break;
							case "mesajarsivle":
							$yonetim->yetkiKontrol->BolumKontrol("mesajYetki");					  
							$yonetim->mesajarsivle($_GET["id"]);					  
							break;
							case "mesajsil":
							$yonetim->yetkiKontrol->BolumKontrol("mesajYetki");					  
							$yonetim->mesajsil($_GET["id"]);					  
							break;
						//-------------------------------	 
							case "mailayar":
							$yonetim->yetkiKontrol->BolumKontrol("ayarYetki");					  
							$yonetim->yonetim2->mailayar();					  
							break;
						//-------------------------------
							case "ayarlar":
							$yonetim->yetkiKontrol->BolumKontrol("ayarYetki");					  
							$yonetim->yonetim2->ayarlar();					  
							break;
						//-------------------------------
							case "kulayar":
							$yonetim->yetkiKontrol->BolumKontrol("yoneticiYetki");					  
							$yonetim->yonetim2->kullistele();					  
							break;
							case "yonsil":
							$yonetim->yetkiKontrol->BolumKontrol("yoneticiYetki");					  
							$yonetim->yonetim2->yonsil($_GET["id"]);					  
							break;
							case "yonekle":
							$yonetim->yetkiKontrol->BolumKontrol("yoneticiYetki");					  
							$yonetim->yonetim2->yonekle();					  
							break;
							case "yoneticiguncelle":
							$yonetim->yetkiKontrol->BolumKontrol("yoneticiYetki");					  
							$yonetim->yonetim2->yonGuncelle();					  
							break;
						//-------------------------------
							case "tas":
							$yonetim->yetkiKontrol->BolumKontrol("tasarimYetki");					  
							$yonetim->yonetim2->tasarimYonetim();					  
							break;	
							case "tasarimguncelle":
							$yonetim->yetkiKontrol->BolumKontrol("tasarimYetki");					  
							$yonetim->yonetim2->tasarimguncelleme();					  
							break;				  
						//-------------------------------
							case "bakim":
								$yonetim->yetkiKontrol->BolumKontrol("ayarYetki");					  
								$yonetim->yonetim2->bakim();					  
							break;
							case "yedek":
								$yonetim->yetkiKontrol->BolumKontrol("ayarYetki");					  
								$yonetim->yonetim2->yedek();					  
							break;
						//------------------------------- 
							case "linkayar":
								$yonetim->yetkiKontrol->BolumKontrol("ayarYetki");					  
								$yonetim->yonetim3->linkayar();					  
							break;
							case "linkguncelle":
								$yonetim->yetkiKontrol->BolumKontrol("ayarYetki");					  
								$yonetim->yonetim3->linkguncelleme();					  
							break;
							case "linksil":
								$yonetim->yetkiKontrol->BolumKontrol("ayarYetki");					  
								$yonetim->yonetim3->linksil();					  
							break;
							case "linkekle":
								$yonetim->yetkiKontrol->BolumKontrol("ayarYetki");					  
								$yonetim->yonetim3->linkekleme();					  
							break;
						//-------------------------------   
							case "videolar":
								$yonetim->yetkiKontrol->BolumKontrol("videoYetki");					  
								$yonetim->yonetim3->videolar();					  
							break;
							case "videoguncelle":
								$yonetim->yetkiKontrol->BolumKontrol("videoYetki");					  
								$yonetim->yonetim3->videoguncelleme();					  
							break;
							case "videosil":
								$yonetim->yetkiKontrol->BolumKontrol("videoYetki");					  
								$yonetim->yonetim3->videosil();					  
							break;
							case "videoekle":
								$yonetim->yetkiKontrol->BolumKontrol("videoYetki");					  
								$yonetim->yonetim3->videoekleme();					  
							break;
						//------------------------------- 
							case "bulten":
								$yonetim->yetkiKontrol->BolumKontrol("bultenYetki");					  
								$yonetim->yonetim3->bulten();					  
							break;
							case "mailgonderme":
								$yonetim->yetkiKontrol->BolumKontrol("bultenYetki");					  
								$yonetim->yonetim3->mailgonderme();					  
							break;
						//-------------------------------	
							case "haberler":
								$yonetim->yetkiKontrol->BolumKontrol("haberYetki");					  
								$yonetim->yonetim2->haberler();					  
							break;
							case "haberguncelle":
								$yonetim->yetkiKontrol->BolumKontrol("haberYetki");					  
								$yonetim->yonetim2->haberguncelleme();					  
							break;
							case "habersil":
								$yonetim->yetkiKontrol->BolumKontrol("haberYetki");					  
								$yonetim->yonetim2->habersil();					  
							break;
							case "haberekle":
								$yonetim->yetkiKontrol->BolumKontrol("haberYetki");					  
								$yonetim->yonetim2->haberekleme();					  
							break;
						//-------------------------------	
							case "smsayar":
								$yonetim->yetkiKontrol->BolumKontrol("ayarYetki");					  
								$yonetim->yonetim3->apiayar();					  
							break;
						//-------------------------------	
							default:
								if ($yonetim->yetkiKontrol->genelYetki==1):
									$yonetim->yonetim3->istatistikbar();						  
								elseif ($yonetim->yetkiKontrol->genelYetki==2):
									$yonetim->introayar();	
								elseif ($yonetim->yetkiKontrol->genelYetki==3):
									$yonetim->yonetim2->yorumlarhepsi();						  
								endif;
						endswitch;  ?> 
                	</div>
            	</div>
            </div>
        </div> 
    </div>
    <script src="<?=URL_YONETIM?>assets/js/vendor/jquery-2.2.4.min.js"></script>    
    <script src="<?=URL_YONETIM?>assets/js/popper.min.js"></script>
    <script src="<?=URL_YONETIM?>assets/js/bootstrap.min.js"></script>
    <script src="<?=URL_YONETIM?>assets/js/owl.carousel.min.js"></script>
    <script src="<?=URL_YONETIM?>assets/js/metisMenu.min.js"></script>
    <script src="<?=URL_YONETIM?>assets/js/jquery.slimscroll.min.js"></script>
    <script src="<?=URL_YONETIM?>assets/js/jquery.slicknav.min.js"></script> 
    <script src="<?=URL_YONETIM?>assets/js/plugins.js"></script>
    <script src="<?=URL_YONETIM?>assets/js/scripts.js"></script>
	<script src="<?=URL_YONETIM?>assets/js/notify.js"></script>
</body>
</html>
