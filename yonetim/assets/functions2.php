<?php
   include_once('./assets/functions.php');
   
   class Yonetim2 extends Yonetim
   {
      public function __construct()
      {
         parent::__construct();
      }
   // haber controls
      public function haberayar()
      {
         $haberler = $this -> prepare("SELECT * FROM haberler");
         $haberler -> execute();

         echo "
            <div class='row'>
               <div class='col-lg-12 border-bottom border-light'>
                  <h4 class='float-left m-2 text-dark d-flex align-items-center'>
                     <a href='control.php?sayfa=haberekle' class='ti-plus bg-dark p-1 text-white mr-2' style='font-size:15px'></a>
                     HABER AYARLARI
                  </h4>
               </div>
         ";
         
         while($haber = $haberler -> fetch(PDO::FETCH_ASSOC))
         { 
            echo "
               <div class='col-lg-6'>
                  <div class='row border border-light m-1 mt-3'>
                     <div class='card-header col-lg-12 d-flex justify-content-between align-items-center border-bottom'>
                        <h5 class='badge badge-dark font-14'>Orders: {$haber['orders']}</h5>
                        <div>
                           <h6 class='float-left mr-2 text-info'>{$haber['header']}</h6>
                           <h6 class='float-right'>{$haber['dates']}</h6>
                        </div> 
                     </div>

                     <div class='card-body p-0'>
                        <p class='card-text border-bottom m-0 p-2'>{$haber['news_tr']}</p>
                        <p class='card-text border-bottom m-0 p-2'>{$haber['news_en']}</p>
                        <p class='card-text border-bottom m-0 p-2'>{$haber['news_pl']}</p>
                     </div>

                     <div class='col-lg-12 d-flex justify-content-around text-right p-2'>
                        <a href='control.php?sayfa=haberguncelle&id=".$haber['id']."' class='ti-reload m-2 text-success' style='font-size:25px'></a>
                        <a href='control.php?sayfa=habersil&id=".$haber['id']."' class='ti-trash m-2 text-danger' style='font-size:25px'></a>
                     </div>   
                  </div>
               </div>
            ";
         }
         echo "</div>";
      }
      public function haberekle()
      {
         $maxs = $this -> prepare("SELECT MAX(orders) + 1 FROM haberler");
         $maxs -> execute();
         $max = $maxs -> fetchColumn();

         if(!$_POST):
            echo "
               <div class='row text-right'>
                  <div class='col-lg-12 border-bottom border-light'>
                     <h3 class='float-left m-2 text-dark'>HABER EKLE</h3>
                  </div>
               </div>
               <div class='row'>
                  <div class='col-lg-6 mx-auto'>
                  <form method='POST'>
                     <div class='row border border-light p-1 m-1 mt-3'>
                           <div class='col-lg-12 p-3 text-left border-bottom border-light'>
                              <div class='form-group'>
                                 <label id='texts'>HEADER</label>
                                 <input type='text' name='header' value='' id='texts' class='form-control' />
                              </div>
                              <div class='form-group'>
                                 <label id='texts'>NEWS TR</label>
                                 <input type='text' name='news_tr' value='' id='texts' class='form-control' />
                              </div>
                              <div class='form-group'>
                                 <label id='texts'>NEWS EN</label>
                                 <input type='text' name='news_en' value='' id='texts' class='form-control' />
                              </div>
                              <div class='form-group'>
                                 <label id='texts'>NEWS PL</label>
                                 <input type='text' name='news_pl' value='' id='texts' class='form-control' />
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
            $header = htmlspecialchars($_POST['header']);
            $news_tr = htmlspecialchars($_POST['news_tr']);
            $news_en = htmlspecialchars($_POST['news_en']);
            $news_pl = htmlspecialchars($_POST['news_pl']);
            $orders = (int)htmlspecialchars($_POST['orders']);

            if(empty($news_tr) || empty($news_en) || empty($news_pl) || empty($orders)):
               echo "
                  <div class='container'>
                     <div class='col-md-8 offset-md-2 alert alert-danger border border-warning mt-4 font-14'>
                           <b>Lutfen!</b> Tum Alanlari Doldurunuz..
                     </div>
                  </div>
               ";
                  header('refresh:2,url=control.php?sayfa=haberekle');
            else:
               $haberler = $this -> prepare("INSERT INTO haberler (header,news_tr,news_en,news_pl,orders) VALUES ('$header','$news_tr','$news_en','$news_pl','$orders')");
               $haberler -> execute();
               
               echo "
                  <div class='container'>
                     <div class='col-md-8 offset-md-2 alert alert-success border border-warning mt-4 font-14'>
                           <b>Tebrikler!</b> Haber Eklendi..
                     </div>
                  </div>
               ";
                  header('refresh:2,url=control.php?sayfa=haberayar');
            endif;
         endif;
      }
      public function haberguncelle()
      {
         $id = $_GET['id'];

         $haberler = $this -> prepare("SELECT * FROM haberler WHERE id='$id'");
         $haberler -> execute();
         $haber = $haberler -> fetch(PDO::FETCH_ASSOC);

         $orders = $this -> prepare("SELECT * FROM haberler ORDER BY orders ASC");
         $orders -> execute();

         if(!$_POST):
            echo "
               <div class='row text-right'>
                  <div class='col-lg-12 border-bottom border-light'>
                     <h3 class='float-left m-2 text-dark'>HABER GUNCELLE</h3>
                  </div>
               </div>
               <div class='row'>
                  <div class='col-lg-6 mx-auto'>
                  <form action='' method='POST'>
                     <div class='row border border-light p-1 m-1 mt-3'>
                           <div class='col-lg-12 p-3 text-left border-bottom border-light'>
                              <div class='form-group'>
                                 <label id='texts'>HEADER</label>
                                 <input type='text' name='header' value='{$haber['header']}' id='texts' class='form-control' />
                              </div>
                              <div class='form-group'>
                                 <label id='texts'>HABER TR</label>
                                 <input type='text' name='news_tr' value='{$haber['news_tr']}' id='texts' class='form-control' />
                              </div>
                              <div class='form-group'>
                                 <label id='texts'>HABER EN</label>
                                 <input type='text' name='news_en' value='{$haber['news_en']}' id='texts' class='form-control' />
                              </div>
                              <div class='form-group'>
                                 <label id='texts'>HABER PL</label>
                                 <input type='text' name='news_pl' value='{$haber['news_pl']}' id='texts' class='form-control' />
                              </div>
                              <div class='form-group'>
                                 <label for='select'>ORDERS {$haber['orders']}</label>
                                 <select name='neworders' id='select' class='custom-select'>";
                                 while($or = $orders -> fetch(PDO::FETCH_ASSOC)):
                                    if($or['orders'] != $haber['orders']):
                                       echo "<option value='".$or["orders"]."'>{$or["orders"]} - {$or["header"]}</option>";
                                    endif;
                                 endwhile;  
                                echo "</select>
                              </div>
                           </div>

                           <div class='col-lg-12 p-3 text-center'>
                              <input type='hidden' name='hidden' value='{$id}' />
                              <input type='hidden' name='oldorders' value='{$haber['orders']}' />
                              <button type='submit' name='submit' value='submit' class='btn btn-dark'>GUNCELLE</button>
                           </div> 
                        </form> 
                     </div>
                  </div>
               </div>";
         else:
            $hidden = htmlspecialchars($_POST['hidden']);
            $header = htmlspecialchars($_POST['header']);
            $news_tr = htmlspecialchars($_POST['news_tr']);
            $news_en = htmlspecialchars($_POST['news_en']);
            $news_pl = htmlspecialchars($_POST['news_pl']);

            $neworders = htmlspecialchars($_POST['neworders']);
            $oldorders = htmlspecialchars($_POST['oldorders']);

           /*  echo $neworders, '<br>';

            echo $oldorders; */

            if(empty($news_tr) || empty($news_en) || empty($news_pl) || empty($neworders)):
               echo "
                  <div class='container'>
                     <div class='col-md-8 offset-md-2 alert alert-danger border border-warning mt-4 font-14'>
                           <b>Lutfen!</b> Tum Alanlari Doldurunuz..
                     </div>
                  </div>
               ";
                  header('refresh:2,url=control.php?sayfa=haberayar');
            else:
               $haberler2 = $this -> prepare("UPDATE haberler SET orders='$oldorders' WHERE orders='$neworders'");
               $haberler2 -> execute();

               $haberler3 = $this -> prepare("UPDATE haberler SET header='$header',news_tr='$news_tr',news_en='$news_en',news_pl='$news_pl',dates=CURRENT_TIMESTAMP(),orders='$neworders' WHERE id='$hidden'");
               $haberler3 -> execute();
               
               echo "
                  <div class='container'>
                     <div class='col-md-8 offset-md-2 alert alert-success border border-warning mt-4 font-14'>
                           <b>Tebrikler!</b> Hizmet Guncellendi..
                     </div>
                  </div>
               ";
                  header('refresh:2,url=control.php?sayfa=haberayar');
            endif;
         endif;
      }
      public function habersil()
      {
         $remove = $this -> prepare("DELETE FROM haberler WHERE id='".$_GET['id']."'");
         $remove -> execute();

         echo "
            <div class='container'>
               <div class='col-md-8 offset-md-2 alert alert-info border border-warning mt-4 font-14'>
                  <b>Tebrikler!</b> Haber Silindi..
               </div>
            </div>
         ";

         header("refresh:2, url=control.php?sayfa=haberayar");
      }
   // istatistikler
      public function istatistik($dbname)
      {
         $mydbs = $this -> prepare("SELECT * FROM ".$dbname);
         $mydbs -> execute();
         $mydb = $mydbs -> rowCount();

         echo '
            <div class="col-lg-3 col-md-6 mt-3">
               <div class="card text-center border border-dark" >
                  <div class="card-body">
                     <h5 class="card-title p-2 bg-dark text-white ">'.strtoupper($dbname).'</h5>	
                     <p class="card-text"><h3><kbd class="text-warning">'.$mydb.'</kbd></h3></p>   
                  </div>
               </div>
            </div>
         ';
      }
      public function istatistikbar()
      {
         $tables = ['haberler','intro','referanslar','filomuz','yorumlar','videolar','bulten'];

         echo '
            <div class="row">
               <div class="col-lg-12 border-bottom border-light">
                  <h4 class="float-left m-2 text-dark d-flex align-items-center">
                     ISTATISTIK BAR
                  </h4>
               </div>
            </div>

            <div class="row">';
            
            foreach($tables as $table):
               $this -> istatistik($table);
            endforeach;
            
         echo '</div>';
            
      }
   // intro controls
      public function introayar()
      {
         $intro = $this -> prepare("SELECT * FROM intro");
         $intro -> execute();

         echo "
            <div class='row'>
               <div class='col-lg-12 border-bottom border-light'>
                  <h4 class='float-left m-2 text-dark d-flex align-items-center'>
                     <a href='control.php?sayfa=introresimekle' class='ti-plus bg-dark p-1 text-white mr-2' style='font-size:15px'></a>
                     INTRO RESIMLERI
                  </h4>
               </div>
         ";
         
         while($intr = $intro -> fetch(PDO::FETCH_ASSOC))
         {
            echo "
               <div class='col-lg-4'>
                  <div class='row p-1 m-1 mt-3'>
                     <div class='col-lg-12'>
                        <img src='".IMG_ARAYUZ.$intr['picturepath']."' />

                        <kbd class='position-absolute bg-white p-2' style='bottom:30px;right:10px'>
                           <a href='control.php?sayfa=introresimguncelle&id=".$intr['id']."' class='ti-reload m-2 text-success' style='font-size:20px'></a>
                           "; ?> <a href='#' class='ti-trash m-2 text-danger' style='font-size:20px' onclick="silmedenSor('control.php?sayfa=introresimsil&id=<?=$intr['id']?>'); return false" ></a> <?php echo "
                        </kbd>
                     </div> 
                  </div>
               </div>
            ";
         }
         echo "</div>";
      }
      public function introresimekle()
      {
         echo "<div class='row'>";

         if($_POST):
            if(empty($_FILES['file']['name'])):
               ?><script>
                  BilgiPenceresi("control.php?sayfa=introresimekle","BASARISIZ","Bir Dosya Secin","warning");
               </script><?php
            else:
               if($_FILES['file']['size'] > (1024 * 1024 * 5)):
                  ?><script>
                     BilgiPenceresi("control.php?sayfa=introresimekle","BASARISIZ","Gecerli Bir Boyut Secin","warning");
                  </script><?php
               else:
                  $files = ['image/png', 'image/jpeg'];
                  if(!in_array($_FILES['file']['type'], $files)):
                     ?><script>
                        BilgiPenceresi("control.php?sayfa=introresimekle","BASARISIZ","Gecerli Bir Uzanti Secin","warning");
                     </script><?php
                  else:
                     $randname = md5(mt_rand(0,999999));
                     $explodename = explode('.', $_FILES['file']['name']);
                     $newname = $randname.".".end($explodename);

                     $pathone = ARAYUZ.'img/carousel/'. $newname;
                     move_uploaded_file($_FILES['file']['tmp_name'],$pathone);

                     $pathtwo = 'carousel/'.$newname;
                     $intro = $this -> prepare("INSERT INTO intro (picturepath) VALUES ('".$pathtwo."')");
                     $intro -> execute();
                     ?><script>
                        BilgiPenceresi("control.php?sayfa=introayar","BASARILI","Basariyla Eklendi","success");
                     </script><?php
                  endif;
               endif;
            endif;
         else:
            $this -> navifunc('introayar','INTRO','INTRO EKLE');
            echo '
                  <div class="col-lg-4 mx-auto mt-3">
                     <div class="card card-bordered">
                        <div class="card-body">
                           <h5 class="title border-bottom pb-4">Intro Resim Yukleme Formu</h5>
                        </div>
                        <div class="card-body pt-0">
                           <form action="" method="POST" enctype="multipart/form-data">
                              <div class="custom-file">
                                 <input type="file" class="custom-file-input" id="file" name="file" value="" />
                                 <label for="file" class="custom-file-label">Choose File</label>
                              </div>

                              <div class="list-group mt-4">
                                    <div class="list-group-item">* Izin Verilen Formatlar: jpg, png</div>
                                    <div class="list-group-item">* Izin Verilen Max Boyut: 5 mb</div>
                              </div>

                              <button type="submit" name="submit" value="submit" class="btn btn-dark mt-4">YUKLE</button>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            '; 
         endif;
      }
      public function introresimguncelle()
      {
         $id = $_GET['id'];
         
         echo "<div class='row'>";

         if($_POST):
            $formid = $_POST['hidden'];

            if(empty($_FILES['file']['name'])):
               echo "
                  <div class='container'>
                     <div class='col-md-12 alert alert-danger border border-dark mt-4 font-14'>
                           <b>Lutfen!</b> Bir Dosya Secin..
                     </div>
                  </div>";
                  header('refresh:2,url=control.php?sayfa=introayar');
            else:
               if($_FILES['file']['size'] > (1024 * 1024 * 5)):
                  echo "
                     <div class='container'>
                        <div class='col-md-12 alert alert-danger border border-dark mt-4 font-14'>
                              <b>Lutfen!</b> Gecerli Bir Boyut Secin..
                        </div>
                     </div>";
                  header('refresh:2,url=control.php?sayfa=introayar');
               else:
                  $files = ['image/png', 'image/jpeg'];
                  if(!in_array($_FILES['file']['type'], $files)):
                     echo "
                        <div class='container'>
                           <div class='col-md-12 alert alert-danger border border-dark mt-4 font-14'>
                                 <b>Lutfen!</b> Gecerli Bir Uzanti Secin..
                           </div>
                        </div>";
                     header('refresh:2,url=control.php?sayfa=introayar');
                  else:
                  // ESKI KAYIT SIL
                     $introtwo = $this -> prepare("SELECT * FROM intro WHERE id='".$id."'");
                     $introtwo -> execute();
                     $introtwos = $introtwo -> fetch(PDO::FETCH_ASSOC);
                     
                     unlink(ARAYUZ.'img/'.$introtwos['picturepath']);

                  // YENI RESIM EKLE
                     $randname = md5(mt_rand(0,999999));
                     $explodename = explode('.', $_FILES['file']['name']);
                     $newname = $randname.'.'.end($explodename);
                     $pathone = ARAYUZ.'/img/carousel/' . $newname;
                     move_uploaded_file($_FILES['file']['tmp_name'],$pathone);

                     $pathtwo = 'carousel/'.$newname;
                     $intro = $this -> prepare("UPDATE intro SET picturepath='".$pathtwo."' WHERE id='".$id."'");
                     $intro -> execute();
                     echo "
                        <div class='container'>
                           <div class='col-md-12 alert alert-success border border-dark mt-4 font-14'>
                                 <b>Tebrikler!</b> Yukleme Islemi Basarili..
                           </div>
                        </div>";
                     header('refresh:2,url=control.php?sayfa=introayar');
                  endif;
               endif;
            endif;
         else:
            $this -> navifunc('introayar','INTRO','INTRO GUNCELLE');
            echo '
                  <div class="col-lg-4 mx-auto mt-2">
                     <div class="card card-bordered">
                        <div class="card-body">
                           <h5 class="title border-bottom pb-4">Intro Resim Guncelleme Formu</h5>
                        </div>
                        <div class="card-body pt-0">
                           <form action="" method="POST" enctype="multipart/form-data">
                              <div class="custom-file">
                                 <input type="file" class="custom-file-input" id="file" name="file" value="" />
                                 <label for="file" class="custom-file-label">Choose File</label>
                              </div>

                              <input type="hidden" name="hidden" value="'.$id.'" />

                              <div class="list-group mt-4">
                                    <div class="list-group-item">* Izin Verilen Formatlar: jpg, png</div>
                                    <div class="list-group-item">* Izin Verilen Max Boyut: 5 mb</div>
                              </div>

                              <button type="submit" name="submit" value="submit" class="btn btn-primary mt-4">YUKLE</button>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            '; 
         endif;
      }
      public function introresimsil()
      {
         $intro = $this -> prepare("SELECT * FROM intro WHERE id='".$_GET['id']."'");
         $intro -> execute();
         $intr = $intro -> fetch(PDO::FETCH_ASSOC);

         @unlink('../' . $intr['picturepath']);

         $remove = $this -> prepare("DELETE FROM intro WHERE id='".$intr['id']."'");
         $remove -> execute();

         ?><script>
            BilgiPenceresi("control.php?sayfa=introayar","BASARILI","Resim Silindi","success");
         </script><?php
      }
   // hakkimizda controls
      public function hakkimizdaayar()
      {
         $hakkimizda = $this -> prepare("SELECT * FROM hakkimizda");
         $hakkimizda -> execute();
         $hakkimiz = $hakkimizda -> fetch(PDO::FETCH_ASSOC);

         if(!$_POST):
            echo "<div class='row'>
               <div class='col-lg-12 border-bottom border-light'>
                  <h4 class='float-left m-2 text-dark d-flex align-items-center'>HAKKIMIZDA AYARLARI</h4>
               </div>
      
               <div class='col-lg-6 mx-auto'>
                  <div class='row border border-light p-1 m-1 mt-3'>
                     <form action='' method='POST' enctype='multipart/form-data'>
                        <div class='col-lg-12 border-bottom border-light p-2 text-center'>
                           <h3>Resim</h3>
                        </div>
                        <div class='col-lg-12 p-2'>
                           <img src='".IMG_ARAYUZ.$hakkimiz['picture']."' />
                           <div class='custom-file text-left mt-3'>
                              <input type='file' name='file' value='' class='custom-file-input' id='files' />
                              <label class='custom-file-label' id='files'>Bir Dosya Girin</label>
                           </div>
                        </div>

                        <div class='col-lg-12 p-2 text-left'>
                           <div class='form-group'>
                              <label for='texts'>BASLIK TR</label>
                              <input type='text' name='header_tr' value='".$hakkimiz['header_tr']."' id='texts' class='form-control' />
                           </div>
                           <div class='form-group'>
                              <label for='texts'>BASLIK EN</label>
                              <input type='text' name='header_en' value='".$hakkimiz['header_en']."' id='texts' class='form-control' />
                           </div>
                           <div class='form-group'>
                              <label for='texts'>BASLIK PL</label>
                              <input type='text' name='header_pl' value='".$hakkimiz['header_pl']."' id='texts' class='form-control' />
                           </div>
                        </div>   

                        <div class='col-lg-12 p-2 text-left'>
                           <div class='form-group'>
                              <label for='textareas1'>CONTENT TR</label>
                              <textarea name='content_tr' id='textareas1' class='form-control' rows='7'>".$hakkimiz['content_tr']."</textarea>
                           </div>
                              
                           <div class='form-group'>
                              <label fo='textareas2'>CONTENT EN</label>
                              <textarea name='content_en' id='textareas2' class='form-control' rows='7'>".$hakkimiz['content_en']."</textarea>
                           </div>
                           <div class='form-group'>
                              <label for='textareas3'>CONTENT PL</label>
                              <textarea name='content_pl' id='textareas3' class='form-control' rows='7'>".$hakkimiz['content_pl']."</textarea>
                           </div>";?> 
                              <script> ClassicEditor.create(document.querySelector( '#textareas1')).catch( error =>{console.error( error )}); </script>
                              <script> ClassicEditor.create(document.querySelector( '#textareas2')).catch( error =>{console.error( error )}); </script>
                              <script> ClassicEditor.create(document.querySelector( '#textareas3')).catch( error =>{console.error( error )}); </script>
                        <?php echo "</div> 

                        <div class='col-lg-12 p-2 text-center'>
                           <button type='submit' name='submit' value='submit' class='btn btn-info'>GUNCELLE</button>
                        </div> 
                     </form> 
                  </div>
               </div>
            </div>";
         else:
            $header_tr = htmlspecialchars($_POST['header_tr']);
            $header_en = htmlspecialchars($_POST['header_en']);
            $header_pl = htmlspecialchars($_POST['header_pl']);

            $content_tr = htmlspecialchars($_POST['content_tr']);
            $content_en = htmlspecialchars($_POST['content_en']);
            $content_pl = htmlspecialchars($_POST['content_pl']);

            if(!empty($_FILES['file']['name'])):  
               
               if($_FILES['file']['size'] < (1024 * 1024 * 5)):

                  $files = ['image/png', 'image/jpeg'];

                  if(in_array($_FILES['file']['type'], $files)):

                     $path = $_FILES['file']['name'];
                     move_uploaded_file($_FILES['file']['tmp_name'],ARAYUZ.'img/'.$path);

                     $hakkimizda = $this -> prepare(
                        'UPDATE hakkimizda SET header_tr="'.$header_tr.'",header_en="'.$header_en.'",header_pl="'.$header_pl.'",
                        content_tr="'.$content_tr.'",content_en="'.$content_en.'",content_pl="'.$content_pl.'",picture="'.$path.'"'
                     );
                     $hakkimizda -> execute();

                     echo "
                        <div class='container'>
                           <div class='col-md-8 offset-md-2 alert alert-success border border-warning mt-4 font-14'>
                                 <b>Tebrikler!</b> Islem Basarili
                           </div>
                        </div>";
                     header('refresh:2,url=control.php?sayfa=hakkimizdaayar');
                    
                  else:
                     echo "
                        <div class='container'>
                           <div class='col-md-8 offset-md-2 alert alert-danger border border-warning mt-4 font-14'>
                              <b>Lutfen!</b> Gecerli Bir Uzanti Secin..
                           </div>
                        </div>";
                     header('refresh:2,url=control.php?sayfa=hakkimizdaayar');
                  endif;
               else:
                  echo "
                     <div class='container'>
                        <div class='col-md-8 offset-md-2 alert alert-danger border border-warning mt-4 font-14'>
                           <b>Lutfen!</b> Gecerli Bir Boyut Secin..
                        </div>
                     </div>";
                  header('refresh:2,url=control.php?sayfa=hakkimizdaayar');
               endif;
            else:
               $hakkimizda = $this -> prepare(
                  'UPDATE hakkimizda SET header_tr="'.$header_tr.'",header_en="'.$header_en.'",header_pl="'.$header_pl.'",
                  content_tr="'.$content_tr.'",content_en="'.$content_en.'",content_pl="'.$content_pl.'"'
               );
               $hakkimizda -> execute();

               echo "
                  <div class='container'>
                     <div class='col-md-8 offset-md-2 alert alert-success border border-warning mt-4 font-14'>
                           <b>Tebrikler!</b> Islem Basarili
                     </div>
                  </div>";
               header('refresh:2,url=control.php?sayfa=hakkimizdaayar');
            endif;

         endif; 
      }
   // hizmetlerimz controls
      public function hizmetayar()
      {
         $hizmetler = $this -> prepare("SELECT * FROM hizmetler");
         $hizmetler -> execute();

         echo "
            <div class='row'>
               <div class='col-lg-12 border-bottom border-light'>
                  <h4 class='float-left m-2 text-dark d-flex align-items-center'>
                     <a href='control.php?sayfa=hizmetekle' class='ti-plus bg-dark p-1 text-white mr-2' style='font-size:15px'></a>
                     HIZMETLERIMIZ AYARLARI
                  </h4>
               </div>
         ";
         
         while($hizmet = $hizmetler -> fetch(PDO::FETCH_ASSOC))
         {
            echo "
               <div class='col-lg-4'>
                  <div class='row border border-light p-1 m-1 mt-3'>
                     <div class='col-lg-12 text-center p-3  border-bottom border-light'>
                        <i class='".$hizmet['icon']." fa-4x'></i>
                     </div>

                     <div class='col-lg-12 d-flex justify-content-around text-right p-3'>
                        <a href='control.php?sayfa=hizmetguncelle&id=".$hizmet['id']."' class='ti-reload m-2 text-success' style='font-size:25px'></a>
                        <a href='control.php?sayfa=hizmetsil&id=".$hizmet['id']."' class='ti-trash m-2 text-danger' style='font-size:25px'></a>
                     </div>   
                  </div>
               </div>
            ";
         }
         echo "</div>";
      }
      public function hizmetekle()
      {
         if(!$_POST):
            echo "
               <div class='row text-right'>
                  <div class='col-lg-12 border-bottom border-light'>
                     <h3 class='float-left m-2 text-dark'>HIZMETLERIMIZ EKLE</h3>
                  </div>
               </div>
               <div class='row'>
                  <div class='col-lg-6 mx-auto'>
                  <form action='' method='POST'>
                     <div class='row border border-light p-1 m-1 mt-3'>
                           <div class='col-lg-12 p-3 border-bottom border-light'>
                              <div class='form-group text-left mt-3'>
                                 <label id='text'>Icon Girin</label>
                                 <input type='text' name='icon' value='' class='form-control' id='text' />
                                 <span class='small form-text text text-muted'>Tum Icon Lar Font-Awesom Sitesinden fa fa-tras Seklinde Girilir..</span>
                              </div>
                           </div>

                           <div class='col-lg-12 p-3 text-left border-bottom border-light'>
                              <div class='form-group'>
                                 <label for='texts'>BASLIK TR</label>
                                 <input type='text' name='title_tr' value='' id='texts1' class='form-control' />
                              </div>
                              <div class='form-group'>
                                 <label for='texts'>BASLIK EN</label>
                                 <input type='text' name='title_en' value='' id='texts2' class='form-control' />
                              </div>
                              <div class='form-group'>
                                 <label for='texts'>BASLIK PL</label>
                                 <input type='text' name='title_pl' value='' id='texts3' class='form-control' />
                              </div>
                           </div>   

                           <div class='col-lg-12 p-3 text-left border-bottom border-light'>
                              <div class='form-group'>
                                 <label for='textareas1'>CONTENT TR</label>
                                 <textarea name='content_tr' id='textareas1' class='form-control' rows='7'></textarea>
                              </div>
                              <div class='form-group'>
                                 <label for='textareas2'>CONTENT EN</label>
                                 <textarea name='content_en' id='textareas2' class='form-control' rows='7'></textarea>
                              </div>
                              <div class='form-group'>
                                 <label for='textareas3'>CONTENT PL</label>
                                 <textarea name='content_pl' id='textareas3' class='form-control' rows='7'></textarea>
                              </div>";?>
                                 <script> ClassicEditor.create(document.querySelector( '#textareas1')).catch( error =>{console.error( error )}); </script>
                                 <script> ClassicEditor.create(document.querySelector( '#textareas2')).catch( error =>{console.error( error )}); </script>
                                 <script> ClassicEditor.create(document.querySelector( '#textareas3')).catch( error =>{console.error( error )}); </script>
                           <?php echo "</div> 

                           <div class='col-lg-12 p-3 text-center'>
                              <button type='submit' name='submit' value='submit' class='btn btn-dark'>GUNCELLE</button>
                           </div> 
                        </form> 
                     </div>
                  </div>
               </div>";
         else:
            $icon = htmlspecialchars($_POST['icon']);
            $title_tr = htmlspecialchars($_POST['title_tr']);
            $title_en = htmlspecialchars($_POST['title_en']);
            $title_pl = htmlspecialchars($_POST['title_pl']);
            $content_tr = htmlspecialchars($_POST['content_tr']);
            $content_en = htmlspecialchars($_POST['content_en']);
            $content_pl = htmlspecialchars($_POST['content_pl']);

            if(empty($icon) || empty($title_tr) || empty($title_en) || empty($title_pl) || empty($content_tr) || empty($content_en) || empty($content_pl)):
               echo "
                  <div class='container'>
                     <div class='col-md-8 offset-md-2 alert alert-danger border border-warning mt-4 font-14'>
                           <b>Lutfen!</b> Tum Alanlari Doldurunuz..
                     </div>
                  </div>
               ";
                  header('refresh:2,url=control.php?sayfa=hizmetekle');
            else:
               $hizmetler = $this -> prepare(
                  "INSERT INTO hizmetler (icon,title_tr,title_en,title_pl,content_tr,content_en,content_pl) VALUES 
                  ('$icon','$title_tr','$title_en','$title_pl','$content_tr','$content_en','$content_pl')"
               );
               $hizmetler -> execute();
               
               echo "
                  <div class='container'>
                     <div class='col-md-8 offset-md-2 alert alert-success border border-warning mt-4 font-14'>
                           <b>Tebrikler!</b> Hizmet Eklendi..
                     </div>
                  </div>
               ";
                  header('refresh:2,url=control.php?sayfa=hizmetayar');
            endif;
         endif;
      }
      public function hizmetguncelle()
      {
         $id = $_GET['id'];

         $hizmetler = $this -> prepare("SELECT * FROM hizmetler WHERE id='".$id."'");
         $hizmetler -> execute();
         $hizmet = $hizmetler -> fetch(PDO::FETCH_ASSOC);

         if(!$_POST):
            echo "
               <div class='row text-right'>
                  <div class='col-lg-12 border-bottom border-light'>
                     <h3 class='float-left m-2 text-dark'>HIZMETLERIMIZ GUNCELLE</h3>
                  </div>
               </div>
               <div class='row'>
                  <div class='col-lg-6 mx-auto'>
                     <form action='' method='POST'>
                        <div class='row border border-light p-1 m-1 mt-3'>
                           <div class='col-lg-12 p-3 border-bottom border-light'>
                              <div class='form-group text-left mt-3'>
                                 <label id='text'>Icon Girin</label>
                                 <input type='text' name='icon' value='".$hizmet['icon']."' class='form-control' id='text' />
                                 <span class='small form-text text text-muted'>Tum Icon Lar Font-Awesom Sitesinden fa fa-tras Seklinde Girilir..</span>
                              </div>
                           </div>

                           <div class='col-lg-12 p-3 text-left border-bottom border-light'>
                              <div class='form-group'>
                                 <label for='texts1'>BASLIK TR</label>
                                 <input type='text' name='title_tr' value='".$hizmet['title_tr']."' id='texts1' class='form-control' />
                              </div>
                              <div class='form-group'>
                                 <label for='texts2'>BASLIK EN</label>
                                 <input type='text' name='title_en' value='".$hizmet['title_en']."' id='texts2' class='form-control' />
                              </div>
                              <div class='form-group'>
                                 <label for='texts3'>BASLIK PL</label>
                                 <input type='text' name='title_pl' value='".$hizmet['title_pl']."' id='texts3' class='form-control' />
                              </div>
                           </div>   

                           <div class='col-lg-12 p-3 text-left border-bottom border-light'>
                              <div class='form-group'>
                                 <label for='textareas1'>CONTENT TR</label>
                                 <textarea name='content_tr' id='textareas1' class='form-control' rows='7'>".$hizmet['content_tr']."</textarea>
                              </div>
                              <div class='form-group'>
                                 <label for='textareas2'>CONTENT EN</label>
                                 <textarea name='content_en' id='textareas2' class='form-control' rows='7'>".$hizmet['content_en']."</textarea>
                              </div>
                              <div class='form-group'>
                                 <label for='textareas3'>CONTENT PL</label>
                                 <textarea name='content_pl' id='textareas3' class='form-control' rows='7'>".$hizmet['content_pl']."</textarea>
                              </div>"; ?>
                                 <script> ClassicEditor.create(document.querySelector( '#textareas1')).catch( error =>{console.error( error )}); </script>
                                 <script> ClassicEditor.create(document.querySelector( '#textareas2')).catch( error =>{console.error( error )}); </script>
                                 <script> ClassicEditor.create(document.querySelector( '#textareas3')).catch( error =>{console.error( error )}); </script>
                           <?echo "</div> 

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
            $icon = htmlspecialchars($_POST['icon']);
            $title_tr = htmlspecialchars($_POST['title_tr']);
            $title_en = htmlspecialchars($_POST['title_en']);
            $title_pl = htmlspecialchars($_POST['title_pl']);
            $content_tr = htmlspecialchars($_POST['content_tr']);
            $content_en = htmlspecialchars($_POST['content_en']);
            $content_pl = htmlspecialchars($_POST['content_pl']);

            if(empty($icon) || empty($title_tr) || empty($title_en) || empty($title_pl) || empty($content_tr) || empty($content_en) || empty($content_pl)):
               echo "
                  <div class='container'>
                     <div class='col-md-8 offset-md-2 alert alert-danger border border-warning mt-4 font-14'>
                           <b>Lutfen!</b> Tum Alanlari Doldurunuz..
                     </div>
                  </div>";
                  header('refresh:2,url=control.php?sayfa=hizmetayar');
            else:
               $hizmetler = $this -> prepare(
                  "UPDATE hizmetler SET icon='".$icon."',title_tr='".$title_tr."',title_en='".$title_en."',title_pl='".$title_pl."',
                  content_tr='".$content_tr."',content_en='".$content_en."',content_pl='".$content_pl."' WHERE id='".$hidden."'"
               );
               $hizmetler -> execute();
               
               echo "
                  <div class='container'>
                     <div class='col-md-8 offset-md-2 alert alert-success border border-warning mt-4 font-14'>
                           <b>Tebrikler!</b> Hizmet Guncellendi..
                     </div>
                  </div>
               ";
                  header('refresh:2,url=control.php?sayfa=hizmetayar');
            endif;
         endif;
      }
      public function hizmetsil()
      {
         $remove = $this -> prepare("DELETE FROM hizmetler WHERE id='".$_GET['id']."'");
         $remove -> execute();

         echo "
            <div class='container'>
               <div class='col-md-8 offset-md-2 alert alert-info border border-warning mt-4 font-14'>
                  <b>Tebrikler!</b> Hizmet Silindi..
               </div>
            </div>
         ";

         header("refresh:2, url=control.php?sayfa=hizmetayar");
      }
   // referanslar controls
      public function referansayar()
      {
         $referanslar = $this -> prepare("SELECT * FROM referanslar");
         $referanslar -> execute();

         echo "
            <div class='row'>
               <div class='col-lg-12 border-bottom border-light'>
                  <h4 class='float-left m-2 text-dark d-flex align-items-center'>
                     <a href='control.php?sayfa=referansresimekle' class='ti-plus bg-dark p-1 text-white mr-2' style='font-size:15px'></a>
                     REFERANS AYARLARI
                  </h4>
               </div>
         ";
         
         while($referans = $referanslar -> fetch(PDO::FETCH_ASSOC))
         {
            echo "
               <div class='col-lg-3 col-md-4 mx-auto'>
                  <div class='row border border-light p-1 m-1 mt-3'>
                     <div class='col-lg-12 text-center p-3 border-bottom border-light'>
                        <img src='".IMG_ARAYUZ.$referans['picturepath']."' />
                     </div>

                     <div class='col-lg-12 d-flex justify-content-around text-right'>
                        <a href='control.php?sayfa=referansresimguncelle&id=".$referans['id']."' class='ti-reload m-2 text-success' style='font-size:25px'></a>
                        <a href='control.php?sayfa=referansresimsil&id=".$referans['id']."' class='ti-trash m-2 text-danger' style='font-size:25px'></a>
                     </div>   
                  </div>
               </div>
            ";
         }
         echo "</div>";
      }
      public function referansresimekle()
      {
         echo "<div class='row'>";

         if($_POST):
            if(empty($_FILES['file']['name'])):
               echo "
                  <div class='container'>
                     <div class='col-md-12 alert alert-danger border border-warning mt-4 font-14'>
                        <b>Lutfen!</b> Bir Dosya Secin..
                     </div>
                  </div>";
                  header('refresh:2,url=control.php?sayfa=referansresimekle');
            else:
               if($_FILES['file']['size'] > (1024 * 1024 * 5)):
                  echo "
                     <div class='container'>
                        <div class='col-md-12 alert alert-danger border border-warning mt-4 font-14'>
                           <b>Lutfen!</b> Gecerli Bir Boyut Secin..
                        </div>
                     </div>";
                  header('refresh:2,url=control.php?sayfa=referansresimekle');
               else:
                  $files = ['image/png', 'image/jpeg'];
                  if(!in_array($_FILES['file']['type'], $files)):
                     echo "
                        <div class='container'>
                           <div class='col-md-12 alert alert-danger border border-warning mt-4 font-14'>
                                 <b>Lutfen!</b> Gecerli Bir Uzanti Secin..
                           </div>
                        </div>";
                     header('refresh:2,url=control.php?sayfa=referansresimekle');
                  else:
                     $randname = md5(mt_rand(0,999999));
                     $explodename = explode('.', $_FILES['file']['name']);
                     $newname = $randname.".".end($explodename);

                     $pathone = ARAYUZ.'img/referans/' . $newname;
                     move_uploaded_file($_FILES['file']['tmp_name'],$pathone);

                     $pathtwo = 'referans/'.$newname;
                     $referanslar = $this -> prepare("INSERT INTO referanslar (picturepath) VALUES ('".$pathtwo."')");
                     $referanslar -> execute();
                     echo "
                        <div class='container'>
                           <div class='col-md-12 alert alert-success border border-info mt-4 font-14'>
                                 <b>Tebrikler!</b> Yukleme Islemi Basarili..
                           </div>
                        </div>";
                     header('refresh:2,url=control.php?sayfa=referansayar');
                  endif;
               endif;
            endif;
         else:
            $this -> navifunc('referansayar','REFERANS','REFERANS EKLE');
            echo '
                  <div class="col-lg-4 mx-auto mt-3">
                     <div class="card card-bordered">
                        <div class="card-body">
                           <h5 class="title border-bottom pb-4">Referans Yukleme Formu</h5>
                        </div>
                        <div class="card-body pt-0">
                           <form action="" method="POST" enctype="multipart/form-data">
                              <div class="custom-file">
                                 <input type="file" class="custom-file-input" id="file" name="file" value="" />
                                 <label for="file" class="custom-file-label">Choose File</label>
                              </div>

                              <div class="list-group mt-4">
                                    <div class="list-group-item">* Izin Verilen Formatlar: jpg, png</div>
                                    <div class="list-group-item">* Izin Verilen Max Boyut: 5 mb</div>
                              </div>

                              <button type="submit" name="submit" value="submit" class="btn btn-dark mt-4">YUKLE</button>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            '; 
         endif;
      }
      public function referansresimguncelle()
      {
         echo "<div class='row'>";

         if($_POST):
            $hidden = $_POST['hidden'];

            if(empty($_FILES['file']['name'])):
               echo "
                  <div class='container'>
                     <div class='col-md-12 alert alert-danger border border-warning mt-4 font-14'>
                           <b>Lutfen!</b> Bir Dosya Secin..
                     </div>
                  </div>";
                  header('refresh:2,url=control.php?sayfa=referansayar');
            else:
               if($_FILES['file']['size'] > (1024 * 1024 * 5)):
                  echo "
                     <div class='container'>
                        <div class='col-md-12 alert alert-danger border border-warning mt-4 font-14'>
                              <b>Lutfen!</b> Gecerli Bir Boyut Secin..
                        </div>
                     </div>";
                  header('refresh:2,url=control.php?sayfa=referansayar');
               else:
                  $files = ['image/png', 'image/jpeg'];
                  if(!in_array($_FILES['file']['type'], $files)):
                     echo "
                        <div class='container'>
                           <div class='col-md-12 alert alert-danger border border-warning mt-4 font-14'>
                                 <b>Lutfen!</b> Gecerli Bir Uzanti Secin..
                           </div>
                        </div>";
                     header('refresh:2,url=control.php?sayfa=referansayar');
                  else:
                  // ESKI KAYIT SIL
                     $referanslartwo = $this -> prepare("SELECT * FROM referanslar WHERE id='".$hidden."'");
                     $referanslartwo -> execute();
                     $referanstwos = $referanslartwo -> fetch(PDO::FETCH_ASSOC);
                     
                     unlink(ARAYUZ.'img/'.$referanstwos['picturepath']);

                  // YENI RESIM EKLE
                     $randname = md5(mt_rand(0,999999));
                     $explodename = explode('.', $_FILES['file']['name']);
                     $newname = $randname.".".end($explodename);

                     $pathone = ARAYUZ.'/img/referans/' . $newname;
                     move_uploaded_file($_FILES['file']['tmp_name'],$pathone);

                     $pathtwo = 'referans/' . $newname;
                     $referanslar = $this -> prepare("UPDATE referanslar SET picturepath='".$pathtwo."' WHERE id='".$hidden."'");
                     $referanslar -> execute();
                     echo "
                        <div class='container'>
                           <div class='col-md-12 alert alert-success border border-info mt-4 font-14'>
                                 <b>Tebrikler!</b> Yukleme Islemi Basarili..
                           </div>
                        </div>";
                     header('refresh:2,url=control.php?sayfa=referansayar');
                  endif;
               endif;
            endif;
         else:
            $id = $_GET['id'];
            $this -> navifunc('referansayar','REFERANS','REFERANS GUNCELLE');
            echo '
                  <div class="col-lg-4 mx-auto mt-3">
                     <div class="card card-bordered">
                        <div class="card-body">
                           <h5 class="title border-bottom pb-4">Referans Guncelleme Formu</h5>
                        </div>
                        <div class="card-body pt-0">
                           <form action="" method="POST" enctype="multipart/form-data">
                              <div class="custom-file">
                                 <input type="file" class="custom-file-input" id="file" name="file" value="" />
                                 <label for="file" class="custom-file-label">Choose File</label>
                              </div>

                              <div class="list-group mt-4">
                                    <div class="list-group-item">* Izin Verilen Formatlar: jpg, png</div>
                                    <div class="list-group-item">* Izin Verilen Max Boyut: 5 mb</div>
                              </div>

                              <input type="hidden" name="hidden" value="'.$id.'" />
                              <button type="submit" name="submit" value="submit" class="btn btn-dark mt-4">YUKLE</button>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            '; 
         endif;
      }
      public function referansresimsil()
      {
         $referanslar = $this -> prepare("SELECT * FROM referanslar WHERE id='".$_GET['id']."'");
         $referanslar -> execute();
         $referans = $referanslar -> fetch(PDO::FETCH_ASSOC);

         @unlink(ARAYUZ.'img/'.$referans['picturepath']);

         $remove = $this -> prepare("DELETE FROM referanslar WHERE id='".$referans['id']."'");
         $remove -> execute();

         echo "
               <div class='container'>
                  <div class='col-md-12 alert alert-danger border border-warning mt-4 font-14'>
                        <b>Tebrikler!</b> Dosya Silindi..
                  </div>
               </div>";

         header("refresh:2, url=control.php?sayfa=referansayar");
      }
   // filo controls
      public function filoayar()
      {
         $filomuz = $this -> prepare("SELECT * FROM filomuz");
         $filomuz -> execute();

         echo "
            <div class='row'>
               <div class='col-lg-12 border-bottom border-light'>
                  <h4 class='float-left m-2 text-dark d-flex align-items-center'>
                     <a href='control.php?sayfa=filoresimekle' class='ti-plus bg-dark p-1 text-white mr-2' style='font-size:15px'></a>
                     FILO RESIMLERI
                  </h4>
               </div>
         ";
         
         while($filo = $filomuz -> fetch(PDO::FETCH_ASSOC))
         {
            echo "
               <div class='col-lg-4'>
                  <div class='row p-1 m-1 mt-3'>
                     <div class='col-lg-12'>
                        <img src='".IMG_ARAYUZ.$filo['picturepath']."' />
                        <kbd class='position-absolute bg-white p-2' style='bottom:10px;right:10px'>
                           <a href='control.php?sayfa=filoresimguncelle&id=".$filo['id']."' class='ti-reload m-2 text-success' style='font-size:20px'></a>
                           <a href='control.php?sayfa=filoresimsil&id=".$filo['id']."' class='ti-trash m-2 text-danger' style='font-size:20px'></a>
                        </kbd>
                     </div>  
                  </div>
               </div>
            ";
         }
         echo "</div>";
      }
      public function filoresimekle()
      {
         echo "<div class='row'>";

         if($_POST):
            if(empty($_FILES['file']['name'])):
               echo "<div class='container'>
                  <div class='col-md-12 alert alert-danger border border-info mt-4'>
                        <b>Lutfen!</b> Bir Dosya Secin..
                  </div>
               </div>";
               header('refresh:2,url=control.php?sayfa=filoresimekle');
            else:
               if($_FILES['file']['size'] > (1024 * 1024 * 5)):
                  echo "<div class='container'>
                     <div class='col-md-12 alert alert-danger border border-info mt-4'>
                           <b>Lutfen!</b> Gecerli Bir Buyukluk Secin..
                     </div>
                  </div>";
                  header('refresh:2,url=control.php?sayfa=filoresimekle');
               else:
                  $files = ['image/png', 'image/jpeg'];
                  if(!in_array($_FILES['file']['type'], $files)):
                     echo "<div class='container'>
                        <div class='col-md-12 alert alert-danger border border-info mt-4'>
                              <b>Lutfen!</b> Gecerli Bir Uzanti Secin..
                        </div>
                     </div>";
                     header('refresh:2,url=control.php?sayfa=filoresimekle');
                  else:
                     $randname = md5(mt_rand(0,999999));
                     $explodename = explode('.', $_FILES['file']['name']);
                     $newname = $randname.".".end($explodename);

                     $pathone = ARAYUZ.'img/filo/' . $newname;
                     move_uploaded_file($_FILES['file']['tmp_name'],$pathone);

                     $pathtwo = 'filo/' . $newname;
                     $filomuz = $this -> prepare("INSERT INTO filomuz (picturepath) VALUES ('".$pathtwo."')");
                     $filomuz -> execute();
                     echo "
                        <div class='container'>
                           <div class='col-md-12 alert alert-success border border-danger mt-4'>
                                 <b>Tebrikler!</b> Yukleme Islemi Basarili..
                           </div>
                        </div>";
                     header('refresh:2,url=control.php?sayfa=filoayar');
                  endif;
               endif;
            endif;
         else:
            echo '
                  <div class="col-lg-4 mx-auto mt-2">
                     <div class="card card-bordered">
                        <div class="card-body">
                           <h5 class="title border-bottom pb-4">Filo Resim Yukleme Formu</h5>
                        </div>
                        <div class="card-body">
                           <form action="" method="POST" enctype="multipart/form-data">
                              <div class="custom-file">
                                 <input type="file" class="custom-file-input" id="file" name="file" value="" />
                                 <label for="file" class="custom-file-label">Choose File</label>
                              </div>

                              <div class="list-group mt-4">
                                    <div class="list-group-item">* Izin Verilen Formatlar: jpg, png</div>
                                    <div class="list-group-item">* Izin Verilen Max Boyut: 5 mb</div>
                              </div>

                              <button type="submit" name="submit" value="submit" class="btn btn-primary mt-4">YUKLE</button>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            '; 
         endif;
      }
      public function filoresimguncelle()
      {
         $id = $_GET['id'];

         echo "<div class='row'>";

         if($_POST):
            $formid = $_POST['hidden'];

            if(empty($_FILES['file']['name'])):
               echo "<div class='container'>
                  <div class='col-md-12 alert alert-danger border border-warning mt-4 font-14'>
                        <b>Lutfen!</b> Bir Dosya Secin..
                  </div>
               </div>";
               header('refresh:2,url=control.php?sayfa=filoayar');
            else:
               if($_FILES['file']['size'] > (1024 * 1024 * 5)):
                  echo "<div class='container'>
                     <div class='col-md-12 alert alert-danger border border-warning mt-4 font-14'>
                           <b>Lutfen!</b> Gecerli Bir Boyut Secin..
                     </div>
                  </div>";
                  header('refresh:2,url=control.php?sayfa=filoayar');
               else:
                  $files = ['image/png', 'image/jpeg'];
                  if(!in_array($_FILES['file']['type'], $files)):
                     echo "<div class='container'>
                        <div class='col-md-12 alert alert-danger border border-warning mt-4 font-14'>
                              <b>Lutfen!</b> Gecerli Bir Uzanti Secin..
                        </div>
                     </div>";
                     header('refresh:2,url=control.php?sayfa=filoayar');
                  else:
                  // ESKI KAYIT SIL
                     $filotwo = $this -> prepare("SELECT * FROM filomuz WHERE id='".$id."'");
                     $filotwo -> execute();
                     $filotwos = $filotwo -> fetch(PDO::FETCH_ASSOC);
                     
                     unlink(ARAYUZ.'img/'.$filotwos['picturepath']);

                  // YENI RESIM EKLE
                     $randname = md5(mt_rand(0,999999));
                     $explodename = explode('.', $_FILES['file']['name']);
                     $newname = $randname.".".end($explodename);

                     $pathone = ARAYUZ.'img/filo/' . $newname;
                     move_uploaded_file($_FILES['file']['tmp_name'],$pathone);

                     $pathtwo = 'filo/' . $newname;
                     $filomuz = $this -> prepare("UPDATE filomuz SET picturepath='".$pathtwo."' WHERE id='".$id."'");
                     $filomuz -> execute();
                     echo "
                        <div class='container'>
                           <div class='col-md-12 alert alert-danger border border-warning mt-4 font-14'>
                                 <b>Tebrikler!</b> Yukleme Islemi Basarili..
                           </div>
                        </div>";
                     header('refresh:2,url=control.php?sayfa=filoayar');
                  endif;
               endif;
            endif;
         else:
            echo '
                  <div class="col-lg-4 mx-auto mt-2">
                     <div class="card card-bordered">
                        <div class="card-body">
                           <h5 class="title border-bottom pb-4">Filo Resim Guncelleme Formu</h5>
                        </div>
                        <div class="card-body">
                           <form action="" method="POST" enctype="multipart/form-data">
                              <div class="custom-file">
                                 <input type="file" class="custom-file-input" id="file" name="file" value="" />
                                 <label for="file" class="custom-file-label">Choose File</label>
                              </div>

                              <input type="hidden" name="hidden" value="'.$id.'" />

                              <div class="list-group mt-4">
                                    <div class="list-group-item">* Izin Verilen Formatlar: jpg, png</div>
                                    <div class="list-group-item">* Izin Verilen Max Boyut: 5 mb</div>
                              </div>

                              <button type="submit" name="submit" value="submit" class="btn btn-primary mt-4">YUKLE</button>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            '; 
         endif;
      }
      public function filoresimsil()
      {
         $filomuz = $this -> prepare("SELECT * FROM filomuz WHERE id='".$_GET['id']."'");
         $filomuz -> execute();
         $filo = $filomuz -> fetch(PDO::FETCH_ASSOC);

         @unlink(ARAYUZ.'img/'.$filo['picturepath']);

         $remove = $this -> prepare("DELETE FROM filomuz WHERE id='".$filo['id']."'");
         $remove -> execute();

         echo "
               <div class='container'>
                  <div class='col-md-12 alert alert-success border border-warning mt-4 font-14'>
                        <b>Tebrikler!</b> Dosya Silindi..
                  </div>
               </div>";

         header("refresh:2, url=control.php?sayfa=filoayar");
      }
   
   
   
   
   
   
   
   
   }







?>





























