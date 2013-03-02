<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--><html class="no-js" lang="<?php echo $lang; ?>"> <!--<![endif]-->

<head>
<meta charset="<?php echo $meta_charset; ?>">
<title><?php echo $site_title; ?></title>
<meta name="description" content="<?php echo $site_description; ?>" />
<meta name="keywords" content="<?php echo $site_keywords; ?>" />
<?php echo $meta_tag; ?>
<?php echo $styles; ?>
<!-- JS -->
<?php echo $scripts_header; ?>
</head>
<body>
<div class="container">
    <div class="navbar">
        <div class="navbar-inner">
            <a class="brand" href="#">House</a>
            <ul class="nav">
                <li <?php if($method == 'sale/lists'): ?>class="active"<?php endif; ?>><a href="/sale/lists">個人物件</a></li>
                <li <?php if($method == 'sale/add'): ?>class="active"<?php endif; ?>><a href="/sale/add">新增物件</a></li>
                <li <?php if($method == 'agentstore'): ?>class="active"<?php endif; ?>><a href="/agentstore">我的店舖</a></li>
                <li <?php if($method == 'agentstore/add'): ?>class="active"<?php endif; ?>><a href="/agentstore/add">新增店舖</a></li>
                <li <?php if($method == 'agentstore/edit'): ?>class="active"<?php endif; ?>><a href="/agentstore/edit">編輯店舖</a></li>
            </ul>
        </div>
    </div>
    <div id="content">
        <?php echo $content; ?>
    </div>
</div>
<?php echo $scripts_footer; ?>
</body>
</html>
