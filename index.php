<?php
   session_start();//tr en pl dil islemleri icn 
 
   include_once('config/baglan.php');
   include_once(ARAYUZ.'lib/teknikfunction.php');   
   $teknik = new Teknik();

   $teknik->languageKontrol();//TEKNIK FUNCTION
   $teknik->cacheKontrol(md5($_SERVER['REQUEST_URI']), 30);//TEKNIK FUNCTION

   ob_start();//header function lari icn, cache islemleri icn kullanlr

   include_once(ARAYUZ.'lib/functions.php'); 
   include_once(ARAYUZ.'lib/tasarim.php');

   $kurumsal = new Kurumsal();
   $tasarim = new Tasarim();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <meta charset="utf-8">
   <meta name="title" content="<?= $kurumsal->metaTitle; ?>">
   <meta name="description" content="<?= $kurumsal->metaDescription; ?>">
   <meta name="keywords" content="<?= $kurumsal->metaKey; ?>">
   <meta name="author" content="<?= $kurumsal->metaAuthor; ?>">
   <meta name="owner" content="<?= $kurumsal->metaOwner; ?>">
   <meta name="copyright" content="<?= $kurumsal->metaCopy; ?>">
   <title><?= $kurumsal->title; ?></title>
   <!-- Fontlar -->
   <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">
   <!-- Bootstrap stil dosyası -->
   <link href="<?= URL; ?>lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
   <!-- işimize yarayacak diğer kütüphane css dosyalarımız -->
   <link href="<?= URL; ?>lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
   <link href="<?= URL; ?>lib/animate/animate.min.css" rel="stylesheet">
   <link href="<?= URL; ?>lib/ionicons/css/ionicons.min.css" rel="stylesheet">
   <link href="<?= URL; ?>lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
   <link href="<?= URL; ?>lib/magnific-popup/magnific-popup.css" rel="stylesheet">
   <link href="<?= URL; ?>lib/ionicons/css/ionicons.min.css" rel="stylesheet">
   <!-- bizim stil dosyamız -->
   <link href="<?= URL; ?>css/style.css" rel="stylesheet">
   <!-- Kütüphaneler -->
   <script src="<?= URL; ?>lib/jquery/jquery.min.js"></script>
   <script src="<?= URL; ?>lib/jquery/jquery-migrate.min.js"></script>
   <script src="<?= URL; ?>lib/bootstrap/js/bootstrap.bundle.min.js"></script>
   <script src="<?= URL; ?>lib/easing/easing.min.js"></script>
   <script src="<?= URL; ?>lib/superfish/hoverIntent.js"></script>
   <script src="<?= URL; ?>lib/superfish/superfish.min.js"></script>
   <script src="<?= URL; ?>lib/wow/wow.min.js"></script>
   <script src="<?= URL; ?>lib/owlcarousel/owl.carousel.min.js"></script>
   <script src="<?= URL; ?>lib/magnific-popup/magnific-popup.min.js"></script>
   <script src="<?= URL; ?>lib/sticky/sticky.js"></script>
   <script src="<?= URL; ?>js/main.js"></script>
   <script type="text/javascript" src="<?= URL; ?>js/jquery.js"></script>
   <script type="text/javascript" src="<?= URL; ?>js/jquery.vticker-min.js"></script>
<script>
   $(document).ready(function(e){
   // v tcker
      $('#news-container1').vTicker({
         speed: 700,
         pause: 4000,
         animation: 'fade',
         mousePause: false,
         showItems: 1
      });
   // v tcker
   // MAIL
      $('#gonderbtn').click(function()
      {
         var error = false;
         var form = $('#mailform').find('.form-group');

         form.children('input').each(function()
         {
            var i = $(this);
            i.css('border-color','');

            if(i.val() == ''){
               i.css('border-color','red');
               $('#mesajsonuc').text('Lutfen Tum Alanlari Doldurunuz..');
               error = true;
            }else{
               $('#mesajsonuc').text('');
               error = false;
            }
         })

         var textarea = form.children('textarea');

         if(textarea.val() == ''){
            textarea.css('border-color','red');
            $('#mesajsonuc').text('Lutfen Tum Alanlari Doldurunuz..');
            error = true;
         }else{
            $('#mesajsonuc').text('');
            error = false;
         }

         if(!error){
            $.ajax({
               type: "POST",
               url:  "<?= URL; ?>lib/mail/gonder.php",
               data:$("#mailform").serialize(),
               success: function(donen){
                  $("#mailform").trigger("reset");
                  $("#formtutucu").fadeOut(500);
                  $("#mesajsonuc").html(donen);
               }
            })
         }
      })  
   // MAIL
   // BULTEN
      $('#bultensonuc').hide();
      $('#bultenbtn').click(function(){
         $.ajax({
            type: 'POST',
            url: '<?= URL; ?>lib/islem.php?islem=islembulten',
            data: $('#bultenform').serialize(),
            success: function(results){
               $('#bultenform').trigger('reset');
               $('#bultentutucu').fadeOut(500);
               $('#bultensonuc').html(results).fadeIn();
            }
         })
      })
   // BULTEN
   })
