<!-- Default config form Tempalte -->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>{{title}}</title>
		<meta name="description" content="">
		<link rel="stylesheet" href='{{base}}'>
		<link rel="stylesheet" href='{{forms}}'>
		<link rel="stylesheet" href='{{buttons}}'>
	</head>
	<body class="pinnackl-background-body">
		<header>
			<nav>
			</nav>
		</header>
		<section>
			<form  class="pinnackl-form pinnackl-form-aligned" action="" method="post">
			<fieldset>
		  	<legend><h1>{{h1}}</h1></legend>
				<div class="pinnackl-control-group">
					<label for="db_host"><span>db_host : </span></label><input id="db_host" class="pinnackl-form" type="text" name="db_host">
				</div>
				<div class="pinnackl-control-group">
					<label for="db_name"><span>db_name : </span></label><input id="db_name" class="pinnackl-form" type="text" name="db_name">
				</div>
				<div class="pinnackl-control-group">
					<label for="db_login"><span>db_login : </span></label><input id="db_login" class="pinnackl-form" type="text" name="db_login">
				</div>
				<div class="pinnackl-control-group">
					<label for="db_password"><span>db_password : </span></label><input id="db_password" class="pinnackl-form" type="password" name="db_password">
				</div>
				<div class="pinnackl-controls">
					<input class="pinnackl-button pinnackl-button-primary" type="submit" name="db_submit" value="Envoyer">
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