<?php
   
   try{
      $connect = new PDO("mysql:host=localhost;dbname=kurumsal;charset=UTF8;", 'root', '');
      $connect -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }catch(PDOException $err){
      die($err -> getMessage());
   }

   
   $islem = $_GET['islem'];

   switch($islem):
      case 'islembulten': 
         $mail = htmlspecialchars(strip_tags($_POST['mail']));

         if(!$_POST):

         else:
            $sunucu = substr($mail, strpos($mail, '@') + 1);
            $error = array();

            getmxrr($sunucu, $error);

            if(count($error) > 0):
               $bulten = $connect -> prepare("SELECT COUNT(mail) FROM bulten WHERE mail='$mail'");
               $bulten -> execute();
               $bull = $bulten -> fetchColumn();

               if($bull > 0):
                  echo "<div class='alert alert-warning border border-danger'>Kayitli Mail..</div>";
               else:
                  $bulten = $connect -> prepare("INSERT INTO bulten (mail) VALUES ('$mail')");
                  $bulten -> execute();

                  echo "<div class='alert alert-info border border-warning'>Mail Kayit Edildi..</div>";
               endif;
            else:
               echo "<div class='alert alert-warning border border-danger'>Gecerli Bir Mail Girin..</div>";
            endif;
         endif;
      break;
   endswitch;
   
   









?>
