<?php ?>
<!-- Default config form Tempalte -->
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    
    <title><?php $this->show('title') ?></title>
    <!-- page builder css -->
    <link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/css/notification/notification.css">
    <link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/css/builder/builder.css">
    <link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/css/builder/menu-builder.css">
    <link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/css/builder/builder-grid.css">
    <link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/css/builder/grid-resize.css">
    <link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/css/builder/grid-list.css">
    <link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/css/builder/module-list.css">
    <link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/css/builder/builder-range.css">
    <link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/js/builder/libs/Trumbowyg/dist/ui/trumbowyg.min.css">
    <link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/js/builder/libs/Trumbowyg/dist/plugins/colors/ui/trumbowyg.colors.min.css">
    <link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/js/builder/libs/Trumbowyg/plugins/upload/trumbowyg.upload.js">
        
    <link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/css/base/base.css">
    <link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/css/grids/grids-core.css">
    <link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/css/menus/menus-core.css">
    <link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/css/menus/extend.css">
    <link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/css/menus/side-menu.css">
    <link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/css/footer/footer.css">
    <link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/css/forms/forms.css">
    <link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/css/forms/extend.css">
    <link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/css/buttons/buttons.css">
    <link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/css/buttons/extend.css">
    <link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/css/tables/extend.css">

    <script src="<?php $this->show('siteurl')?>nimda/template/js/libs/sophwork.js"></script>
    <script src="<?php $this->show('siteurl')?>nimda/template/js/notification.js"></script>
</head>
<body>
<div id="layout">
    <!-- Menu toggle -->
    <a href="#menu" id="menuLink" class="menu-link">
        <!-- Hamburger icon -->
        <span></span>
    </a>
    <div class="pinnackl-header-menu">
        <span>Welcome, <b>Admin</b></span>
        <a class="pinnackl-button pinnackl-button-white btn-70" href="<?php $this->show('siteurl')?>">
            Back to your website
        </a>
    </div>
    <div id="menu">
        <div class="pinnackl-menu">
            <a class="pinnackl-menu-heading" href="<?php $this->show('siteurl')?>nimda/">Pinnackl Press</a>
            <ul class="pinnackl-menu-list">
        	<?php foreach ($this->viewData->menu as $key => $value) : ?>
                <li class="pinnackl-menu-item <?php $this->isActive($this->show($value, 'page_tag'))?>">
                    <a href="<?php $this->show('siteurl')?>nimda/<?php $this->show($value, 'page_tag');?>"
                        class="pinnackl-menu-link">
                        <?php $this->show($value, 'page_name')?>
                    </a>
                </li>
            <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div id="updated" class="notification">
        <span class="close-notification noselect">&#215;</span>
        <span class="text-notification"></span>
    </div>