<?php ?>
<!-- Default config form Tempalte -->
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    
    <title><?php $this->show('title') ?></title>
    <link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/css/base/base.css">
    <link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/css/grids/grids-core.css">
    <link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/css/menus/menus-core.css">
    <link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/css/menus/extend.css">
    <link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/css/menus/side-menu.css">
    <link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/css/forms/forms.css">
    <link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/css/forms/extend.css">
    <link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/css/buttons/buttons.css">
    <link rel="stylesheet" href="<?php $this->show('siteurl')?>nimda/template/css/tables/extend.css">
</head>
<body>
<div id="layout">
    <!-- Menu toggle -->
    <a href="#menu" id="menuLink" class="menu-link">
        <!-- Hamburger icon -->
        <span></span>
    </a>

    <div id="menu">
        <div class="pinnackl-menu">
            <a class="pinnackl-menu-heading" href="../nimda/">Pinnackl Press</a>
            <!-- <a class="pinnackl-menu-heading" href="../">Your site</a> -->
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
