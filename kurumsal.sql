-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: fdb29.atspace.me
-- Üretim Zamanı: 10 Ağu 2020, 06:00:29
-- Sunucu sürümü: 5.7.20-log
-- PHP Sürümü: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `3527749_kurumsal`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayarlar`
--

CREATE TABLE `ayarlar` (
  `id` int(11) NOT NULL,
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
  `mesajtercih` int(11) NOT NULL DEFAULT '1',
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
  `url` varchar(100) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `ayarlar`
--

INSERT INTO `ayarlar` (`id`, `title`, `metatitle`, `metadesc`, `metakey`, `metaauthor`, `metaowner`, `metacopy`, `logoyazisi`, `twit`, `face`, `ints`, `telefonno`, `adres`, `mailadres`, `slogan_tr`, `slogan_en`, `referansUstBaslik_tr`, `referansUstBaslik_en`, `referansbaslik_tr`, `referansbaslik_en`, `filoUstBaslik_tr`, `filoUstBaslik_en`, `filobaslik_tr`, `filobaslik_en`, `yorumUstBaslik_tr`, `yorumUstBaslik_en`, `yorumbaslik_tr`, `yorumbaslik_en`, `iletisimUstBaslik_tr`, `iletisimUstBaslik_en`, `iletisimbaslik_tr`, `iletisimbaslik_en`, `hizmetlerUstBaslik_tr`, `hizmetlerUstBaslik_en`, `hizmetlerbaslik_tr`, `hizmetlerbaslik_en`, `mesajtercih`, `haritabilgi`, `footer`, `videoustbaslik_tr`, `videoaltbaslik_tr`, `videoustbaslik_en`, `videoaltbaslik_en`, `haberler_tr`, `haberler_en`, `bakimzaman`, `yedekzaman`, `url`) VALUES
(1, 'Udemy Nakliyat ', 'Udemy Nakliyat', 'Uluslar arası nakliyat', 'nakliyat, taşıma, kamyon', 'Udemy Nakliyat TİC', 'Udemy Nakliyat TİC', '2019', 'Udemy Nakliyat', 'http://localhost:8080/PROJELER/kurumsalsite/twit', 'http://localhost:8080/PROJELER/kurumsalsite/face', 'http://localhost:8080/PROJELER/kurumsalsite/inst', '+90 212 111 11 11', 'Evren mah. dünya sok.yer kabuğu apt. no:1 Beylikdüzü', 'info@udemynakliyat.com', 'Nakliyatta Güven', 'We carry in safety ', 'REFERANSLAR ', 'REFERANCES ', 'Burada Refeans bölümünün başlığı olacak ', 'Undertitel of Referances ', 'ARAÇLARIMIZ ', 'OUR VEHICLES ', 'Burada Araçlarımız bölümünün başlığı olacak ', 'Undertitel of our vehicles part ', 'MÜŞTERİ YORUMLARI ', 'CUSTOMER FFEDBACKS ', 'Burada Müşteri yorumları bölümünün başlığı olacak ', 'Feedbacks from our customers ', 'İLETİŞİM ', 'CONTACT ', 'Burada iletişim bölümünün başlığı olacak', 'Contact Form ', 'HİZMETLERİMİZ ', 'SERVICES ', 'Yılların vermiş olduğu tecrübe ile ürünleriniz güvenle taşıyoruz. ', 'Our Services ', 1, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d48187.25741308118!2d28.611613590057516!3d40.98797099143595!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14b55fc19deb0b3b%3A0xdf4ea093f30983c6!2zQmV5bGlrZMO8esO8L8Swc3RhbmJ1bA!5e0!3m2!1str!2str!4v1545739036216', '2019 © Copyright Udemy', 'VİDEOLARIMIZ', 'Şirketimize ait videolar', 'VİDEOS', 'VİDEOS en', 'BİZDEN HABERLER :', 'NEWS :', '30/08/2019 - 14:48', '27/07/2020 - 14:07', 'http://localhost:8080/PROJELER/kurumsalsite');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bulten`
--

