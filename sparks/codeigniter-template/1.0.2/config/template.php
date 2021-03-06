<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * default layout
 * Location: application/views/
 */
$config['template_layout'] = 'template/layout';

/**
 * default css
 */
$config['template_css'] = array(
    'http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.0/css/bootstrap-combined.min.css' => 'screen',
    'http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/themes/ui-darkness/jquery-ui.css' => 'screen'
);

/**
 * default javascript
 * load javascript on header: FALSE
 * load javascript on footer: TRUE
 */
$config['template_js'] = array(
    '//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js' => false,
    '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js' => false,
    '//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.0/js/bootstrap.min.js' => false,
    '//cdnjs.cloudflare.com/ajax/libs/handlebars.js/1.0.0-rc.3/handlebars.min.js' => false
);

/**
 * default variable
 */
$config['template_vars'] = array(
    'site_description' => 'house',
    'site_keywords' => 'house'
);

/**
 * default site title
 */
$config['base_title'] = 'house';

/**
 * default title separator
 */
$config['title_separator'] = ' | ';
