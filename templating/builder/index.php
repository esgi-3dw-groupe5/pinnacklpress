<?php
	if(count($_POST) > 0){
		echo'<pre style="background:#ffffff">';
		var_dump(json_decode($_POST['pageBuilder']));
		echo'</pre>';
		return;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title> Title </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<link rel="stylesheet" href="css/builder.css">
		<link rel="stylesheet" href="css/builder-grid.css">
		<link rel="stylesheet" href="css/grid-resize.css">
		<link rel="stylesheet" href="css/grid-list.css">
		<link rel="stylesheet" href="css/module-list.css">
		<link rel="stylesheet" href="css/builder-range.css">
		<link rel="stylesheet" href="/pinnacklpress/nimda/template/css/base/base.css">
		<link rel="stylesheet" href="/pinnacklpress/nimda/template/css/menus/menus-core.css">
		<link rel="stylesheet" href="/pinnacklpress/nimda/template/css/menus/extend.css">
		<link rel="stylesheet" href="/pinnacklpress/nimda/template/css/menus/side-menu.css">
		<link rel="stylesheet" href="/pinnacklpress/nimda/template/css/buttons/buttons.css">
		
		<link rel="stylesheet" href="js/libs/Trumbowyg/dist/ui/trumbowyg.min.css">
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
			</nav>
		</header>
		<section>
			<!-- Overlay -->
			<div class="overlay"></div>
			<!-- /Overlay -->
			<!-- Gridlist -->
			<div class="grid-list box">
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
			<!-- /Gridlist -->
			<!-- content list -->
			<div class="content-list box">
				<header>Chose a modules <i id="close-md"></i></header>
				<div class="modules-list">
					<div class='modules' data="[text]">
						<div class="md md-text"></div>
					</div>
				</div>
			</div>
			<!-- /content list -->
			<!-- Modules -->
			<div class="text-module box">
				<header>Text Module<i id="close-tx"></i></header>
				<div class="box-list">
					<div id="wysiwyg"></div>
					<div class="validate-module">
						<button id="clear-tx-md" class="pinnackl-button">Clear</button>
						<button id="save-tx-md" class="pinnackl-button">Save</button>
					</div>
				</div>
			</div>
			<!-- /Modules -->		
			<div class="content">
				<div class="validate-builder">
						<input class="builder-range" id="add-number" type="range" min="1" max="12" step="1">
						<input id="number" type="text">
						<button id="add-button-obo" class="pinnackl-button pinnackl-button-primary">New line</button>
						<button id="add-button-grp" class="pinnackl-button pinnackl-button-primary">New grouped line</button>
						<button id="clear-builder" class="pinnackl-button pinnackl-button-primary">Clear</button>
						<button id="save-builder" class="pinnackl-button pinnackl-button-primary">Save</button>
				</div>
				<div id="canvas"></div>
			</div>
		</section>
		<aside>
		</aside>
		<footer>
		</footer>
	</div>
	<script src="js/libs/jquery-1.11.0.min.js"></script>
	<script src="js/libs/Trumbowyg/dist/trumbowyg.min.js"></script>
	<script src="js/builder.js"></script>
	<script src="js/grids.js"></script>
	<script src="js/modules.js"></script>
	<script src="js/listeners.js"></script>
	</body>
</html>