CREATE TABLE `bulten` (
  `id` int(11) NOT NULL,
  `mail` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `tel` varchar(10) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `bulten`
--

INSERT INTO `bulten` (`id`, `mail`, `tel`) VALUES
(1, 'olcay@gmail.com', '5058867828'),
(2, 'mehmet@gmail.com', '5058449494'),
(3, 'hakan@gmail.com', '5323148898'),
(4, 'ahmet@gmail.com', '4448877719'),
(9, 'ayse@hotmail.com', '3996660304');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `filomuz`
--

CREATE TABLE `filomuz` (
  `id` int(11) NOT NULL,
  `resimyol` varchar(60) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `filomuz`
--

INSERT INTO `filomuz` (`id`, `resimyol`) VALUES
(1, 'img/filo/1.jpg'),
(2, 'img/filo/2.jpg'),
(3, 'img/filo/3.jpg'),
(4, 'img/filo/4.jpg'),
(5, 'img/filo/5.jpg'),
(6, 'img/filo/6.jpg'),
(7, 'img/filo/7.jpg'),
(8, 'img/filo/8.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `gelenmail`
--

CREATE TABLE `gelenmail` (
  `id` int(11) NOT NULL,
  `ad` varchar(40) COLLATE utf8_turkish_ci NOT NULL,
  `mailadres` varchar(40) COLLATE utf8_turkish_ci NOT NULL,
  `konu` varchar(40) COLLATE utf8_turkish_ci NOT NULL,
  `mesaj` text COLLATE utf8_turkish_ci NOT NULL,
  `zaman` varchar(40) COLLATE utf8_turkish_ci NOT NULL,
  `durum` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `gelenmail`
--

INSERT INTO `gelenmail` (`id`, `ad`, `mailadres`, `konu`, `mesaj`, `zaman`, `durum`) VALUES
(1, 'olcay', 'olci@bumbum.com', 'Deneme konusu', 'içerik içeirk içerik içeirk içerik içeirk', '14.01.2019', 1),
(2, 'mehmet', 'sdds@bumbum.com', 'Deneme konusu', 'içerik içeirk içerik içeirk içerik içeirk', '14.01.2019', 1),
(3, 'berk', 'berk@bumbum.com', 'Deneme konusu', 'içerik içeirk içerik içeirk içerik içeirk', '14.01.2019', 2),
(7, 'ahmet', 'ahmet@hotmail.com', 'mesajımın konusduaduasdu', 'iöeriğim budur adsydasyasydasşdkasşldkasd', '17.01.2019', 1),
(6, 'Yusuf', 'yusuf@bumbum.com', 'Deneme konusu', 'içerik içeirk içerik içeirk içerik içeirk', '14.01.2019', 1),
(8, 'wd', 'dsad', 'dsad', 'sad', '28.01.2019/23:12', 1),
(24, 'Terlik LTD.ŞTİ.', 'olcay', 'dsd', 'dsad', '06.08.2019/13:10', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `gelenmailayar`
--

CREATE TABLE `gelenmailayar` (
  `id` int(11) NOT NULL,
  `host` varchar(40) COLLATE utf8_turkish_ci NOT NULL,
  `mailadres` varchar(40) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(40) COLLATE utf8_turkish_ci NOT NULL,
  `port` int(11) NOT NULL,
  `aliciadres` varchar(40) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `gelenmailayar`
--

INSERT INTO `gelenmailayar` (`id`, `host`, `mailadres`, `sifre`, `port`, `aliciadres`) VALUES
(1, 'free.mboxhosting.com', 'mail@oneproject.ml', 'duDI,O}X2FmomU:u', 465, 'ao_keklik@hotmail.com');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `haberler`
--

CREATE TABLE `haberler` (
  `id` int(11) NOT NULL,
  `icerik_tr` text COLLATE utf8_turkish_ci NOT NULL,
  `icerik_en` text COLLATE utf8_turkish_ci NOT NULL,
  `tarih` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `haberler`
--

INSERT INTO `haberler` (`id`, `icerik_tr`, `icerik_en`, `tarih`) VALUES
(1, 'Türkçe Haber verim-1', 'İng Haber verim-1', '2019-05-02 15:55:33'),
(2, 'Türkçe Haber verim-2', 'İng Haber verim-2', '2019-05-02 15:57:08'),
(5, 'Türkçe Haber verim-3', 'İng Haber verim-3', '2019-05-02 15:57:16');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hakkimizda`
--

CREATE TABLE `hakkimizda` (
  `id` int(11) NOT NULL,
  `baslik_tr` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `baslik_en` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `icerik_tr` text COLLATE utf8_turkish_ci NOT NULL,
  `icerik_en` text COLLATE utf8_turkish_ci NOT NULL,
  `resim` varchar(40) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `hakkimizda`
--

INSERT INTO `hakkimizda` (`id`, `baslik_tr`, `baslik_en`, `icerik_tr`, `icerik_en`, `resim`) VALUES
(1, 'Yeni hakkımızda başlık', 'İngilizce Hakkımızda Başlık', '<p>Yaygın inancın tersine, Lorem Ipsum rastgele sözcüklerden oluşmaz. Kökleri M.Ö. 45 <strong>tarihinden</strong> bu yana klasik Latin edebiyatına<strong> kadar</strong> uzanan 2000 <i>yıllık</i> bir geçmişi vardır. Virginiadaki Hampden-Sydney Collegedan Latince profesörü Richard McClintock, bir Lorem Ipsum pasajında geçen ve anlaşılması en güç sözcüklerden biri olan Yaygın inancın tersine, Lorem Ipsum rastgele sözcüklerden oluşmaz. Kökleri M.Ö. 45 tarihinden bu yana klasik Latin edebiyatına kadar uzanan 2000 yıllık bir geçmişi vardır. Virginiadaki Hampden-Sydney Collegedan Latince profesörü Richard McClintock, bir Lorem Ipsum pasajında geçen ve anlaşılması en güç sözcüklerden biri olan</p>', '<p>İngilizce İçerik <strong>İngilizce</strong> İçerik İngilizce İçerik İngilizce İçerik İngilizce İçerik İngilizce İçerik İngilizce İçerik İngilizce İçerik İngilizce İçerik İngilizce İçerik İngilizce İçerik İngilizce İçerik İngilizce İçerik</p>', 'img/hakkimiz.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hizmetler`
--

CREATE TABLE `hizmetler` (
  `id` int(11) NOT NULL,
  `baslik_tr` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `baslik_en` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `icerik_tr` text COLLATE utf8_turkish_ci NOT NULL,
  `icerik_en` text COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `hizmetler`
--

INSERT INTO `hizmetler` (`id`, `baslik_tr`, `baslik_en`, `icerik_tr`, `icerik_en`) VALUES
(1, 'İthalat', 'yyy', '<p>Ürünlerini,<strong> güvenle</strong> istenilen limandan alarak istenilen limana teslim ediyoruz.</p>', '<p>ooo</p>'),
(2, 'İhracat', 'b', 'Ürünlerini, güvenle istenilen limandan alarak istenilen limana teslim ediyoruz.', 'dsd'),
(4, 'Depoloma', 'c', '<p>Ürünlerinizi depolarımızda güvenle saklıyoruz.</p>', '<p>dasdgfdgfdg</p>'),
(5, 'Çok hızlıyız', 'd', 'Gerçekten epey hızlıyız, sorunsuz taşırız ne var ne yok.', 'dasd');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `intro`
--

CREATE TABLE `intro` (
  `id` int(11) NOT NULL,
  `resimyol` varchar(60) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `intro`
--

INSERT INTO `intro` (`id`, `resimyol`) VALUES
(2, 'img/carousel/2.jpg'),
(3, 'img/carousel/3.jpg'),
(4, 'img/carousel/4.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `linkler`
--

CREATE TABLE `linkler` (
  `id` int(11) NOT NULL,
  `ad_tr` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `ad_en` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `etiket` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `siralama` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `linkler`
--

INSERT INTO `linkler` (`id`, `ad_tr`, `ad_en`, `etiket`, `siralama`) VALUES
(1, 'Anasayfa', 'Homepage', 'body', 1),
(2, 'Hakkımızda', 'About us', 'hakkimizda', 2),
(3, 'Hizmetlerimiz', 'Services', 'hizmetler', 3),
(4, 'Araç Filomuz', 'Gallery', 'filo', 4),
(5, 'iletişim', 'Contact', 'iletisim', 6),
(12, 'Videolar', 'Videos', 'videolar', 5);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mail_sablonlar`
--

CREATE TABLE `mail_sablonlar` (
  `id` int(10) UNSIGNED NOT NULL,
  `baslik` varchar(40) NOT NULL,
  `icerik` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `mail_sablonlar`
--

INSERT INTO `mail_sablonlar` (`id`, `baslik`, `icerik`) VALUES
(2, 'Indirim Kampanyasi', 'Bayraminiz Icin Sizlere Tebrik Dolu Mesajlar Gondermeyi Bir Borc Bilir, Bayraminizi En ICten Dileklerimizle Kutlar, Mutlu Yarinlar Dileriz.'),
(3, 'Bayraminiz Mubarek Olsun', 'Bayraminiz Icin Sizlere Tebrik Dolu Mesajlar Gondermeyi Bir Borc Bilir, Bayraminizi En ICten Dileklerimizle Kutlar, Mutlu Yarinlar Dileriz.'),
(5, 'Zafer Gunu Tebrigi', 'Zafer Gununuzu Tebrik Ederiz..');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `referanslar`
--

CREATE TABLE `referanslar` (
  `id` int(11) NOT NULL,
  `resimyol` varchar(40) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `referanslar`
--

INSERT INTO `referanslar` (`id`, `resimyol`) VALUES
(1, 'img/referans/ref1.png'),
(2, 'img/referans/ref2.png'),
(3, 'img/referans/ref3.png'),
(4, 'img/referans/ref4.png'),
(5, 'img/referans/ref5.png'),
(6, 'img/referans/ref6.png'),
(7, 'img/referans/ref7.png'),
(8, 'img/referans/ref8.png');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `smsayar`
--

CREATE TABLE `smsayar` (
  `id` int(10) UNSIGNED NOT NULL,
  `apikey` varchar(40) NOT NULL,
  `guvkey` varchar(70) NOT NULL,
  `baslik` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `smsayar`
--

INSERT INTO `smsayar` (`id`, `apikey`, `guvkey`, `baslik`) VALUES
(1, '927015198a782709e5a526255bdbddeb', '$2y$12$cAWTHCCSc7xexURw6CjH8uoxcyOAiz9HWK6RqAHpZd1FXwW0mpxhO', 'A.O.Keklik');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tasarim`
--

CREATE TABLE `tasarim` (
  `id` int(11) NOT NULL,
  `hiztercih` int(11) NOT NULL DEFAULT '0',
  `reftercih` int(11) NOT NULL DEFAULT '0',
  `yorumtercih` int(11) NOT NULL DEFAULT '0',
  `videotercih` int(11) NOT NULL DEFAULT '0',
  `bultentercih` int(11) NOT NULL DEFAULT '0',
  `habertercih` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `tasarim`
--

INSERT INTO `tasarim` (`id`, `hiztercih`, `reftercih`, `yorumtercih`, `videotercih`, `bultentercih`, `habertercih`) VALUES
(1, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tasarimbolumler`
--

CREATE TABLE `tasarimbolumler` (
  `id` int(11) NOT NULL,
  `ad` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `classAd` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `siralama` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `tasarimbolumler`
--

INSERT INTO `tasarimbolumler` (`id`, `ad`, `classAd`, `siralama`) VALUES
(1, 'HAKKIMIZDA', 'hakkimizda', 1),
(2, 'HİZMETLER', 'HizmettasarimDuzen', 2),
(3, 'REFERANS', 'ReftasarimDuzen', 3),
(4, 'FİLOMUZ', 'filomuz', 4),
(5, 'VİDEOLAR', 'VideotasarimDuzen', 5),
(6, 'YORUMLAR', 'YorumtasarimDuzen', 6);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `videolar`
--

CREATE TABLE `videolar` (
  `id` int(11) NOT NULL,
  `link` varchar(15) COLLATE utf8_turkish_ci NOT NULL,
  `siralama` int(11) NOT NULL,
  `durum` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `videolar`
--

INSERT INTO `videolar` (`id`, `link`, `siralama`, `durum`) VALUES
(1, 'pHAQA8FJP3c', 2, 1),
(2, 'OKvCV8MFIaw', 3, 0),
(3, 'L3wKzyIN1yk', 1, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yonetim`
--

CREATE TABLE `yonetim` (
  `id` int(11) NOT NULL,
  `kulad` varchar(60) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(60) COLLATE utf8_turkish_ci NOT NULL,
  `aktif` int(11) NOT NULL DEFAULT '0',
  `genelYetki` int(11) NOT NULL DEFAULT '0',
  `introYetki` int(11) NOT NULL DEFAULT '0',
  `aracYetki` int(11) NOT NULL DEFAULT '0',
  `videoYetki` int(11) NOT NULL DEFAULT '0',
  `hakkimizYetki` int(11) NOT NULL DEFAULT '0',
  `hizmetlerYetki` int(11) NOT NULL DEFAULT '0',
  `referansYetki` int(11) NOT NULL DEFAULT '0',
  `tasarimYetki` int(11) NOT NULL DEFAULT '0',
  `yorumYetki` int(11) NOT NULL DEFAULT '0',
  `mesajYetki` int(11) NOT NULL DEFAULT '0',
  `bultenYetki` int(11) NOT NULL DEFAULT '0',
  `haberYetki` int(11) NOT NULL DEFAULT '0',
  `yoneticiYetki` int(11) NOT NULL DEFAULT '0',
  `ayarYetki` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `yonetim`
--

INSERT INTO `yonetim` (`id`, `kulad`, `sifre`, `aktif`, `genelYetki`, `introYetki`, `aracYetki`, `videoYetki`, `hakkimizYetki`, `hizmetlerYetki`, `referansYetki`, `tasarimYetki`, `yorumYetki`, `mesajYetki`, `bultenYetki`, `haberYetki`, `yoneticiYetki`, `ayarYetki`) VALUES
(1, 'olcay', '96de4eceb9a0c2b9b52c0b618819821b', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(8, 'mehmet', '96de4eceb9a0c2b9b52c0b618819821b', 0, 2, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 'merve', '96de4eceb9a0c2b9b52c0b618819821b', 1, 3, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0),
(11, 'tugce', '96de4eceb9a0c2b9b52c0b618819821b', 0, 2, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 0, 0, 0),
(14, 'emre', '96de4eceb9a0c2b9b52c0b618819821b', 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumlar`
--

CREATE TABLE `yorumlar` (
  `id` int(11) NOT NULL,
  `icerik` text COLLATE utf8_turkish_ci NOT NULL,
  `isim` varchar(50) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `yorumlar`
--

INSERT INTO `yorumlar` (`id`, `icerik`, `isim`) VALUES
(1, 'Ürünlerimizi çok iyi taşıdınız aferin size Ürünlerimizi çok iyi taşıdınız aferin size Ürünlerimizi çok iyi taşıdınız aferin size Ürünlerimizi çok iyi taşıdınız aferin size', 'Mahmut'),
(2, 'Ürünlerimizi çok iyi taşıdınız aferin size Ürünlerimizi çok iyi taşıdınız aferin size Ürünlerimizi çok iyi taşıdınız aferin size Ürünlerimizi çok iyi taşıdınız aferin size', 'Terlik LTD.ŞTİ.'),
(3, 'Ürünlerimizi çok iyi taşıdınız aferin size Ürünlerimizi çok iyi taşıdınız aferin size Ürünlerimizi çok iyi taşıdınız aferin size Ürünlerimizi çok iyi taşıdınız aferin size', 'ahmet'),
(4, 'Ürünlerimizi çok iyi taşıdınız aferin size Ürünlerimizi çok iyi taşıdınız aferin size Ürünlerimizi çok iyi taşıdınız aferin size Ürünlerimizi çok iyi taşıdınız aferin size', 'Hüseyin');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ayarlar`
--
ALTER TABLE `ayarlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `bulten`
--
ALTER TABLE `bulten`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `filomuz`
--
ALTER TABLE `filomuz`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `gelenmail`
--
ALTER TABLE `gelenmail`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `gelenmailayar`
--
ALTER TABLE `gelenmailayar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `haberler`
--
ALTER TABLE `haberler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `hakkimizda`
--
ALTER TABLE `hakkimizda`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `hizmetler`
--
ALTER TABLE `hizmetler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `intro`
--
ALTER TABLE `intro`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `linkler`
--
ALTER TABLE `linkler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `mail_sablonlar`
--
ALTER TABLE `mail_sablonlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `referanslar`
--
ALTER TABLE `referanslar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `smsayar`
--
ALTER TABLE `smsayar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tasarim`
--
ALTER TABLE `tasarim`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tasarimbolumler`
--
ALTER TABLE `tasarimbolumler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `videolar`
--
ALTER TABLE `videolar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `yonetim`
--
ALTER TABLE `yonetim`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `ayarlar`
--
ALTER TABLE `ayarlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `bulten`
--
ALTER TABLE `bulten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Tablo için AUTO_INCREMENT değeri `filomuz`
--
ALTER TABLE `filomuz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Tablo için AUTO_INCREMENT değeri `gelenmail`
--
ALTER TABLE `gelenmail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- Tablo için AUTO_INCREMENT değeri `gelenmailayar`
--
ALTER TABLE `gelenmailayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `haberler`
--
ALTER TABLE `haberler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Tablo için AUTO_INCREMENT değeri `hakkimizda`
--
ALTER TABLE `hakkimizda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `hizmetler`
--
ALTER TABLE `hizmetler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Tablo için AUTO_INCREMENT değeri `intro`
--
ALTER TABLE `intro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- Tablo için AUTO_INCREMENT değeri `linkler`
--
ALTER TABLE `linkler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Tablo için AUTO_INCREMENT değeri `mail_sablonlar`
--
ALTER TABLE `mail_sablonlar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Tablo için AUTO_INCREMENT değeri `referanslar`
--
ALTER TABLE `referanslar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Tablo için AUTO_INCREMENT değeri `smsayar`
--
ALTER TABLE `smsayar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `tasarim`
--
ALTER TABLE `tasarim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `tasarimbolumler`
--
ALTER TABLE `tasarimbolumler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Tablo için AUTO_INCREMENT değeri `videolar`
--
ALTER TABLE `videolar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Tablo için AUTO_INCREMENT değeri `yonetim`
--
ALTER TABLE `yonetim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Tablo için AUTO_INCREMENT değeri `yorumlar`
--
ALTER TABLE `yorumlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
