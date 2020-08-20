<?php 


class yetkiKontrol extends yonetim {
	
			
	//-----------------MEVCUT YETKİ DURUMUNA BAKILIYOR----------------------------------	
	
	function __construct() {
		parent::__construct();//vt baglntisi

		$cookid=$_COOKIE["kulbilgi"];
		$cozduk=parent::coz($cookid);	
		$yetkiBak=parent::sorgum("select * from yonetim  where id=".$cozduk,1);	
		
		$this->genelYetki=$yetkiBak["genelYetki"];
		$this->introYetki=$yetkiBak["introYetki"];
		$this->aracYetki=$yetkiBak["aracYetki"];
		$this->videoYetki=$yetkiBak["videoYetki"];
		$this->hakkimizYetki=$yetkiBak["hakkimizYetki"];
		$this->hizmetlerYetki=$yetkiBak["hizmetlerYetki"];
		$this->referansYetki=$yetkiBak["referansYetki"];
		$this->tasarimYetki=$yetkiBak["tasarimYetki"];
		$this->yorumYetki=$yetkiBak["yorumYetki"];
		$this->mesajYetki=$yetkiBak["mesajYetki"];
		$this->bultenYetki=$yetkiBak["bultenYetki"];
		$this->haberYetki=$yetkiBak["haberYetki"];
		$this->yoneticiYetki=$yetkiBak["yoneticiYetki"];
		$this->ayarYetki=$yetkiBak["ayarYetki"];	
	}
	
	function BolumKontrol($mevcutyetki) {
		if($this->$mevcutyetki!=1):		  
			header("Location:control.php");
			 exit();
		endif;	
	}
	
	function LinkKontrol(){
		
		if ($this->introYetki==1):	echo '<li><a href="control.php?sayfa=introayar"><i class="ti-image"></i> <span>İntro Ayarları</span></a></li>'; endif;
		if ($this->aracYetki==1): echo '<li><a href="control.php?sayfa=aracfilo"><i class="ti-car"></i> <span>Araç Filosu</span></a></li> '; endif;
		if ($this->videoYetki==1):	echo '<li><a href="control.php?sayfa=videolar"><i class="ti-video-clapper"></i> <span>Video Yönetimi</span></a></li>'; endif;
		if ($this->hakkimizYetki==1): echo '<li><a href="control.php?sayfa=hakkimiz"><i class="ti-flag"></i> <span>Hakkımızda Ayarları</span></a></li>'; endif;
		if ($this->hizmetlerYetki==1):	echo '<li><a href="control.php?sayfa=hizmetler"><i class="ti-medall"></i> <span>Hizmetlerimiz Ayarları</span></a></li>'; endif;
		if ($this->referansYetki==1): echo '<li><a href="control.php?sayfa=ref"><i class="ti-eye"></i> <span>Referanslar Ayarları</span></a></li>'; endif;
		if ($this->tasarimYetki==1): echo '<li><a href="control.php?sayfa=tas"><i class="ti-palette"></i> <span>Tasarım  Ayarları</span></a></li>'; endif;
		if ($this->yorumYetki==1): echo '<li><a href="control.php?sayfa=yorumlar"><i class="ti-comment-alt"></i> <span>Müşteri Yorumları</span></a></li>'; endif;
		if ($this->mesajYetki==1): echo '<li><a href="control.php?sayfa=gelenmesaj"><i class="fa fa-envelope"></i> <span>Gelen Mesajlar</span></a></li>'; endif;
		if ($this->bultenYetki==1):
			echo '<li><a href="javascript:void(0)" aria-expanded="true">
      			<i class="fa fa-cog"></i> <span>Iletisim Yonetimi</span></a>
				<ul class="collapse"> 
					<li><a href="control.php?sayfa=bulten"><i class="ti-save-alt"></i> <span>Bülten Ayarları</span></a></li>		
					<li><a href="control.php?sayfa=mailgonderme"><i class="fa fa-envelope"></i> <span>Mail Gonderme</span></a></li>  
				</ul>      
      		</li>';
		endif;
		if ($this->haberYetki==1) : echo '<li><a href="control.php?sayfa=haberler"><i class="ti-save-alt"></i> <span>Haber Ayarları</span></a></li>'; endif;
		if ($this->yoneticiYetki==1) : echo '<li><a href="control.php?sayfa=kulayar"><i class="ti-user"></i> <span>Kullanıcı Ayarları</span></a></li>'; endif;
		if ($this->ayarYetki==1):		
			echo '<li><a href="javascript:void(0)" aria-expanded="true">
      			<i class="fa fa-cog"></i> <span>Ayarlar</span></a>
				<ul class="collapse"> 
					<li><a href="control.php?sayfa=siteayar"><i class="ti-pencil"></i> <span>Site Ayarları</span></a></li>
					<li><a href="control.php?sayfa=smsayar"><i class="fa fa-envelope"></i> <span>SMS Api Ayarları</span></a></li>  		
					<li><a href="control.php?sayfa=mailayar"><i class="fa fa-envelope"></i> <span>Mail Ayarları</span></a></li>  
					<li><a href="control.php?sayfa=linkayar"><i class="fa fa-align-justify"></i> <span>Link Ayarları</span></a></li>   
					<li><a href="control.php?sayfa=bakim"><i class="ti-server"></i> <span>Veritabanı Bakım</span></a></li> 
					<li><a href="control.php?sayfa=yedek"><i class="ti-server"></i> <span>Veritabanı Yedek</span></a></li>    
				</ul>      
      		</li>';
		
		endif;	
        



  






           
        
                   
                   
      
		
	}
	
	

}


?>