SET NAMES utf8;DROP TABLE IF EXISTS ayarlar;

CREATE TABLE `ayarlar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `metaTitle` varchar(50) NOT NULL,
  `metaDescription` text NOT NULL,
  `metaKey` text NOT NULL,
  `metaAuthor` varchar(40) NOT NULL,
  `metaOwner` varchar(40) NOT NULL,
  `metaCopy` varchar(40) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `twitter` varchar(70) NOT NULL,
  `facebook` varchar(70) NOT NULL,
  `instagram` varchar(70) NOT NULL,
  `header_tr` text NOT NULL,
  `header_en` text NOT NULL,
  `header_pl` text NOT NULL,
  `news_title_tr` varchar(50) NOT NULL,
  `news_title_en` varchar(50) NOT NULL,
  `news_title_pl` varchar(50) NOT NULL,
  `hizmet_header_tr` varchar(50) NOT NULL,
  `hizmet_header_en` varchar(50) NOT NULL,
  `hizmet_header_pl` varchar(50) NOT NULL,
  `hizmet_tr` text NOT NULL,
  `hizmet_en` text NOT NULL,
  `hizmet_pl` text NOT NULL,
  `referans_header_tr` varchar(50) NOT NULL,
  `referans_header_en` varchar(50) NOT NULL,
  `referans_header_pl` varchar(50) NOT NULL,
  `referans_tr` text NOT NULL,
  `referans_en` text NOT NULL,
  `referans_pl` text NOT NULL,
  `filo_header_tr` varchar(50) NOT NULL,
  `filo_header_en` varchar(50) NOT NULL,
  `filo_header_pl` varchar(50) NOT NULL,
  `filo_tr` text NOT NULL,
  `filo_en` text NOT NULL,
  `filo_pl` text NOT NULL,
  `yorum_header_tr` varchar(50) NOT NULL,
  `yorum_header_en` varchar(50) NOT NULL,
  `yorum_header_pl` varchar(50) NOT NULL,
  `yorum_tr` text NOT NULL,
  `yorum_en` text NOT NULL,
  `yorum_pl` text NOT NULL,
  `video_header_tr` varchar(100) NOT NULL,
  `video_header_en` varchar(100) NOT NULL,
  `video_header_pl` varchar(100) NOT NULL,
  `video_tr` text NOT NULL,
  `video_en` text NOT NULL,
  `video_pl` text NOT NULL,
  `iletisim_header_tr` varchar(50) NOT NULL,
  `iletisim_header_en` varchar(50) NOT NULL,
  `iletisim_header_pl` varchar(50) NOT NULL,
  `iletisim_tr` text NOT NULL,
  `iletisim_en` text NOT NULL,
  `iletisim_pl` text NOT NULL,
  `phone` varchar(25) NOT NULL,
  `adress` varchar(150) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `map` text NOT NULL,
  `mailtercih` int(11) NOT NULL DEFAULT 0,
  `footer` varchar(250) NOT NULL,
  `bakim` varchar(250) NOT NULL,
  `yedek` varchar(250) NOT NULL,
  `url` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO ayarlar VALUES("1","asX","asc","asC","asc","aSC","asc","aSC","Udemy &lt;span&gt;Nakliyat&lt;/span&gt;","https://www.twitter.com","https://www.facebook.com","https://www.instagram.com","Guvenle Tasiyoruz &lt;br&gt; Tasimacilikta Dev","English Englis &lt;br&gt; English","Polish Polish &lt;br&gt; Polish","Bizden Haberler: ","News From Us:","Wiadomości Od Nas:","Hizmetlerimiz","Services","Usługi","Yılların vermiş olduğu tecrübe ile ürünleriniz güv yılların vermiş olduğu tecrübe ile ürünleriniz güv.","hizmet_en","hizmet_pl","Referanslar","Referances","Polishlang","referans_tr","referans_en","referans_pl","Filomuz","Vehicle Fleet","Flota Pojazdów","filo_tr","filo_en","filo_pl","Yorumlar","Comments","Commentasz","yorum_tr","yorum_en","yorum_pl","Videolar","Videos","Filmy","video_tr","video_en","video_pl","Iletisim","Contact","Kontakt","iletisim_tr","iletisim_en","iletisim_pl","+48 888 999 777","Verbug Ul. Sentenberg No: 22, Num: 33, Katowice/Polska","udemy@mail.com","https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d163403.6871703345!2d18.867108940569288!3d50.21380790393959!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4716ce2336a1ccd1%3A0xb9af2a350559fabb!2sKatovi%C3%A7e%2C%20Polonya!5e0!3m2!1str!2str!4v1595014661765!5m2!1str!2str","3","2020 © Copyright &lt;strong&gt;Udemy&lt;/strong&gt;","06-07-2020 16:31:27","18-07-2020 06:54:30","http://localhost:8080/project/kurumsalsite/");



DROP TABLE IF EXISTS bulten;

CREATE TABLE `bulten` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mail` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

