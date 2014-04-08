<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/KMB.ico" " type="image/x-icon" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<meta id='meta_desc' name='Description' content='http://kmb.unit.itb.ac.id merupakan website yang berisi tentang informasi-informasi dari kegiatan-kegiatan yang dilakukan KMB Dhamma&ntilde;ano ITB. Selain itu website ini juga digunakan untuk mempermudah kolaborasi dan penyebaran informasi dari anggota KMB Dhamma&ntilde;ano ITB sendiri.'>
	<?php //<meta id='meta_keywords' name='Keywords' content='Opini.co.id, Opini.com, opini, ahli, komentar, pandangan, tanggapan, wawasan, breaking, news, berita, terkini, terbaru, Indonesia, nasional, internasional, olahraga, sepakbola,bola, IPTEK, teknologi, pendidikan, sosial, budaya, kolom, foto, video.'>");?>
	<meta property='og:title' content='KMB Dhamma&ntilde;ano ITB'>
	<meta property='og:url' content='http://kmb.unit.itb.ac.id'>
	<meta property='og:image' content='<?php echo Yii::app()->request->baseUrl."/images/KMB.png"?>'>

	<title>KMB Dhamma&ntilde;ano ITB</title>
	
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" /> 
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" /> 
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
	
	<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
	<?php Yii::app()->clientScript->registerCoreScript('jquery.ui'); ?>
	<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-31095675-1']);
		_gaq.push(['_setDomainName', 'unit.itb.ac.id']);
		_gaq.push(['_trackPageview']);

		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>
</head>

<body>
	<div id="outerdiv">
		<div id="wrapper">
			<div class="masthead">
				<div id="header">
					<div class="maintitle">
						<div class="logo">
							<?php echo CHtml::image(Yii::app()->request->baseUrl."/images/KMB.png", "LogoKMB", array("")); ?>
						</div>
						<div id="title">
							<h1><?php echo CHtml::encode(Yii::app()->name); ?><small>Dhamma&ntilde;ano ITB</small></h1>	
						</div>
						<div class="logo">
							<?php echo CHtml::image(Yii::app()->request->baseUrl."/images/ITB.png", "LogoITB", array("")); ?>
						</div>
					</div>
				</div>
			</div><!-- header -->

			<div id="container">
				<div id="foxmenucontainer">
					<div id="menu">
						<?php $this->widget('zii.widgets.CMenu',array(
							'items'=>array(
								array('label'=>'Berita', 'url'=>array('/post/index')),
								array('label'=>'Bhadra Bodhi', 'url'=>array('/bb/index')),
								array('label'=>'Profil', 'url'=>array('/profiles/profiles'), 'visible'=>!Yii::app()->user->isGuest),
								array('label'=>'Kalender', 'url'=>array('/site/calendar')),
								/*array('label'=>'Kusaladhana', 'url'=>array('/kusaladhana/viewbrosur'), 'items'=>array(
                                    array('label'=>'Anggaran', 'url'=>array('/kusaladhana/viewanggaran')),
                                    array('label'=>'Brosur', 'url'=>array('/kusaladhana/viewbrosur')),
                                )),*/
								array('label'=>'Kepengurusan', 'url'=>array('/site/about')),
								array('label'=>'Sejarah', 'url'=>array('/site/sejarah')),
								array('label'=>'Survey', 'url'=>array('/survey/index'), 'visible'=>!Yii::app()->user->isGuest),
								array('label'=>'Daftar', 'url'=>array('/site/registration'), 'visible'=>Yii::app()->user->isGuest),
							),
						)); ?>
					</div>
				</div>

				<div class="clear"></div>
				<!-- mainmenu -->

				<?php echo $content; ?>

				<div class="clear"></div>

			</div>
			
			<div id="footer">
				<div class="left" >
					Copyright &copy; KMB Dhamma&ntilde;ano ITB.<br />
					All Rights Reserved. Design by <a href="http://www.fabthemes.com/jovan/">Jovan Theme</a>. <?php echo Yii::powered(); ?>
					<br />
					<div class="clr"></div>
				</div>
				<div class="right">
					<strong>Alamat:</strong>
					Sunken Court E-09, Jl Ganesha No. 10 
					<br />
					Institut Teknologi Bandung
					<br />
					Bandung
					<br />
					<strong>Komentar, kritik, dan saran:</strong>
					<a href="mailto:fernandojordan.92@gmail.com" class="email">fernandojordan.92@gmail.com</a>
				</div>
			</div><!-- footer -->
		</div>
	</div>
	<div id="blacktrans">
		<div id="framebackimg">
			<div id="closebutton">
				<a href="javascript:close()">X</a>
			</div>
			<div id="divbackimg">
				<img id="backimg" src=""/>
			</div>
		</div>
	</div>
	<?php
		if (Yii::app()->user->isGuest)
		{
			echo '
			<div class="panel">
				<div class="form">
					<form action="'.Yii::app()->request->baseUrl.'/site/login" method="post">	
						<div class="row">
							<label for="UserLogin_username">Username</label>		<input name="UserLogin[username]" id="UserLogin_username" type="text" />	
						</div>
						<div class="row">
							<label for="UserLogin_password">Sandi</label>		<input name="UserLogin[password]" id="UserLogin_password" type="password" />	
						</div>
						<div class="row rememberMe" style="float:left;">
							<input id="ytUserLogin_rememberMe" type="hidden" value="0" name="UserLogin[rememberMe]" /><input name="UserLogin[rememberMe]" id="UserLogin_rememberMe" value="1" type="checkbox" /><label for="UserLogin_rememberMe">Ingat saya</label>
						</div>
						<div class="row submit" style="margin-top:45px;">
							<input type="submit" name="yt0" value="Masuk" />	
						</div>
					</form>
				</div><!-- form -->  
			</div>
			<div style="clear:both;"></div>
			</div>
			<a class="trigger" href="#">Masuk</a>
			';
			?>
			<script type="text/javascript">
				$(document).ready(function(){
					$(".trigger").click(function(){
						$(".panel").toggle("fast");
						$(this).toggleClass("active");
						return false;
					});
				});
			</script>
			<?php
		}
		else
		{
			echo '
				<a class="trigger" href="'.Yii::app()->request->baseUrl.'/site/logout">Keluar</a>				
			';
		}
	?>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/all.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/easySlider1.7.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider({
				auto: true, 
				continuous: true,
				controlsShow: false,
				pause: 3300,
			});
		});	
	</script>
	
	</body>
</html>