<?php
		try{
			$baglanti=new PDO("mysql:host=localhost;dbname=kurumsal;charset=utf8","root","");	
			$baglanti->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);	
		}catch(PDOException $e) {
			die($e->getMessage());
		}

		@$kareket = $_GET["islem"];

		switch ($kareket) :
			case "bultenislem":
				$gelenmail=htmlspecialchars(strip_tags($_POST["mail"]));

				if (!$_POST) :
					echo "Posttan gelmiyorsun";
				else:	
					// girilen adresin gerçekten mail olup olmadığı
					// boş olup olmaması
					$sunucu=substr($gelenmail,strpos($gelenmail,'@')+1);
					
					//olcay@zumazuma.com
					$error=array();
					getmxrr($sunucu,$error);
					
					if (count($error) > 0):	
						// diğer kontroller ve veritabanı ilemiş
						//** gelen mailin daha önce kayıt edilip edilmediğini kontrol edebiliriz.
						$kayiet=$baglanti->prepare("INSERT INTO bulten (mail) VALUES ('$gelenmail')");	
						$kayiet->execute();		
					
						echo '<div class="alert alert-success mt-2">Başarıyla Kayıt Olundu.<br> Teşekkür ederiz.</div>';
					else:
						echo '<div class="alert alert-danger mt-2">Girilen Adres Geçersiz</div>';
					endif;
				endif;
			break;
		endswitch;





?>