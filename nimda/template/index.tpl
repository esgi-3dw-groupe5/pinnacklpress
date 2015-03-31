<!-- Default config form Tempalte -->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>{{title}}</title>
		<meta name="description" content="">
		{% macros %}
		<link rel="stylesheet" href='template/css/{{css}}.css'>
		{% endmacros %}
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
			        </ul>
			    </div>
			</div>
		</header>
		<section>
		</section>
		<aside>
			<div id="layout" class="pure-g">
			    <div class="sidebar pure-u-1 pure-u-md-1-4">
			        <div class="header">
			            <h1 class="brand-title">Pinnackl Press</h1>
			            <h2 class="brand-tagline"></h2>

			            <nav class="nav">
			                <ul class="nav-list">
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