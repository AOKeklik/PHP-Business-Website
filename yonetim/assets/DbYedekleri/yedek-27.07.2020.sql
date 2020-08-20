SET NAMES utf8;DROP TABLE IF EXISTS ayarlar;

CREATE TABLE `ayarlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `metatitle` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `metadesc` text COLLATE utf8_turkish_ci NOT NULL,
  `metakey` text COLLATE utf8_turkish_ci NOT NULL,
  `metaauthor` varchar(40) COLLATE utf8_turkish_ci NOT NULL,
  `metaowner` varchar(40) COLLATE utf8_turkish_ci NOT NULL,
  `metacopy` varchar(40) COLLATE utf8_turkish_ci NOT NULL,
  `logoyazisi` varchar(40) COLLATE utf8_turkish_ci NOT NULL,
  `twit` varchar(70) COLLATE utf8_turkish_ci NOT NULL,
  `face` varchar(70) COLLATE utf8_turkish_ci NOT NULL,
  `ints` varchar(70) COLLATE utf8_turkish_ci NOT NULL,
  `telefonno` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `adres` varchar(150) COLLATE utf8_turkish_ci NOT NULL,
  `mailadres` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `slogan_tr` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `slogan_en` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `referansUstBaslik_tr` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `referansUstBaslik_en` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `referansbaslik_tr` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `referansbaslik_en` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `filoUstBaslik_tr` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `filoUstBaslik_en` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `filobaslik_tr` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `filobaslik_en` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `yorumUstBaslik_tr` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `yorumUstBaslik_en` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `yorumbaslik_tr` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `yorumbaslik_en` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `iletisimUstBaslik_tr` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `iletisimUstBaslik_en` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `iletisimbaslik_tr` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `iletisimbaslik_en` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `hizmetlerUstBaslik_tr` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `hizmetlerUstBaslik_en` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `hizmetlerbaslik_tr` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `hizmetlerbaslik_en` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `mesajtercih` int(11) NOT NULL DEFAULT 1,
  `haritabilgi` text COLLATE utf8_turkish_ci NOT NULL,
  `footer` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `videoustbaslik_tr` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `videoaltbaslik_tr` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `videoustbaslik_en` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `videoaltbaslik_en` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `haberler_tr` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `haberler_en` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `bakimzaman` varchar(40) COLLATE utf8_turkish_ci NOT NULL,
  `yedekzaman` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `url` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO ayarlar VALUES("1","Udemy Nakliyat ","Udemy Nakliyat","Uluslar arası nakliyat","nakliyat, taşıma, kamyon","Udemy Nakliyat TİC","Udemy Nakliyat TİC","2019","Udemy Nakliyat","http://localhost:8080/PROJELER/kurumsalsite/twit","http://localhost:8080/PROJELER/kurumsalsite/face","http://localhost:8080/PROJELER/kurumsalsite/inst","+90 212 111 11 11","Evren mah. dünya sok.yer kabuğu apt. no:1 Beylikdüzü","info@udemynakliyat.com","Nakliyatta Güven","We carry in safety ","REFERANSLAR ","REFERANCES ","Burada Refeans bölümünün başlığı olacak ","Undertitel of Referances ","ARAÇLARIMIZ ","OUR VEHICLES ","Burada Araçlarımız bölümünün başlığı olacak ","Undertitel of our vehicles part ","MÜŞTERİ YORUMLARI ","CUSTOMER FFEDBACKS ","Burada Müşteri yorumları bölümünün başlığı olacak ","Feedbacks from our customers ","İLETİŞİM ","CONTACT ","Burada iletişim bölümünün başlığı olacak","Contact Form ","HİZMETLERİMİZ ","SERVICES ","Yılların vermiş olduğu tecrübe ile ürünleriniz güvenle taşıyoruz. ","Our Services ","3","https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d48187.25741308118!2d28.611613590057516!3d40.98797099143595!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14b55fc19deb0b3b%3A0xdf4ea093f30983c6!2zQmV5bGlrZMO8esO8L8Swc3RhbmJ1bA!5e0!3m2!1str!2str!4v1545739036216","2019 © Copyright Udemy","VİDEOLARIMIZ","Şirketimize ait videolar","VİDEOS","VİDEOS en","BİZDEN HABERLER :","NEWS :","30/08/2019 - 14:48","25/07/2020 - 13:37","http://localhost:8080/PROJELER/kurumsalsite");



DROP TABLE IF EXISTS bulten;

CREATE TABLE `bulten` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `tel` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO bulten VALUES("1","olcay@gmail.com","5058867828");
INSERT INTO bulten VALUES("2","mehmet@gmail.com","5058449494");
INSERT INTO bulten VALUES("3","hakan@gmail.com","5323148898");
INSERT INTO bulten VALUES("4","ahmet@gmail.com","4448877719");
INSERT INTO bulten VALUES("9","ayse@hotmail.com","3996660304");



DROP TABLE IF EXISTS filomuz;

CREATE TABLE `filomuz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resimyol` varchar(60) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO filomuz VALUES("1","img/filo/1.jpg");
INSERT INTO filomuz VALUES("2","img/filo/2.jpg");
INSERT INTO filomuz VALUES("3","img/filo/3.jpg");
INSERT INTO filomuz VALUES("4","img/filo/4.jpg");
INSERT INTO filomuz VALUES("5","img/filo/5.jpg");
INSERT INTO filomuz VALUES("6","img/filo/6.jpg");
INSERT INTO filomuz VALUES("7","img/filo/7.jpg");
INSERT INTO filomuz VALUES("8","img/filo/8.jpg");



DROP TABLE IF EXISTS gelenmail;

CREATE TABLE `gelenmail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(40) COLLATE utf8_turkish_ci NOT NULL,
  `mailadres` varchar(40) COLLATE utf8_turkish_ci NOT NULL,
  `konu` varchar(40) COLLATE utf8_turkish_ci NOT NULL,
  `mesaj` text COLLATE utf8_turkish_ci NOT NULL,
  `zaman` varchar(40) COLLATE utf8_turkish_ci NOT NULL,
  `durum` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO gelenmail VALUES("1","olcay","olci@bumbum.com","Deneme konusu","içerik içeirk içerik içeirk içerik içeirk","14.01.2019","1");
