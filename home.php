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

// refresh json files for development mode
//ul_ad_data_update_static();
//ul_balance_update_static();

get_header(); ?>

<!--reserved button for view all ads-->
<div class="container additional-top-btns">
    <a href="<?php echo site_url( '/archive', 'http' ); ?>" class="dropdown-toggle"><span id="home-all-ads" class="with-border home-button">Archive</span></a>
    <a href="#" onclick="home_autoscroll()" class="dropdown-toggle"><span id="home-about" class="with-border home-button">About</span></a>
</div>

<div class="container-fluid" style="min-height:100vh;background-color:rgba(250,250,250,1);margin-top:-135px;padding-top:-135px;box-shadow: 4px 0px 36px rgba(0,0,0,0.3);">
	<div class="row">
        <div style="height:30px;"></div>

        <div class="container-fluid">
            <?php include(locate_template( 'parts/facevalue/facevalue.php' )); ?>
        </div>
    </div>  
</div>


<div class="container-fluid" style="min-height:100vh;overflow:hidden;">
	<div class="row">
    	<div class="container" style="pointer-event:none;">

            <div class="row">
                <div id="fv_home_text" class="col-sm-6">
                    
                    <p style="padding-top:100px;text-align:left">Unlimited Limited is a venture communist corporation, or an austere capitalist commune. It is an experiment on the form of the business organization. Making revenue from advertisement, it then distribute its humble wealth and power equally to its shareholders, which is open for anyone to <a href="http://hq.unlimitedltd.co/signup" style="white-space:nowrap;">sign up</a>, free of charge.</p>
                    <A name="about"></A>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>
