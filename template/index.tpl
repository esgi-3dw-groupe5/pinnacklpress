<!-- Default Index Tempalte -->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?php $this->show('sitename'); ?> - <?php $this->show('sitedescription'); ?></title>
		<meta name="description" content="">
		<link rel="stylesheet" href="">
	</head>
	<body>
		<header>
			<nav>
				<ul>
					<?php foreach ($this->viewData->menu as $key => $value) :?>
						<li class="">
							<a href="/pinnacklpress/<?php $this->show($value, 'page_tag'); ?>">
								<?php $this->show($value, 'page_name'); ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</nav>
		</header>
		<section>
		</section>
		<aside>
		</aside>
		<footer>
		</footer>
	</body>
</html>