INSERT INTO gelenmail VALUES("2","mehmet","sdds@bumbum.com","Deneme konusu","içerik içeirk içerik içeirk içerik içeirk","14.01.2019","1");
INSERT INTO gelenmail VALUES("3","berk","berk@bumbum.com","Deneme konusu","içerik içeirk içerik içeirk içerik içeirk","14.01.2019","2");
INSERT INTO gelenmail VALUES("7","ahmet","ahmet@hotmail.com","mesajımın konusduaduasdu","iöeriğim budur adsydasyasydasşdkasşldkasd","17.01.2019","1");
INSERT INTO gelenmail VALUES("6","Yusuf","yusuf@bumbum.com","Deneme konusu","içerik içeirk içerik içeirk içerik içeirk","14.01.2019","1");
INSERT INTO gelenmail VALUES("8","wd","dsad","dsad","sad","28.01.2019/23:12","1");
INSERT INTO gelenmail VALUES("24","Terlik LTD.ŞTİ.","olcay","dsd","dsad","06.08.2019/13:10","1");



DROP TABLE IF EXISTS gelenmailayar;

CREATE TABLE `gelenmailayar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `host` varchar(40) COLLATE utf8_turkish_ci NOT NULL,
  `mailadres` varchar(40) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(40) COLLATE utf8_turkish_ci NOT NULL,
  `port` int(11) NOT NULL,
  `aliciadres` varchar(40) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO gelenmailayar VALUES("1","smtp.gmail.com","blabla","ssifffreee","587","info@udemynakliyat.com");



DROP TABLE IF EXISTS haberler;

CREATE TABLE `haberler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icerik_tr` text COLLATE utf8_turkish_ci NOT NULL,
  `icerik_en` text COLLATE utf8_turkish_ci NOT NULL,
  `tarih` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO haberler VALUES("1","Türkçe Haber verim-1","İng Haber verim-1","2019-05-02 15:55:33");
INSERT INTO haberler VALUES("2","Türkçe Haber verim-2","İng Haber verim-2","2019-05-02 15:57:08");
INSERT INTO haberler VALUES("5","Türkçe Haber verim-3","İng Haber verim-3","2019-05-02 15:57:16");



DROP TABLE IF EXISTS hakkimizda;

CREATE TABLE `hakkimizda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `baslik_tr` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `baslik_en` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `icerik_tr` text COLLATE utf8_turkish_ci NOT NULL,
  `icerik_en` text COLLATE utf8_turkish_ci NOT NULL,
  `resim` varchar(40) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO hakkimizda VALUES("1","Yeni hakkımızda başlık","İngilizce Hakkımızda Başlık","<p>Yaygın inancın tersine, Lorem Ipsum rastgele sözcüklerden oluşmaz. Kökleri M.Ö. 45 <strong>tarihinden</strong> bu yana klasik Latin edebiyatına<strong> kadar</strong> uzanan 2000 <i>yıllık</i> bir geçmişi vardır. Virginiadaki Hampden-Sydney Collegedan Latince profesörü Richard McClintock, bir Lorem Ipsum pasajında geçen ve anlaşılması en güç sözcüklerden biri olan Yaygın inancın tersine, Lorem Ipsum rastgele sözcüklerden oluşmaz. Kökleri M.Ö. 45 tarihinden bu yana klasik Latin edebiyatına kadar uzanan 2000 yıllık bir geçmişi vardır. Virginiadaki Hampden-Sydney Collegedan Latince profesörü Richard McClintock, bir Lorem Ipsum pasajında geçen ve anlaşılması en güç sözcüklerden biri olan</p>","<p>İngilizce İçerik <strong>İngilizce</strong> İçerik İngilizce İçerik İngilizce İçerik İngilizce İçerik İngilizce İçerik İngilizce İçerik İngilizce İçerik İngilizce İçerik İngilizce İçerik İngilizce İçerik İngilizce İçerik İngilizce İçerik</p>","img/hakkimiz.jpg");