INSERT INTO bulten VALUES("1","adana@sedef.com");
INSERT INTO bulten VALUES("3","fruze@cicek.com");
INSERT INTO bulten VALUES("4","abiye@elbise.com");
INSERT INTO bulten VALUES("7","adana@saray.com");
INSERT INTO bulten VALUES("8","figurem@cicek.com");
INSERT INTO bulten VALUES("11","adana@meral.com");
INSERT INTO bulten VALUES("20","figure@cicek.com");



DROP TABLE IF EXISTS filomuz;

CREATE TABLE `filomuz` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `picturepath` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `data` varchar(50) NOT NULL,
  `statu` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

INSERT INTO gelenmail VALUES("1","Hasan Arslan","arslan@gmail.com","Lorem ipsum dolor sit amet.","Ilgili Urunun Alis Tarihinden 3 Is Gunu Sonra Hatasi Ve Kusuru Tesbit Edilmis Ve Ilgili Urun Geri Iade Edilmek Uzere Tarafiniza Post Yoluyla Gonderilmistir. ","1980-06-01 08:57:12","0");
INSERT INTO gelenmail VALUES("2","Fevzi Cakmak","cakmak@mail.com","Lorem ipsum dolor sit amet.","Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam architecto itaque pariatur eligendi saepe. Similique maxime maiores tenetur voluptates quaerat incidunt, error autem mollitia delectus. Adipisci sunt inventore doloremque sit.","1980-06-01 08:57:12","0");
INSERT INTO gelenmail VALUES("3","Semsettin Bayramoglu","bayram@hotmail.com","Lorem ipsum dolor sit amet.","Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam architecto itaque pariatur eligendi saepe. Similique maxime maiores tenetur voluptates quaerat incidunt, error autem mollitia delectus. Adipisci sunt inventore doloremque sit.","1980-06-01 08:57:12","0");
INSERT INTO gelenmail VALUES("4","Esref Akman","akman@mail.com","Lorem ipsum dolor sit amet.","Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam architecto itaque pariatur eligendi saepe. Similique maxime maiores tenetur voluptates quaerat incidunt, error autem mollitia delectus. Adipisci sunt inventore doloremque sit.","1980-06-01 08:57:12","0");
INSERT INTO gelenmail VALUES("5","Zekai Aydin","aydin@mail.com","Lorem ipsum dolor sit amet.","Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam architecto itaque pariatur eligendi saepe. Similique maxime maiores tenetur voluptates quaerat incidunt, error autem mollitia delectus. Adipisci sunt inventore doloremque sit.","1980-06-01 08:57:12","1");
INSERT INTO gelenmail VALUES("6","Ali Riza Kurum","kurum@gmail.com","Lorem ipsum dolor sit amet.","Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam architecto itaque pariatur eligendi saepe. Similique maxime maiores tenetur voluptates quaerat incidunt, error autem mollitia delectus. Adipisci sunt inventore doloremque sit.","1980-06-01 08:57:12","1");
INSERT INTO gelenmail VALUES("7","Asim Sirel","sirel@hotmail.com","Lorem ipsum dolor sit amet.","Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam architecto itaque pariatur eligendi saepe. Similique maxime maiores tenetur voluptates quaerat incidunt, error autem mollitia delectus. Adipisci sunt inventore doloremque sit.","1980-06-01 08:57:12","2");
INSERT INTO gelenmail VALUES("8","Ali Fuat","fuat@mail.com","Lorem ipsum dolor sit amet.","Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam architecto itaque pariatur eligendi saepe. Similique maxime maiores tenetur voluptates quaerat incidunt, error autem mollitia delectus. Adipisci sunt inventore doloremque sit.","1980-06-01 08:57:12","0");
INSERT INTO gelenmail VALUES("9","Sena Yildiz","yildiz@gerna.com","Lorem ipsum dolor sit amet.","Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam architecto itaque pariatur eligendi saepe. Similique maxime maiores tenetur voluptates quaerat incidunt, error autem mollitia delectus. Adipisci sunt inventore doloremque sit.","1980-06-01 08:57:12","0");
INSERT INTO gelenmail VALUES("11","Ersan Yayla","yayla@gerna.com","Lorem ipsum dolor sit amet.","Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam architecto itaque pariatur eligendi saepe. Similique maxime maiores tenetur voluptates quaerat incidunt, error autem mollitia delectus. Adipisci sunt inventore doloremque sit.","1980-06-01 08:57:12","2");
INSERT INTO gelenmail VALUES("12","Ramazan Bircan","bircan@gmail.com","Lorem ipsum dolor sit amet.","Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam architecto itaque pariatur eligendi saepe. Similique maxime maiores tenetur voluptates quaerat incidunt, error autem mollitia delectus. Adipisci sunt inventore doloremque sit.","1980-06-01 08:57:12","0");
INSERT INTO gelenmail VALUES("13","/lskdmcl/akdC","akls;mc'al;C","A'sckmpaSKLC","asklmc'aklMC'","07-05-2020 19:52:57","0");
INSERT INTO gelenmail VALUES("14","/lkml'k","/lsdkm'lkDMC","al'ksmc'kaMC","ALksmc'kaDMC","07-05-2020 19:55:22","0");
INSERT INTO gelenmail VALUES("15","","","","","07-09-2020 10:26:59","0");
INSERT INTO gelenmail VALUES("16","","","","","07-10-2020 19:40:35","0");
INSERT INTO gelenmail VALUES("17","Adiniz Soyadiniz","udemy@mail.com","Konu Konu"," Mesaj Mesaj Mesaj Mesaj Mesaj Mesaj Mesaj Mesaj Mesaj Mesaj  Mesaj Mesaj Mesaj Mesaj Mesaj Mesaj Mesaj Mesaj Mesaj Mesaj  Mesaj Mesaj Mesaj Mesaj Mesaj Mesaj Mesaj Mesaj Mesaj Mesaj","07-15-2020 17:41:20","0");
INSERT INTO gelenmail VALUES("18","Adiniz Soyadiniz","mail@mail.com","Konu Konu"," Mesaj Mesaj Mesaj Mesaj Mesaj Mesaj Mesaj Mesaj Mesaj Mesaj  Mesaj Mesaj Mesaj Mesaj Mesaj Mesaj Mesaj Mesaj Mesaj Mesaj  Mesaj Mesaj Mesaj Mesaj Mesaj Mesaj Mesaj Mesaj Mesaj Mesa","07-15-2020 17:42:09","0");
INSERT INTO gelenmail VALUES("19","SADCsdavc","sDVCsadvc","sDCsadvc","sDVsdvsdV","07-15-2020 19:26:12","0");



