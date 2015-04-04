<!-- Default config form Tempalte -->
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
    <title>{{title}}</title>
<link rel="stylesheet" href="template/css/base/base.css">
<link rel="stylesheet" href="template/css/grids/grids-core.css">
<link rel="stylesheet" href="template/css/menus/menus-core.css">
<link rel="stylesheet" href="template/css/menus/extend.css">
<link rel="stylesheet" href="template/css/menus/side-menu.css">
<link rel="stylesheet" href="template/css/forms/forms.css">
<link rel="stylesheet" href="template/css/buttons/buttons.css">
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
            <ul class="pinnackl-menu-list">
        	{% macros %}
            <li class="pinnackl-menu-item {{active}}"><a href="../nimda/{{menu}[L]}" class="pinnackl-menu-link">{{menu}}</a></li>
            {% endmacros %}
            </ul>
        </div>
    </div>