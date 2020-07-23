<?php
   include_once("tasarim.php");

   class Kurumsal extends PDO
   {
      public $title,$metaTitle,$metaDescription,$metaKey,$metaAuthor,$metaOwner,$metaCopy,$logo,$twitter,$facebook,$instagram,$phone,$adress,$mail,$iletisim;
      public $header,$news_title,$referans,$referans_header,$yorum,$yorum_header,$filo,$filo_header,$hizmet,$hizmet_header,$video_header,$video;
      public $header_adres,$header_tel,$header_mail,$mail_name,$mail_mail,$mail_subject,$mail_message,$mail_submit;
      protected $linkid = [];

      // constructor
         public function __construct()
         {
            parent::__construct('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8;',DB_USER,DB_PASS);

            $ayarlar = $this -> prepare("SELECT * FROM ayarlar");
            $ayarlar -> execute();
            $ayarlar = $ayarlar -> fetch(PDO::FETCH_ASSOC);

            $this -> title             = $ayarlar['title'];
            $this -> metaTitle         = $ayarlar['metaTitle'];
            $this -> metaDescription   = $ayarlar['metaDescription'];
            $this -> metaKey           = $ayarlar['metaKey'];
            $this -> metaAuthor        = $ayarlar['metaAuthor'];
            $this -> metaOwner         = $ayarlar['metaOwner'];
            $this -> metaCopy          = $ayarlar['metaCopy'];
            $this -> logo              = $ayarlar['logo'];
            $this -> twitter           = $ayarlar['twitter'];
            $this -> facebook          = $ayarlar['facebook'];
            $this -> instagram         = $ayarlar['instagram'];
            $this -> phone             = $ayarlar['phone'];
            $this -> adress            = $ayarlar['adress'];
            $this -> mail              = $ayarlar['mail'];
            $this -> map               = $ayarlar['map'];
            $this -> footer            = $ayarlar['footer'];
            $this -> url               = $ayarlar['url'];

            if($_SESSION['language'] == 'tr'):
               /* header */
               $this -> header = $ayarlar['header_tr'];
               /* news title */
               $this -> news_title = $ayarlar['news_title_tr'];
               /* hizmet */
               $this -> hizmet_header = $ayarlar['hizmet_header_tr'];
               $this -> hizmet = $ayarlar['hizmet_tr'];
               /* referans */
               $this -> referans_header = $ayarlar['referans_header_tr'];
               $this -> referans = $ayarlar['referans_tr'];
               /* filo */
               $this -> filo = $ayarlar['filo_tr'];
               $this -> filo_header = $ayarlar['filo_header_tr'];
               /* yorum */
               $this -> yorum_header = $ayarlar['yorum_header_tr'];
               $this -> yorum = $ayarlar['yorum_tr'];
               /* videoalr */
               $this -> video_header = $ayarlar['video_header_tr'];
               $this -> video = $ayarlar['video_tr'];
               /* iletisim */
               $this -> iletisim_header = $ayarlar['iletisim_header_tr'];
               $this -> iletisim = $ayarlar['iletisim_tr'];
               /* iletisim bilgi */
               $this->header_adres = 'Adresimiz';
               $this->header_tel = 'Telefon Numaramiz';
               $this->header_mail = 'Mail Adresimiz';
               $this->mail_code = 'Guvenlik Kodu';
               $this->mail_name = 'Adiniz';
               $this->mail_mail = 'Mail Adresiniz';
               $this->mail_subject = 'Konu';
               $this->mail_message = 'Mesajiniz';
               $this->mail_submit = 'GONDER';
            elseif($_SESSION['language'] == 'en'):
               /* header */
               $this -> header = $ayarlar['header_en'];
               /* news title */
               $this -> news_title = $ayarlar['news_title_en'];
               /* hizmet */
               $this -> hizmet_header = $ayarlar['hizmet_header_en'];
               $this -> hizmet = $ayarlar['hizmet_en'];
               /* referans */
               $this -> referans_header = $ayarlar['referans_header_en'];
               $this -> referans = $ayarlar['referans_en'];
               /* filo */
               $this -> filo = $ayarlar['filo_en'];
               $this -> filo_header = $ayarlar['filo_header_en'];
               /* yorum */
               $this -> yorum_header = $ayarlar['yorum_header_en'];
               $this -> yorum = $ayarlar['yorum_en'];
               /* videoalr */
               $this -> video_header = $ayarlar['video_header_en'];
               $this -> video = $ayarlar['video_en']; 
               /* iletisim */
               $this -> iletisim_header = $ayarlar['iletisim_header_en'];
               $this -> iletisim = $ayarlar['iletisim_en'];
               /* iletisim bilgi */
               $this->header_adres = 'Address';
               $this->header_tel = 'Our Phone Number';
               $this->header_mail = 'Our Mail Address';
               $this->mail_name = 'Your Name';
               $this->mail_mail = 'Your Mail Address';
               $this->mail_code = 'Security Code';
               $this->mail_subject = 'Subject';
               $this->mail_message = 'Your Comment';
               $this->mail_submit = 'SEND';
            elseif($_SESSION['language'] == 'pl'):
               /* header */
               $this -> header = $ayarlar['header_pl'];
               /* news title */
               $this -> news_title = $ayarlar['news_title_pl'];
               /* hizmet */
               $this -> hizmet_header = $ayarlar['hizmet_header_pl'];
               $this -> hizmet = $ayarlar['hizmet_pl'];
               /* referans */
               $this -> referans_header = $ayarlar['referans_header_pl'];
               $this -> referans = $ayarlar['referans_pl'];
               /* filo */
               $this -> filo = $ayarlar['filo_pl'];
               $this -> filo_header = $ayarlar['filo_header_pl'];
               /* yorum */
               $this -> yorum_header = $ayarlar['yorum_header_pl'];
               $this -> yorum = $ayarlar['yorum_pl'];
               /* videoalr */
               $this -> video_header = $ayarlar['video_header_pl'];
               $this -> video = $ayarlar['video_pl'];
               /* iletisim */
               $this -> iletisim_header = $ayarlar['iletisim_header_pl'];
               $this -> iletisim = $ayarlar['iletisim_pl']; 
               /* iletisim bilgi */
               $this->header_adres = 'Adres';
               $this->header_tel = 'Nasz Numer Telefonu';
               $this->header_mail = 'Nasz Adres Pocztowy';
               $this->mail_name = 'Twoje Imię';
               $this->mail_mail = 'Twój Adres Pocztowy';
               $this->mail_code = 'Kod Bezpieczeństwa';
               $this->mail_subject = 'Przedmiot';
               $this->mail_message = 'Twój Komentarz';  
               $this->mail_submit = 'WYSŁAĆ';            
            endif;

         }
      // intor slider pictures
         public function introbak()
         {
            $intro = $this -> prepare("SELECT * FROM intro");
            $intro -> execute();
            
            while($intros = $intro -> fetch(PDO::FETCH_ASSOC)):
               echo '<div class="item" style="background-image:url('.IMG_ARAYUZ.$intros["picturepath"].');"></div>';
            endwhile;
         }
      // haberler
         public function haberler()
         {
            $haberler = $this -> prepare("SELECT * FROM haberler ORDER BY orders ASC");
            $haberler -> execute();
            echo '
               <div class="container wow fadeInUp">
                  <div class="row mt-2 pt-3  border-secondary  border-bottom" >
                     <div class="col-lg-3 col-md-3 text-right"><h5>'.$this->news_title.'</h5></div>
                     <div class="col-lg-9 col-md-9 text-info text-left" id="news-container1">
                        <ul style="list-style-type:none;">';
                        while($haber = $haberler -> fetch(PDO::FETCH_ASSOC)):
                           echo "<li>{$haber['news_'.$_SESSION['language']]} | {$haber['dates']}</li>";
                        endwhile;
                        echo '</ul>
                     </div>
                  </div>
               </div>
            ';
         }
      // about us
         public function hakkimizda()
         {
            $hakkimizda = $this -> prepare("SELECT * FROM hakkimizda");
            $hakkimizda -> execute();
            $hakkimizda = $hakkimizda -> fetch(PDO::FETCH_ASSOC);
            echo '
               <section id="hakkimizda" class="wow fadeInUp">
                  <div class="container">
                     <div class="row">
                        <div class="col-lg-6 hakkimizda-img">
                           <img src="'.IMG_ARAYUZ.$hakkimizda['picture'].'"  alt="'.$hakkimizda['picture'].'"/>
                        </div>
                        <div class="col-lg-6 content">
                           <h2>'.$hakkimizda['header_'.$_SESSION['language']].'</h2>
                           <h3>'.htmlspecialchars_decode($hakkimizda['content_'.$_SESSION['language']]).'</h3>
                        </div>
                     </div>
                  </div>
               </section>
            ';
         }
      // our services
         public function hizmetler($header = false)
         {
            $hizmetler = $this -> prepare("SELECT * FROM hizmetler");
            $hizmetler -> execute();

            echo '
               <div class="section-header">
                  <h2>'.$this->hizmet_header.'</h2>
                  <p>'.$header.'</p>
               </div>
               <div class="row">';

            while($hizm = $hizmetler -> fetch(PDO::FETCH_ASSOC)):
               echo "
                     <div class='col-lg-6'>
                        <div class='box wow fadeInLeft'>
                           <div class='icon'><i class='{$hizm['icon']}'></i></div>
                           <h4 class='title'><a href='#'>{$hizm['title_'.$_SESSION['language']]}</a></h4>
                           <p class='description'>".htmlspecialchars_decode($hizm['content_'.$_SESSION['language']])."</p>
                        </div> 
                     </div>";
            endwhile;
            echo  '</div>';
         }
      // referances
         public function referanslar($header = false)
         {
            $referanslar = $this -> prepare("SELECT * FROM referanslar");
            $referanslar -> execute();

            echo "
               <div class='section-header'>
                  <h2>".$this->referans_header."</h2>
                  <p>".$header."</p>
               </div>
               <div class='owl-carousel clients-carousel'>
            ";

            while($referans = $referanslar -> fetch(PDO::FETCH_ASSOC)):
               echo '<img src="'.IMG_ARAYUZ.$referans["picturepath"].'" alt="Referans-'.$this->url.$referans['id'].'" />';
            endwhile;

            echo "</div>";
         }
      // vehicle fleet
         public function filomuz()
         {
            $filomuz = $this -> prepare("SELECT * FROM filomuz");
            $filomuz -> execute();

            echo "
               <section id='filo' class='wow fadeInUp'>
                  <div class='container'>
                     <div class='section-header'>
                        <h2>".$this->filo_header."</h2>
                        <p>".$this->filo."</p>
                     </div>
                  </div>
                  <div class='container-fluid'>
                     <div class='row no-gutters'>";
            while($filo = $filomuz -> fetch(PDO::FETCH_ASSOC)):
               echo  "  <div class='col-lg-3 col-md-4'>         
                           <div class='filo-item wow fadeInUp'>            
                              <a href='".IMG_ARAYUZ.$filo['picturepath']."' class='filo-popup'>
                              <img src='".IMG_ARAYUZ.$filo['picturepath']."' alt='".IMG_ARAYUZ.$filo['picturepath']."' />
                              <div class='filo-overlay'></div>
                              </a>
                           </div>
                        </div>";
            endwhile;
            echo "   </div>   
                  </div>
               </section>";
         }
      // customers comment
         public function yorumlar($header = false)
         {
            $yorumlar = $this -> prepare("SELECT * FROM yorumlar");
            $yorumlar -> execute();

            echo '
               <div class="section-header">
                  <h2>'.$this->yorum_header.'</h2>
                  <p>'.$header.'</p>
               </div>
               <div class="owl-carousel testimonials-carousel">
            ';

            while($yorum = $yorumlar -> fetch(PDO::FETCH_ASSOC)):
               echo '
                  <div class="testimonial-item">
                     <p>
                        <img src="'.$this->url.'img/sol.png" class="quote-sign-left" />
                        '.htmlspecialchars_decode($yorum['content']).'
                        <img src="'.$this->url.'img/sag.png" class="quote-sign-right" />
                     </p>
                     <img src="'.$this->url.'img/yorum.jpg" class="testimonial-img" alt="" />
                     <h3>'.$yorum['name'].'</h3>
                  </div>
               ';
            endwhile;

            echo '</div>';
         }
      // link controls
         public function linkler()
         {
            $tasarim = $this -> prepare("SELECT hizmetler,videolar FROM tasarim");
            $tasarim -> execute();
            $tasari = $tasarim -> fetch(PDO::FETCH_ASSOC);

            $linklertwo = $this -> prepare("SELECT * FROM linkler WHERE name_tr LIKE ? OR name_tr LIKE ?");
            $linklertwo -> execute(['Hizmet%', 'Video%']);

            while($linktwo = $linklertwo -> fetch(PDO::FETCH_ASSOC)):
               $this->linkid[] = $linktwo['id']; 
            endwhile;

            $linkler = $this -> prepare("SELECT * FROM linkler ORDER BY orders ASC");
            $linkler -> execute();

            $num = 0;

            while($link = $linkler -> fetch(PDO::FETCH_ASSOC)):
               if($num == 0):
                  $num = 1;
                  echo "<li class='menu-active'><a href='#".$link['tag']."'>".$link['name_'.$_SESSION['language']]."</a></li>";
               else:
                  if($link['id'] == $this->linkid[0]):
                     if($tasari['hizmetler'] == 0):
                        echo "<li class='menu-active'><a href='#".$link['tag']."'>".$link['name_'.$_SESSION['language']]."</a></li>";
                     else:
                        continue;
                     endif;
                  elseif($link['id'] == $this->linkid[1]):
                     if($tasari['videolar'] == 0):
                        echo "<li class='menu-active'><a href='#".$link['tag']."'>".$link['name_'.$_SESSION['language']]."</a></li>";
                     else:
                        continue;
                     endif;
                  else:
                     echo "<li class='menu-active'><a href='#".$link['tag']."'>".$link['name_'.$_SESSION['language']]."</a></li>";
                  endif;
               endif;
            endwhile;
         }
      // videolar control
         public function videolar()
         {
            $videolar = $this -> prepare("SELECT * FROM videolar WHERE statu='1' ORDER BY orders ASC");
            $videolar -> execute();
            
            echo "
               <div class='container'>
                  <div class='section-header'>
                     <h2>".$this->video_header."</h2>
                     <p>".$this->video."</p>
                  </div>
               </div>
               <div class='container'>
                  <div class='row no-gutters'>
            ";
            
            while($video = $videolar -> fetch(PDO::FETCH_ASSOC)):
               echo "
                  <div class='col-lg-4 col-md-6 p-2'>
                     <div class='embed-responsive embed-responsive-16by9'>
                        <iframe class='embed-responsive-item' src='https://www.youtube.com/embed/".$video['link']."' allowfullscreen></iframe>
                     </div>
                  </div>
               ";
            endwhile;
            
            echo "
                  </div>   
               </div>
            ";
         }
     
   }
?>
