<html>
<head>
	<title></title>
		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1.0" name="viewport">
		<title></title>
		<link href='http://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>
		<style type="text/css">
			html, body {
				margin: 0;
			    width: 100%;
			    height: 100%;
			    position: relative;
			    overflow: hidden;
			    color: #fff;
				font-family: 'Orbitron', serif;
			}

			#bg {
			    background: url("<?php $this->show('siteurl')?>template/img/about.svg");
			    background-repeat: no-repeat;
			    background-size: cover;
			    background-position: bottom right;
			    width: 102%;
			    height: 98%;
			    position: fixed;
			    left: 0;
			    right: 0;
			    bottom: 0;
			    z-index: 0;
			}

			.header{
				background: #272822;
				min-height: 2%;
				max-height: 2%;
				border-bottom: solid 1px #5272aa;
				width: 102%;
				position: fixed;
				top: 0;
				left: 0;
				z-index: 1;
			}

			.content {
			    position: fixed;
			    top: 50px;
			    left: 50px;
			    z-index: 10;
			}

			h1 {
			    font-size: 62px;
			    margin-bottom: 0;
			}

			p {
			    font-size: 24px;
			    display: inline-block;
			    line-height: 36px;
			}
			a:link,
			a:visited,
			a:hover,
			a:active{
				color: #fff;
			}
		</style>
</head>
<body>
<div class="header"></div>
<div id="bg"></div>
<div class="content">
	<h1><?php $this->show('errorNb')?></h1>
	<p>
	<?php $this->show('errorMsg')?>.
	<br>
	I've eaten the page you've requested.
	<br>
	<a href="<?php $this->show('url');?>">&#8592; Back to the website</a>
	</p>
</div>
</body>
</html>