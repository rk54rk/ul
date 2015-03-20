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

<div style="height:10px;"></div>
<?php include(locate_template( 'parts/facevalue/facevalue.php' )); ?>
<div>&nbsp;</div>

<?php get_footer(); ?>
