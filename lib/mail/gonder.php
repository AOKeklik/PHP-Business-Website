<?php
   session_start();
   
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;

   require "src/Exception.php";
   require "src/PHPMailer.php";
   require "src/SMTP.php";

      $connect = new PDO("mysql:host=localhost;dbname=kurumsal;charset=UTF8;",'root','');

      $gelenmailayar = $connect -> prepare("SELECT * FROM gelenmailayar");
      $gelenmailayar -> execute();
      $gelenmail = $gelenmailayar -> fetch(PDO::FETCH_ASSOC);

      $ayarlar = $connect -> prepare("SELECT mailtercih FROM ayarlar");
      $ayarlar -> execute();
      $ayar = $ayarlar -> fetch(PDO::FETCH_ASSOC);

      $mail = new PHPMailer(true);
      $mail->SMTPDebug = 0;
      $mail->isSMTP();
      $mail->CharSet = 'UTF-8';
      $mail->Host = $gelenmail['host'];
      $mail->SMTPAuth = true;
      $mail->Username = $gelenmail['mail'];
      $mail->Password = $gelenmail['password'];
      $mail->SMTPSecure = 'tls';
      $mail->Port = $gelenmail['port'];
      $mail->isHTML(true);
      $mail->addAddress($gelenmail['receiver']);

      if($_POST):
         $isim = htmlspecialchars(strip_tags($_POST['isim']));
         $mails = htmlspecialchars(strip_tags($_POST['mail']));
         $konu = htmlspecialchars(strip_tags($_POST['konu']));
         $captcha = htmlspecialchars(strip_tags($_POST['captcha']));
         $mesaj = htmlspecialchars(strip_tags($_POST['mesaj']));
         $token = htmlspecialchars(strip_tags($_POST['token']));
         $date = date("m-d-Y H:i:s");

         if($token != $_SESSION['token']):
            echo "<div class='alert alert-danger text-center mx-auto'><b>MESAJ</b> -- {$token} -- {$_SESSION['token']} -- Sistem Hatasi... </div>";
         else:
            if($captcha != $_SESSION['codes']):
               echo "<div class='alert alert-danger text-center mx-auto'><b>MESAJ</b> Guvenlik Kodu Hatali... </div>";
            else:
               switch($ayar['mailtercih']):
                  case 1: 
                     $mail->setFrom($mails,$isim); 
                     $mail->addReplyTo($mails,'yanitlaisim');
                     $mail->Subject = $konu;
                     $mail->Body = $mesaj;

                     if($mail->send()):
                        echo "<div class='alert alert-success text-center mx-auto'><b>MESAJ</b> Basariyla Gonderildi... </div>";
                     else:
                        $gelenmail = $connect -> prepare("INSERT INTO gelenmail (name,mail,subject,message,data) VALUES (?,?,?,?,?)");
                        $gelenmail -> bindParam(1, $isim, PDO::PARAM_STR);
                        $gelenmail -> bindParam(2, $mails, PDO::PARAM_STR);
                        $gelenmail -> bindParam(3, $konu, PDO::PARAM_STR);
                        $gelenmail -> bindParam(4, $mesaj, PDO::PARAM_STR);
                        $gelenmail -> bindParam(5, $date, PDO::PARAM_STR);
                        $gelenmail -> execute();

                        echo "<div class='alert alert-success text-center mx-auto'><b>MESAJ</b> Kaydedildi.. </div>";
                     endif;
                  break;
                  case 2: 
                     $mail->setFrom($mails,$isim); 
                     $mail->addReplyTo($mails,'yanitlaisim');
                     $mail->Subject = $konu;
                     $mail->Body = $mesaj;
                     $mail->send();

                     $gelenmail = $connect -> prepare("INSERT INTO gelenmail (name,mail,subject,message,data) VALUES (?,?,?,?,?)");
                     $gelenmail -> bindParam(1, $isim, PDO::PARAM_STR);
                     $gelenmail -> bindParam(2, $mails, PDO::PARAM_STR);
                     $gelenmail -> bindParam(3, $konu, PDO::PARAM_STR);
                     $gelenmail -> bindParam(4, $mesaj, PDO::PARAM_STR);
                     $gelenmail -> bindParam(5, $date, PDO::PARAM_STR);
                     $gelenmail -> execute();

                     echo "<div class='alert alert-success text-center mx-auto'><b>MESAJ</b> Gonderildi Ve Kaydedildi.. 2</div>";
                  break; 
                  case 3: 
                     $gelenmail = $connect -> prepare("INSERT INTO gelenmail (name,mail,subject,message,data) VALUES (?,?,?,?,?)");
                     $gelenmail -> bindParam(1, $isim, PDO::PARAM_STR);
                     $gelenmail -> bindParam(2, $mails, PDO::PARAM_STR);
                     $gelenmail -> bindParam(3, $konu, PDO::PARAM_STR);
                     $gelenmail -> bindParam(4, $mesaj, PDO::PARAM_STR);
                     $gelenmail -> bindParam(5, $date, PDO::PARAM_STR);
                     $gelenmail -> execute();

                     echo "<div class='alert alert-success text-center mx-auto'><b>MESAJ</b> Kaydedildi 3..</div>";
                  break; 
               endswitch;
            endif;
         endif;
      endif;
?>