DROP TABLE IF EXISTS gelenmailayar;

CREATE TABLE `gelenmailayar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `host` varchar(50) NOT NULL,
  `port` int(11) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `receiver` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO gelenmailayar VALUES("1","smtp.gmail.com","587","info@udemynakliyat.com","info@udemynakliyat.com","123");



DROP TABLE IF EXISTS haberler;

CREATE TABLE `haberler` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `header` varchar(250) NOT NULL,
  `news_tr` text NOT NULL,
  `news_en` text NOT NULL,
  `news_pl` text NOT NULL,
  `dates` datetime NOT NULL DEFAULT current_timestamp(),
  `orders` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO haberler VALUES("1","news 1","Yaygın inancın tersine, Lorem Ipsum rastgele sözcüklerden oluşmaz. ","Contrary to popular belief, Lorem Ipsum is not simply random text. ","W przeciwieństwie do rozpowszechnionych opinii, Lorem Ipsum nie jest tylko przypadkowym tekstem.","2020-07-14 14:29:25","1");
INSERT INTO haberler VALUES("2","news 2","Yaygın inancın tersine, Lorem Ipsum rastgele sözcüklerden oluşmaz.","Contrary to popular belief, Lorem Ipsum is not simply random text.","W przeciwieństwie do rozpowszechnionych opinii, Lorem Ipsum nie jest tylko przypadkowym tekstem.","2020-07-13 18:33:07","2");
INSERT INTO haberler VALUES("3","news 3","Yaygın inancın tersine, Lorem Ipsum rastgele sözcüklerden oluşmaz.","Contrary to popular belief, Lorem Ipsum is not simply random text.","W przeciwieństwie do rozpowszechnionych opinii, Lorem Ipsum nie jest tylko przypadkowym tekstem.","2020-07-13 18:33:07","3");
INSERT INTO haberler VALUES("4","news 4","Yaygın inancın tersine, Lorem Ipsum rastgele sözcüklerden oluşmaz.","Contrary to popular belief, Lorem Ipsum is not simply random text.","W przeciwieństwie do rozpowszechnionych opinii, Lorem Ipsum nie jest tylko przypadkowym tekstem.","2020-07-13 18:45:12","4");
INSERT INTO haberler VALUES("5","news 5","Yaygın inancın tersine, Lorem Ipsum rastgele sözcüklerden oluşmaz.","Contrary to popular belief, Lorem Ipsum is not simply random text.","W przeciwieństwie do rozpowszechnionych opinii, Lorem Ipsum nie jest tylko przypadkowym tekstem.","2020-07-13 18:45:48","5");
INSERT INTO haberler VALUES("6","news 6","Yaygın inancın tersine, Lorem Ipsum rastgele sözcüklerden oluşmaz.","Contrary to popular belief, Lorem Ipsum is not simply random text.","W przeciwieństwie do rozpowszechnionych opinii, Lorem Ipsum nie jest tylko przypadkowym tekstem.","2020-07-13 18:33:07","6");



DROP TABLE IF EXISTS hakkimizda;

CREATE TABLE `hakkimizda` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `header_tr` varchar(150) NOT NULL,
  `header_en` varchar(150) NOT NULL,
  `header_pl` varchar(150) NOT NULL,
  `content_tr` text NOT NULL,
  `content_en` text NOT NULL,
  `content_pl` text NOT NULL,
  `picture` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO hakkimizda VALUES("1","Hakkimizda Merak Ettiginiz Hersey..","Everything You Wonder About Us..","Wszystko, co o nas zastanawiasz..","&lt;p&gt;Lorem Ipsum, dizgi ve baskı endüstrisinde kullanılan mıgır metinlerdir. Lorem Ipsum, adı bilinmeyen bir matbaacının bir hurufat numune kitabı oluşturmak üzere bir yazı galerisini alarak karıştırdığı 1500'lerden beri endüstri standardı sahte metinler olarak kullanılmıştır. Beşyüz yıl boyunca varlığını sürdürmekle kalmamış, aynı zamanda pek değişmeden elektronik dizgiye de sıçramıştır.&lt;/p&gt;","&lt;p&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;","&lt;p&gt;Lorem Ipsum jest tekstem stosowanym jako przykładowy wypełniacz w przemyśle poligraficznym. Został po raz pierwszy użyty w XV w. przez nieznanego drukarza do wypełnienia tekstem próbnej książki. Pięć wieków później zaczął być używany przemyśle elektronicznym, pozostając praktycznie niezmienionym. Spopularyzował się w latach 60.&lt;/p&gt;","img/hakkimiz.jpg");



DROP TABLE IF EXISTS hizmetler;

CREATE TABLE `hizmetler` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `icon` varchar(255) NOT NULL,
  `title_tr` varchar(250) NOT NULL,
  `title_en` varchar(250) NOT NULL,
  `title_pl` varchar(250) NOT NULL,
  `content_tr` text NOT NULL,
  `content_en` text NOT NULL,
  `content_pl` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO hizmetler VALUES("2","fa fa-picture-o","Baslik 1","Header 1","Nagłówek 1","&lt;p&gt;Yinelenen bir sayfa içeriğinin okuyucunun dikkatini dağıttığı bilinen bir gerçektir.&lt;/p&gt;","&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscingLorem ipsum dolor sit amet, consectetur adipiscing..&lt;/p&gt;","&lt;p&gt;Jest dostępnych wiele różnych wersji Lorem Ipsum, ale większość zmieniła się pod wpływem dodanego humoru czy przypadkowych słów.&lt;/p&gt;");
INSERT INTO hizmetler VALUES("3","fa fa-map","Baslik 2","Header 2","Nagłówek 2","Yinelenen bir sayfa içeriğinin okuyucunun dikkatini dağıttığı bilinen bir gerçektir.","Lorem ipsum dolor sit amet, consectetur adipiscingLorem ipsum dolor sit amet, consectetur adipiscing..","Jest dostępnych wiele różnych wersji Lorem Ipsum, ale większość zmieniła się pod wpływem dodanego humoru czy przypadkowych słów, które..");
INSERT INTO hizmetler VALUES("4","fa fa-shopping-bag","Baslik 3","Header 3","Nagłówek 3","Yinelenen bir sayfa içeriğinin okuyucunun dikkatini dağıttığı bilinen bir gerçektir.","Lorem ipsum dolor sit amet, consectetur adipiscingLorem ipsum dolor sit amet, consectetur adipiscing..","Jest dostępnych wiele różnych wersji Lorem Ipsum, ale większość zmieniła się pod wpływem dodanego humoru czy przypadkowych słów, które..");
INSERT INTO hizmetler VALUES("6","fa fa-bar-chart","Baslik 4","Header 4","Nagłówek 4","Yinelenen bir sayfa içeriğinin okuyucunun dikkatini dağıttığı bilinen bir gerçektir. ","Lorem ipsum dolor sit amet, consectetur adipiscingLorem ipsum dolor sit amet, consectetur adipiscing..","Jest dostępnych wiele różnych wersji Lorem Ipsum, ale większość zmieniła się pod wpływem dodanego humoru czy przypadkowych słów, które..");



DROP TABLE IF EXISTS intro;

CREATE TABLE `intro` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `picturepath` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

INSERT INTO intro VALUES("1","img/carousel/1.jpg");
INSERT INTO intro VALUES("2","img/carousel/2.jpg");
INSERT INTO intro VALUES("3","img/carousel/3.jpg");
INSERT INTO intro VALUES("4","img/carousel/4.jpg");
INSERT INTO intro VALUES("5","img/carousel/5.jpg");



DROP TABLE IF EXISTS linkler;

CREATE TABLE `linkler` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_tr` varchar(50) NOT NULL,
  `name_en` varchar(50) NOT NULL,
  `name_pl` varchar(50) NOT NULL,
  `tag` varchar(50) NOT NULL,
  `orders` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO linkler VALUES("1","Anasayfa","Home","Strona Główna","body","1");
