<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Pinnackl Press - Connection</title>
		<meta name="description" content="">
		<link rel="stylesheet" href="<?=$includeUrl?>template/css/animate.css">
		<link rel="stylesheet" href="<?=$includeUrl?>template/css/base/base.css">
		<link rel="stylesheet" href="<?=$includeUrl?>template/css/forms/forms.css">
		<link rel="stylesheet" href="<?=$includeUrl?>template/css/buttons/buttons-core.css">
		<link rel="stylesheet" href="<?=$includeUrl?>template/css/buttons/buttons.css">
		<style type="text/css">
			form{
				color:#777;
			}
			aside {
			    background: rgb(202, 60, 60) none repeat scroll 0 0;
			    border-radius: 3px;
			    color: #fff;
			    padding: 0.3em 1em;
			    width: 36.333%;
			    margin: auto;
			    text-align: left;
			    margin-bottom: 1em;
			    font-weight: bold;
			}
			aside a:link,
			aside a:visited,
			aside a:hover,
			aside a:active{
				color: #fff;
			}

			a:link,
			a:visited,
			a:hover,
			a:active{
				color: #777;
			}
		</style>
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
			  		<legend><h3>Admin Connection</h3></legend>
			  		<aside class="animated bounce" style="display:<?=(($error)?'block':'none')?>">
			  			<span>Oh no!</span><br><span>Something has gone wrong.</span><br>
			  			<h4>It might be due to bad credentials,<br>have you enough rights to get here?</h4>
			  			<span><a href="<?=$siteUrl?>">Get me out of here?</a></span>
			  		</aside>
					<div class="pinnackl-control-group">
						<label for="login"><span>Login : </span></label>
						<input id="login" class="pinnackl-input-1-4" type="email" name="email" required placeholder="Email"
						value="<?=$login?>">
					</div>
					<div class="pinnackl-control-group">
						<label for="password"><span>Password : </span></label>
						<input id="password" class="pinnackl-input-1-4" type="password" name="password" required placeholder="Password">
					</div>
					<div class="pinnackl-controls">
						<input class="pinnackl-button pinnackl-button-primary pinnackl-input-1-4" type="submit" value="Submit">
						<div class="pinnackl-control">
                            <a href="<?=$siteUrl?>recovery">Forgot your password?</a>
						</div>
					</div>
				</fieldset>
			</form>
		</section>
	</body>
</html>