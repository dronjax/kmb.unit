<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/KMB.ico" type="image/x-icon" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<meta name='Description' content='http://kmb.unit.itb.ac.id merupakan website yang berisi tentang informasi-informasi tentang KMB Dhamma&ntilde;ano ITB.' />
	<?php //<meta id='meta_keywords' name='Keywords' content='Opini.co.id, Opini.com, opini, ahli, komentar, pandangan, tanggapan, wawasan, breaking, news, berita, terkini, terbaru, Indonesia, nasional, internasional, olahraga, sepakbola,bola, IPTEK, teknologi, pendidikan, sosial, budaya, kolom, foto, video.'>");?>

	<meta property='og:title' content='KMB Dhamma&ntilde;ano ITB' />
	<meta property='og:url' content='http://kmb.unit.itb.ac.id' />
	<meta property='og:image' content='<?php echo Yii::app()->request->baseUrl."/images/KMB.png"?>' />

	<title>KMB Dhamma&ntilde;ano ITB</title>
	
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" /> 
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" /> 
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.css" />
	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
	
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
		<div id="header">
			<div class="wrapper">
				<div id="maintitle">
					<div class="logo">
						<a href="http://kmb.unit.itb.ac.id"><?php echo CHtml::image(Yii::app()->request->baseUrl."/images/KMB.png", "LogoKMB"); ?></a>
					</div>
					<div id="title">
						<h1><a href="http://kmb.unit.itb.ac.id"><?php echo CHtml::encode(Yii::app()->name); ?></a><small>Dhamma&ntilde;ano <a href="http://www.itb.ac.id">Institut Teknologi Bandung</a></small></h1>	
					</div>
					<div id="funky_monk">
					</div>
				</div>
			</div>
			<div class="clear"></div>
				
			<div id="menu">
				<div class="wrapper">
					<?php
						// TODO Efficient this
						$temp_user = Users::model()->findByAttributes(array("username" => Yii::app()->user->name)); 
						$temp_profile = Profiles::model()->findByAttributes(array("user_id" => $temp_user->id));
						$this->widget('bootstrap.widgets.TbMenu',array(
								'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
								'htmlOptions'=>array('style'=>'width:100%;'),
								'encodeLabel'=>false,
								'items'=>array(
									array('label'=>'Berita', 'url'=>array('/post/index')),
									array('label'=>'Bhadra Bodhi', 'url'=>array('/bb/index')),
									array('label'=>'Kalender', 'url'=>array('/site/calendar')),
									array('label'=>'Kusaladhana', 'url'=>array('/kusaladhana/'), 'items'=>array(
	                                    array('label'=>'Anggaran', 'url'=>array('/kusaladhana/viewanggaran')),
	                                    array('label'=>'Brosur', 'url'=>array('/kusaladhana/viewbrosur')),
	                                )),
									array('label'=>'Perihal', 'url'=>array('/site/about')),
									array('label'=>'Survey', 'url'=>array('/survey/index'), 'visible'=>!Yii::app()->user->isGuest),
									array('label'=>'Daftar', 'url'=>array('/site/registration'), 'visible'=>((Yii::app()->user->isGuest) && (Yii::app()->params["kmb_config"]["registration"]))),
									array('label'=>'Masuk', 'url'=>array('#'), 'itemOptions'=>array('id'=>'login_button'), 'visible'=>Yii::app()->user->isGuest),
									array('label'=>'Keluar', 'url'=>array('/site/logout'), 'itemOptions'=>array('id'=>'login_button'), 'visible'=>!Yii::app()->user->isGuest),
									array('label'=>CHtml::image(Yii::app()->request->baseUrl."/images/Users/".$temp_profile->gambar, "Profile Picture", array('id'=>'profile_picture_img')), 'itemOptions'=>array('id'=>'profile_picture'), 'url'=>array('/profiles/profiles'), 'visible'=>!Yii::app()->user->isGuest),
								),
							)); ?>
					<form id="login_form" action="<?php echo Yii::app()->request->baseUrl ?>/site/login" method="post">	
						<div class="row">
							<label for="UserLogin_username">Username</label>		<input name="UserLogin[username]" id="UserLogin_username" type="text" />	
						</div>
						<div class="row">
							<label for="UserLogin_password">Sandi</label>		<input name="UserLogin[password]" id="UserLogin_password" type="password" />	
						</div>
						<div class="row rememberMe">
							<input id="ytUserLogin_rememberMe" type="hidden" value="0" name="UserLogin[rememberMe]" /><input name="UserLogin[rememberMe]" id="UserLogin_rememberMe" value="1" type="checkbox" />
							<label for="UserLogin_rememberMe">Ingat saya</label>
							<a id="forgot_pass_link" href="<?php echo Yii::app()->request->baseUrl ?>/site/forgot_pass">Lupa Sandi</a>
						</div>
						<div class="row submit">
							<input type="submit" name="yt0" value="Masuk" />
						</div>
						<div class="clear"></div>
					</form>
				</div>
				<div class="clear"></div>
				<!-- mainmenu -->
			</div>
		</div>
		<!-- header -->

		<div id="container">
			<div class="wrapper">
				<?php echo $content; ?>
	
				<div class="clear"></div>
			</div>
		</div>
		
		<div id="footer">
			<div class="wrapper">
				<div class="left" >
					<?php if(isset($this->breadcrumbs)):?>
						<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
							'homeLink'=>CHtml::link('Beranda', array('/site/index')),
							'links'=>$this->breadcrumbs,
						)); ?><!-- breadcrumbs -->
					<?php endif?>
					<div id="address">
						<strong>Alamat:</strong>
						Sunken Court E-09, Jl Ganesha No. 10 
						<br />
						Institut Teknologi Bandung
						<br />
						Bandung
						<br />
					</div>
					<div class="clr"></div>
				</div>
				<div class="right">
					Copyright &copy; KMB Dhamma&ntilde;ano ITB.<br />
					
					<strong>Komentar, kritik, dan saran:</strong>
					<a href="mailto:<?php echo Yii::app()->params["kmb_config"]["admin_email"]; ?>" class="email"><?php echo Yii::app()->params["kmb_config"]["admin_email"]; ?></a>
				</div>
			</div>
		</div>
		<!-- footer -->
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
			
			?>
			<script type="text/javascript">
				$(document).ready(function()
				{
					$("#login_button").click(function()
					{
						$("#login_form").toggleClass("active");
						$(this).toggleClass("active2");
						return false;
					});
				});
			</script>
			<?php
		}
	?>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.js" ></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/all.js"></script>
	
	</body>
</html>