<?php
    include_once('../config/baglan.php');
    include_once(YONETIM.'assets/functions.php');
    include_once(YONETIM.'assets/functions2.php');
    $yonetim2 = new Yonetim2();
    $yonetim = new Yonetim();

    $yonetim2 -> kontrolet('index');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <title>Udemy Nakliyat-Yönetim Paneli</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">    
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">   
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>

<?php if(empty($_POST)): ?>
<!-- FORM -->
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form action="" method="POST">
                    <div class="login-form-head">
                        <h4>YONETIM PANELI</h4>
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="kuladlab">Kullanici Adi</label>
                            <input type="text" name="kulad" id="kuladlab">
                            <i class="ti-user"></i>
                        </div>

                        <div class="form-gp">
                            <label for="sifrelab">Parola</label>
                            <input type="password" name="sifre" id="sifrelab">
                            <i class="ti-user"></i>
                        </div>

                        <div class="submit-btn-area">
                            <input type="submit" class="btn btn-dark" value="GIRIS YAP">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- FORM -->
<?php
    else:
        $kulad = htmlspecialchars($_POST['kulad']);
        $sifre = htmlspecialchars($_POST['sifre']);
        
        if($kulad === '' || $sifre === ''):
            echo "<div class='container'>
                <div class='col-md-12 alert alert-warning border border-success mt-4 font-14 text-center'>
                    <b>Lutfen!</b> Tum Alanlari Dondurunuz..
                </div>
            </div>";
            header('refresh:2, url=index.php');
        else:
            $yonetim -> giriskontrol($kulad,$sifre);
        endif;
    endif;

?>
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>  
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>
</html>