INSERT INTO linkler VALUES("2","Hakkimizda","About Us","O Nas","hakkimizda","2");
INSERT INTO linkler VALUES("3","Hizmetlerimiz","Our Services","Nasze Usługi","hizmetler","3");
INSERT INTO linkler VALUES("4","Filomuz","Products","Produkty","filo","4");
INSERT INTO linkler VALUES("5","Videolar","Videos","Filmy","videolar","5");
INSERT INTO linkler VALUES("6","Iletisim","Contact","Kontakt","iletisim","6");



DROP TABLE IF EXISTS referanslar;

CREATE TABLE `referanslar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `picturepath` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO referanslar VALUES("1","img/referans/ref1.png");
INSERT INTO referanslar VALUES("2","img/referans/ref2.png");
INSERT INTO referanslar VALUES("3","img/referans/ref3.png");
INSERT INTO referanslar VALUES("4","img/referans/ref4.png");
INSERT INTO referanslar VALUES("5","img/referans/ref5.png");
INSERT INTO referanslar VALUES("6","img/referans/ref6.png");
INSERT INTO referanslar VALUES("7","img/referans/ref7.png");
INSERT INTO referanslar VALUES("8","img/referans/ref8.png");



DROP TABLE IF EXISTS tasarim;

CREATE TABLE `tasarim` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `haberler` int(11) NOT NULL,
  `hizmetler` int(11) NOT NULL DEFAULT 0,
  `referanslar` int(11) NOT NULL DEFAULT 0,
  `yorumlar` int(11) NOT NULL DEFAULT 0,
  `videolar` int(11) NOT NULL DEFAULT 0,
  `bultenler` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO tasarim VALUES("1","0","0","0","0","0","0");



DROP TABLE IF EXISTS tasarimbolumler;

CREATE TABLE `tasarimbolumler` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `classname` varchar(50) NOT NULL,
  `orders` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

INSERT INTO tasarimbolumler VALUES("1","HAKKIMIZDA","hakkimizda","1");
INSERT INTO tasarimbolumler VALUES("2","HIZMETLER","tasarimhizmetler","2");
INSERT INTO tasarimbolumler VALUES("3","REFERANSLAR","tasarimreferanslar","3");
INSERT INTO tasarimbolumler VALUES("4","FILOMUZ","filomuz","4");
INSERT INTO tasarimbolumler VALUES("5","YORUMLAR","tasarimyorumlar","5");
INSERT INTO tasarimbolumler VALUES("6","VIDOLAR","tasarimvideolar","6");



DROP TABLE IF EXISTS videolar;

CREATE TABLE `videolar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `link` varchar(50) NOT NULL,
  `orders` int(11) NOT NULL,
  `statu` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

