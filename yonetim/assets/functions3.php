<?php

   class Yonetim3 extends Yonetim
   {
      public function __construct()
      {
         parent::__construct();
      }
   // mail 
      private $veriler = [];
   // comment controls
      public function yorumayar()
      {
         $yorumlar = $this -> prepare("SELECT * FROM yorumlar");
         $yorumlar -> execute();

         echo "<div class='row'>
            <div class='col-lg-12 border-bottom border-light'>
               <h4 class='float-left m-2 text-dark d-flex align-items-center'>
                  <a href='control.php?sayfa=yorumekle' class='ti-plus bg-dark p-1 text-white mr-2' style='font-size:15px'></a>
                  YORUMLAR AYAR
               </h4>
            </div>";
         
         while($yorum = $yorumlar -> fetch(PDO::FETCH_ASSOC)):
            echo "<div class='col-lg-4'>
               <div class='row border border-light p-1 m-1 mt-3'>
                  <div class='col-lg-12 text-center p-2  border-bottom border-light'>
                     <h3 class=''>".$yorum['name']."</h3>
                  </div>

                  <div class='col-lg-12 text-center p-2  border-bottom border-light'>
                     <p class=''>".$yorum['content']."</p>
                  </div>

                  <div class='col-lg-12 p-2 d-flex justify-content-around text-right'>
                     <a href='control.php?sayfa=yorumguncelle&id=".$yorum['id']."' class='ti-reload m-2 text-success' style='font-size:25px'></a>
                     <a href='control.php?sayfa=yorumsil&id=".$yorum['id']."' class='ti-trash m-2 text-danger' style='font-size:25px'></a>
                  </div>   
               </div>
            </div>";
         endwhile;
         echo "</div>";
      }
      public function yorumekle()
      {
         if(!$_POST):
            echo "<div class='row text-right'>
               <div class='col-lg-12 border-bottom'>
                  <h3 class='float-left m-2 text-dark'>YORUM EKLE</h3>
               </div>
            </div>
            <div class='row'>
               <div class='col-lg-6 mx-auto'>
               <form action='' method='POST'>
                  <div class='row border border-light p-1 m-1 mt-3'>
                     <div class='col-lg-12 p-3 text-left border-bottom border-light'>
                        <div class='form-group'>
                           <label for='texts'>NAME</label>
                           <input type='text' name='name' value='' id='texts' class='form-control' />
                        </div>
                     </div>   

                     <div class='col-lg-12 p-3 text-left border-bottom border-light'>
                        <div class='form-group'>
                           <label for='textareas'>CONTENT</label>
                           <textarea name='content' id='textareas' class='form-control' rows='7'></textarea>
                        </div>";?>
                           <script> ClassicEditor.create(document.querySelector( '#textareas')).catch( error =>{console.error( error )}); </script>
                     <?php "</div> 

                     <div class='col-lg-12 p-3 text-center'>
                        <button type='submit' name='submit' value='submit' class='btn btn-info'>GUNCELLE</button>
                     </div> 
                  </form> 
                  </div>
               </div>
            </div>";
         else:
            $name = htmlspecialchars($_POST['name']);
            $content = htmlspecialchars($_POST['content']);

            if(empty($name) || empty($content)):
               echo "<div class='container'>
                  <div class='col-md-8 offset-md-2 alert alert-danger border border-info mt-4 font-14'>
                        <b>Lutfen!</b> Tum Alanlari Doldurunuz..
                  </div>
               </div>";
               header('refresh:2,url=control.php?sayfa=yorumekle');
            else:
               $yorumlar = $this -> prepare("INSERT INTO yorumlar (name,content) VALUES ('".$name."','".$content."')");
               $yorumlar -> execute();
               
               echo "<div class='container'>
                  <div class='col-md-8 offset-md-2 alert alert-success border border-warning mt-4 font-14'>
                        <b>Tebrikler!</b> Yorum Eklendi..
                  </div>
               </div>";
               header('refresh:2,url=control.php?sayfa=yorumayar');
            endif;
         endif;
      }
      public function yorumguncelle()
      {
         $id = $_GET['id'];

         $yorumlar = $this -> prepare("SELECT * FROM yorumlar WHERE id='".$id."'");
         $yorumlar -> execute();
         $yorum = $yorumlar -> fetch(PDO::FETCH_ASSOC);

         if(!$_POST):
            echo "
               <div class='row text-right'>
                  <div class='col-lg-12 border-bottom'>
                     <h3 class='float-left mt-3 text-info'>HIZMET GUNCELLE</h3>
                  </div>
               </div>
               <div class='row'>
                  <div class='col-lg-6 mx-auto'>
                     <form action='' method='POST'>
                        <div class='row border border-light p-1 m-1 mt-3'>
                           <div class='col-lg-12 p-3 text-left border-bottom border-light'>
                              <div class='form-group'>
                                 <label for='texts'>BASLIK</label>
                                 <input type='text' name='name' value='".$yorum['name']."' id='texts' class='form-control' />
                              </div>
                           </div>   

                           <div class='col-lg-12 p-3 text-left border-bottom border-light'>
                              <div class='form-group'>
                                 <label for='textareas'>CONTENT</label>
                                 <textarea name='content' id='textareas' class='form-control' rows='7'>".$yorum['content']."</textarea>
                              </div>";?>
                                 <script> ClassicEditor.create(document.querySelector( '#textareas')).catch( error =>{console.error( error )}); </script>
                           <?php echo "</div> 

                           <div class='col-lg-12 p-3 text-center'>
                              <input type='hidden' name='hidden' value='".$id."' />
                              <button type='submit' name='submit' value='submit' class='btn btn-info'>GUNCELLE</button>
                           </div> 
                        </div>
                     </form> 
                  </div>
               </div>";
         else:
            $hidden = htmlspecialchars($_POST['hidden']);
            $name = htmlspecialchars($_POST['name']);
            $content = htmlspecialchars($_POST['content']);

            if(empty($name) || empty($content)):
               echo "
                  <div class='container'>
                     <div class='col-md-8 offset-md-2 alert alert-danger border border-info mt-4 font-14'>
                           <b>Lutfen!</b> Tum Alanlari Doldurunuz..
                     </div>
                  </div>";
                  header('refresh:2,url=control.php?sayfa=yorumayar');
            else:
               $yorumlar = $this -> prepare("UPDATE yorumlar SET name='".$name."',content='".$content."' WHERE id='".$hidden."'");
               $yorumlar -> execute();
               
               echo "
                  <div class='container'>
                     <div class='col-md-8 offset-md-2 alert alert-success border border-warning mt-4 font-14'>
                           <b>Tebrikler!</b> Yorum Guncellendi..
                     </div>
                  </div>
               ";
                  header('refresh:2,url=control.php?sayfa=yorumayar');
            endif;
         endif;
      }
      public function yorumsil()
      {
         $remove = $this -> prepare("DELETE FROM yorumlar WHERE id='".$_GET['id']."'");
         $remove -> execute();

         echo "
               <div class='container'>
                  <div class='col-md-8 offset-md-2 alert alert-success border border-warning mt-4 font-14'>
                        <b>Tebrikler!</b> Dosya Silindi..
                  </div>
               </div>";

         header("refresh:2, url=control.php?sayfa=yorumayar");
      }
   // customres messages
      private function mailgetir($veriler)
      {
         $gelenmail = $this -> prepare("SELECT * FROM ".$veriler[0]." WHERE statu='".$veriler[1]."'");
         $gelenmail -> execute();
         return $gelenmail;
      }
      public function gelenmail()
      {
         echo '<div class="row">
            <div class="col-lg-12 mt-2">
               <div class="card">
                  <div class="card-body">

                     <ul class="nav nav-tabs" id="myTab" role="tablist"> 
                        <li class="nav-item">
                           <a href="#gelen" id="gelen-tab" class="nav-link active d-flex align-items-center" aria-control="gelen" aria_selected="true" data-toggle="tab" role="tab">
                              <div class="badge badge-danger mr-2 font-14">'.$this -> mailgetir(['gelenmail',0]) -> rowCount().'</div>
                              Gelen Mesajlar
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#okunmus" id="okunmus-tab" class="nav-link d-flex align-items-center" aria-control="okunmus" aria_selected="true" data-toggle="tab" role="tab">
                              <div class="badge badge-danger mr-2 font-14">'.$this -> mailgetir(['gelenmail',1]) -> rowCount().'</div>
                              Okunmus Mesajlar
                           </a>
                        </li> 
                        <li class="nav-item">
                           <a href="#arsiv" id="arsiv-tab" class="nav-link"  aria-control="arsiv" aria_selected="true" data-toggle="tab" role="tab">
                              <div class="badge badge-danger mr-2 font-14">'.$this -> mailgetir(['gelenmail',2]) -> rowCount().'</div>
                              Arsiv
                           </a>
                        </li> 
                     </ul>
                     <div class="tab-content mt-3" id="benimTab">
                        <div class="tab-pane fade show active" id="gelen" aria-labelledby="gelen-tab" role="tabpanel">';
                           $gelenmail = $this -> mailgetir(['gelenmail',0]);
                           if($gelenmail -> rowCount()  > 0):
                              while($mail = $gelenmail -> fetch(PDO::FETCH_ASSOC)):
                                 echo '
                                    <div class="row">
                                       <div class="col-lg-12 bg-light mt-2 font-weight-bold" style="border-radius:5px; border:1px solid #eeeeee">
                                          <div class="row border-bottom">
                                             <div class="col-lg-1 p-1">Ad</div>
                                             <div class="col-lg-2 p-1 text-primary">'.$mail['name'].'</div>
                                             <div class="col-lg-1 p-1">Mail Adresi</div>
                                             <div class="col-lg-2 p-1 text-primary">'.$mail['mail'].'</div>
                                             <div class="col-lg-1 p-1">Konu</div>
                                             <div class="col-lg-2 p-1 text-primary">'.$mail['subject'].'</div>
                                             <div class="col-lg-1 p-1">Tarih</div>
                                             <div class="col-lg-1 p-1 text-primary">'.$mail['data'].'</div>
                                             <div class="col-lg-1 p-1">
                                                <a href="control.php?sayfa=mesajoku&id='.$mail['id'].'"><i class="fa fa-folder-open fa-1x pr-3 text-dark"></i></a>
                                                <a href="control.php?sayfa=mesajarsivle&id='.$mail['id'].'"><i class="fa fa-share fa-1x pr-3 text-dark"></i></a>
                                                <a href="control.php?sayfa=mesajsil&id='.$mail['id'].'"><i class="fa fa-close fa-1x pr-1 text-dark"></i></a>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 ';
                              endwhile;
                           else:
                              echo "
                                 <div class='container'>
                                    <div class='col-md-10 offset-md-1 alert alert-danger border border-info mt-4 font-14'>
                                          <b>Malesef!</b> Gelen Mesaj Yok..
                                    </div>
                                 </div>
                              ";
                           endif;
                        echo '</div>

                        <div class="tab-pane fade" id="okunmus" aria-labelledby="okunmus-tab" role="tabpanel">';
                           $gelenmail = $this -> mailgetir(['gelenmail',1]);
                           if($gelenmail -> rowCount()  > 0):
                              while($mail = $gelenmail -> fetch(PDO::FETCH_ASSOC)):
                                 echo '
                                    <div class="row">
                                       <div class="col-lg-12 bg-light mt-2 font-weight-bold" style="border-radius:5px; border:1px solid #eeeeee">
                                          <div class="row border-bottom">
                                             <div class="col-lg-1 p-1">Ad</div>
                                             <div class="col-lg-2 p-1 text-primary">'.$mail['name'].'</div>
                                             <div class="col-lg-1 p-1">Mail Adresi</div>
                                             <div class="col-lg-2 p-1 text-primary">'.$mail['mail'].'</div>
                                             <div class="col-lg-1 p-1">Konu</div>
                                             <div class="col-lg-2 p-1 text-primary">'.$mail['subject'].'</div>
                                             <div class="col-lg-1 p-1">Tarih</div>
                                             <div class="col-lg-1 p-1 text-primary">'.$mail['data'].'</div>
                                             <div class="col-lg-1 p-1">
                                                <a href="control.php?sayfa=mesajoku&id='.$mail['id'].'"><i class="fa fa-folder-open fa-1x pr-3 text-dark"></i></a>
                                                <a href="control.php?sayfa=mesajarsivle&id='.$mail['id'].'"><i class="fa fa-share fa-1x pr-3 text-dark"></i></a>
                                                <a href="control.php?sayfa=mesajsil&id='.$mail['id'].'"><i class="fa fa-close fa-1x pr-1 text-dark"></i></a>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 ';
                              endwhile;
                           else:
                              echo "
                                 <div class='container'>
                                    <div class='col-md-10 offset-md-1 alert alert-danger border border-info mt-4 font-14'>
                                          <b>Malesef!</b> Okunmus Mesaj Yok..
                                    </div>
                                 </div>
                              ";
                           endif;
                        echo '</div>

                        <div class="tab-pane fade" id="arsiv" aria-labelledby="arsiv-tab" role="tabpanel">';
                           $gelenmail = $this -> mailgetir(['gelenmail',2]);
                           if($gelenmail -> rowCount()  > 0):
                              while($mail = $gelenmail -> fetch(PDO::FETCH_ASSOC)):
                                 echo '
                                    <div class="row">
                                       <div class="col-lg-12 bg-light mt-2 font-weight-bold" style="border-radius:5px; border:1px solid #eeeeee">
                                          <div class="row border-bottom">
                                             <div class="col-lg-1 p-1">Ad</div>
                                             <div class="col-lg-2 p-1 text-primary">'.$mail['name'].'</div>
                                             <div class="col-lg-1 p-1">Mail Adresi</div>
                                             <div class="col-lg-2 p-1 text-primary">'.$mail['mail'].'</div>
                                             <div class="col-lg-1 p-1">Konu</div>
                                             <div class="col-lg-2 p-1 text-primary">'.$mail['subject'].'</div>
                                             <div class="col-lg-1 p-1">Tarih</div>
                                             <div class="col-lg-1 p-1 text-primary">'.$mail['data'].'</div>
                                             <div class="col-lg-1 p-1">
                                                <a href="control.php?sayfa=mesajoku&id='.$mail['id'].'"><i class="fa fa-folder-open fa-1x pr-3 text-dark"></i></a>
                                                <a href="control.php?sayfa=mesajsil&id='.$mail['id'].'"><i class="fa fa-close fa-1x pr-1 text-dark"></i></a>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 ';
                              endwhile;
                           else:
                              echo "
                                 <div class='container'>
                                    <div class='col-md-10 offset-md-1 alert alert-danger border border-info mt-4 font-14'>
                                          <b>Malesef!</b> Arsiv Bos..
                                    </div>
                                 </div>
                              ";
                           endif;
                        echo '</div>
                     </div>

                  </div>
               </div>
            </div>
         </div>';
      }
      public function mesajoku()
      {
         $gelenmail = $this -> prepare("SELECT * FROM gelenmail WHERE id='".$_GET['id']."'");
         $gelenmail -> execute();
         $mail = $gelenmail -> fetch(PDO::FETCH_ASSOC);

         if($mail['statu'] != 2):
            $update = $this -> prepare("UPDATE gelenmail SET statu='1' WHERE id='".$_GET['id']."'");
            $update -> execute();
         endif;
            
         echo '<div class="row">
            <div class="col-lg-12 bg-light font-weight-bold" style="border-radius:5px; border:1px solid #eeeeee">
               <div class="row border-bottom">
                  <div class="col-lg-1 p-1">Ad</div>
                  <div class="col-lg-2 p-1 text-primary">'.$mail['name'].'</div>
                  <div class="col-lg-1 p-1">Mail Adresi</div>
                  <div class="col-lg-2 p-1 text-primary">'.$mail['mail'].'</div>
                  <div class="col-lg-1 p-1">Konu</div>
                  <div class="col-lg-2 p-1 text-primary">'.$mail['subject'].'</div>
                  <div class="col-lg-1 p-1">Tarih</div>
                  <div class="col-lg-1 p-1 text-primary">'.$mail['data'].'</div>
                  <div class="col-lg-1 p-1">
                     <a href="control.php?sayfa=gelenmail"><i class="fa fa-undo fa-1x pr-3 text-dark"></i></a>
                     <a href="control.php?sayfa=mesajarsivle&id='.$mail['id'].'"><i class="fa fa-share fa-1x pr-3 text-dark"></i></a>
                     <a href="control.php?sayfa=mesajsil&id='.$mail['id'].'"><i class="fa fa-close fa-1x pr-1 text-dark"></i></a>
                  </div>
               </div>
               <div class="row m-4">
                     <div class="col-lg-12">'.$mail['message'].'</div>
               </div>
            </div>
         </div>';
      }
      public function mesajarsiv()
      {
         $gelenmail = $this -> prepare("UPDATE gelenmail SET statu='2' WHERE id='".$_GET['id']."'");
         $gelenmail -> execute();

         echo '<div class="row">
            <div class="col-lg-12 bg-light font-weight-bold" style="border-radius:5px; border:1px solid #eeeeee">
               <div class="alert alert-info m-3">Mesaj Arsivlendi..</div>
            </div>
         </div>';
         header("refresh:2, url=control.php?sayfa=gelenmail");
      }
      public function mesajsil()
      {
         $gelenmail = $this -> prepare("DELETE FROM gelenmail WHERE id='".$_GET['id']."'");
         $gelenmail -> execute();

         echo '<div class="row">
            <div class="col-lg-12 bg-light font-weight-bold" style="border-radius:5px; border:1px solid #eeeeee">
               <div class="alert alert-info m-3">Mesaj Silindi..</div>
            </div>
         </div>';
         header("refresh:2, url=control.php?sayfa=gelenmail");
      }
   // user controls
      public function ayarlar()
      {
         $cookie = unserialize(gzuncompress(gzinflate(base64_decode($_COOKIE['userinfo']))));

         $yonetim = $this -> prepare("SELECT * FROM yonetim WHERE id='".$cookie."'");
         $yonetim -> execute();
         $yonet = $yonetim -> fetch(PDO::FETCH_ASSOC);
         
         if(!empty($_POST)):
            $name     = htmlspecialchars($_POST['name']);
            $password     = htmlspecialchars($_POST['password']);
            $newpassword     = htmlspecialchars($_POST['newpassword']);
            $newpasswordsecond = htmlspecialchars($_POST['newpasswordsecond']);

            if(empty($name)):
               echo "
                  <div class='container'>
                     <div class='col-md-12 alert alert-danger border border-warning mt-4 font-14'>
                        <b>Lutfen</b> Gecerli Bir Kullanici Adi Giriniz..
                     </div>
                  </div>
               ";
               header('refresh:2, url=control.php?sayfa=ayarlar');
            else:
               if(($yonet['password'] != md5(sha1(md5($password)))) || empty($password)):
                  echo "
                     <div class='container'>
                        <div class='col-md-12 alert alert-danger border border-warning mt-4 font-14'>
                           <b>Uzgunuz</b> Sifre Hatali..
                        </div>
                     </div>
                  ";
                  header('refresh:2, url=control.php?sayfa=ayarlar');
               else:
                  if(($newpassword != $newpasswordsecond) || (empty($newpassword) || empty($newpasswordsecond))):
                     echo "
                        <div class='container'>
                           <div class='col-md-12 alert alert-danger border border-warning mt-4 font-14'>
                              <b>Uzgunuz</b> Sifreler Uyumsuz..
                           </div>
                        </div>
                     ";
                     header('refresh:2, url=control.php?sayfa=ayarlar');
                  else:
                     $newpassword = md5(sha1(md5($newpasswordsecond)));
                     $update = $this -> prepare("UPDATE yonetim SET name=?,password=? WHERE id='".$cookie."'");

                     $update -> bindParam(1, $name, PDO::PARAM_STR);
                     $update -> bindParam(2, $newpassword, PDO::PARAM_STR);

                     $update -> execute();

                     echo "
                        <div class='container'>
                           <div class='col-md-12 alert alert-success border border-warning mt-4 font-14'>
                              <b>Kullanici Ayarlari</b> Basariyla Guncellendi..
                           </div>
                        </div>
                     ";
                     header('refresh:2, url=control.php?sayfa=ayarlar');
                  endif;
               endif;
            endif;
         else:
            echo '
               <form action="" method="POST">
                  <div class="row">
                     <div class="col-lg-12 border-bottom border-light p-2 text-left">
                        <h3 class="container">KULLANICI AYARLARI</h3>
                     </div>
                     <!-- title -->
                     <div class="col-lg-8 mx-auto mt-3 border">
                           <div class="row">
                              <div class="col-lg-4 border-right text-left pt-2">
                                 <span class="h4 font-weight-bold">Kullanici Adi</span>
                              </div>
                              <div class="col-lg-8 p-2">
                                 <input type="text" name="name" value="'.$yonet['name'].'" class="form-control">
                              </div>
                           </div>
                     </div>
                     <!-- meta title -->
                     <div class="col-lg-8 mx-auto border">
                           <div class="row">
                              <div class="col-lg-4 border-right text-left  pt-2">
                                 <span class="h4 font-weight-bold">Kullanici Sifresi</span>
                              </div>
                              <div class="col-lg-8 p-2">
                                 <input type="password" name="password" value="" class="form-control">
                              </div>
                           </div>
                     </div>
                     <!-- meta description -->
                     <div class="col-lg-8 mx-auto border">
                           <div class="row">
                              <div class="col-lg-4 border-right text-left  pt-2">
                                 <span class="h4 font-weight-bold">Yeni Sifre</span>
                              </div>
                              <div class="col-lg-8 p-2">
                                 <input type="password" name="newpassword" value="" class="form-control">
                              </div>
                           </div>
                     </div>
                     <!-- meta key -->
                     <div class="col-lg-8 mx-auto border">
                           <div class="row">
                              <div class="col-lg-4 border-right text-left  pt-2">
                                 <span class="h4 font-weight-bold">Yeni Sifre Tekrari</span>
                              </div>
                              <div class="col-lg-8 p-2">
                                 <input type="password" name="newpasswordsecond" value="" class="form-control">
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
      public function kullaniciayar()
      {
         $yonetim = $this -> prepare("SELECT * FROM yonetim");
         $yonetim -> execute();

         echo '
            <div class="row">
               <div class="col-lg-6 mt-5 mx-auto">
                  <div class="card">
                     <div class="card-body">
                        <h4 class="header-title">
                           <a href="control.php?sayfa=kullaniciekle" class="ti-plus bg-dark p-1 text-white mr-2 mt-3"></a>
                           KULLANICILAR
                        </h4>
                        <div class="single-table">
                           <div class="table-responsive table-hover">
                              <table class="table text-center border border-light">
                                 <thead class="text-uppercase thead-dark">
                                    <tr>
                                       <th scope="col">Ad</th>
                                       <th scope="col">Yetkilendirme</th>
                                       <th scope="col">Guncelle</th>
                                       <th scope="col">Sil</th>
                                    </tr>
                                 </thead>
                                 <tbody>';
                              while($yonet = $yonetim -> fetch(PDO::FETCH_ASSOC)):
                                 echo '
                                    <tr>
                                       <th scope="row">'.$yonet['name'].'</th>'; 
                                          switch($yonet['authority']): 
                                             case 1: echo '<th scope="col" class="bg-light">Tam Yetkili</th>'; break;
                                             case 2: echo '<th scope="col" class="bg-light">Editor Yetkili</th>'; break;
                                             case 3: echo '<th scope="col" class="bg-light">Uye Yetkili</th>'; break;
                                          endswitch;
                                       echo '<th scope="row"><a href="control.php?sayfa=kullaniciguncelle&id='.$yonet['id'].'"><i class="ti-reload text-success"></i></th>
                                       <th scope="row"><a href="control.php?sayfa=kullanicisil&id='.$yonet['id'].'"><i class="ti-trash text-danger"></i></th>
                                    </tr>
                                 ';
                              endwhile;
                                 echo '</tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         ';
      }
      public function kullaniciekle()
      {
         $yonetim = $this -> prepare("SHOW COLUMNS FROM yonetim WHERE FIELD NOT IN ('id','name','password','active','authority')");
         $yonetim -> execute();

         if(!empty($_POST)):
            $name = htmlspecialchars($_POST['name']);
            $password = htmlspecialchars($_POST['password']);
            $newpassword = htmlspecialchars($_POST['newpassword']);
            $authority = (int)htmlspecialchars($_POST['authority']);
            
            foreach($yonetim as $yonet):
                  ${$yonet[0]} = $this->checkboxcontrol(htmlspecialchars($yonet[0]));
            endforeach;
            

            if(empty($name) || empty($password) || empty($newpassword) || empty($authority)):
               echo "<div class='container'>
                  <div class='col-md-12 alert alert-danger border border-warning mt-4 font-14'>
                     <b>Lutfen</b> Tum Alanlari Doldurunuz..
                  </div>
               </div>";
               header('refresh:2, url=control.php?sayfa=kullaniciekle');
            else:
               if($password != $newpassword):
                  echo "<div class='container'>
                     <div class='col-md-12 lert alert-danger border border-warning mt-4 font-14'>
                        <b>Uzgunuz</b> Sifreler Uyusmuyor..
                     </div>
                  </div>";
                  header('refresh:2, url=control.php?sayfa=kullaniciekle');
               else:
                  $newpasswords = md5(sha1(md5($newpassword)));
                  $update = $this -> prepare("INSERT INTO yonetim 
                  (name,password,authority,ayar,siteayar,mailayar,bakim,link,istatistik,yonetimm,tasarim,intro,haber,hakkimizda,hizmet,referans,filo,yorum,video,mesaj,bulten) VALUES 
                  ('$name','$newpasswords','$authority','$ayar','$siteayar','$mailayar','$bakim','$link','$istatistik','$yonetimm','$tasarim','$intro','$haber','$hakkimizda','$hizmet','$referans','$filo','$yorum','$video','$mesaj','$bulten')");
                  $update -> execute();

                  echo "<div class='container'>
                     <div class='col-md-12 alert alert-success border border-warning mt-4 font-14'>
                        <b>Kullanici</b> Basariyla Eklendi..
                     </div>
                  </div>";
                  header('refresh:2, url=control.php?sayfa=kullaniciayar');
               endif;
            endif;
         else:
            echo '<form method="POST">
               <div class="row">
                     '.$this->navifunc('kullaniciayar','KULLANICI','KULLANICI EKLE').'
                  <!-- title -->
                  <div class="col-lg-8 mx-auto mt-3 border">
                        <div class="row">
                           <div class="col-lg-4 border-right pt-3 text-left">
                              <span class="h4 font-weight-bold">Kullanici Adi</span>
                           </div>
                           <div class="col-lg-8 p-2">
                              <input type="text" name="name" class="form-control" />
                           </div>
                        </div>
                  </div>
                  <!-- kullanici sifre -->
                  <div class="col-lg-8 mx-auto border">
                        <div class="row">
                           <div class="col-lg-4 border-right pt-3 text-left">
                              <span class="h4 font-weight-bold">Kullanici Sifresi</span>
                           </div>
                           <div class="col-lg-8 p-2">
                              <input type="password" name="password" class="form-control" />
                           </div>
                        </div>
                  </div>
                  <!-- kullanici sifre tekrar -->
                  <div class="col-lg-8 mx-auto border">
                        <div class="row">
                           <div class="col-lg-4 border-right pt-3 text-left">
                              <span class="h4 font-weight-bold">Sifre Tekrari</span>
                           </div>
                           <div class="col-lg-8 p-2">
                              <input type="password" name="newpassword" class="form-control">
                           </div>
                        </div>
                  </div>
                  <!-- YETKI -->
                  <div class="col-lg-8 mx-auto border">
                     <div class="row">
                           <div class="col-lg-4 border-right pt-3 text-left">
                              <span class="h4 font-weight-bold">Yonetim Yetki</span>
                           </div>
                           <div class="col-lg-8 p-2">
                              <select name="authority" id="select" class="custom-select">
                                 <option value="1">1- YONETICI</option>
                                 <option value="2">2- EDITOR</option>
                                 <option value="3">3- KULLANICI</option>
                              </select>
                           </div>
                        </div>
                  </div>
                  <!-- YETKI -->
                  <div class="col-lg-8 mx-auto border">
                     <div class="row">
                           <div class="col-md-12 border-right pt-3 text-left">
                              <span class="h4 font-weight-bold">Yetki Alanlari</span>
                           </div>
                           <div class="col-md-12 p-3 text-left">
                              <div class="row">';
                              
                              foreach($yonetim as $yonet):
                                 $num = 0;
                                 if($num < 4):
                                    echo '
                                       <div class="col-md-3 pl-5 h6">
                                          <div class="form-check form-check-inline">
                                             <input type="checkbox" name="'.$yonet[0].'" id="'.$yonet[0].'" value="1" class="form-check-input" />
                                             <label class="form-check-label" for="'.$yonet[0].'">'.$yonet[0].'</label>
                                          </div>
                                       </div>';
                                    $num++;
                                 else:
                                    echo '</div><div class="row">';
                                 endif;
                              endforeach;
                        echo '</div></div></div>
                  </div>
                  <!-- botton -->
                  <div class="col-lg-8 mx-auto m-2">
                        <input type="submit" name="button" value="GUNCELLE" class="btn btn-dark m-2">
                  </div>
               </div>
            </form>';
         endif;
      }
      public function kullaniciguncelle()
      {
         $id = $_GET['id'];

         $yonetim = $this -> prepare("SHOW COLUMNS FROM yonetim WHERE FIELD NOT IN ('id','name','password','active','authority')");
         $yonetim -> execute();

         $yonetim2 = $this -> prepare("SELECT * FROM yonetim WHERE id='$id'");
         $yonetim2 -> execute();
         $yonet2 = $yonetim2 -> fetch(PDO::FETCH_ASSOC);

         echo '<form id="formkullaniciguncelle" method="POST">
            <div class="row">
                  '.$this->navifunc('kullaniciayar','KULLANICI','KULLANICI GUNCELLE').'
               <!-- title -->
               <div class="col-lg-8 mx-auto mt-3 border">
                     <div class="row">
                        <div class="col-lg-4 border-right pt-3 text-left">
                           <span class="h4 font-weight-bold">Kullanici Adi</span>
                        </div>
                        <div class="col-lg-8 p-2">
                           <input type="text" name="name" value="'.$yonet2['name'].'" id="name" class="form-control" />
                        </div>
                     </div>
               </div>
               <!-- YETKI -->
               <div class="col-lg-8 mx-auto border">
                  <div class="row">
                        <div class="col-lg-4 border-right pt-3 text-left">
                           <span class="h4 font-weight-bold">Yonetim Yetki</span>
                        </div>
                        <div class="col-lg-8 p-2">
                           <select name="authority" id="select" class="custom-select">';
                           $authorities = [1 => 'YONETICI', 2 => 'EDITOR', 3 => 'KULLANICI'];
                           
                           foreach($authorities as $key => $aut):
                              if($yonet2['authority'] == $key):
                                 echo '<option selected value="'.$key.'">'.$key.' - '.$aut.'</option>';
                              else:
                                 echo '<option value="'.$key.'">'.$key.' - '.$aut.'</option>';
                              endif;
                           endforeach;
                           echo '</select>
                        </div>
                     </div>
               </div>
               <!-- YETKI -->
               <div class="col-lg-8 mx-auto border">
                  <div class="row">
                        <div class="col-md-12 border-right pt-3 text-left">
                           <span class="h4 font-weight-bold">Yetki Alanlari</span>
                        </div>
                        <div class="col-md-12 p-3 text-left">
                           <div class="row">';
                           
                           foreach($yonetim as $yonet):
                              $num = 0;
                              if($num < 4):
                                 $yetki = $this -> query("SELECT ".$yonet[0]." FROM yonetim WHERE id ='$id'");
                                 $yetki = $yetki-> fetch();

                                 echo '<div class="col-md-3 pl-5 h6"><div class="form-check form-check-inline">';
                                 if($yetki[$yonet[0]] == 1):
                                       echo '<input checked type="checkbox" name="'.$yonet[0].'" id="'.$yonet[0].'" value="1" class="form-check-input" />
                                       <label class="form-check-label" for="'.$yonet[0].'">'.$yonet[0].'</label>';
                                 else:
                                       echo '<input type="checkbox" name="'.$yonet[0].'" id="'.$yonet[0].'" value="1" class="form-check-input" />
                                       <label class="form-check-label" for="'.$yonet[0].'">'.$yonet[0].'</label>';
                                 endif;
                                 echo '</div></div>';
                                 $num++;
                              else:
                                 echo '</div><div class="row">';
                              endif;
                           endforeach;
                     echo '</div></div></div>
               </div>
               <!-- botton -->
               <div class="col-lg-8 mx-auto m-2">
                     <input type="hidden" name="hidden" value="'.$id.'" />
                     <input type="submit" name="button" value="GUNCELLE" id="btnkullaniciguncelle" class="btn btn-dark m-2">
               </div>
            </div>
         </form>';
      }
      public function kullanicisil()
      {
         $yonetim = $this -> prepare("DELETE FROM yonetim WHERE id='".$_GET['id']."'");
         $yonetim -> execute();

         echo "<div class='container'>
            <div class='col-md-12 alert alert-success border border-warning mt-4 font-14'>
               <b>Tebrikler</b> Kullanici Silindi..
            </div>
         </div>";
         header('refresh:2, url=control.php?sayfa=kullaniciayar');
      }
   // video controls
      public function videoayar()
      {
         $tercih = isset($_GET['tercih']) ? $_GET['tercih'] : 2;

         switch($tercih):
            case 1: $videolar = $this -> prepare("SELECT * FROM videolar WHERE statu='{$tercih}' ORDER BY orders ASC"); break;
            case 0: $videolar = $this -> prepare("SELECT * FROM videolar WHERE statu='{$tercih}' ORDER BY orders ASC"); break;
            default: $videolar = $this -> prepare("SELECT * FROM videolar ORDER BY orders ASC"); break;
         endswitch;
         
         $videolar -> execute();

         echo "
            <div class='row'>
               <div class='col-lg-12 border-bottom border-light'>
                  <h4 class='float-left m-2 text-dark d-flex align-items-center'>
                     <a href='control.php?sayfa=videoekle' class='ti-plus bg-dark p-1 text-white mr-2' style='font-size:15px'></a>
                     VIDO GALERI
                  </h4>

                  <div class='dropdown float-right w-25'>
                     <button class='btn btn-secondary w-100 dropdown-toggle p-2 mt-1' id='btndrop' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                        <i class='fa fa-filter d-md-inline d-sm-none'></i> Filtrele
                     </button>
                     <div class='dropdown-menu dropdown-menu-right' aria-lableledby='btndrop'>
                        <a href='control.php?sayfa=videoayar&tercih=1' class='dropdown-item' style='font-size:15px'>Active</a>
                        <a href='control.php?sayfa=videoayar&tercih=0' class='dropdown-item' style='font-size:15px'>Passive</a>
                        <a href='control.php?sayfa=videoayar&tercih=2' class='dropdown-item' style='font-size:15px'>Complete</a>
                     </div>
                     
                  </div>
               </div>
         ";
         
         while($video = $videolar -> fetch(PDO::FETCH_ASSOC))
         {
            echo "
               <div class='col-lg-4'>
                  <div class='row mt-3'>
                     <div class='col-lg-12'>
                        <div class='embed-responsive embed-responsive-16by9'>
                           <iframe class='embed-responsive-item' src='https://www.youtube.com/embed/".$video['link']."' allowfullscreen></iframe>
                        </div>
                        
                        <kbd class='position-absolute bg-white text-dark p-1 d-flex justify-content-between align-items-center' style='bottom:30px;right:10px'>
                           <p>Orders: <strong>".$video['orders']."</strong>  Statu: <strong>".$video['statu']."</strong></p>
                           <a href='control.php?sayfa=videoguncelle&id=".$video['id']."' class='ti-reload m-2 text-success' style='font-size:25px'></a>
                           <a href='control.php?sayfa=videosil&id=".$video['id']."' class='ti-trash m-2 text-danger' style='font-size:25px'></a>
                        </kbd>
                     </div>  
                  </div>
               </div>
            ";
         }
         echo "</div>";
      }
      public function videoekle()
      {
         echo "<div class='row'>";

         if($_POST):
            $link = htmlspecialchars(strip_tags($_POST['link']));
            $statu = htmlspecialchars(strip_tags($_POST['statu']));
            $orders = htmlspecialchars(strip_tags($_POST['orders']));

            if(empty($link) || empty($orders)):
               echo "
                  <div class='container'>
                     <div class='col-md-8 offset-md-2 d-flex justify-content-center align-items-center alert alert-warning border border-success mt-4 text-dark font-14'>
                           <p><b>Lutfen!</b> Tum Alanlari Doldurunuz..</p>
                     </div>
                  </div>";

               header('refresh:2,url=control.php?sayfa=videoekle');
            else:
               $videolar = $this -> prepare("INSERT INTO videolar (link,statu,orders) VALUES ('$link','$statu','$orders')");
               $videolar -> execute();

               echo "
                  <div class='container'>
                     <div class='col-md-8 offset-md-2 d-flex justify-content-center align-items-center alert alert-success border border-warning mt-4 font-14'>
                           <p><b>Tebrikler!</b> Video Eklendi..</p>
                     </div>
                  </div>";

               header('refresh:2,url=control.php?sayfa=videoayar');
            endif;
         else:
            $videolar = $this -> prepare("SELECT MAX(orders) + 1 FROM videolar ORDER BY orders ASC LIMIT 1");
            $videolar -> execute();
            $video = $videolar -> fetchColumn();

            echo '
                  <div class="col-lg-4 mx-auto mt-2">
                     <div class="card card-bordered">
                        <div class="card-body pb-0">
                           <h5 class="title border-bottom pb-4">Video Yukleme Formu</h5>
                        </div>
                        <div class="card-body text-left">
                           <form method="POST">
                              <div class="form-group">
                                 <label for="link">LINK</label>
                                 <input name="link" value="" type="text" class="form-control" id="link" />
                              </div>

                              <div class="form-group">
                                 <label for="btnlabel">STATU</label>
                                 <div id="btnlabel" class="btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-light active">
                                       <input name="statu" value=1  type="radio" checked />
                                       ACIK
                                    </label>

                                    <label class="btn btn-light">
                                       <input name="statu" value=0 type="radio" />
                                       KAPALI
                                    </label>
                                 </div>
                              </div>
                                 

                              <label for="orders">ORDERS</label>
                              <select name="orders" id="orders" class="custom-select">
                                 <option value="'.$video.'">'.$video.'</option>
                              </select>

                              <button type="submit" name="submit" value="submit" class="btn btn-dark mt-4">YUKLE</button>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            '; 
         endif;
      }
      public function videoguncelle()
      {
         echo "<div class='row'>";

         if($_POST):
            $hidden = htmlspecialchars(strip_tags($_POST['hidden']));
            $link = htmlspecialchars(strip_tags($_POST['link']));
            $statu = (int)htmlspecialchars(strip_tags($_POST['statu']));
            $neworders = htmlspecialchars(strip_tags($_POST['neworders']));

            if(empty($link) || empty($neworders)):
               echo "<div class='container'>
                  <div class='col-md-8 offset-md-2 d-flex justify-content-center align-items-center alert alert-warning border border-success mt-4 text-dark font-14'>
                        <p><b>Lutfen!</b> Tum Alanlari Doldurunuz..</p>
                  </div>
               </div>";
               header('refresh:2,url=control.php?sayfa=videoayar');
            else:
               $videolar2 = $this -> prepare("SELECT orders FROM videolar WHERE id='$hidden' ORDER BY orders ASC LIMIT 1");
               $videolar2 -> execute();
               $video2 = $videolar2 -> fetchColumn();

               $videolar3 = $this -> prepare("UPDATE videolar SET orders='{$video2}' WHERE orders='$neworders' ORDER BY id ASC LIMIT 1");
               $videolar3 -> execute();

               $videolar4 = $this -> prepare("UPDATE videolar SET link='$link',statu='$statu',orders='$neworders' WHERE id='$hidden' ORDER BY id ASC LIMIT 1");
               $videolar4 -> execute();

               echo "<div class='container'>
                  <div class='col-md-8 offset-md-2 d-flex justify-content-center align-items-center alert alert-success border border-warning mt-4 font-14'>
                        <p><b>Tebrikler!</b> Video Guncellendi..</p>
                  </div>
               </div>";
               header('refresh:2,url=control.php?sayfa=videoayar');
            endif;
         else:
            $id = $_GET['id'];

            $videolar = $this -> prepare("SELECT * FROM videolar WHERE (id != '$id') ORDER BY orders ASC");
            $videolar -> execute();

            $videolartwo = $this -> prepare("SELECT * FROM videolar WHERE id='$id' ORDER BY orders ASC");
            $videolartwo -> execute();
            $videotwo = $videolartwo -> fetch(PDO::FETCH_ASSOC);

            echo '<div class="col-lg-4 mx-auto mt-2">
                  <div class="card card-bordered">
                     <div class="card-body pb-0">
                        <h5 class="title border-bottom pb-4">Video Guncelleme Formu</h5>
                     </div>
                     <div class="card-body text-left">
                        <form method="POST">
                           <div class="form-group">
                              <label for="link">LINK</label>
                              <input name="link" value="'.$videotwo['link'].'" type="text" class="form-control" id="link" />
                           </div>

                           <div class="form-group">
                              <label for="btnlabel">STATU</label>
                              <div id="btnlabel" class="btn-group-toggle" data-toggle="buttons">';

                              if($videotwo['statu'] == '1'){
                                 echo '<label class="btn btn-light active"><input name="statu" value="1"  type="radio" checked /> ACIK</label>';
                                 echo '<label class="btn btn-light"><input name="statu" value="0" type="radio" /> KAPALI</label>';
                              }
                                 
                              if($videotwo['statu'] == '0'){
                                 echo '<label class="btn btn-light"><input name="statu" value="1"  type="radio" /> ACIK</label>';
                                 echo '<label class="btn btn-light active"><input name="statu" value="0" type="radio" checked /> KAPALI</label>';
                              }
                                 
                              echo '</div>
                           </div>

                           <label for="orders">ORDERS '.$videotwo['orders'].'</label>
                           <select name="neworders" id="orders" class="custom-select">';
                           while($video = $videolar -> fetch(PDO::FETCH_ASSOC)):
                              echo '<option value="'.$video['orders'].'">'.$video['orders'].'</option>';
                           endwhile;
                           echo '</select>

                           <input type="hidden" name="hidden" value="'.$id.'" />
                           <button type="submit" name="submit" value="submit" class="btn btn-dark mt-4">GUNCELLE</button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>'; 
         endif;
      }
      public function videosil()
      {
         $remove = $this -> prepare("DELETE FROM videolar WHERE id='{$_GET['id']}' ORDER BY id ASC LIMIT 1");
         $remove -> execute();

         echo "<div class='container'>
            <div class='col-md-8 offset-md-2 alert alert-info border border-WARNING mt-4 font-14'>
               <b>Tebrikler!</b> Video Silindi..
            </div>
         </div>";
         header("refresh:2, url=control.php?sayfa=videoayar");
      }
  
   }







?>





























