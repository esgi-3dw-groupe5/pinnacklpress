<!-- Default Index Tempalte -->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1.0" name="viewport">
		<title><?php $this->show('sitename'); ?> - <?php $this->show('sitedescription'); ?></title>
		<meta name="description" content="">
		<link href='http://fonts.googleapis.com/css?family=Amaranth' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css"
			href="<?php $this->show('siteurl');?>template/themes/<?php $this->show('theme') ?>/css/base/base.css">
		<link rel="stylesheet" type="text/css"
			href="<?php $this->show('siteurl');?>template/themes/<?php $this->show('theme') ?>/css/grids/grids.css">
		<link rel="stylesheet" type="text/css"
			href="<?php $this->show('siteurl');?>template/themes/<?php $this->show('theme') ?>/css/sidebar/extend.css">
		<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="templatethemes/<?php $this->show('theme') ?>/css/sidebar/extend-ie.css">
		<![endif]-->
		<link rel="stylesheet" type="text/css"
			href="<?php $this->show('siteurl');?>template/themes/<?php $this->show('theme') ?>/css/menus/menus-core.css">
		<link rel="stylesheet" type="text/css"
			href="<?php $this->show('siteurl');?>template/themes/<?php $this->show('theme') ?>/css/menus/menus-horizontal.css">
		<link rel="stylesheet" type="text/css"
			href="<?php $this->show('siteurl');?>template/themes/<?php $this->show('theme') ?>/css/menus/menus-dropdown.css">
		<link rel="stylesheet" type="text/css"
			href="<?php $this->show('siteurl');?>template/themes/<?php $this->show('theme') ?>/css/menus/menus-skin.css">
		<link rel="stylesheet" type="text/css"
			href="<?php $this->show('siteurl');?>template/themes/<?php $this->show('theme') ?>/css/menus/extend.css">
		<link rel="stylesheet" type="text/css"
			href="<?php $this->show('siteurl');?>template/themes/<?php $this->show('theme') ?>/css/buttons/buttons-core.css">
		<link rel="stylesheet" type="text/css"
			href="<?php $this->show('siteurl');?>template/themes/<?php $this->show('theme') ?>/css/buttons/buttons.css">
		<link rel="stylesheet" type="text/css"
			href="<?php $this->show('siteurl');?>template/themes/<?php $this->show('theme') ?>/css/forms/forms.css">
		<link rel="stylesheet" type="text/css"
			href="<?php $this->show('siteurl');?>template/themes/<?php $this->show('theme') ?>/css/articles/articles.css">
		<link rel="stylesheet" type="text/css"
			href="<?php $this->show('siteurl');?>template/themes/<?php $this->show('theme') ?>/css/comments/comments.css">
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
                                        <a href="<?php $this->show('siteurl');?>"
                                           class="pinnackl-menu-link logo"><?php $this->show('sitename'); ?></a>
									</li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="line content">
                        <?php if (empty($_SESSION['user']['pseudo'])
                            && ((isset($_GET['p']) && $_GET['p'] != 'connection') || !isset($_GET['p']))) : ?>
                                                    <?php
                            $form = new \controller\form\Form();
                            $formData = $form->getForm('connection');
                            $htmlForm = new \sophwork\modules\htmlElements\htmlForm($formData, 'connection', $this->get('siteurl').'controller/controllers/listener/listeners.php');
                            $htmlForm->createForm()->output();
                        ?>
                        <a href="<?php $this->show('siteurl')?>recovery">Mot de passe oublié ?</a>
                        <?php elseif (!empty($_SESSION['user']['pseudo'])) : ?>
                        <h4>Bienvenue 
                            <a class="pinnackl-username"
                               href="<?php $this->e(sophwork\core\Sophwork::getUrl('user/'.$_SESSION['user']['url']), 'L'); ?>">
                                <?php $this->e($_SESSION['user']['pseudo']) ?>
                            </a>
                                
                            <p><a class="pinnackl-logout" href="<?php $this->show('siteurl')?>?act=logout">Déconnexion</a></p>
                        </h4>
                        <?php endif; ?>
					</div>
				</div>
				<?php endif; ?>
				<div class="<?php echo (($this->get('sidebar') == 'on')?'grid-3_4':'grid-4_4 no-sidebar') ?> body">
					<div class="line header">
						<div class="grid-4_4">
							<nav class="pinnackl-menu pinnackl-menu-horizontal">
								<ul class="pinnackl-menu-list">
									<?php $color=0; if($this->viewData->links): ?>
										<?php foreach ($this->viewData->links as $key => $value) : ?>
										<li class="pinnackl-menu-item pinnackl-menu-allow-hover">
											<a href="<?php $this->e($value['link']) ?>"
												class="pinnackl-menu-link <?='m-'.$color++?>
												<?php $this->isActive($value['tag'])?>">
												<?php $this->e($value['name']) ?>
											</a>
											<?php if(sizeof($value['children']) > 0) : ?>
											<ul class="pinnackl-menu-children">
												<?php foreach ($value['children'] as $key => $val) : ?>
												<li class="pinnackl-menu-item">
													<a href="<?php $this->e($val['link']) ?>" class="pinnackl-menu-link">
														<?php $this->e($val['name']) ?>
													</a>
												</li>
												<?php endforeach; ?>
											</ul>
											<?php endif; ?>
										</li>
										<?php endforeach; ?>
									<?php endif; ?>
								</ul>
							</nav>
						</div>
					</div>
					<div class="line sub-content">
						<div class="grid-4_4 container">
							<?php $this->viewData->page->render(); ?>
						</div>
                        <?php 
                        if(isset($_SESSION['form']['error'])){
                            foreach ($_SESSION['form']['error'] as $value){
                                echo "$value<br />\n";
                            }
                            unset($_SESSION['form']);
                        }
                        ?>
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