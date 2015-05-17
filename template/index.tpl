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
		<link rel="stylesheet" href="templating/builder/js/libs/Trumbowyg/dist/ui/trumbowyg.min.css">
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
			<?php //$this->viewData->layout1->output(); ?>
			<?php $this->viewData->layout->output(); ?>
			<?php $this->viewData->page->render(); ?>

		</section>
		
		<footer class="grid-12">
		</footer>

	</body>
	<script src="/pinnacklpress/templating/builder/js/libs/jquery-1.11.0.min.js"></script>
	<script src="/pinnacklpress/templating/builder/js/libs/trumbowyg/dist/trumbowyg.min.js"></script>
	<script>
		console.log($( "input[name='content']" ));
		$( "input[name='content']" ).trumbowyg();
	</script>
</html>