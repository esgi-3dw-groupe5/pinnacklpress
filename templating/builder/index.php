<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title> Title </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<link rel="stylesheet" href="css/builder.css">
		<link rel="stylesheet" href="css/grid-resize.css">
		<link rel="stylesheet" href="css/grid-list.css">
		<link rel="stylesheet" href="/pinnacklpress/nimda/template/css/base/base.css">
		<link rel="stylesheet" href="/pinnacklpress/nimda/template/css/menus/menus-core.css">
		<link rel="stylesheet" href="/pinnacklpress/nimda/template/css/menus/extend.css">
		<link rel="stylesheet" href="/pinnacklpress/nimda/template/css/menus/side-menu.css">
		<link rel="stylesheet" href="/pinnacklpress/nimda/template/css/buttons/buttons.css">
	</head>
	<body>
		<div id="layout">
			<div id="menu">
			    <div class="pinnackl-menu">
					<a class="pinnackl-menu-heading" href="../nimda/">Pinnackl Press</a>
					<ul class="pinnackl-menu-list">
						<li class="pinnackl-menu-item items" draggable="true"><a class="pinnackl-menu-link">Menu1</a></li>
						<li class="pinnackl-menu-item items" draggable="true"><a class="pinnackl-menu-link">Menu2</a></li>
					</ul>
				</div>
			</div>
		<header>
			<nav>
				<div class="add-panel">
					<header>One by one</header>
					<input id="add-number" type="range" min="1" max="12" step="1">
					<input id="number" type="text">
					<div style="margin-bottom:2px">
						<button id="add-button-obo" class="pinnackl-button">New line</button><br>
					</div>
					<div style="margin-bottom:2px">
						<button id="add-button-grp" class="pinnackl-button">New grouped line</button>
					</div>
				</div>
				<div class="overlay"></div>
				<div class="grid-list">
					<header>Chose a grid <i id="close-gl"></i></header>
					<div class="layouts-list">
						<div class='layouts' data="4_4">
							<div class="dg dg-4_4"></div>
						</div>
						<div class='layouts' data="2_4,2_4">
							<div class="dg dg-2_4"></div>
							<div class="dg dg-2_4"></div>
						</div>
						<div class='layouts' data="1_3,1_3,1_3">
							<div class="dg dg-1_3"></div>
							<div class="dg dg-1_3"></div>
							<div class="dg dg-1_3"></div>
						</div>
						
						<div class='layouts' data="1_4,1_4,1_4,1_4">
							<div class="dg dg-1_4"></div>
							<div class="dg dg-1_4"></div>
							<div class="dg dg-1_4"></div>
							<div class="dg dg-1_4"></div>
						</div>
						<div class='layouts' data="2_3,1_3">
							<div class="dg dg-2_3"></div>
							<div class="dg dg-1_3"></div>
						</div>
						<div class='layouts' data="1_3,2_3">
							<div class="dg dg-1_3"></div>
							<div class="dg dg-2_3"></div>
						</div>
						<div class='layouts' data="3_4,1_4">
							<div class="dg dg-3_4"></div>
							<div class="dg dg-1_4"></div>
						</div>
						<div class='layouts' data="1_4,3_4">
							<div class="dg dg-1_4"></div>
							<div class="dg dg-3_4"></div>
						</div>
						
						<div class='layouts' data="2_4,1_4,1_4">
							<div class="dg dg-2_4"></div>
							<div class="dg dg-1_4"></div>
							<div class="dg dg-1_4"></div>
						</div>
						<div class='layouts' data="1_4,1_4,2_4">
							<div class="dg dg-1_4"></div>
							<div class="dg dg-1_4"></div>
							<div class="dg dg-2_4"></div>
						</div>
						<div class='layouts' data="1_4,2_4,1_4">
							<div class="dg dg-1_4"></div>
							<div class="dg dg-2_4"></div>
							<div class="dg dg-1_4"></div>
						</div>

					</div>
				</div>
			</nav>
		</header>
		<section>
			<div class="content">
			</div>
			<div id="ctx-menu" class="context">
				<header>
					<h4 id="ctx-title"></h4><i id="ctx-close">&#10148;</i>
				</header>
			</div>
		</section>
		<aside>
		</aside>
		<footer>
		</footer>
	</div>
	<script src="js/grids.js"></script>
	<script src="js/builder.js"></script>
	<script>
		addListners();
	</script>
	</body>
</html>