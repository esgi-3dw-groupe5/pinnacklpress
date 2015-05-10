<?php
	require('htmlElement.php');
	require('Builder.php');
	$layout = new htmlElement('div');
	$layout->set('class', 'line');

	$grid1 = new htmlElement('div');
	$grid1->set('class', 'grid-1_4');
	
	$grid2 = new htmlElement('div');
	$grid2->set('class', 'grid-2_4');
	$grid2->set('text', $plop);
	
	$grid3 = new htmlElement('div');
	$grid3->set('class', 'grid-1_4');

	$layout->inject($grid1);
	$layout->inject($grid2);
	$layout->inject($grid3);

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title> Title </title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/builder-grid.css">
		<link rel="stylesheet" href="/pinnacklpress/nimda/template/css/base/base.css">
		<link rel="stylesheet" href="/pinnacklpress/nimda/template/css/menus/menus-core.css">
		<link rel="stylesheet" href="/pinnacklpress/nimda/template/css/menus/extend.css">
		<link rel="stylesheet" href="/pinnacklpress/nimda/template/css/menus/side-menu.css">
		<link rel="stylesheet" href="/pinnacklpress/nimda/template/css/buttons/buttons.css">
	</head>
	<body>
		<header>
			<nav>
			</nav>
		</header>
		<section>
			<div class="line">
				<div class="grid-1_4">
					<div id="menu">
					    <div class="pinnackl-menu">
							<a class="pinnackl-menu-heading" href="../nimda/">Pinnackl Press</a>
							<ul class="pinnackl-menu-list">
								<li class="pinnackl-menu-item items active" draggable="true"><a class="pinnackl-menu-link">Menu1</a></li>
								<li class="pinnackl-menu-item items" draggable="true"><a class="pinnackl-menu-link">Menu2</a></li>
								<li class="pinnackl-menu-item items" draggable="true"><a class="pinnackl-menu-link">Menu3</a></li>
								<li class="pinnackl-menu-item items" draggable="true"><a class="pinnackl-menu-link">Menu4</a></li>
								<li class="pinnackl-menu-item items" draggable="true"><a class="pinnackl-menu-link">Menu5</a></li>
								<li class="pinnackl-menu-item items" draggable="true"><a class="pinnackl-menu-link">Menu6</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="grid-3_4">
					<?php
						$layout->output();
					?>
				</div>
			</div>
		</section>
		<aside>
		</aside>
		<footer>
		</footer>
	</body>
</html>