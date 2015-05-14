<!-- Default Index Tempalte -->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?php $this->show('sitename'); ?> - <?php $this->show('sitedescription'); ?></title>
		<meta name="description" content="">
		<link rel="stylesheet" href="template/css/builder/builder-grid.css">
		<link rel="stylesheet" href="template/css/menus/extend.css">
		<link rel="stylesheet" href="template/css/sidebar/extend.css">
		<link rel="stylesheet" href="template/css/base/base.css">
		<link rel="stylesheet" href="template/css/footer/footer.css">
	</head>
	<body>
		<header id="menu" class="grid-12">
			<nav>
				<ul>
					<?php foreach ($this->viewData->menu as $key => $value) :?>
						<li class="menu">
							<a href="/pinnacklpress/<?php $this->show($value, 'page_tag'); ?>">
								<?php $this->show($value, 'page_name'); ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</nav>
		</header>
		<aside id="sidebar" class="grid-2">
		</aside>
		<section id="content" class="grid-10">
			<?php $this->viewData->layout->output(); ?>
		</section>
		
		<footer class="grid-12">
		</footer>

	</body>
</html>