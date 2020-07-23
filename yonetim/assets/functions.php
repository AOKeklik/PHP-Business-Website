<?php
   ob_start();

   class Yonetim extends PDO
   {
      public function __construct()
      {
         parent::__construct('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8;',DB_USER,DB_PASS);//pdo baglntisi
      }
   // dosya ac
      public function openfiles($dosyalar = [])
      {
         foreach($dosyalar as $key => $dosya):
            include_once(YONETIM."assets/".$key.".php");
            $this->$dosya = new $dosya;
         endforeach;
      }
   // get url
      public function getUrl()
      {
         $urls = $this -> prepare("SELECT url FROM ayarlar");
         $urls -> execute();
         $url = $urls -> fetch(PDO::FETCH_ASSOC);

         return $url['url'];
      }
   // NAVI
      public function navifunc($parentlink,$parent,$child)
      {
         echo '
            <div class="col-lg-12 border-bottom border-light">
               <nav class="mt-2 h6 font-weight-bold" aria-label="breadcrumb">
                  <ol class="breadcrumb mb-2">
                     <li class="breadcrumb-item"><a href="'.$this->geturl().'/yonetim/control.php?sayfa='.$parentlink.'">'.$parent.'</a></li>
                     <li class="breadcrumb-item active" aria-current="page">'.$child.'</li>
                  </ol>
               </nav>
            </div>
         ';
      }
   // checkbox control
      public function checkboxcontrol($name)
      {
         if(isset($_POST[$name])):
            return 1;
         else:
            return 0;
         endif;
      }
   // site settings
      public function siteayar()
      {
         if(!empty($_POST)):

            $getayarlar = $this -> prepare("SHOW COLUMNS FROM ayarlar WHERE FIELD NOT IN ('id','bakim','yedek')");
            $getayarlar -> execute();

            foreach($getayarlar as $gets):
               if ($gets[0] == 'mailtercih'):
                  ${$gets[0]} = htmlspecialchars($_POST[$gets[0]]);
                  $updateayarlar = $this -> prepare("UPDATE ayarlar SET ".$gets[0]."=".${$gets[0]}."");
               else:
                  ${$gets[0]} = htmlspecialchars($_POST[$gets[0]]);
                  $updateayarlar = $this -> prepare("UPDATE ayarlar SET ".$gets[0]."='".${$gets[0]}."'");
               endif;
               $updateayarlar -> execute();
            endforeach; 
              
            ?><script>
               BilgiPenceresi("control.php?sayfa=siteayar","BAŞARILI","Guncelleme işlemi başarılı","success");
            </script><?php
         else:
            $ayarlar = $this -> prepare("SELECT * FROM ayarlar");
            $ayarlar -> execute();
            $ayar = $ayarlar -> fetch(PDO::FETCH_ASSOC);

            echo '<form action="control.php?sayfa=siteayar" method="POST">
               <div class="row">
                  <div class="col-lg-12">
                        <h3 class="text-left text-dark p-2 mb-3 border-bottom border-light">SITE AYARLARI</h3>
                  </div>';
                              
                  $array = ['url','logo','footer'];

                  foreach($array as $arr):
                     echo  '<div class="col-lg-8 mx-auto border">
                        <div class="row">
                           <div class="col-lg-3 border-right p-0 pt-3 pl-3 text-left">
                              <span class="h5 font-weight-bold">'.strtoupper(str_replace(['','',''],['','',''],$arr)).'</span>
                           </div>
                           <div class="col-lg-9 p-2">
                              <input type="text" name="'.$arr.'" value="'.$ayar[$arr].'" class="form-control">
                           </div>
                        </div>
                     </div>';
                  endforeach;
                  echo '
                  <!-- mailtercih -->
                  <div class="col-lg-8 mx-auto border">
                        <div class="row">
                           <div class="col-lg-3 border-right p-3 text-left">
                              <span class="h4 font-weight-bold">Mail Tercih</span>
                           </div>
                           <div class="col-lg-9 d-flex align-items-center justify-content-around">
                              <div class="form-check form-check-inline">
                                 <input '; echo $ayar['mailtercih'] == 1 ? 'checked' : null; echo ' type="radio" name="mailtercih" value="1" class="form-check-input" id="one">
                                 <label class="form-check-label" for="one">Mail</label>
                              </div>
                              <div class="form-check form-check-inline">
                                 <input '; echo $ayar['mailtercih'] == 2 ? 'checked' : null; echo ' type="radio" name="mailtercih" value="2" class="form-check-input" id="two">
                                 <label class="form-check-label" for="two">Mail & Mesaj</label>
                              </div>
                              <div class="form-check form-check-inline">
                                 <input '; echo $ayar['mailtercih'] == 3 ? 'checked' : null; echo ' type="radio" name="mailtercih" value="3" class="form-check-input" id="three">
                                 <label class="form-check-label" for="three">Mesaj</label>
                              </div>
                           </div>
                        </div>
                  </div>
                  <!-- mail tercih -->
               <!-- ---------------------------- meta ---------------------------- -->
                  <div class="col-lg-8 mx-auto border p-0">
                     <div class="accordion" id="accordionExample">
                        <div class="card">
                           <div class="card-header" id="heading1">
                              <h2 class="card-title mb-0" type="button" data-toggle="collapse" data-target="#collapse10" aria-expanded="true" aria-controls="collapse10" style="cursor:pointer;">
                                 META TAGS
                              </h2>
                           </div>
                           <div id="collapse10" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                              <div class="card-body p-0">';
                              
                              $array = ['title','metaTitle','metaDescription','metaKey','metaAuthor','metaOwner','metaCopy'];

                              foreach($array as $arr):
                                 echo  '<div class="col-lg-12 border">
                                    <div class="row">
                                       <div class="col-lg-3 border-right p-0 pt-3 pl-3 text-left">
                                          <span class="h5 font-weight-bold">'.strtoupper(str_replace('meta','',$arr)).'</span>
                                       </div>
                                       <div class="col-lg-9 p-2">
                                          <input type="text" name="'.$arr.'" value="'.$ayar[$arr].'" class="form-control">
                                       </div>
                                    </div>
                                 </div>';
                              endforeach;
                           echo '</div>
                           </div>
                        </div>
                     </div>
                  </div>
               <!-- ---------------------------- meta ---------------------------- -->
               <!-- ---------------------------- social ---------------------------- -->
                  <div class="col-lg-8 mx-auto border p-0">
                     <div class="accordion" id="accordionExample">
                        <div class="card">
                           <div class="card-header" id="heading1">
                              <h2 class="card-title mb-0" type="button" data-toggle="collapse" data-target="#collapse11" aria-expanded="true" aria-controls="collapse11" style="cursor:pointer;">
                                 SOCIAL
                              </h2>
                           </div>
                           <div id="collapse11" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                              <div class="card-body p-0">';
                              
                              $array = ['twitter','facebook','instagram'];

                              foreach($array as $arr):
                                 echo  '<div class="col-lg-12 border">
                                    <div class="row">
                                       <div class="col-lg-3 border-right p-0 pt-3 pl-3 text-left">
                                          <span class="h5 font-weight-bold">'.strtoupper($arr).'</span>
                                       </div>
                                       <div class="col-lg-9 p-2">
                                          <input type="text" name="'.$arr.'" value="'.$ayar[$arr].'" class="form-control">
                                       </div>
                                    </div>
                                 </div>';
                              endforeach;
                           echo '</div>
                           </div>
                        </div>
                     </div>
                  </div>
               <!-- ---------------------------- social ---------------------------- -->
               <!-- ---------------------------- header ---------------------------- -->
                  <div class="col-lg-8 mx-auto border p-0">
                     <div class="accordion" id="accordionExample">
                        <div class="card">
                           <div class="card-header" id="heading1">
                              <h2 class="card-title mb-0" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1" style="cursor:pointer;">
                                 HEADER
                              </h2>
                           </div>

                           <div id="collapse1" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                              <div class="card-body p-0">';
                              
                              $array = ['header_tr','header_en','header_pl'];

                              foreach($array as $arr):
                                 echo  '<div class="col-lg-12 border">
                                    <div class="row">
                                       <div class="col-lg-3 border-right p-0 pt-3 pl-3 text-left">
                                          <span class="h5 font-weight-bold">'.strtoupper(str_replace(['header','_'],['head',' '],$arr)).'</span>
                                       </div>
                                       <div class="col-lg-9 p-2">
                                          <input type="text" name="'.$arr.'" value="'.$ayar[$arr].'" class="form-control">
                                       </div>
                                    </div>
                                 </div>';
                              endforeach;
                           echo '</div>
                           </div>
                        </div>
                     </div>
                  </div>
               <!-- ---------------------------- header ---------------------------- -->
               <!-- ---------------------------- news ---------------------------- -->
                  <div class="col-lg-8 mx-auto border p-0">
                     <div class="accordion" id="accordionExample">
                        <div class="card">
                           <div class="card-header" id="heading1">
                              <h2 class="card-title mb-0" type="button" data-toggle="collapse" data-target="#collapse9" aria-expanded="true" aria-controls="collapse9" style="cursor:pointer;">
                                 HABERLER
                              </h2>
                           </div>

                           <div id="collapse9" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                              <div class="card-body p-0">';
                              
                              $array = ['news_title_tr','news_title_en','news_title_pl'];

                              foreach($array as $arr):
                                 echo  '<div class="col-lg-12 border">
                                    <div class="row">
                                       <div class="col-lg-3 border-right p-0 pt-3 pl-3 text-left">
                                          <span class="h5 font-weight-bold">'.strtoupper(str_replace(['title','_'],[' ',''],$arr)).'</span>
                                       </div>
                                       <div class="col-lg-9 p-2">
                                          <input type="text" name="'.$arr.'" value="'.$ayar[$arr].'" class="form-control">
                                       </div>
                                    </div>
                                 </div>';
                              endforeach;
                           echo '</div>
                           </div>
                        </div>
                     </div>
                  </div>
               <!-- ---------------------------- news ---------------------------- -->
               <!-- ---------------------------- hizmet ---------------------------- -->
                  <div class="col-lg-8 mx-auto border p-0">
                     <div class="accordion" id="accordionExample">
                        <div class="card">
                           <div class="card-header" id="headingOne">
                              <h2 class="card-title mb-0" type="button" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2" style="cursor:pointer;">
                                 HIZMETLER
                              </h2>
                           </div>

                           <div id="collapse2" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                              <div class="card-body p-0">';
                              
                              $array = ['hizmet_header_tr','hizmet_header_en','hizmet_header_pl','hizmet_tr','hizmet_en','hizmet_pl'];

                              foreach($array as $arr):
                                 echo  '<div class="col-lg-12 border">
                                    <div class="row">
                                       <div class="col-lg-3 border-right p-0 pt-3 pl-3 text-left">
                                          <span class="h5 font-weight-bold">'.strtoupper(str_replace(['hizmet','header','_'],['hiz','head',' '],$arr)).'</span>
                                       </div>
                                       <div class="col-lg-9 p-2">
                                          <input type="text" name="'.$arr.'" value="'.$ayar[$arr].'" class="form-control">
                                       </div>
                                    </div>
                                 </div>';
                              endforeach;
                           echo '</div>
                           </div>
                        </div>
                     </div>
                  </div>
               <!-- ---------------------------- hizmet ---------------------------- -->
               <!-- ---------------------------- referans ---------------------------- -->
                  <div class="col-lg-8 mx-auto border p-0">
                     <div class="accordion" id="accordionExample">
                        <div class="card">
                           <div class="card-header" id="heading1">
                              <h2 class="card-title mb-0" type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3" style="cursor:pointer;">
                                 REFERANSLAR
                              </h2>
                           </div>

                           <div id="collapse3" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                              <div class="card-body p-0">';
                              
                              $array = ['referans_header_tr','referans_header_en','referans_header_pl','referans_tr','referans_en','referans_pl'];

                              foreach($array as $arr):
                                 echo  '<div class="col-lg-12 border">
                                    <div class="row">
                                       <div class="col-lg-3 border-right p-0 pt-3 pl-3 text-left">
                                          <span class="h5 font-weight-bold">'.strtoupper(str_replace(['referans','header','_'],['ref','head',' '],$arr)).'</span>
                                       </div>
                                       <div class="col-lg-9 p-2">
                                          <input type="text" name="'.$arr.'" value="'.$ayar[$arr].'" class="form-control">
                                       </div>
                                    </div>
                                 </div>';
                              endforeach;
                           echo '</div>
                           </div>
                        </div>
                     </div>
                  </div>
               <!-- ---------------------------- referans ---------------------------- -->
               <!-- ---------------------------- FILO ---------------------------- -->
                  <div class="col-lg-8 mx-auto border p-0">
                     <div class="accordion" id="accordionExample">
                        <div class="card">
                           <div class="card-header" id="heading1">
                              <h2 class="card-title mb-0" type="button" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4" style="cursor:pointer;">
                                 FILOMUZ
                              </h2>
                           </div>

                           <div id="collapse4" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                              <div class="card-body p-0">';
                              
                              $array = ['filo_header_tr','filo_header_en','filo_header_pl','filo_tr','filo_en','filo_pl'];

                              foreach($array as $arr):
                                 echo  '<div class="col-lg-12 border">
                                    <div class="row">
                                       <div class="col-lg-3 border-right p-0 pt-3 pl-3 text-left">
                                          <span class="h5 font-weight-bold">'.strtoupper(str_replace(['header','_'],['head',' '],$arr)).'</span>
                                       </div>
                                       <div class="col-lg-9 p-2">
                                          <input type="text" name="'.$arr.'" value="'.$ayar[$arr].'" class="form-control">
                                       </div>
                                    </div>
                                 </div>';
                              endforeach;
                           echo '</div>
                           </div>
                        </div>
                     </div>
                  </div>
               <!-- ---------------------------- FILO ---------------------------- -->
               <!-- ---------------------------- YORUM ---------------------------- -->
                  <div class="col-lg-8 mx-auto border p-0">
                     <div class="accordion" id="accordionExample">
                        <div class="card">
                           <div class="card-header" id="heading1">
                              <h2 class="card-title mb-0" type="button" data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collapse5" style="cursor:pointer;">
                                 YORUMLARIMIZ
                              </h2>
                           </div>

                           <div id="collapse5" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                              <div class="card-body p-0">';
                              
                              $array = ['yorum_header_tr','yorum_header_en','yorum_header_pl','yorum_tr','yorum_en','yorum_pl'];

                              foreach($array as $arr):
                                 echo  '<div class="col-lg-12 border">
                                    <div class="row">
                                       <div class="col-lg-3 border-right p-0 pt-3 pl-3 text-left">
                                          <span class="h5 font-weight-bold">'.strtoupper(str_replace(['yorum','header','_'],['yor','head',' '],$arr)).'</span>
                                       </div>
                                       <div class="col-lg-9 p-2">
                                          <input type="text" name="'.$arr.'" value="'.$ayar[$arr].'" class="form-control">
                                       </div>
                                    </div>
                                 </div>';
                              endforeach;
                           echo '</div>
                           </div>
                        </div>
                     </div>
                  </div>
               <!-- ---------------------------- YORUM ---------------------------- -->
               <!-- ---------------------------- VIDEOLAR ---------------------------- -->
                  <div class="col-lg-8 mx-auto border p-0">
                     <div class="accordion" id="accordionExample">
                        <div class="card">
                           <div class="card-header" id="heading1">
                              <h2 class="card-title mb-0" type="button" data-toggle="collapse" data-target="#collapse7" aria-expanded="true" aria-controls="collapse7" style="cursor:pointer;">
                                 VIDEOLAR
                              </h2>
                           </div>

                           <div id="collapse7" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                              <div class="card-body p-0">';
                              
                              $array = ['video_header_tr','video_header_en','video_header_pl','video_tr','video_en','video_pl'];

                              foreach($array as $arr):
                                 echo  '<div class="col-lg-12 border">
                                    <div class="row">
                                       <div class="col-lg-3 border-right p-0 pt-3 pl-3 text-left">
                                          <span class="h5 font-weight-bold">'.strtoupper(str_replace(['video','header','_'],['vid','head',' '],$arr)).'</span>
                                       </div>
                                       <div class="col-lg-9 p-2">
                                          <input type="text" name="'.$arr.'" value="'.$ayar[$arr].'" class="form-control">
                                       </div>
                                    </div>
                                 </div>';
                              endforeach;
                           echo '</div>
                           </div>
                        </div>
                     </div>
                  </div>
               <!-- ---------------------------- VIDEOLAR ---------------------------- -->
               <!-- ---------------------------- iletisim 1 ---------------------------- -->
                  <div class="col-lg-8 mx-auto border p-0">
                     <div class="accordion" id="accordionExample">
                        <div class="card">
                           <div class="card-header" id="heading1">
                              <h2 class="card-title mb-0" type="button" data-toggle="collapse" data-target="#collapse6" aria-expanded="true" aria-controls="collapse6" style="cursor:pointer;">
                                 ILETISIM 1
                              </h2>
                           </div>

                           <div id="collapse6" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                              <div class="card-body p-0">';
                              
                              $array = ['iletisim_header_tr','iletisim_header_en','iletisim_header_pl','iletisim_tr','iletisim_en','iletisim_pl'];

                              foreach($array as $arr):
                                 echo  '<div class="col-lg-12 border">
                                    <div class="row">
                                       <div class="col-lg-3 border-right p-0 pt-3 pl-3 text-left">
                                          <span class="h5 font-weight-bold">'.strtoupper(str_replace(['iletisim','header','_'],['ilet','head',' '],$arr)).'</span>
                                       </div>
                                       <div class="col-lg-9 p-2">
                                          <input type="text" name="'.$arr.'" value="'.$ayar[$arr].'" class="form-control">
                                       </div>
                                    </div>
                                 </div>';
                              endforeach;
                           echo '</div>
                           </div>
                        </div>
                     </div>
                  </div>
               <!-- ---------------------------- iletisim 1 ---------------------------- -->
               <!-- ---------------------------- iletisim 2 ---------------------------- -->
                  <div class="col-lg-8 mx-auto border p-0">
                     <div class="accordion" id="accordionExample">
                        <div class="card">
                           <div class="card-header" id="heading1">
                              <h2 class="card-title mb-0" type="button" data-toggle="collapse" data-target="#collapse12" aria-expanded="true" aria-controls="collapse12" style="cursor:pointer;">
                                 ILETISIM 2
                              </h2>
                           </div>

                           <div id="collapse12" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                              <div class="card-body p-0">';
                              
                              $array = ['phone','adress','mail','map'];

                              foreach($array as $arr):
                                 echo  '<div class="col-lg-12 border">
                                    <div class="row">
                                       <div class="col-lg-3 border-right p-0 pt-3 pl-3 text-left">
                                          <span class="h5 font-weight-bold">'.strtoupper(str_replace(['map','',''],['maps','',''],$arr)).'</span>
                                       </div>
                                       <div class="col-lg-9 p-2">
                                          <input type="text" name="'.$arr.'" value="'.$ayar[$arr].'" class="form-control">
                                       </div>
                                    </div>
                                 </div>';
                              endforeach;
                           echo '</div>
                           </div>
                        </div>
                     </div>
                  </div>
               <!-- ---------------------------- iletisim 2 ---------------------------- -->
                  <!-- botton -->
                  <div class="col-lg-8 mx-auto m-2">
                        <input type="submit" name="button" value="GUNCELLE" class="btn btn-dark m-2">
                  </div>
               </div>
            </form>';
         endif;
      }
   // message controls
      public function mailayar()
      {
         $gelenmailayar = $this -> prepare("SELECT * FROM gelenmailayar");
         $gelenmailayar -> execute();
         $ayar = $gelenmailayar -> fetch(PDO::FETCH_ASSOC);
         
         if(!empty($_POST)):
            $host     = htmlspecialchars($_POST['host']);
            $port     = htmlspecialchars($_POST['port']);
            $mail     = htmlspecialchars($_POST['mail']);
            $password = htmlspecialchars($_POST['password']);

            $update = $this -> prepare("UPDATE gelenmailayar SET host=?,port=?,mail=?,receiver=?,password=?");

            $update -> bindParam(1, $host, PDO::PARAM_STR);
            $update -> bindParam(2, $port, PDO::PARAM_STR);
            $update -> bindParam(3, $mail, PDO::PARAM_STR);
            $update -> bindParam(4, $mail, PDO::PARAM_STR);
            $update -> bindParam(5, $password, PDO::PARAM_STR);

            $update -> execute();
            ?><script>
               BilgiPenceresi("control.php?sayfa=mailayar","BAŞARILI","Guncelleme işlemi başarılı","success");
            </script><?php
         else:
            echo '
               <form action="" method="POST">
                  <div class="row">
                     <div class="col-lg-12">
                           <h3 class="text-left text-dark p-2 mb-2 border-bottom border-light">MESAJ AYARLARI</h3>
                     </div>
                     <!-- title -->
                     <div class="col-lg-8 mx-auto mt-2 border">
                           <div class="row">
                              <div class="col-lg-3 border-right p-3 text-left">
                                 <span class="h4 font-weight-bold">Host Adresi</span>
                              </div>
                              <div class="col-lg-9 p-2">
                                 <input type="text" name="host" value="'.$ayar['host'].'" class="form-control">
                              </div>
                           </div>
                     </div>
                     <!-- meta title -->
                     <div class="col-lg-8 mx-auto border">
                           <div class="row">
                              <div class="col-lg-3 border-right p-3 text-left">
                                 <span class="h4 font-weight-bold">Port Adresi</span>
                              </div>
                              <div class="col-lg-9 p-2">
                                 <input type="text" name="port" value="'.$ayar['port'].'" class="form-control">
                              </div>
                           </div>
                     </div>
                     <!-- meta description -->
                     <div class="col-lg-8 mx-auto border">
                           <div class="row">
                              <div class="col-lg-3 border-right p-3 text-left">
                                 <span class="h4 font-weight-bold">Mail Adresi</span>
                              </div>
                              <div class="col-lg-9 p-2">
                                 <input type="text" name="mail" value="'.$ayar['mail'].'" class="form-control">
                              </div>
                           </div>
                     </div>
                     <!-- meta description -->
                     <div class="col-lg-8 mx-auto border">
                           <div class="row">
                              <div class="col-lg-3 border-right p-3 text-left">
                                 <span class="h4 font-weight-bold">Alici Mail</span>
                              </div>
                              <div class="col-lg-9 p-2">
                                 <input type="text" name="mail" value="'.$ayar['receiver'].'" class="form-control">
                              </div>
                           </div>
                     </div>
                     <!-- meta key -->
                     <div class="col-lg-8 mx-auto border">
                           <div class="row">
                              <div class="col-lg-3 border-right p-3 text-left">
                                 <span class="h4 font-weight-bold">Host Sifre</span>
                              </div>
                              <div class="col-lg-9 p-2">
                                 <input type="password" name="password" value="'.$ayar['password'].'" class="form-control">
                              </div>
                           </div>
                     </div>
                     <!-- botton -->
                     <div class="col-lg-8 mx-auto m-2">
                           <input type="submit" name="button" value="GUNCELLE" class="btn btn-dark m-2">
                     </div>
                  </div>
               </form>
            ';
         endif;
      }
   // tasarim controls
      private function tasarimtercih($num,$column)
      {
         $tasarimArray = ['Open','Close'];
         
         foreach($tasarimArray as $key => $value):
            if($num == $key):
               echo '<div class="switch-field">
                  <input type="radio" id="'.$column.'a" name="'.$column.'" value="'.$key.'" data-value="'.$column.'" checked/>
                  <label for="'.$column.'a">'.$value.'</label>
               </div>';
            else:
               echo '<div class="switch-field">
                  <input type="radio" id="'.$column.'b" name="'.$column.'" value="'.$key.'" data-value="'.$column.'" />
                  <label for="'.$column.'b">'.$value.'</label>
               </div>';
            endif;
         endforeach;
      }
      public function tasarimayar()
      {
         $tasarim = $this -> prepare("SELECT * FROM tasarim");
         $tasarim -> execute();
         $ayar = $tasarim -> fetch(PDO::FETCH_ASSOC);
            
         echo '<div class="row">
            <div class="col-lg-12 border-bottom border-light">
               <h4 class="float-left m-2 text-dark d-flex align-items-center">TASARIM AYARLARI</h4>
            </div>

            <!-- tasarim tercih -->
            
            <div id="tasarim" class="col-lg-5 mx-auto border mt-3 mb-3">
            <form method="POST">
               <div class="row">
                  <div class="col-lg-12 border border-light p-3">
                     <span class="h4 font-weight-bold">BOLUM GORUNURLUK</span>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-4 border border-light p-2">
                     <span class="h5 font-weight-bold">BOLUM</span>
                  </div>
                  <div class="col-lg-4 border border-light p-2">
                     <span class="h5 font-weight-bold">ACIK</span>
                  </div>
                  <div class="col-lg-4 border border-light p-2">
                     <span class="h5 font-weight-bold">KAPALI</span>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-4 border border-light p-2 text-left">
                     <span class="h4 font-weight-bold">Haberler</span>
                  </div>
                  <div class="col-lg-8 d-flex align-items-center justify-content-around border-bottom border-light">';
                     $this->tasarimtercih($ayar['haberler'],'haberler');
                  echo '</div>
               </div>

               <div class="row">
                  <div class="col-lg-4 border border-light p-2 text-left">
                     <span class="h4 font-weight-bold">Hizmetler</span>
                  </div>
                  <div class="col-lg-8 d-flex align-items-center justify-content-around border-bottom border-light">';
                     $this->tasarimtercih($ayar['hizmetler'],'hizmetler');
                  echo '</div>
               </div>

               <div class="row">
                  <div class="col-lg-4 border border-light p-2 text-left">
                     <span class="h4 font-weight-bold">Referanslar</span>
                  </div>
                  <div class="col-lg-8 d-flex align-items-center justify-content-around border-bottom border-light">';
                        $this->tasarimtercih($ayar['referanslar'],'referanslar');
                  echo '</div>
               </div>

               <div class="row">
                  <div class="col-lg-4 border border-light p-2 text-left">
                     <span class="h4 font-weight-bold">Yorumlar</span>
                  </div>
                  <div class="col-lg-8 d-flex align-items-center justify-content-around border-bottom border-light">';
                     $this->tasarimtercih($ayar['yorumlar'],'yorumlar');
                  echo '</div>
               </div>

               <div class="row">
                  <div class="col-lg-4 border border-light p-2 text-left">
                     <span class="h4 font-weight-bold">Videolar</span>
                  </div>
                  <div class="col-lg-8 d-flex align-items-center justify-content-around border-bottom border-light">';
                     $this->tasarimtercih($ayar['videolar'],'videolar');
                  echo '</div>
               </div>

               <div class="row">
                  <div class="col-lg-4 border border-light p-2 text-left">
                     <span class="h4 font-weight-bold">Bultenler</span>
                  </div>
                  <div class="col-lg-8 d-flex align-items-center justify-content-around border-bottom border-light">';
                     $this->tasarimtercih($ayar['bultenler'],'bultenler');
                  echo '</div>
               </div>
            </form>
         </div>';

         /* ----------- table ----------- */

         $tasarimbolumler = $this -> prepare("SELECT * FROM tasarimbolumler ORDER BY orders ASC");
         $tasarimbolumler -> execute();

         echo'<!-- tasarim TABLE -->
               <div class="col-lg-5 mx-auto mt-3 mb-3 p-0">  
                  <table class="table table-striped table-bordered mb-0">
                     <tbody>
                        <tr>
                           <td colspan="3"><h4>BOLUM SIRASI</h4></td>
                        </tr>
                        <tr>
                           <td><h5>Name</h5></td>
                           <td><h5>Orders</h5></td>
                           <td><h5>Guncelle</h5></td>
                        </tr>';
                     while($tasarim = $tasarimbolumler -> fetch(PDO::FETCH_ASSOC)):
                        echo '
                        <tr>
                           <td>'.$tasarim['name'].'</td>
                           <td>'.$tasarim['orders'].'</td>
                           <td><a href="control.php?sayfa=tasarimbolumguncelle&id='.$tasarim['id'].'" class="ti-reload m-2 text-success" style="font-size:25px"></a></td>
                        </tr>';
                     endwhile;
                     echo '</tbody>
                  </table>
               </div>
            </div>
         </div>';
      }
      public function tasarimbolumguncelle()
      {
         $id = $_GET['id'];

         $tasarimbolumler = $this -> prepare("SELECT * FROM tasarimbolumler WHERE id='$id'");
         $tasarimbolumler -> execute();
         $tasarim = $tasarimbolumler -> fetch(PDO::FETCH_ASSOC);

         $orders = $this -> prepare("SELECT * FROM tasarimbolumler WHERE id != {$tasarim['id']} ORDER BY orders ASC");
         $orders -> execute();

         if(!$_POST):
            echo "
               <div class='row text-right'>
                  <div class='col-lg-12 border-bottom border-light'>
                     <h3 class='float-left m-2 text-dark'>BOLUM GUNCELLE</h3>
                  </div>
               </div>
               <div class='row'>
                  <div class='col-lg-6 mx-auto'>
                  <form action='' method='POST'>
                     <div class='row border border-light p-1 m-1 mt-3'>
                           <div class='col-lg-12 p-3 text-left border-bottom border-light'>
                              <div class='form-group'>
                                 <label id='texts'>BOLUM ADI</label>
                                 <input type='text' name='name' value='{$tasarim['name']}' id='texts' class='form-control' />
                              </div>
                              <div class='form-group'>
                                 <label for='select'>ORDERS {$tasarim['orders']}</label>
                                 <select name='neworders' id='select' class='custom-select'>";
                                 while($or = $orders -> fetch(PDO::FETCH_ASSOC)):
                                    echo "<option value='".$or["orders"]."'>{$or["orders"]} - {$or["name"]}</option>";
                                 endwhile;  
                                echo "</select>
                              </div>
                           </div>

                           <div class='col-lg-12 p-3 text-center'>
                              <input type='hidden' name='hidden' value='{$id}' />
                              <input type='hidden' name='oldorders' value='{$tasarim['orders']}' />
                              <button type='submit' name='submit' value='submit' class='btn btn-dark'>GUNCELLE</button>
                           </div> 
                        </form> 
                     </div>
                  </div>
               </div>";
         else:
            $hidden = htmlspecialchars($_POST['hidden']);
            $name = htmlspecialchars($_POST['name']);

            $neworders = htmlspecialchars($_POST['neworders']);
            $oldorders = htmlspecialchars($_POST['oldorders']);

           /*  echo $neworders, '<br>';

            echo $oldorders; */

            if(empty($hidden) || empty($name) || empty($neworders) || empty($oldorders)):
               echo "
                  <div class='container'>
                     <div class='col-md-8 offset-md-2 alert alert-danger border border-warning mt-4 font-14'>
                           <b>Lutfen!</b> Tum Alanlari Doldurunuz..
                     </div>
                  </div>
               ";
                  header('refresh:2,url=control.php?sayfa=tasarimayar');
            else:
               $tasarimbolumler2 = $this -> prepare("UPDATE tasarimbolumler SET orders='$oldorders' WHERE orders='$neworders'");
               $tasarimbolumler2 -> execute();

               $tasarimbolumler3 = $this -> prepare("UPDATE tasarimbolumler SET name='$name',orders='$neworders' WHERE id='$hidden'");
               $tasarimbolumler3 -> execute();
               
               ?><script>
                  BilgiPenceresi("control.php?sayfa=tasarimayar","BAŞARILI","Guncelleme işlemi başarılı","success");
               </script><?php
            endif;
         endif;
      }
   // bakim controls
      public function bakimayar()
      {
         echo "<div class='row'>";

         if($_POST):

            $date = date("d-m-Y H:i:s");
            $bakim = $this -> prepare("UPDATE ayarlar SET bakim='".$date."'");
            $bakim -> execute();

            $kurumsal = $this -> prepare("SHOW TABLES");
            $kurumsal -> execute();
            
            echo '
            <div class="container">
               <div class="list-group col-md-4 offset-md-4 mt-3">';
            while($kurum = $kurumsal->fetch(PDO::FETCH_ASSOC)):
               $this -> query("REPAIR TABLE ".$kurum['Tables_in_kurumsal']);
               $this -> query("OPTIMIZE TABLE ".$kurum['Tables_in_kurumsal']);

               echo '<div class="list-group-item text-left">
                           <i class="fa fa-check text-success text-right ml-4 mr-4"></i>
                           <span class="card-title ml-5">'.$kurum['Tables_in_kurumsal'].'</span>
                     </div>';
            endwhile;
               echo '</div></div>';

            header('refresh:2,url=control.php?sayfa=bakimayar');
         else:
            $bakim = $this -> prepare("SELECT * FROM ayarlar");
            $bakim -> execute();
            $bak = $bakim -> fetch(PDO::FETCH_ASSOC);

            echo '
                  <div class="col-lg-4 mx-auto mt-3">
                     <div class="card card-bordered">
                        <div class="card-body">
                           <h5 class="title border-bottom pb-4">Veritabani Bakim Formu</h5>
                        </div>
                        <div class="card-body pt-0">
                        <div class="alert alert-success">'.$bak['bakim'].'</div>
                           <form action="" method="POST">
                              <button type="submit" name="submit" value="submit" class="btn btn-dark mt-4">BAKIMI BASLAT</button>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            '; 
         endif;
      }
   // yedek controls
      public function yedekayar()
      {
         echo "<div class='row'>";
 
         if($_POST): 
            $this->yedekle();
         else:
            $bakim = $this -> prepare("SELECT yedek FROM ayarlar");
            $bakim -> execute();
            $bak = $bakim -> fetch(PDO::FETCH_ASSOC);

            echo '<div class="col-lg-4 mx-auto mt-3">
                  <div class="card card-bordered">
                     <div class="card-body">
                        <h5 class="title border-bottom pb-4">Veritabani Yedekleme Formu</h5>
                     </div>
                     <div class="card-body pt-0">
                     <div class="alert alert-success">'.$bak['yedek'].'</div>
                        <form method="POST">
                           <input type="submit" name="button" value="YEDEK AL" class="btn btn-dark mt-4" />
                        </form>
                     </div>
                  </div>
               </div>
            </div>'; 
         endif;
      }
      public function yedekle()
      {
         $tables = [];
         $result = $this -> prepare("SHOW TABLES");
         $result -> execute();

         while($table = $result->fetch(PDO::FETCH_ASSOC)):
            $tables[] = $table['Tables_in_kurumsal'];
         endwhile;

         $return = "SET NAMES utf8;";

         foreach($tables as $table):
            $veriler = $this -> prepare("SELECT * FROM $table");
            $veriler -> execute();
            $num = $veriler -> columnCount();

            $return .= "DROP TABLE IF EXISTS $table;";

            $creates = $this -> prepare("SHOW CREATE TABLE $table");
            $creates -> execute();
            $create = $creates -> fetch(PDO::FETCH_ASSOC);

            $return .= "\n\n".$create["Create Table"].";\n\n";

            for ($i = 0; $i < $num; $i++): 
               while($row = $veriler -> fetch(PDO::FETCH_NUM)):
                  $return .= "INSERT INTO $table VALUES(";
                     for($ii = 0; $ii < $num; $ii++):
                        if(isset($row[$ii])): $return .= '"'.$row[$ii].'"'; else: $return .= '""'; endif; 
                        if($ii < ($num -1)): $return .=  ','; endif;
                     endfor;
                  $return .= ");\n";
               endwhile;
            endfor;
            $return .= "\n\n\n";
         endforeach;

         $creatfolder = fopen('assets/dbyedek/yedek-'.date('d.m.Y').'.sql','w+');
         fwrite($creatfolder, $return);
         fclose($creatfolder);

         $date = date("d-m-Y H:i:s");
         $yedek = $this -> prepare("UPDATE ayarlar SET yedek='$date'");
         $yedek -> execute();

         echo "<div class='col-md-12 alert alert-success border border-warning mt-4 font-14'>
            <b>Tebrikler!</b> Kayitlar Duzgun..
         </div>";
         header('refresh:2,url=control.php?sayfa=yedekayar');
      }
   // linkler controls
      public function linkayar()
      {
         $linkler = $this -> prepare("SELECT * FROM linkler");
         $linkler -> execute();

         echo "
            <div class='row'>
               <div class='col-lg-12 border-bottom border-light'>
                  <h4 class='float-left m-2 text-dark d-flex align-items-center'>
                     <a href='control.php?sayfa=linkekle' class='ti-plus bg-dark p-1 text-white mr-2' style='font-size:15px'></a>
                     LINKLER AYARLARI
                  </h4>
               </div>
         ";
         
         while($link = $linkler -> fetch(PDO::FETCH_ASSOC))
         { 
            echo "
               <div class='col-lg-6'>
                  <div class='row border border-light m-1 mt-3'>
                     <div class='card-header col-lg-12 d-flex justify-content-between align-items-center border-bottom'>
                        <h5 class='badge badge-dark font-14'>Orders: {$link['orders']}</h5>
                        <h6 class=''>{$link['name_tr']}</h6>
                        <h6 class=''>{$link['name_en']}</h6>
                        <h6 class=''>{$link['name_pl']}</h6>
                     </div>

                     <div class='col-lg-12 d-flex justify-content-around text-right p-3'>
                        <a href='control.php?sayfa=linkguncelle&id=".$link['id']."' class='ti-reload m-2 text-success' style='font-size:25px'></a>
                        <a href='control.php?sayfa=linksil&id=".$link['id']."' class='ti-trash m-2 text-danger' style='font-size:25px'></a>
                     </div>   
                  </div>
               </div>
            ";
         }
         echo "</div>";
      }
      public function linkekle()
      {
         $maxs = $this -> prepare("SELECT MAX(orders) + 1 FROM linkler");
         $maxs -> execute();
         $max = $maxs -> fetchColumn();

         if(!$_POST):
            echo "
               <div class='row text-right'>
                  <div class='col-lg-12 border-bottom border-light'>
                     <h3 class='float-left m-2 text-dark'>LINK EKLE</h3>
                  </div>
               </div>
               <div class='row'>
                  <div class='col-lg-6 mx-auto'>
                  <form action='' method='POST'>
                     <div class='row border border-light p-1 m-1 mt-3'>
                           <div class='col-lg-12 p-3 text-left border-bottom border-light'>
                              <div class='form-group'>
                                 <label id='texts'>LINK TR</label>
                                 <input type='text' name='name_tr' value='' id='texts' class='form-control' />
                              </div>
                              <div class='form-group'>
                                 <label id='texts'>LINK EN</label>
                                 <input type='text' name='name_en' value='' id='texts' class='form-control' />
                              </div>
                              <div class='form-group'>
                                 <label id='texts'>LINK PL</label>
                                 <input type='text' name='name_pl' value='' id='texts' class='form-control' />
                              </div>
                              <div class='form-group'>
                                 <label id='texts'>TAGS</label>
                                 <input type='text' name='tag' value='' id='texts' class='form-control' />
                              </div>
                              <div class='form-group'>
                                 <label for='select'>ORDERS</label>
                                 <select name='orders' id='select' class='custom-select'>
                                    <option value='".$max."'>".$max."</option>
                                 </select>
                              </div>
                           </div>

                           <div class='col-lg-12 p-3 text-center'>
                              <button type='submit' name='submit' value='submit' class='btn btn-dark'>EKLE</button>
                           </div> 
                        </form> 
                     </div>
                  </div>
               </div>";
         else:
            $name_tr = htmlspecialchars($_POST['name_tr']);
            $name_en = htmlspecialchars($_POST['name_en']);
            $name_pl = htmlspecialchars($_POST['name_pl']);
            $tag = htmlspecialchars($_POST['tag']);
            $orders = htmlspecialchars($_POST['orders']);

            if(empty($name_tr) || empty($name_en) || empty($name_pl) || empty($tag) || empty($orders)):
               echo "
                  <div class='container'>
                     <div class='col-md-8 offset-md-2 alert alert-danger border border-warning mt-4 font-14'>
                           <b>Lutfen!</b> Tum Alanlari Doldurunuz..
                     </div>
                  </div>
               ";
                  header('refresh:2,url=control.php?sayfa=linkekle');
            else:
               $linkler = $this -> prepare("INSERT INTO linkler (name_tr,name_en,name_pl,tag,orders) VALUES ('$name_tr','$name_en','$name_pl','$tag','$orders')");
               $linkler -> execute();
               
               ?><script>
                  BilgiPenceresi("control.php?sayfa=linkayar","BAŞARILI","Guncelleme işlemi başarılı","success");
               </script><?php
            endif;
         endif;
      }
      public function linkguncelle()
      {
         $id = $_GET['id'];

         $linkler = $this -> prepare("SELECT * FROM linkler WHERE id='$id'");
         $linkler -> execute();
         $link = $linkler -> fetch(PDO::FETCH_ASSOC);

         $orders = $this -> prepare("SELECT * FROM linkler");
         $orders -> execute();

         if(!$_POST):
            echo "
               <div class='row text-right'>
                  <div class='col-lg-12 border-bottom border-light'>
                     <h3 class='float-left m-2 text-dark'>LINK GUNCELLE</h3>
                  </div>
               </div>
               <div class='row'>
                  <div class='col-lg-6 mx-auto'>
                  <form action='' method='POST'>
                     <div class='row border border-light p-1 m-1 mt-3'>
                           <div class='col-lg-12 p-3 text-left border-bottom border-light'>
                              <div class='form-group'>
                                 <label id='texts'>LINK TR</label>
                                 <input type='text' name='name_tr' value='{$link['name_tr']}' id='texts' class='form-control' />
                              </div>
                              <div class='form-group'>
                                 <label id='texts'>LINK EN</label>
                                 <input type='text' name='name_en' value='{$link['name_en']}' id='texts' class='form-control' />
                              </div>
                              <div class='form-group'>
                                 <label id='texts'>LINK PL</label>
                                 <input type='text' name='name_pl' value='{$link['name_pl']}' id='texts' class='form-control' />
                              </div>
                              <div class='form-group'>
                                 <label id='texts'>TAGS</label>
                                 <input type='text' name='tag' value='{$link['tag']}' id='texts' class='form-control' />
                              </div>
                              <div class='form-group'>
                                 <label for='select'>ORDERS {$link['orders']}</label>
                                 <select name='neworders' id='select' class='custom-select'>";
                                 while($or = $orders -> fetch(PDO::FETCH_ASSOC)):
                                    if($or['orders'] != $link['orders']):
                                       echo "<option value='".$or["orders"]."'>{$or["orders"]} - {$or["name_tr"]}</option>";
                                    endif;
                                 endwhile;  
                                echo "</select>
                              </div>
                           </div>

                           <div class='col-lg-12 p-3 text-center'>
                              <input type='hidden' name='hidden' value='{$id}' />
                              <input type='hidden' name='oldorders' value='{$link['orders']}' />
                              <button type='submit' name='submit' value='submit' class='btn btn-dark'>GUNCELLE</button>
                           </div> 
                        </form> 
                     </div>
                  </div>
               </div>";
         else:
            $hidden = htmlspecialchars($_POST['hidden']);
            $name_tr = htmlspecialchars($_POST['name_tr']);
            $name_en = htmlspecialchars($_POST['name_en']);
            $name_pl = htmlspecialchars($_POST['name_pl']);
            $tag = htmlspecialchars($_POST['tag']);

            $neworders = htmlspecialchars($_POST['neworders']);
            $oldorders = htmlspecialchars($_POST['oldorders']);

           /*  echo $neworders, '<br>';

            echo $oldorders; */

            if(empty($name_tr) || empty($name_en) || empty($name_pl) || empty($tag) || empty($neworders)):
               echo "
                  <div class='container'>
                     <div class='col-md-8 offset-md-2 alert alert-danger border border-warning mt-4 font-14'>
                           <b>Lutfen!</b> Tum Alanlari Doldurunuz..
                     </div>
                  </div>
               ";
                  header('refresh:2,url=control.php?sayfa=linkekle');
            else:
               $linkler2 = $this -> prepare("UPDATE linkler SET orders='$oldorders' WHERE orders='$neworders'");
               $linkler2 -> execute();

               $linkler3 = $this -> prepare("UPDATE linkler SET name_tr='$name_tr',name_en='$name_en',name_pl='$name_pl',tag='$tag',orders='$neworders' WHERE id='$hidden'");
               $linkler3 -> execute();
               
               ?><script>
                  BilgiPenceresi("control.php?sayfa=linkayar","BAŞARILI","Guncelleme işlemi başarılı","success");
               </script><?php
            endif;
         endif;
      }
      public function linksil()
      {
         $remove = $this -> prepare("DELETE FROM linkler WHERE id='".$_GET['id']."'");
         $remove -> execute();

         echo "
            <div class='container'>
               <div class='col-md-8 offset-md-2 alert alert-info border border-warning mt-4 font-14'>
                  <b>Tebrikler!</b> Link Silindi..
               </div>
            </div>
         ";

         header("refresh:2, url=control.php?sayfa=linkayar");
      }
   // bulten conrols
      public function satirsayisi()
      {
         $bulten = $this -> prepare("SELECT mail FROM bulten");
         $bulten -> execute();
         $bull = $bulten -> rowCount();

         if($bull < 10):
            return "000{$bull}";
         elseif($bull < 100):
            return "00{$bull}";
         elseif($bull < 1000):
            return "0{$bull}";
         else:
            return $bull;
         endif;
      }
      public function mailara()
      {
         $mail = $_POST['mail'];

         if(empty($mail)):
            echo "<div class='col-md-12 alert alert-warning border border-success mt-4 font-14'>
                  <p><b>Lutfen!</b> Bir Sozcuk Girin..</p>
            </div>";

            header('refresh:2,url=control.php?sayfa=bultenayar');
         else:
            $bulten = $this -> prepare("SELECT * FROM bulten WHERE mail LIKE '%$mail%'");
            $bulten -> execute();

            while($bull = $bulten -> fetch(PDO::FETCH_ASSOC)):
               echo "<div class='col-md-3'>
                  <div class='row border p-2'>
                     <div class='col-md-7'>{$bull['mail']}</div>
                     <div class='col-md-5'>
                        <a href='control.php?sayfa=bultenayar&process=mailguncelle&id=".$bull['id']."' class='ti-reload m-2 text-success' style='font-size:20px'></a>
                        <a href='control.php?sayfa=bultenayar&process=mailsil&id=".$bull['id']."' class='ti-trash m-2 text-danger' style='font-size:20px'></a>
                     </div>
                  </div>
               </div>";
            endwhile;
         endif;
      }
      public function mailguncelle()
      {
         if($_POST):
            $hidden = htmlspecialchars(strip_tags($_POST['hidden']));
            $mail = htmlspecialchars(strip_tags($_POST['mail']));

            if(empty($mail)):
               echo "<div class='col-md-12 alert alert-warning border border-success mt-4 font-14'>
                     <p><b>Lutfen!</b> Tum Alanlari Doldurunuz..</p>
               </div>";
               header('refresh:2,url=control.php?sayfa=bultenayar');
            else:
               $bultenler = $this -> prepare("UPDATE bulten SET mail='{$mail}' WHERE id='$hidden'");
               $bultenler -> execute();

               ?><script>
                  BilgiPenceresi("control.php?sayfa=bultenayar","BAŞARILI","Guncelleme işlemi başarılı","success");
               </script><?php
            endif;
         else:
            $id = $_GET['id'];

            $bultenler = $this -> prepare("SELECT * FROM bulten WHERE id='$id'");
            $bultenler -> execute();
            $bulten = $bultenler -> fetch(PDO::FETCH_ASSOC);

            echo '<div class="col-lg-5 mx-auto mt-2 mb-2">
                  <div class="card card-bordered">
                     <div class="card-body text-left">
                        <form method="POST">
                           <div class="form-group">
                              <label for="mail">MAIL</label>
                              <input name="mail" value="'.$bulten['mail'].'" type="text" class="form-control" id="mail" />
                           </div>

                           <input type="hidden" name="hidden" value="'.$id.'" />
                           <button type="submit" name="submit" value="submit" class="btn btn-dark mt-4">GUNCELLE</button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>'; 
         endif;
      }
      public function mailsil()
      {
         $remove = $this -> prepare("DELETE FROM bulten WHERE id='{$_GET['id']}'");
         $remove -> execute();

         echo "<div class='col-md-12 alert alert-success border border-warning mt-4 font-14'>
                  <b>Tebrikler!</b> Mail Silindi..
         </div>";
         header('refresh:2,url=control.php?sayfa=bultenayar');
      }
      public function bakim()
      {
         $bulten = $this -> prepare("SELECT MAX(id) AS id, mail FROM bulten GROUP BY mail HAVING COUNT(*) > 1");
         $bulten -> execute();
         $num = $bulten -> rowCount();

         if($num > 0):
            $arr = [];

            while($bull = $bulten -> fetch(PDO::FETCH_ASSOC)):
               $arr[] = $bull['id'];
            endwhile;
            $bulten2 = $this -> prepare("DELETE FROM bulten WHERE id IN(".implode(',',$arr).")");
            $bulten2 -> execute();
            
            echo "<div class='col-md-12 alert alert-success border border-warning mt-4 font-14'>
                  <b>Silinen Kayit:</b> ".$num." <br> Benzer Mailler Silindi..
            </div>";
            header('refresh:2,url=control.php?sayfa=bultenayar');
         else:
            echo "<div class='col-md-12 alert alert-warning border border-danger mt-4 font-14'>
               <b>Tebrikler!</b> Kayitlar Duzgun..
            </div>";
            header('refresh:2,url=control.php?sayfa=bultenayar');
         endif;
      }
      public function bultenayar()
      {
         echo "
            <div class='row text-right'>
               <div class='col-lg-12 border-bottom border-light'>
                  <h3 class='float-left m-2 text-dark'>BULTEN AYARLARI</h3>
               </div>
            </div>
            <div class='row'>
               <div class='col-lg-12'>
                  <div class='row border border-light p-1 m-1 mt-3 mb-3'>
                     <div class='col-lg-4 p-3 text-left'>
                        <form action='control.php?sayfa=bultenayar&process=mailara' method='POST'>
                           <div class='form-group'>
                              <label for='mail'>MAIL ADRESI ARA</label>
                              <input type='text' name='mail' value='' class='form-control' id='mail' />
                           </div>
                           <input type='submit' name='btnones' value='MAIL ARA' class='btn btn-dark' />
                        </form>
                     </div>

                     <div class='col-lg-3 text-left mt-3'>
                        <label class='d-block'>MAIL ADERSLERINI INDIR</label>
                        <form action='prints.php' method='POST'>
                           <div class='d-flex justify-content-between mb-3 mt-3'>
                              <div class='form-check form-check-inline'>
                                 <input type='radio' name='tercih' value='exel' class='form-check-input' id='one'>
                                 <label class='form-check-label' for='one'>EXEL DOSYASI</label>
                              </div>
                              <div class='form-check form-check-inline'>
                                 <input checked type='radio' name='tercih' value='txt' class='form-check-input' id='two'>
                                 <label class='form-check-label' for='two'>TXT DOSYASI</label>
                              </div>
                           </div>
                           <input type='submit' name='btntwos' value='DOSYA INDIR' class='btn btn-dark mt-3' />
                        </form>
                     </div>

                     <div class='col-lg-2 mt-3 text-left'>
                        <label class='d-block'>TOPLAM KAYITLI MAIL</label>
                        <h5 class='mt-3'>".($this->satirsayisi($this))."</h5>
                     </div>

                     <div class='col-lg-3 text-left mt-3'>
                        <label class='d-block'>BAKIM</label>
                           <h5 class='mt-3'>10-09-2019 10:30:33</h5>
                        <form action='control.php?sayfa=bultenayar&process=bakim' method='POST'>
                           <input type='submit' name='btnthrees' value='BAKIM YAP' class='btn btn-dark mt-4' />
                        </form>
                     </div>

                  </div>
               </div>
            </div>";
         
         $process = isset($_GET['process']) ? $_GET['process'] : null;

         echo "<div class='col-md-12'>
             <div class='row bg-light p-2 border mt-1'>";

         switch($process):
            case'mailara': $this->mailara(); break;
            case'mailguncelle': $this->mailguncelle(); break;
            case'mailsil': $this->mailsil(); break;
            case'bakim': $this->bakim(); break;
         endswitch;

         echo "</div></div>";
         
      }
   // login controls
      public function cookieSifre($veri)
      {
         return base64_encode(gzdeflate(gzcompress(serialize($veri))));
      } 
      public function cookieCoz($veri)
      {
         return unserialize(gzuncompress(gzinflate(base64_decode($veri))));
      }
      public function kuladial()
      {
         $cookie = $this -> cookieCoz($_COOKIE['userinfo']);

         $yonetim = $this -> prepare("SELECT * FROM yonetim WHERE id='$cookie'");
         $yonetim -> execute();
         $yonet = $yonetim -> fetch(PDO::FETCH_ASSOC);

         return $yonet['name'];
      } 
      public function giriskontrol($kulad,$sifre)
      {
         $pass = md5(sha1(md5($sifre)));

         $yonetim = $this -> prepare("SELECT * FROM yonetim WHERE name='$kulad' AND password='$pass'");
         $yonetim -> execute();

         $num = $yonetim -> rowCount();

         if($num === 0):
            echo "<div class='container'>
               <div class='col-md-8 offset-md-2 d-flex justify-content-center align-items-center alert alert-warning border border-dark mt-4 text-dark font-14'>
                  <div class='d-inline-block mr-2' style='width:25px;height:25px;background:url(assets/images/loading.gif) center/100px no-repeat;'></div>
                  <p><b>Basarisiz!</b> Sifre Veya Kullanici Adi Hatali..</p>
               </div>
            </div>";
            header('refresh:2, url=index.php');
         else:
            $yonet = $yonetim -> fetch(PDO::FETCH_NUM);

            $yonetim = $this -> prepare("UPDATE yonetim SET active=1 WHERE id='{$yonet[0]}'");
            $yonetim -> execute();
            
            setcookie('userinfo', $this->cookieSifre($yonet[0]), strtotime('+1 day'));

            echo "<div class='container'>
               <div class='col-md-8 offset-md-2 d-flex justify-content-center align-items-center alert alert-success border border-dark mt-4 text-dark font-14'>
                  <div class='d-inline-block mr-2' style='width:25px;height:25px;background:url(assets/images/loading.gif) center/100px no-repeat;'></div>
                  <p><b>Tebrikler!</b> Giris..</p>
               </div>
            </div>";
            header('refresh:2, url=control.php');
         endif;
      }
      public function cikis()
      {
         $cookie = $this -> cookieCoz($_COOKIE['userinfo']);

         $update = $this -> prepare("UPDATE yonetim SET active=0 WHERE id='$cookie'");
         $update -> execute();

         setcookie('userinfo', '', strtotime('-1 day')); 

         echo "<div class='container'>
            <div class='col-md-8 offset-md-2 d-flex justify-content-center align-items-center alert alert-success border border-dark mt-4 text-dark font-14'>
               <div class='d-inline-block mr-2' style='width:25px;height:25px;background:url(assets/images/loading.gif) center/100px no-repeat;'></div>
               <p><b>Tebrikler!</b> Cikiliyo..</p>
            </div>
         </div>";
         header('refresh:2, url=index.php');
      }
      public function kontrolet($sayfa)
      {
         if(isset($_COOKIE['userinfo'])):
            if($sayfa == 'index'): header('Location:control.php'); endif;
         else:
            if($sayfa == 'control'): header('Location:index.php'); endif;
         endif;
      }
   

   }
?>

