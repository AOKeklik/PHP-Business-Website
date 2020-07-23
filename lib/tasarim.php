<?php

   include_once(ARAYUZ."lib/functions.php");

   class Tasarim extends Kurumsal
   {
      public $haberler,$hizmetler,$referanslar,$yorumlar,$videolar,$bultenler;

      public function __construct()
      {
         parent::__construct();

         $tasarim = $this -> prepare("SELECT * FROM tasarim");
         $tasarim -> execute();
         $tasari = $tasarim -> fetch(PDO::FETCH_ASSOC);

         $this->haberler = $tasari['haberler'];
         $this->hizmetler = $tasari['hizmetler'];
         $this->referanslar = $tasari['referanslar'];
         $this->yorumlar = $tasari['yorumlar'];
         $this->videolar = $tasari['videolar'];
         $this->bultenler = $tasari['bultenler'];

      }
   // hizmetler
      public function tasarimhaberler()
      {
            if($this->haberler == 0):
               parent::haberler();
            endif;
      }
   // hizmetler
      public function tasarimhizmetler()
      {
         if($this->hizmetler == 0):
            echo "<section id='hizmetler' class='wow fadeInUp'>
                  <div class='container'>"; 
                  parent::hizmetler($this->hizmet); 
            echo "</div></section>";
         endif;
      }
   // rferanslar
      public function tasarimreferanslar()
      {
         if($this->referanslar == 0):
            echo "<section id='referanslar' class='wow fadeInUp'>
                  <div class='container'>"; 
                  parent::referanslar($this->referans);
            echo "</div></section>";
         endif;
      }
   // yorumlar
      public function tasarimyorumlar()
      {
         if($this->yorumlar == 0):
            echo "<section id='yorumlar' class='wow fadeInUp'>
                  <div class='container'>"; 
                  parent::yorumlar($this->yorum); 
            echo "</div></section>";
         endif;
      }
   // videolar
      public function tasarimvideolar()
      {
         if($this->videolar == 0):
            echo "<section id='videolar' class='wow fadeInUp'>";
                  parent::videolar($this->yorum); 
            echo "</section>";
         endif;
      }
   // videolar
      public function tasarimbultenler()
      {
         if($this->bultenler == 0):

            echo '
                <div class="col-md-6 mx-auto">
                  <div class="row">
                     <div id="bultensonuc" class="col-12 mt-5"></div>
                     <div id="bultentutucu" class="col-12">
                           <h4 class="pt-2 pb-2 border-bottom">Bultenimize Kayit Olun..</h4>
                           <form id="bultenform">
                           <input type="text" name="mail" id="mail" class="float-left w-75 form-control" placeholder="Mail Adresinizi Giriniz..">
                           <input type="button"  value="'.$this->mail_submit.'" id="bultenbtn" class="float-right btn btn-info"/>
                           </form>
                     </div>
                  </div>
               </div>
            ';
         endif;
      }
   // tasarim bolumleri
      public function tasarimbolumler()
      {
         $tasarimbolum = $this -> prepare("SELECT * FROM tasarimbolumler ORDER BY orders ASC");
         $tasarimbolum -> execute();

         while($tasarim = $tasarimbolum -> fetch(PDO::FETCH_ASSOC)):
            $funcname = $tasarim['classname'];
            $this -> $funcname();
         endwhile;
      }
   }






?>