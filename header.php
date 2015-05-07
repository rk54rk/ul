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
<!-- Favicon -->
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/favicon.png" />

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

	<header id="masthead" class="site-header" role="banner">        
        <nav class="navbar-top navbar navbar-default navbar-fixed-top" style="z-index:999;">
          <div class="container">
            <div id="navbar-logo" class="navbar-header navbar-block">
			  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
            </div>
              
            <ul id="navbar-menu" class="nav navbar-nav navbar-left">
                <li class="dropdown">
                    
                  <a href="#" class="dropdown-toggle with-border" data-toggle="dropdown" role="button" aria-expanded="false" style="border:2px solid #444;padding:3px 6px;margin-top:-3px;margin-left:30px;" >
                      <span>Menu</span>
                  </a>
                    
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo site_url( '/#about', 'http' ); ?>">About</a></li>
                    <li><a href="<?php echo site_url( '/buy', 'http' ); ?>">Buy an ad</a></li>
                    <li><a href="http://hq.unlimitedltd.co/signup">Join the company</a></li>
                    <li><a href="http://hq.unlimitedltd.co">Headquarters</a></li>
                  </ul>
                </li>
              </ul>
          </div>
        </nav>        
            
	</header><!-- #masthead -->


	<div id="content" class="site-content">
