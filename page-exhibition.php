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

<!-- styles specific to exhibition environment -->
<style>
  body, html{background-color:#000;background-image:none;overflow:hidden}
  .fv_dot{}
  #navbar-menu{display:none;}
  #navbar-logo a{display:none;}
  .fv_caption {display:block;opacity:0;transition:opacity 0.5s linear;}
  .fv_bigpic{display:block;opacity:0;transition:opacity 0.5s linear;}
</style>

<!-- hidden for exhibition version -->
<div class="container" style="display:none;" data-scroll-index="0">
    <a href="<?php echo site_url( '/archive', 'http' ); ?>" class="dropdown-toggle"><span id="home-all-ads" class="with-border home-button">Archive</span></a>
    <a href="#" onclick="home_autoscroll()" class="dropdown-toggle"><span id="home-about" class="with-border home-button">About</span></a>
</div>

<div class="container-fluid" style="min-height:100vh;margin-top:-135px;padding-top:-135px">
	<div class="row">
        <div style="height:30px;"></div>

        <div class="container-fluid">
            <?php include(locate_template( 'parts/facevalue/facevalue.php' )); ?>
        </div>
    </div>  
</div>


<div class="container-fluid" style="min-height:100vh;overflow:hidden;" data-scroll-index="1">
	<div class="row">
    	<div class="container" style="pointer-event:none;">
            <div class="row">
                <div class="col-sm-6" style="height:100px;"></div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    
                    <p id="fv_home_text" style="color:white;text-align:left">Unlimited Limited is a venture communist corporation, or an austere capitalist commune. It is an experiment on the form of the business organization. Making revenue from advertisement, it then distribute its humble wealth and power equally to its shareholders, which is open for anyone to sign up, free of charge.</p>
                    <A name="about"></A>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

var s=1;
var d_dot;

// switching page every a while
setInterval(
  function () {
    if (s==0){
      home_autoscroll();
      s = 1;
    }
    else{
      home_autoscroll_top();
      s = 0;
    }
  }, 10000
);

// open an ad every a while
setInterval(
  function () {
    jQuery(d_dot).find('.fv_caption').css( "opacity", '0');
    jQuery(d_dot).find('.fv_bigpic').css( "opacity", '0');

    d_dot = Math.floor(Math.random() * dot_id);
    d_dot = '#dot' + d_dot;
    console.log(d_dot);
    
//    jQuery(d_dot).find('.fv_caption').css( "display", 'block');
//    jQuery(d_dot).find('.fv_bigpic').css( "display", 'block');
    
    jQuery(d_dot).find('.fv_caption').css( "opacity", '1');
    jQuery(d_dot).find('.fv_bigpic').css( "opacity", '1');
    
  }, 2000
);

  
</script>

<?php get_footer();?>
