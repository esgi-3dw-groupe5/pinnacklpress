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
		  	<legend><h3>1st Step : Database Connection</h3></legend>
				<div class="pinnackl-control-group">
					<label for="db_host"><span>DB Host : </span></label><input id="db_host" class="pinnackl-form" type="text" name="db_host" required>
				</div>
				<div class="pinnackl-control-group">
					<label for="db_name"><span>DB Name : </span></label><input id="db_name" class="pinnackl-form" type="text" name="db_name" required>
				</div>
				<div class="pinnackl-control-group">
					<label for="db_login"><span>DB Login : </span></label><input id="db_login" class="pinnackl-form" type="text" name="db_login" required>
				</div>
				<div class="pinnackl-control-group">
					<label for="db_password"><span>DB Password : </span></label><input id="db_password" class="pinnackl-form" type="password" name="db_password">
				</div>
                <div class="pinnackl-controls">
                    <input class="pinnackl-button pinnackl-button-primary" type="submit" name="pp_dbConfig" value="Submit">
                </div>
			</fieldset>
			</form>
		</section>
		<aside>
		</aside>
		<footer>
		</footer>
	</body>
</html>