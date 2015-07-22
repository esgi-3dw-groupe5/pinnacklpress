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
		  	<legend><h3>3rd Step : Setup Pinnackl Press options</h3></legend>
				<div class="pinnackl-control-group">
					<label for="sitename"><span>Site Name : </span></label>
					<input id="sitename" class="pinnackl-input-1-4" type="text" name="sitename" placeholder="Site name" required>
				</div>
				<div class="pinnackl-control-group">
					<label for="sitedescription"><span>Site Description : </span></label>
					<input id="sitedescription" class="pinnackl-input-1-4" type="text" name="sitedescription" placeholder="Site description" required>
				</div>
				<div class="pinnackl-control-group">
					<label for="siteurl"><span>Site URL : </span></label>
					<input id="siteurl" class="pinnackl-input-1-4" type="text" name="siteurl" value="<?php $this->show('siteUrl')?>" placeholder="<?php $this->show('siteUrl')?>">
				</div>
				<div class="pinnackl-controls">
					<input class="pinnackl-button pinnackl-button-primary" type="submit" name="pp_settings" value="Submit">
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