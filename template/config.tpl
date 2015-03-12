<!-- Default config form Tempalte -->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>{{title}}</title>
		<meta name="description" content="">
		<link rel="stylesheet" href="">
		<style type="text/css">
			*{
				margin: 0;
				padding: 0;
			}
			html{
				width: 100%;
				height: 100%;
			}
			body{
				color: #777;
				width: 80%;
				height: 100%;
				margin-left: auto;
				margin-right: auto;
				background: #f8f8f8;
			}

			fieldset{
				border: 0 none;
				margin: 0;
				padding: 0.35em 0 0.75em;
			}
			legend{
				border-bottom: 1px solid #e5e5e5;
				color: #333;
				display: block;
				margin-bottom: 0.3em;
				padding: 0.3em 0;
				width: 100%;
			}
			label{
				display: block;
				margin: 0.25em 0;
			}
			input{
				display: block;
				margin: 0.25em 0;
				
				border: 1px solid #ccc;
				border-radius: 4px;
				box-shadow: 0 1px 3px #ddd inset;
				box-sizing: border-box;
				display: inline-block;
				padding: 0.5em 0.6em;
				vertical-align: middle;
			}
			button{
				display: block;
				background-color: #0078e7;
				color: #fff;
				-moz-user-select: none;
				box-sizing: border-box;
				cursor: pointer;
				line-height: normal;
				text-align: center;
				vertical-align: middle;
				white-space: nowrap;
				
				font-family: inherit;
				font-size: 100%;
				padding: .5em 1em;
				border: 1px solid #999;
				border: 0 rgba(0,0,0,0);
				text-decoration: none;
				border-radius: 2px;
			}
		</style>
	</head>
	<body>
		<header>
			<nav>
			</nav>
		</header>
		<section>
			<form action="" method="post">
			<fieldset>
		  	<legend><h1>{{h1}}</h1></legend>
				<label for="db_host"><span>db_host : </span></label><input id="db_host" class="" type="text" name="db_host">
				<label for="db_name"><span>db_name : </span></label><input id="db_name" class="" type="text" name="db_name">
				<label for="db_login"><span>db_login : </span></label><input id="db_login" class="" type="text" name="db_login">
				<label for="db_password"><span>db_password : </span></label><input id="db_password" class="" type="password" name="db_password">
				<input type="submit" name="db_submit" value="Envoyer">
			</fieldset>
			</form>
		</section>
		<aside>
		</aside>
		<footer>
		</footer>
	</body>
</html>