<?php

   class Yetkicontrol extends Yonetim
   {
      public function __construct()
      {
         parent::__construct();

         $cookieid = parent::cookieCoz($_COOKIE['userinfo']);

         $yetkiler = $this -> prepare("SELECT * FROM yonetim WHERE id='$cookieid'");
         $yetkiler -> execute();
         $yetki = $yetkiler -> fetch(PDO::FETCH_ASSOC);

         $yonetim = $this -> prepare("SHOW COLUMNS FROM yonetim WHERE FIELD NOT IN ('id','name','password','active')");
         $yonetim -> execute();

         foreach($yonetim as $yonet):
            $this->{$yonet[0]} = $yetki[$yonet[0]];
         endforeach;
         
      }

      public function linkyetkileri()
      {

         if($this->ayar == 1): 
            echo '<li><a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-cog"></i> <span>Ayarlar</span></a><ul class="collapse">';
               echo $this->siteayar == 1 ? '<li><a href="control.php?sayfa=siteayar"><i class="ti-pencil"></i> <span>Site Ayarları</span></a></li>' : null;
               echo $this->yonetimm == 1 ? '<li><a href="control.php?sayfa=kullaniciayar"><i class="ti-user"></i> <span>Kullanici Ayar</span></a></li>' : null;
               echo $this->mailayar == 1 ? '<li><a href="control.php?sayfa=mailayar"><i class="fa fa-envelope"></i> <span>Mail Ayarlari</span></a></li>' : null;
               echo $this->tasarim == 1 ? '<li><a href="control.php?sayfa=tasarimayar"><i class="fa fa-eye"></i> <span>Tasarim Ayarlari</span></a></li>' : null;
               echo $this->bakim == 1 ? '<li><a href="control.php?sayfa=bakimayar"><i class="ti-server"></i> <span>Bakim Ayarlari</span></a></li>' : null;
               echo $this->bakim == 1 ? '<li><a href="control.php?sayfa=yedekayar"><i class="ti-server"></i> <span>Yedekleme Ayarlari</span></a></li>' : null;
               echo $this->link == 1 ? '<li><a href="control.php?sayfa=linkayar"><i class="fa fa-cogs"></i> <span>Link Ayarlari</span></a></li>' : null;
               echo $this->bulten == 1 ? '<li><a href="control.php?sayfa=bultenayar"><i class="fas fa-at"></i> <span>Bulten Ayarlari</span></a></li>' : null;
            echo '</ul></li>';
         endif;

         echo $this->haber == 1 ? '<li><a href="control.php?sayfa=haberayar"><i class="fa fa-newspaper"></i> <span>Haber Ayarlari</span></a></li>' : null;
         echo $this->istatistik == 1 ? '<li><a href="control.php?sayfa=istatistikbar"><i class="fas fa-file-medical-alt"></i> <span>Istatistik Bar</span></a></li>' : null;
         echo $this->intro == 1 ? '<li><a href="control.php?sayfa=introayar"><i class="ti-image"></i> <span>İntro Ayarları</span></a></li>' : null;
         echo $this->hakkimizda == 1 ? '<li><a href="control.php?sayfa=hakkimizdaayar"><i class="ti-flag"></i> <span>Hakkımızda Ayarları</span></a></li>' : null;
         echo $this->hizmet == 1 ? '<li><a href="control.php?sayfa=hizmetayar"><i class="ti-medall"></i> <span>Hizmetlerimiz Ayarları</span></a></li>' : null;
         echo $this->referans == 1 ? '<li><a href="control.php?sayfa=referansayar"><i class="ti-eye"></i> <span>Referanslar Ayarları</span></a></li>' : null;
         echo $this->filo == 1 ? '<li><a href="control.php?sayfa=filoayar"><i class="ti-car"></i> <span>Araç Filosu</span></a></li>' : null;
         echo $this->yorum == 1 ? '<li><a href="control.php?sayfa=yorumayar"><i class="ti-comment-alt"></i> <span>Müşteri Yorumları</span></a></li>' : null;
         echo $this->mesaj == 1 ? '<li><a href="control.php?sayfa=gelenmail"><i class="far fa-paper-plane"></i> <span>Gelen Mailler</span></a></li>' : null;
         echo $this->video == 1 ? '<li><a href="control.php?sayfa=videoayar"><i class="fa fa-film"></i> <span>Video Ayarlari</span></a></li>' : null;
      }

      public function bolumkontrol($mevcutyetki)
      {
         if($this -> $mevcutyetki != 1):
            header('Location:control.php');
            exit();
         endif;
      }
   
     
   }







?>





























