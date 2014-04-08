<?php 
	$this->breadcrumbs=array(
		"Mengatur Ulang Sandi",
	);
?>

<div id="title_head">
	<h3>Mengatur ulang Sandi</h3>
	<hr />
</div>

<div class="form">
	<form method="post" action="/site/recover_pass">
		<input type="hidden" name="activation_code" value="<?php echo $model->active_key; ?>"/>
		<div class="row">
			<label for="recover_pass">Sandi Baru</label>
			<input id="recover_pass" name="new_password" type="password" />
		</div>
		<div class="row">
			<label for="recover_pass_again">Sandi Baru Lagi</label>
			<input id="recover_pass_again" name="new_password_again" type="password" />
		</div>
		<div class="row submit">
			<input type="submit" value="Ubah" />
		</div>
	</form>
</div>