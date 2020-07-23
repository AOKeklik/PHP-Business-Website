<?php
// genel ayarlar
    /* define('URL','http://localhost:8080/project/kurumsalsite/');//kok dizin icin
    define('URL_YONETIM','http://localhost:8080/project/kurumsalsite/yonetim/');
    define('IMG_ARAYUZ','http://localhost:8080/project/kurumsalsite/img/');
    define('IMG_YONETIM','http://localhost:8080/project/kurumsalsite/yonetim/assets/images/');

    define('DOCUMENT',$_SERVER['DOCUMENT_ROOT']);//include_once icin 
    define('ARAYUZ',DOCUMENT.'/project/kurumsalsite/');
    define('YONETIM',DOCUMENT.'/project/kurumsalsite/yonetim/'); */

    define('URL','http://oneproject.ml/');//kok dizin icin
    define('URL_YONETIM','http://oneproject.ml/yonetim/');
    define('IMG_ARAYUZ','http://oneproject.ml/img/');
    define('IMG_YONETIM','http://oneproject.ml/yonetim/assets/images/');

    define('DOCUMENT',$_SERVER['DOCUMENT_ROOT']);//include_once icin 
    define('ARAYUZ',DOCUMENT.'/');
    define('YONETIM',DOCUMENT.'/yonetim/');


// ana pdo baglantisi
    define('DB_HOST','sql312.epizy.com');
    define('DB_NAME','epiz_26320372_kurumsal');
    define('DB_USER','epiz_26320372');
    define('DB_PASS','dzpvJgw5T5cOP');
    /* define('DB_HOST','localhost');
    define('DB_NAME','kurumsal');
    define('DB_USER','root');
    define('DB_PASS',''); */

    try{    
        $connect = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8;',DB_USER,DB_PASS);
        $connect -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $err){
        die($err -> getMessage());
    }



?>