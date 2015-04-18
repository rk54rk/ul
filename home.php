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

<div class="page-title"><span>Total value of the company</span></div>

<div class="container-fluid" style="min-height:100vh">
	<div class="row">
        <div style="height:30px;"></div>

        <div class="container-fluid">
            <?php ul_balance_update_static(); ?>
<?php

ul_ad_data_update_static();
    
?>
            <?php include(locate_template( 'parts/facevalue/facevalue.php' )); ?>
        </div>
        
        <div style="height:50px;"></div>
        
        <div style="position:absolute;bottom:50px;width:100%">
            
            <div class = "container">
                    <table width="100%">
                        <tr>
                            <td width="33%" style="text-align:left">
                                <span><a href="<?php echo site_url( '/buy', 'http' ); ?>">Buy an advertising for £10.</a></span>
                            </td>
                            <td width="34%" style="text-align:center">
                                <span><a href="#" onclick="home_autoscroll()">About us</a></span>
                            </td>
                            <td width="33%" style="text-align:right">
                                <span>View all advertising</span>
                            </td>
                        </tr>
                    </table>
            </div>
            
        </div>
    </div>  
</div>


<div class="container-fluid" style="min-height:100vh;background-color:#FFFFC0;z-index:-1;">
	<div class="row">
    	<div class="container">
        	<div class="infinity-scroll">
                <div style="height:100px;"></div>
                <h3 style="text-align:left;">The Unlimited Limited is a venture communist corporation, or an austere capitalist commune. It&nbsp;makes revenue from advertisement, then distribute the wealth and power equally to each share holder of the company, or, inhabitant of the community. It is not intended to be a critique, but to explore new forms of ‘doing business’ or ‘running a commercial organization’ in the backdrop of decentralization in the internet age.</h3>
                <h3>The total value of the company: £0.00<br>Total share holders: 1 <br>Each one have of the company:£0.00</h3>
                <h3>Click here to sign up as a share holder.</h3>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>
