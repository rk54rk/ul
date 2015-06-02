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

get_header();?>

<div class="container">
  <h2 style="margin-top:-4px">Archive</h2>

  <div class="row">

  <!--description-->
  <div class="col-sm-6" style="padding-right:100px;">
      <p>2014</p>
  </div>
    <div class="col-sm-6" style="padding-right:100px;">
    <?php 
    $ads = ul_ad_data_get(100);
      foreach ($ads as $ad){ ?>
      <a href="http://ww" target="_blank">
        <div class="fv_dot" style="background-image:url(/wp-content/uploads/ad/<?php echo $ad["thumbnail"] ?>)">
          <div class="fv_bigpic">
            <div class="fv_caption">
              <div class="fv_caption_title"><?php echo $ad["title"] ?></div>
              <div class="fv_caption_bname"><?php echo $ad["business_name"] ?></div>
            </div>
            <img class="fv_bigpic_img" src="/wp-content/uploads/ad/<?php echo $ad["bigpic"] ?>"></img>
          </div>
        </div>
      </a>
    <?
      }
      ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>
