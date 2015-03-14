<!-- Default Index Tempalte -->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>{{title}}</title>
		<meta name="description" content="">
		<link rel="stylesheet" href="">
	</head>
	<body>
		<header>
			<nav>
				<ul>
					{% macros %}
					<li>{{menu}}</li>
					{% endmacros %}
				</ul>
			</nav>
		</header>
		<section>
			<h1>{{h1}}</h1>
			{% macro %}
				<div>{{my element}}</div>
			{% endmacro %}
		</section>
		<aside>
		</aside>
		<footer>
			{{footer}}
		</footer>
	</body>
</html>