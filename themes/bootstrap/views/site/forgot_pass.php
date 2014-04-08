<?php 
	$this->breadcrumbs=array(
		"Lupa Sandi",
	);
?>

<div id="title_head">
	<h3>Lupa Sandi</h3>
	<hr />
</div>

<div class="form">
	<form method="post" action="/site/forgot_pass">
		<div class="row">
			<label for="forgot_email">Email</label>
			<input id="forgot_email" name="email" type="text" />
		</div>
		<div class="row submit">
			<input type="submit" value="Kirim" />
		</div>
	</form>
</div>