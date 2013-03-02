<!doctype html>
<html lang="<?php echo $lang; ?>">
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
                <li <?php if($method == 'sale/requirement'): ?>class="active"<?php endif; ?>><a href="/sale/requirement">購屋需求</a></li>
                <li <?php if($method == 'sale/add'): ?>class="active"<?php endif; ?>><a href="/sale/add">新增物件</a></li>
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
