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
<div class="container">
    <a href="<?php echo site_url( '/all-ads', 'http' ); ?>" class="dropdown-toggle"><span class="with-border home-button">All ads</span></a>
    <a href="#" onclick="home_autoscroll()" class="dropdown-toggle"><span class="with-border home-button">About</span></a>
</div>

<div class="container-fluid" style="min-height:100vh;">
	<div class="row">
        <div style="height:30px;"></div>

        <div class="container-fluid">
            <?php include(locate_template( 'parts/facevalue/facevalue.php' )); ?>
        </div>
    </div>  
</div>


<div class="container-fluid" style="min-height:100vh;background-color:#FFFFC0;overflow:hidden;">
	<div class="row">
    	<div class="container" style="pointer-event:none;">
            <div class="row">
                <div class="col-sm-6" style="height:100px;"></div>
            </div>
            <div class="row">
                <div class="col-sm-6" style="background-color:#FFFFC0;box-shadow:0 0 20px 20px #FFFFC0;margin-top:-100px;padding-top:100px">
                    
                    <p style="text-align:left">Unlimited Limited is a venture communist corporation, or an austere capitalist commune. It is an experiment on the form of the business organization. Making revenue from advertisement, it then distribute the wealth and power equally to its shareholders. Future ventures and daily running of the company are decided by voting in its <a href="http://hq.unlimitedltd.co">headquarters</a>.</p>
                    <p>Anyone can <a href="http://hq.unlimitedltd.co/signup">sign up</a> as a shareholder here for free.</p>
                    <A name="about"></A>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>