INSERT INTO videolar VALUES("1","A-JiXw4tiiM","1","0");
INSERT INTO videolar VALUES("2","A-JiXw4tiiM","2","0");
INSERT INTO videolar VALUES("3","A-JiXw4tiiM","3","1");
INSERT INTO videolar VALUES("4","A-JiXw4tiiM","4","0");
INSERT INTO videolar VALUES("5","A-JiXw4tiiM","5","1");
INSERT INTO videolar VALUES("8","Kc2tl61TrN0","6","0");
INSERT INTO videolar VALUES("11","cpjby8K70AM","7","1");



DROP TABLE IF EXISTS yonetim;

CREATE TABLE `yonetim` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `password` varchar(100) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `authority` int(11) NOT NULL DEFAULT 0,
  `ayar` int(11) NOT NULL DEFAULT 0,
  `siteayar` int(11) NOT NULL DEFAULT 0,
  `yonetimm` int(11) NOT NULL DEFAULT 0,
  `mailayar` int(11) NOT NULL DEFAULT 0,
  `tasarim` int(11) NOT NULL DEFAULT 0,
  `bakim` int(11) NOT NULL DEFAULT 0,
  `link` int(11) NOT NULL DEFAULT 0,
  `bulten` int(11) NOT NULL DEFAULT 0,
  `haber` int(11) NOT NULL DEFAULT 0,
  `istatistik` int(11) NOT NULL DEFAULT 0,
  `intro` int(11) NOT NULL DEFAULT 0,
  `hakkimizda` int(11) NOT NULL DEFAULT 0,
  `hizmet` int(11) NOT NULL DEFAULT 0,
  `referans` int(11) NOT NULL DEFAULT 0,
  `filo` int(11) NOT NULL DEFAULT 0,
  `yorum` int(11) NOT NULL DEFAULT 0,
  `mesaj` int(11) NOT NULL DEFAULT 0,
  `video` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

