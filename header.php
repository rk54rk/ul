<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package ul
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<!-- Bootstrap from CDN -->
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/inc/bootstrap.min.css">
<!-- Google fonts -->
<link href='http://fonts.googleapis.com/css?family=Trocchi' rel='stylesheet' type='text/css'>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

	<header id="masthead" class="site-header" role="banner">        
        <nav class="navbar-top navbar navbar-default navbar-static-top" style="z-index:9999;">
          <div class="container">
            <div class="navbar-header">
			  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
            </div>
            <ul class="navbar-nav navbar-right">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Menu</span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Buy advertising</a></li>
                    <li><a href="#">About us</a></li>
                    <li><a href="#">Join the company</a></li>
                    <li><a href="#">Boardroom</a></li>
                  </ul>
                </li>
              </ul>
          </div>
        </nav>        
            
	</header><!-- #masthead -->


	<div id="content" class="site-content">
