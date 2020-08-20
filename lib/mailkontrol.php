<?php
	@session_start();
	include_once(KOK."lib/fonksiyon.php");

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;	

	class mailkontrol extends kurumsal 
	{
		public $mailsinifi, $bizimmailadresimiz;

		function __construct() {
			parent::__construct("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8",DB_USER,DB_PASS);
			$ayarson = parent::sorgum("select * from gelenmailayar",1);
			
			require KOK.'lib/mail/src/Exception.php';
			require KOK.'lib/mail/src/PHPMailer.php';
			require KOK.'lib/mail/src/SMTP.php';

			$this->mailsinifi= new PHPMailer(true);
			$this->mailsinifi->SMTPDebug=0;
			$this->mailsinifi->isSMTP();
			$this->mailsinifi->CharSet = 'UTF-8';
			$this->mailsinifi->Host =$ayarson["host"];
			$this->mailsinifi->SMTPAuth=true;
			$this->mailsinifi->Username=$ayarson["mailadres"];
			$this->mailsinifi->Password=$ayarson["sifre"];
			$this->mailsinifi->SMTPSecure="tls";
			$this->mailsinifi->Port =$ayarson["port"];
			$this->mailsinifi->isHTML(true);
			$this->bizimmailadresimiz=$ayarson["aliciadres"];
		}

		function mailgonder (array $mailadres=NULL,$mailbaslik,$mailicerik,array $arayuzislem=NULL){
			if (isset($arayuzislem)):		
				$this->mailsinifi->addAddress($this->bizimmailadresimiz); 		
				$this->mailsinifi->setFrom($arayuzislem["mailadresi"],$arayuzislem["ad"]);
				$this->mailsinifi->addReplyTo($arayuzislem["mailadresi"],"Yanıt");
			endif;
			
			if(isset($mailadres)):	
				$this->mailsinifi->setFrom($this->bizimmailadresimiz,$mailbaslik);
				$this->mailsinifi->addReplyTo($this->bizimmailadresimiz,"Yanıt");
			
				foreach ($mailadres as $deger):
					$this->mailsinifi->addAddress($deger);		
				endforeach;	
			endif;		
				
			$this->mailsinifi->Subject=$mailbaslik;
			$this->mailsinifi->Body=$mailicerik;		
			
			return $this->mailsinifi->send();
			
		}

			
		
	}
?>