<!-- Default Index Tempalte -->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?php $this->show('sitename'); ?> - <?php $this->show('sitedescription'); ?></title>
		<meta name="description" content="">
		<link rel="stylesheet" href="nimda/template/css/builder/builder-grid.css">
		<link rel="stylesheet" href="template/css/menus/extend.css">
		<link rel="stylesheet" href="template/css/sidebar/extend.css">
		<link rel="stylesheet" href="template/css/base/base.css">
		<link rel="stylesheet" href="template/css/footer/footer.css">
	</head>
	<body>
		<header id="header" class="grid-12">
			<nav>
				<ul>
				</ul>
			</nav>
		</header>
		<aside id="sidebar" class="grid-2">
		</aside>
		<section id="content" class="grid-10">
			<?php $this->viewData->layout->output(); ?>
			<?php $this->viewData->page->render(); ?>

		</section>
		
		<footer class="grid-12">
		</footer>

	</body>
</html>