</script>
</head>
<body id="body">
<!-- topbar -->
   <section id="topbar" class="d-none d-lg-block">
      <div class="container clearfix">
         <div class="contact-info float-left">
            <i class="fa fa-envelope-o"></i><a href="mailto:<?= $kurumsal->mail; ?>"><?= $kurumsal->mail; ?></a>
            <i class="fa fa-phone"></i><?= $kurumsal->phone; ?>     
         </div>    
         <div class="social-links float-right">    
            <a href="<?= $kurumsal->twitter; ?>" class="twitter"><i class="fa fa-twitter"></i></a>
            <a href="<?= $kurumsal->facebook; ?>" class="facebook"><i class="fa fa-facebook"></i></a>
            <a href="<?= $kurumsal->instagram; ?>" class="instagram"><i class="fa fa-instagram"></i></a> 

            <a href="tr" class="facebook">TR</a>
            <a href="en" class="facebook">EN</a> 
            <a href="pl" class="facebook">PL</a>
         </div>
      </div>
   </section> 
<!-- topbar -->
<!-- header -->
   <header id="header">
      <div class="container">
         <div id="logo" class="pull-left">
            <h1><a href="#body" class="scrollto"><?= htmlspecialchars_decode($kurumsal->logo); ?></a></h1>
         </div>
         <nav id="nav-menu-container">
         <ul class="nav-menu">        
         
         <?= $kurumsal ->linkler(); ?>
         
         </ul>
         </nav>
      </div>
   </header>
<!-- header -->
<!-- intro -->
   <section id="intro">
      <div class="intro-content">
         <h2><?= htmlspecialchars_decode($kurumsal->header); ?></h2>
      </div>
      <div id="intro-carousel" class="owl-carousel">
         <?php echo $kurumsal->introbak(); ?>
      </div>
   </section>
<!-- intro -->
<!-- main -->
   <main id="main">
<!-- BİZDEN HABERLER BÖLÜMÜ -->
   <?=$tasarim -> tasarimhaberler();?>       
<!-- BİZDEN HABERLER BÖLÜMÜ -->
<!-- BOLUMLER -->
   <?= $tasarim -> tasarimbolumler(); ?>
<!-- BOLUMLER -->
<!-- contact -->
   <section id="iletisim" class="wow fadeInUp">
      <div class="container">
         <div class="section-header">
            <h2><?= $kurumsal->iletisim_header; ?></h2>
            <p><?= $kurumsal->iletisim; ?></p>
   		</div>
         
         <div class="row contact-info">
            <div class="col-md-4">
               <div class="contact-address">
                  <i class="ion-ios-location-outline"></i>
                  <h3><?= $kurumsal->header_adres; ?></h3>
                  <address><?= $kurumsal->adress; ?></address>
               </div>
            </div>
         
            <div class="col-md-4">
               <div class="contact-phone">
                  <i class="ion-ios-telephone-outline"></i>
                  <h3><?= $kurumsal->header_tel; ?></h3>
                  <p><a href="tel:<?= $kurumsal->phone; ?>"><?= $kurumsal->phone; ?></a></p>
               </div>
            </div>
         
            <div class="col-md-4">
               <div class="contact-email">
                  <i class="ion-ios-email-outline"></i>
                  <h3><?= $kurumsal->header_mail; ?></h3>
                  <p><a href="mailto:<?= $kurumsal->mail; ?>"><?= $kurumsal->mail; ?></a></p>
               </div>
            </div>
         </div>
      </div>

      <div class="container mb-4">
         <iframe src="<?= $kurumsal->map ?>" width="100%" height="380" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>

      <div class="container">
         <div class="form">
            <div id="mesajsonuc"></div>
            <div id="formtutucu">
               <form id="mailform">
                  <div class="form-row">
                     <div class="form-group col-md-6">
                        <input type="text" name="isim" class="form-control" placeholder="<?= $kurumsal->mail_name; ?>" required="required" />
                     </div>
                     <div class="form-group col-md-6">
                        <input type="text" name="mail" class="form-control" placeholder="<?= $kurumsal->mail_mail; ?>" required="required" />
                     </div>
                  </div>

                  <div class="form-row">
                     <div class="form-group col-md-1">
                        <img src="<?=URL;?>captcha.php" />
                     </div>
                     <div class="form-group col-md-5">
                        <input type="text" name="captcha" class="form-control" placeholder="<?= $kurumsal->mail_code; ?>" required="required" />
                     </div>
                     <div class="form-group col-md-6">
                        <input type="text" name="konu" class="form-control" placeholder="<?= $kurumsal->mail_subject; ?>" required="required" />
                     </div>
                  </div>

                  <div class="form-group">
                     <textarea class="form-control" name="mesaj" placeholder="<?= $kurumsal->mail_message; ?>" rows="5"></textarea>
                  </div>

                  <?php 
                     $token = md5(mt_rand(0,9999999)); 
                     $_SESSION['token'] = $token; 
                  ?>
                  <input type="hidden" name="token" value="<?=$token;?>" />
                  <div class="text-center"><input type="button"  value="<?= $kurumsal->mail_submit; ?>" id="gonderbtn" class="btn btn-info"/></div>
               </form>
            </div>
         </div>
      </div>
   </section>
<!-- contact -->
</main>
<!-- main -->
<!-- footer -->
   <footer id="footer">
      <div class="container">
         <div class="row">
            <?=$tasarim -> tasarimbultenler(); ?>
            <div class="col-md-6 mx-auto">
               <div class="row">
                  <div class="col-12 mt-5">
                     <div class="copyright pt-2"><?=htmlspecialchars_decode($kurumsal->footer)?></div>
                     <div class="credits"> <?= $kurumsal->metaOwner; ?> </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </footer>
<!-- footer -->
<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
</body>
</html>

<!-- $teknik->cacheStart(md5($_SERVER['REQUEST_URI']));//TEKNIK FUNCTION  -->
<?php
      $teknik->cacheStart(md5($_SERVER['REQUEST_URI']));
?>