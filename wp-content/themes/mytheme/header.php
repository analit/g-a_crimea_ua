<?php ?>

<meta charset="<?php bloginfo('charset'); ?>" />

<title><?php wp_title('|', true, 'right'); ?></title>

<meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">        

<!-- common stylesheets-->
<!-- bootstrap framework css -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/bootstrap/css/bootstrap-responsive.min.css">
<!-- iconSweet2 icon pack (16x16) -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/img/icsw2_16/icsw2_16.css">
<!-- splashy icon pack -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/img/splashy/splashy.css">
<!-- flag icons -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/img/flags/flags.css">
<!-- power tooltips -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/lib/powertip/jquery.powertip.css">

<link type="image/x-icon" rel="icon" href="<?php echo get_template_directory_uri(); ?>/img/LogoGA.ico">
<link type="image/x-icon" rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/LogoGA.ico">

<!-- aditional stylesheets -->


<!-- main stylesheet -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/beoro.css">

<!--[if lte IE 8]><link rel="stylesheet" href="css/ie8.css"><![endif]-->
<!--[if IE 9]><link rel="stylesheet" href="css/ie9.css"><![endif]-->

<!--[if lt IE 9]>
    <script src="js/ie/html5shiv.min.js"></script>
    <script src="js/ie/respond.min.js"></script>
    <script src="js/lib/flot-charts/excanvas.min.js"></script>
<![endif]-->

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>"type="text/css" media="screen" />

<?php wp_head(); ?>