DROP TABLE IF EXISTS hizmetler;

CREATE TABLE `hizmetler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `baslik_tr` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `baslik_en` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `icerik_tr` text COLLATE utf8_turkish_ci NOT NULL,
  `icerik_en` text COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO hizmetler VALUES("1","İthalat","yyy","<p>Ürünlerini,<strong> güvenle</strong> istenilen limandan alarak istenilen limana teslim ediyoruz.</p>","<p>ooo</p>");
INSERT INTO hizmetler VALUES("2","İhracat","b","Ürünlerini, güvenle istenilen limandan alarak istenilen limana teslim ediyoruz.","dsd");
INSERT INTO hizmetler VALUES("4","Depoloma","c","<p>Ürünlerinizi depolarımızda güvenle saklıyoruz.</p>","<p>dasdgfdgfdg</p>");
INSERT INTO hizmetler VALUES("5","Çok hızlıyız","d","Gerçekten epey hızlıyız, sorunsuz taşırız ne var ne yok.","dasd");



DROP TABLE IF EXISTS intro;

CREATE TABLE `intro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resimyol` varchar(60) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO intro VALUES("2","img/carousel/2.jpg");
INSERT INTO intro VALUES("3","img/carousel/3.jpg");
INSERT INTO intro VALUES("4","img/carousel/4.jpg");



DROP TABLE IF EXISTS linkler;

CREATE TABLE `linkler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_tr` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `ad_en` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `etiket` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `siralama` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO linkler VALUES("1","Anasayfa","Homepage","body","1");
INSERT INTO linkler VALUES("2","Hakkımızda","About us","hakkimizda","2");
INSERT INTO linkler VALUES("3","Hizmetlerimiz","Services","hizmetler","3");
INSERT INTO linkler VALUES("4","Araç Filomuz","Gallery","filo","4");
INSERT INTO linkler VALUES("5","iletişim","Contact","iletisim","6");
INSERT INTO linkler VALUES("12","Videolar","Videos","videolar","5");



DROP TABLE IF EXISTS referanslar;

CREATE TABLE `referanslar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resimyol` varchar(40) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO referanslar VALUES("1","img/referans/ref1.png");
INSERT INTO referanslar VALUES("2","img/referans/ref2.png");
INSERT INTO referanslar VALUES("3","img/referans/ref3.png");
INSERT INTO referanslar VALUES("4","img/referans/ref4.png");
INSERT INTO referanslar VALUES("5","img/referans/ref5.png");
INSERT INTO referanslar VALUES("6","img/referans/ref6.png");
INSERT INTO referanslar VALUES("7","img/referans/ref7.png");
INSERT INTO referanslar VALUES("8","img/referans/ref8.png");



DROP TABLE IF EXISTS smsayar;

CREATE TABLE `smsayar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `apikey` varchar(40) NOT NULL,
  `guvkey` varchar(70) NOT NULL,
  `baslik` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO smsayar VALUES("1","927015198a782709e5a526255bdbddeb","$2y$12$cAWTHCCSc7xexURw6CjH8uoxcyOAiz9HWK6RqAHpZd1FXwW0mpxhO","A.O.Keklik");



DROP TABLE IF EXISTS tasarim;

CREATE TABLE `tasarim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hiztercih` int(11) NOT NULL DEFAULT 0,
  `reftercih` int(11) NOT NULL DEFAULT 0,
  `yorumtercih` int(11) NOT NULL DEFAULT 0,
  `videotercih` int(11) NOT NULL DEFAULT 0,
  `bultentercih` int(11) NOT NULL DEFAULT 0,
  `habertercih` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO tasarim VALUES("1","0","0","0","0","0","0");



DROP TABLE IF EXISTS tasarimbolumler;

