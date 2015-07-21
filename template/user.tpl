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
        <script type="text/javascript" src="<?php $this->show('siteUrl')?>template/js/install.js"></script>
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
		  	<legend><h3>2nd Step : Create Superadministrator and SMTP</h3></legend>
				<div class="pinnackl-control-group">
					<label for="pp_login"><span>Admin Login : </span></label><input id="pp_login" class="pinnackl-form" type="text" name="pseudo" required>
				</div>
				<div class="pinnackl-control-group">
					<label for="pp_email"><span>Admin Email : </span></label><input id="pp_email" class="pinnackl-form" type="email" name="email" required>
				</div>
				<div class="pinnackl-control-group">
					<label for="pp_password"><span>Admin Password : </span></label><input id="pp_password" class="pinnackl-form" type="password" name="password" required>
				</div>
				<div class="pinnackl-control-group">
					<label for="pp_confirm"><span>Password Confirm : </span></label><input id="pp_confirm" class="pinnackl-form" type="password" name="confirm" required>
				</div>
                <legend></legend>
                <div class="pinnackl-control-group">
                    <label for="smtp_email"><span>SMTP Email : </span></label><input id="smtp_email" class="pinnackl-form" type="email" name="smtp_email" required>
                </div>
                <div class="pinnackl-control-group">
                    <label for="smtp_host"><span>SMTP Host : </span></label><input id="smtp_host" class="pinnackl-form" type="text" name="smtp_host" required>
                </div>
                <div class="pinnackl-control-group">
                    <label>SMTP Authentification : </label> 
                </div>
                <div class="pinnackl-control-group">
                    <label>True
                        <input type="radio" id="smtp_auth_true" name="smtp_auth" required value="true" onclick="activate();">
                    </label>
                    <label>False
                        <input type="radio" id="smtp_auth_false" name="smtp_auth" value="false" onclick="activate();">
                    </label>
                </div>
                <div class="pinnackl-control-group">
                    <label for="smtp_username"><span>SMTP Username : </span></label><input id="smtp_username" class="pinnackl-form" type="text" name="smtp_username">
                </div>
                <div class="pinnackl-control-group">
                    <label for="smtp_password"><span>SMTP Password : </span></label><input id="smtp_password" class="pinnackl-form" type="text" name="smtp_password">
                </div>
                <div class="pinnackl-control-group">
                    <label for="smtp_port"><span>SMTP Port : </span></label><input id="smtp_port" class="pinnackl-form" type="number" name="smtp_port">
                </div>
                <div class="pinnackl-controls">
                    <input class="pinnackl-button pinnackl-button-primary" type="submit" name="pp_adConfig" value="Submit">
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