INSERT INTO yonetim VALUES("1","abdullah","96de4eceb9a0c2b9b52c0b618819821b","1","1","1","1","1","1","1","1","1","1","1","1","1","1","1","1","1","1","1","1");
INSERT INTO yonetim VALUES("2","cansu","0af2e8b1e4a91c959f3f8ed885a39f1c","0","2","1","1","0","0","1","0","1","0","1","0","1","1","1","1","1","1","0","1");
INSERT INTO yonetim VALUES("5","hakan","96de4eceb9a0c2b9b52c0b618819821b","0","3","1","0","0","0","0","0","0","0","0","0","0","0","0","0","0","1","0","0");



DROP TABLE IF EXISTS yorumlar;

CREATE TABLE `yorumlar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO yorumlar VALUES("1","&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscingLorem ipsum dolor sit amet, consectetur adipiscing Lorem ipsum dolor sit amet, consectetur adipiscingLorem ipsum dolor sit amet, consectetur adipiscing Lorem ipsum dolor sit amet, consectetur adipiscingLorem ipsum dolor sit amet, consectetur adipiscing&lt;/p&gt;","Ahmet Hakan");
INSERT INTO yorumlar VALUES("2","Lorem ipsum dolor sit amet, consectetur adipiscingLorem ipsum dolor sit amet, consectetur adipiscing
","Semsi Inkaya");
INSERT INTO yorumlar VALUES("3","Lorem ipsum dolor sit amet, consectetur adipiscingLorem ipsum dolor sit amet, consectetur adipiscing
","Fehmi Uyar");
INSERT INTO yorumlar VALUES("4","Lorem ipsum dolor sit amet, consectetur adipiscingLorem ipsum dolor sit amet, consectetur adipiscing
","Timur Fernan");
INSERT INTO yorumlar VALUES("5","Lorem ipsum dolor sit amet, consectetur adipiscingLorem ipsum dolor sit amet, consectetur adipiscing
","Garen Bulduk");



