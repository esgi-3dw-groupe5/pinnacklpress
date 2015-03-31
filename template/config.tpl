<!-- Default config form Tempalte -->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>{{title}}</title>
		<meta name="description" content="">
		<link rel="stylesheet" href='{{menu}}'>
		<link rel="stylesheet" href='{{sidebar}}'>
		<link rel="stylesheet" href='{{base}}'>
		<link rel="stylesheet" href='{{forms}}'>
		<link rel="stylesheet" href='{{buttons}}'>
	</head>
	<body class="pinnackl-background-body">
		<header>
			<div class="custom-menu-wrapper">
			    <div class="pinnackl-menu custom-menu custom-menu-top">
			        <a href="#" class="pinnackl-menu-heading custom-menu-brand">PINNACKL</a>
			        <a href="#" class="custom-menu-toggle" id="toggle"><s class="bar"></s><s class="bar"></s></a>
			    </div>
				<div class="pinnackl-menu pinnackl-menu-horizontal pinnackl-menu-scrollable custom-menu custom-menu-bottom custom-menu-tucked" id="tuckedMenu">
			        <div class="custom-menu-screen"></div>
			        <ul class="pinnackl-menu-list">
			            <li class="pinnackl-menu-item"><a href="#" class="pinnackl-menu-link">Home</a></li>
			            <li class="pinnackl-menu-item"><a href="#" class="pinnackl-menu-link">About</a></li>
			            <li class="pinnackl-menu-item"><a href="#" class="pinnackl-menu-link">Contact</a></li>
			            <li class="pinnackl-menu-item"><a href="#" class="pinnackl-menu-link">Blog</a></li>
			            <li class="pinnackl-menu-item"><a href="#" class="pinnackl-menu-link">GitHub</a></li>
			            <li class="pinnackl-menu-item"><a href="#" class="pinnackl-menu-link">Twitter</a></li>
			            <li class="pinnackl-menu-item"><a href="#" class="pinnackl-menu-link">Apple</a></li>
			            <li class="pinnackl-menu-item"><a href="#" class="pinnackl-menu-link">Google</a></li>
			            <li class="pinnackl-menu-item"><a href="#" class="pinnackl-menu-link">Wang</a></li>
			            <li class="pinnackl-menu-item"><a href="#" class="pinnackl-menu-link">Yahoo</a></li>
			            <li class="pinnackl-menu-item"><a href="#" class="pinnackl-menu-link">W3C</a></li>
			        </ul>
			    </div>
			</div>
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
			<div id="layout" class="pure-g">
			    <div class="sidebar pure-u-1 pure-u-md-1-4">
			        <div class="header">
			            <h1 class="brand-title">A Sample Blog</h1>
			            <h2 class="brand-tagline">Creating a blog layout using Pure</h2>

			            <nav class="nav">
			                <ul class="nav-list">
			                    <li class="nav-item">
			                        <a class="pure-button" href="">Pure</a>
			                    </li>
			                    <li class="nav-item">
			                        <a class="pure-button" href="">YUI Library</a>
			                    </li>
			                </ul>
			            </nav>
			        </div>
			    </div>
			</div>
		</aside>
		<footer>
		</footer>
	</body>
</html>



<script>
(function (window, document) {
document.getElementById('toggle').addEventListener('click', function (e) {
    document.getElementById('tuckedMenu').classList.toggle('custom-menu-tucked');
    document.getElementById('toggle').classList.toggle('x');
});
})(this, this.document);
</script>