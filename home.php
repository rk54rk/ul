<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package ul
 */

get_header(); ?>

<div class="page-title" style="text-align:center;position:relative;top:-45px">Total value of the company</div>

<div class="container" style="height:100vh">
    
    <div style="height:30px;"></div>
    
    <?php include(locate_template( 'parts/facevalue/facevalue.php' )); ?>
    
    <div style="height:100px;"></div>
    <p style="text-align:center;"><a href="<?php echo site_url( '/buy', 'http' ); ?>">Buy an advertising for £10.</a> | <a href="<?php echo site_url( '/buy', 'http' ); ?>">View all advertising</a></p>
    
</div>

<div class="container-fluid">
	<div class="row" style="background-color:#FFFFC0">
    	<div class="container">
        	<div class="infinity-scroll">
            <h3 style="text-align:center;">The Unlimited Limited is an experimental commercial organization. </h3>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>