CREATE TABLE `tasarimbolumler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `classAd` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `siralama` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO tasarimbolumler VALUES("1","HAKKIMIZDA","hakkimizda","1");
INSERT INTO tasarimbolumler VALUES("2","HİZMETLER","HizmettasarimDuzen","2");
INSERT INTO tasarimbolumler VALUES("3","REFERANS","ReftasarimDuzen","3");
INSERT INTO tasarimbolumler VALUES("4","FİLOMUZ","filomuz","4");
INSERT INTO tasarimbolumler VALUES("5","VİDEOLAR","VideotasarimDuzen","5");
INSERT INTO tasarimbolumler VALUES("6","YORUMLAR","YorumtasarimDuzen","6");



DROP TABLE IF EXISTS videolar;

CREATE TABLE `videolar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(15) COLLATE utf8_turkish_ci NOT NULL,
  `siralama` int(11) NOT NULL,
  `durum` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO videolar VALUES("1","pHAQA8FJP3c","2","1");
INSERT INTO videolar VALUES("2","OKvCV8MFIaw","3","0");
INSERT INTO videolar VALUES("3","L3wKzyIN1yk","1","1");



DROP TABLE IF EXISTS yonetim;

CREATE TABLE `yonetim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kulad` varchar(60) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(60) COLLATE utf8_turkish_ci NOT NULL,
  `aktif` int(11) NOT NULL DEFAULT 0,
  `genelYetki` int(11) NOT NULL DEFAULT 0,
  `introYetki` int(11) NOT NULL DEFAULT 0,
  `aracYetki` int(11) NOT NULL DEFAULT 0,
  `videoYetki` int(11) NOT NULL DEFAULT 0,
  `hakkimizYetki` int(11) NOT NULL DEFAULT 0,
  `hizmetlerYetki` int(11) NOT NULL DEFAULT 0,
  `referansYetki` int(11) NOT NULL DEFAULT 0,
  `tasarimYetki` int(11) NOT NULL DEFAULT 0,
  `yorumYetki` int(11) NOT NULL DEFAULT 0,
  `mesajYetki` int(11) NOT NULL DEFAULT 0,
  `bultenYetki` int(11) NOT NULL DEFAULT 0,
  `haberYetki` int(11) NOT NULL DEFAULT 0,
  `yoneticiYetki` int(11) NOT NULL DEFAULT 0,
  `ayarYetki` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO yonetim VALUES("1","olcay","96de4eceb9a0c2b9b52c0b618819821b","1","1","1","1","1","1","1","1","1","1","1","1","1","1","1");
INSERT INTO yonetim VALUES("8","mehmet","96de4eceb9a0c2b9b52c0b618819821b","0","2","1","1","1","0","0","0","0","0","0","0","0","0","0");
INSERT INTO yonetim VALUES("9","merve","96de4eceb9a0c2b9b52c0b618819821b","1","3","0","0","0","0","0","0","0","1","0","0","0","0","0");
INSERT INTO yonetim VALUES("11","tugce","96de4eceb9a0c2b9b52c0b618819821b","0","2","1","1","1","1","1","1","1","0","0","1","0","0","0");
INSERT INTO yonetim VALUES("14","emre","96de4eceb9a0c2b9b52c0b618819821b","0","3","0","0","0","0","0","0","0","0","0","0","0","0","0");



DROP TABLE IF EXISTS yorumlar;

CREATE TABLE `yorumlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icerik` text COLLATE utf8_turkish_ci NOT NULL,
  `isim` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO yorumlar VALUES("1","Ürünlerimizi çok iyi taşıdınız aferin size Ürünlerimizi çok iyi taşıdınız aferin size Ürünlerimizi çok iyi taşıdınız aferin size Ürünlerimizi çok iyi taşıdınız aferin size","Mahmut");
INSERT INTO yorumlar VALUES("2","Ürünlerimizi çok iyi taşıdınız aferin size Ürünlerimizi çok iyi taşıdınız aferin size Ürünlerimizi çok iyi taşıdınız aferin size Ürünlerimizi çok iyi taşıdınız aferin size","Terlik LTD.ŞTİ.");
INSERT INTO yorumlar VALUES("3","Ürünlerimizi çok iyi taşıdınız aferin size Ürünlerimizi çok iyi taşıdınız aferin size Ürünlerimizi çok iyi taşıdınız aferin size Ürünlerimizi çok iyi taşıdınız aferin size","ahmet");
INSERT INTO yorumlar VALUES("4","Ürünlerimizi çok iyi taşıdınız aferin size Ürünlerimizi çok iyi taşıdınız aferin size Ürünlerimizi çok iyi taşıdınız aferin size Ürünlerimizi çok iyi taşıdınız aferin size","Hüseyin");



