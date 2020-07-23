<?php

   class Teknik
   {
      public function languageKontrol()
      {
         @$lang = $_GET['language'];//dil islemleri icin session olstr

         if($lang == 'tr' || $lang == 'en' || $lang == 'pl'):
            @$_SESSION['language'] = $lang;
         elseif(!isset($_SESSION['language'])):
            $_SESSION['language'] = 'tr';
         endif;
      }

      public function cacheKontrol($filename, $seconds)
      {
         $cachedosya = './cache/'.$filename.'.html';//cache dosyasini dil pakedine gore olstrarak baslattik en tr pl

         if(file_exists($cachedosya) && (time() - $seconds < filemtime($cachedosya)))://dosya olusmus ve yenilnme zamanindan 10 saniye gecmis ise
            include($cachedosya);
            exit();
         endif;
      }

      public function cacheStart($filename)
      {
         $cachedosya = "./cache/".$filename.".html";// cache dosyasini dil pakedine gore olstrarak baslattik

         $dosyam = fopen($cachedosya, "w");//cache dosyamizi olstrduk varsa yeniledik 
         fwrite($dosyam, ob_get_contents());//cache in baslatildigi sayfayi dosyaya yazdi
         fclose($dosyam);//dosyayi kapdik 
         ob_end_flush();//cache islemlerimizi noktaliyoruz
      }
   }







?>