<!-- Default Index Tempalte -->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1.0" name="viewport">
		<title><?php $this->show('sitename'); ?> - <?php $this->show('sitedescription'); ?></title>
		<meta name="description" content="">
		<link rel="stylesheet" type="text/css"
			href="<?php $this->show('siteurl');?>/template/themes/<?php $this->show('theme') ?>/css/base/base.css">
		<link rel="stylesheet" type="text/css"
			href="<?php $this->show('siteurl');?>/template/themes/<?php $this->show('theme') ?>/css/grids/grids.css">
		<link rel="stylesheet" type="text/css"
			href="<?php $this->show('siteurl');?>/template/themes/<?php $this->show('theme') ?>/css/sidebar/extend.css">
		<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="template/themes/<?php $this->show('theme') ?>/css/sidebar/extend-ie.css">
		<![endif]-->
		<link rel="stylesheet" type="text/css"
			href="<?php $this->show('siteurl');?>/template/themes/<?php $this->show('theme') ?>/css/menus/menus-core.css">
		<link rel="stylesheet" type="text/css"
			href="<?php $this->show('siteurl');?>/template/themes/<?php $this->show('theme') ?>/css/menus/menus-horizontal.css">
		<link rel="stylesheet" type="text/css"
			href="<?php $this->show('siteurl');?>/template/themes/<?php $this->show('theme') ?>/css/menus/menus-skin.css">
		<link rel="stylesheet" type="text/css"
			href="<?php $this->show('siteurl');?>/template/themes/<?php $this->show('theme') ?>/css/menus/extend.css">
		<link rel="stylesheet" type="text/css"
			href="<?php $this->show('siteurl');?>/template/themes/<?php $this->show('theme') ?>/css/buttons/buttons-core.css">
		<link rel="stylesheet" type="text/css"
			href="<?php $this->show('siteurl');?>/template/themes/<?php $this->show('theme') ?>/css/buttons/buttons.css">
		<link rel="stylesheet" type="text/css"
			href="<?php $this->show('siteurl');?>/template/themes/<?php $this->show('theme') ?>/css/forms/forms.css">
		<link rel="stylesheet" type="text/css"
			href="<?php $this->show('siteurl');?>/template/themes/<?php $this->show('theme') ?>/css/articles/articles.css">
	</head>
	<body class="line">
		<div id="layout">
			<div class="line content">
				<?php if($this->get('sidebar') == 'on'): ?>
				<div class="grid-1_4 sidebar">
					<div class="line header">
						<div class="grid-4_4">
							<nav class="pinnackl-menu pinnackl-menu-horizontal">
								<ul class="pinnackl-menu-list">
									<li class="pinnackl-menu-item">
										<a href="" class="pinnackl-menu-link">menu 1</a>
									</li>
									<li class="pinnackl-menu-item">
										<a href="" class="pinnackl-menu-link">menu 2</a>
									</li>
									<li class="pinnackl-menu-item">
										<a href="" class="pinnackl-menu-link">menu 3</a>
									</li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="line content">
						<div class="grid-4_4">
							side bar contents
						</div>
					</div>
				</div>
				<?php endif; ?>
				<div class="<?php echo (($this->get('sidebar') == 'on')?'grid-3_4':'grid-4_4 no-sidebar') ?> body">
					<div class="line header">
						<div class="grid-4_4">
							<nav class="pinnackl-menu pinnackl-menu-horizontal">
								<ul class="pinnackl-menu-list">
									<?php foreach ($this->viewData->links as $key => $value) : ?>
									<li class="pinnackl-menu-item">
										<a href="<?php $this->e($value['link']) ?>" class="pinnackl-menu-link">
											<?php $this->e($value['name']) ?>
										</a>
									</li>
								<?php endforeach; ?>
								</ul>
							</nav>
						</div>
					</div>
					<div class="line sub-content">
						<div class="grid-4_4 container">
							<?php $this->viewData->page->render(); ?>
						</div>
					</div>
					<?php $this->viewData->footer->render(); ?>
					<div class="line footer-right">
						<div class="grid-4_4 ft-right-section">
							Created by PinnacklPress ©
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>