<?php
Class IMVerify {
    const IM_PUBLIC_KEY = '7d0091eb9346ad8bb354815b56432651'; // Iletimerkezi api public key, panel ustunden olusturabilirsiniz.
    const IM_SECRET_KEY = '$2y$12$.I40WeRJ9NCrZ3fqdx5dCO4wCHoXzA/I9OAo6jOWK0xN6iOFS/ukK'; // Iletimerkezi api secret key, panel ustunden olusturabilirsiniz.
    const IM_SENDER     = 'ILETI MRKZI'; // Mesajin iletilecegi baslik bilgisi.

    private function createVerificationCode() {
        $_SESSION['vcode'] = rand(100000, 999999);
        return $_SESSION['vcode'];
    }


    

    public function checkIsValid($code) {

        if($code == $_SESSION['vcode']) {
            unset($_SESSION['vcode']);
            return true;
        }

        return false;
    }
}

// Eger sessioni kendi sisteminizde baslatmadiysaniz baslatmaniz gerekir, opsiyonel.
session_start();

// Birinci adim kullanicinin telefonuna dogrulama kodunun iletilmesi.
$im  = new IMVerify();
$gsm = '5057023100'; //$_POST['telefon']; //Kullanicinin girdigi telefon numarasi -> 5050001122... vb
$im->send($gsm); // Kullanicinin telefonuna dogrulama kodunu uretir ve gonderir.

if($im -> send($gsm)):
    echo 'SMS Gonderildi';
else:
    echo 'SMS Gonderildi';
endif;

// Ikinci adim kullanicidan aldigimiz dogrulama kodu dogrumu.
$im     = new IMVerify();
$v_code = $_POST['pin']; // Kullanicinin forma yazdigi dogrulama kodu
if($im->checkIsValid($v_code)) {
    //Dogrulama basarili
} else {
    //Dogrulama basarisiz
}
