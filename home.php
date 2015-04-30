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

<div class="page-title"><span style="border-bottom:1px solid #444;"></span></div>

<div class="container-fluid" style="min-height:100vh">
	<div class="row">
        <div style="height:30px;"></div>

        <div class="container-fluid">
            <?php include(locate_template( 'parts/facevalue/facevalue.php' )); ?>
        </div>
    </div>  
</div>


<div class="container-fluid" style="min-height:100vh;background-color:#FFFFC0;z-index:-1;">
	<div class="row">
    	<div class="container">
            <div class="row">
                <div class="col-sm-6" style="height:100px;"></div>
            </div>
            <div class="row">
                <div class="col-sm-6" style="background-color:#FFFFC0;box-shadow:0 0 20px 20px #FFFFC0">
                    
                    <p style="text-align:left">The Unlimited Limited is a venture communist corporation, or an austere capitalist commune. It makes revenue from advertisement, then distribute the wealth and power equally to each share holder of the company, or inhabitant of the community.</h3>
                    <p>The total value of the company: £0.00<br>Total share holders: 1 <br>Each one have of the company:£0.00</p>
                    <p>Click here to sign up as a share holder.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>
