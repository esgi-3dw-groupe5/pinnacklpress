<!-- Default config form Tempalte -->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Pinnackl Press - Installation</title>
		<meta name="description" content="">
		<link rel="stylesheet" href="<?php $this->show('siteUrl')?>template/css/base/base.css">
		<link rel="stylesheet" href="<?php $this->show('siteUrl')?>template/css/forms/forms.css">
		<link rel="stylesheet" href="<?php $this->show('siteUrl')?>template/css/buttons/buttons-core.css">
		<link rel="stylesheet" href="<?php $this->show('siteUrl')?>template/css/buttons/buttons.css">
	</head>
	<body class="pinnackl-background-body">
		<header>
			<nav>
			</nav>
		</header>
		<section>
			<h1>Pinnackl Press</h1>
			<form  class="pinnackl-form pinnackl-form-aligned" action="" method="post">
			<fieldset>
		  	<legend><h3>2nd Step : Create 1st administrator</h3></legend>
				<div class="pinnackl-control-group">
					<label for="pp_login"><span>Admin login : </span></label><input id="pp_login" class="pinnackl-form" type="text" name="pseudo" required>
				</div>
				<div class="pinnackl-control-group">
					<label for="pp_email"><span>Admin email : </span></label><input id="pp_email" class="pinnackl-form" type="email" name="email" required>
				</div>
				<div class="pinnackl-control-group">
					<label for="pp_password"><span>Admin password : </span></label><input id="pp_password" class="pinnackl-form" type="password" name="password" required>
				</div>
				<div class="pinnackl-control-group">
					<label for="pp_confirm"><span>Password confirm : </span></label><input id="pp_confirm" class="pinnackl-form" type="password" name="confirm" required>
				</div>
				<div class="pinnackl-controls">
					<input class="pinnackl-button pinnackl-button-primary" type="submit" name="pp_adConfig" value="Submit">
				</di>
			</fieldset>
			</form>
		</section>
		<aside>
		</aside>
		<footer>
		</footer>
	</body>
</html>