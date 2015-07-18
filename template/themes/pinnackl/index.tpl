<!-- Default Index Tempalte -->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1.0" name="viewport">
		<title><?php $this->show('sitename'); ?> - <?php $this->show('sitedescription'); ?></title>
		<meta name="description" content="">
		<link href='http://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css"
			href="<?php $this->show('siteurl');?>template/themes/<?php $this->show('theme') ?>/css/base/base.css">
		<link rel="stylesheet" type="text/css"
			href="<?php $this->show('siteurl');?>template/themes/<?php $this->show('theme') ?>/css/base/extend.css">
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
			href="<?php $this->show('siteurl');?>template/themes/<?php $this->show('theme') ?>/css/forms/ranges.css">
		<link rel="stylesheet" type="text/css"
			href="<?php $this->show('siteurl');?>template/themes/<?php $this->show('theme') ?>/css/articles/articles.css">
		<link rel="stylesheet" type="text/css"
			href="<?php $this->show('siteurl');?>template/themes/<?php $this->show('theme') ?>/css/comments/comments.css">
		<link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/js/builder/libs/Trumbowyg/dist/ui/trumbowyg.min.css">
   		<link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/js/builder/libs/Trumbowyg/dist/plugins/colors/ui/trumbowyg.colors.min.css">
    	<link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/js/builder/libs/Trumbowyg/plugins/upload/trumbowyg.upload.js">
	</head>
	<body class="line">
		<div id="layout">
			<div class="line content">
				<?php if ($this->get('sidebar') == 'on'): ?>
				<div class="grid-1_4 sidebar">
					<div class="line header">
						<div class="grid-4_4">
							<nav class="pinnackl-menu pinnackl-menu-horizontal">
								<ul class="pinnackl-menu-list li-logo">
									<li class="pinnackl-menu-item li-logo">
										<a href="<?php $this->show('siteurl');?>"
											class="pinnackl-menu-link logo"><?php $this->show('sitename'); ?></a>
									</li>
								</ul>
							</nav>
						</div>
					</div>
					<div class="line content">
						<div class="grid-4_4">
							<form class="pinnackl-form pure-form-aligned">
								<fieldset>
									<div class="pure-control-group">
            							<label for="">Username</label>
										<input id="" type="range" min="0" max="10" step="1" name="">
									</div>
									<div class="pure-control-group">
            							<label for="">Username</label>
										<input id="" type="range" min="0" max="10" step="1" name="">
									</div>
									<div class="pure-control-group">
            							<label for="">Username</label>
										<input id="" type="range" min="0" max="10" step="1" name="">
									</div>
									<div class="pure-control-group">
            							<label for="">Username</label>
										<input id="" type="range" min="0" max="10" step="1" name="">
									</div>
									<div class="pure-control-group">
            							<label for="">Username</label>
										<input id="" type="range" min="0" max="10" step="1" name="">
									</div>
								</fieldset>
							</form>
							<?php if (empty($_SESSION['user']['pseudo']) && (isset($_GET['p']) && $_GET['p'] != 'connection')) : ?>
								<?php
									$form = new \controller\form\Form();
									$formData = $form->getForm('connection');
									$htmlForm = new \sophwork\modules\htmlElements\htmlForm($formData, 'connection');
									$htmlForm->createForm()->output();
								?>
							<?php elseif (!empty($_SESSION['user']['pseudo'])) : ?>
								<h4>Bienvenue : <?php echo'<pre style="background:#ffffff">';
								var_dump($_SESSION);
								echo'</pre>'; ?></h4>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<div class="<?= (($this->get('sidebar') == 'on')?'grid-3_4':'grid-4_4 no-sidebar') ?> body">
					<div class="line header">
						<div class="grid-4_4">
							<nav class="pinnackl-menu pinnackl-menu-horizontal">
								<ul class="pinnackl-responsive">
									<li><button id="burger" class="pinnackl-responsive-burger"></button></li>
								</ul>
								<ul id="menu" class="pinnackl-menu-list visible">
									<?php if ($this->viewData->links): ?>
										<?php foreach ($this->viewData->links as $key => $value) : ?>
										<?php if (($value['tag'] == 'connection' || $value['tag'] == 'inscription')
												&& !empty($_SESSION['user']['pseudo']))
												continue;
										?>
										<li class="pinnackl-menu-item pinnackl-menu-allow-hover">
											<a href="<?php $this->e($value['link']) ?>"
												class="pinnackl-menu-link
												<?php $this->isActive($value['tag'])?>">
												<?php $this->e($value['name']) ?>
											</a>
											<?php if (sizeof($value['children']) > 0) : ?>
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
							<?php if(property_exists($this->viewData, 'comment'))$this->viewData->comment->render(); ?>
						</div>
                        <?php 
                        // if(isset($_SESSION['form'])){
                        //     foreach ($_SESSION['form']['error'] as $value){
                        //         echo "$value<br />\n";
                        //     }
                        //     unset($_SESSION['form']);
                        // }
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
		<script src="<?php $this->show('siteurl')?>nimda/template/js/builder/libs/jquery-1.11.0.min.js"></script>
		<script src="<?php $this->show('siteurl')?>nimda/template/js/builder/libs/Trumbowyg/dist/trumbowyg.min.js"></script>
		<script src="<?php $this->show('siteurl')?>nimda/template/js/builder/libs/Trumbowyg/dist/plugins/upload/trumbowyg.upload.js"></script>
		<script src="<?php $this->show('siteurl')?>nimda/template/js/builder/libs/Trumbowyg/dist/plugins/colors/trumbowyg.colors.js"></script>
		<script src="<?php $this->show('siteurl')?>nimda/template/js/builder/libs/Trumbowyg/dist/plugins/base64/trumbowyg.base64.js"></script>
		<script>
			(function(e){
				var burger = document.getElementById('burger');
				var menu = document.getElementById('menu');
				burger.addEventListener('click', function(){
					menu.classList.toggle("visible");
				});
			})(document);
			document.addEventListener("DOMContentLoaded", function() {
				$('#wysiwyg').trumbowyg({
        	        btns: ['viewHTML',
        	            '|', 'btnGrp-design',
        	            '|', 'link',
        	            '|', 'btnGrp-justify',
        	            '|', 'btnGrp-lists',
        	            '|', 'foreColor', 'backColor']
        	    });
			});			
		</script>
	</body>
</html>