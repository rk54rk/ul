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
<div class="row">
        
<!--description-->
<div class="col-sm-6" style="padding-right:100px;">
    <h2 style="margin-top:-4px">Buy our front page advertising</h2>
    <p>Here you can put up a new advert on the front page of Unlimited Limited. Currently we charge £1 per advertising.</p>
    <p>Our front page will only display 50 latest advertisings. That means your ad could be replaced by new ones after a while, however it will be stored in our archive indefinately.</p>
    <p>You ad could also randomly appear on the printed matters of the Unlimited Limited.</p>
</div>
        
        
<!--buy ad forms, 2 steps-->
<div class="col-sm-6">

<?php
// image uploader settings
$max_file_size = 1024*500; // 500kb
$valid_exts = array('jpeg', 'jpg', 'png');

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_FILES['image']) AND isset($_FILES['thumbnail']) ) {
  if( $_FILES['image']['size'] < $max_file_size ){
    // get file extension
    $ext_l = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    $ext_s = strtolower(pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION));
      
    if (in_array($ext_l, $valid_exts) && in_array($ext_s, $valid_exts)) {
        
      // add new database entry, get the id of the entry.
      $title = $_POST['title'];
      $link = $_POST['link'];
      $business = $_POST['business'];
      $ad_id = ul_ad_add($title, $link, $business, $ext_l, $ext_s);
        
      /* resize and save images */
      $file_L = ul_ad_saveimg($ad_id, $title, 'image', $ext_l, 'l');
      $file_S = ul_ad_saveimg($ad_id, $title, 'thumbnail', $ext_s, 's');
      
      
      // show second screen: confirmation page and Paypal button.
      ?>
    <style>
        #add-ad-1{display:none;}
    </style>
    
    <div id="add-ad-2"> 
        <h4>Step 2: Confirmation</h4>
        
        <br><br>
        
        <div class="ad-img-s" style="height:50px;width:50px;border-radius: 50%;box-shadow: 4px 4px 12px rgba(0,0,0,0.2);background-size:cover;background-image: url('<?php echo $file_S;?>')"></div>
        
        <br><br>
        
        <img src="<?php echo $file_L;?>" class="ad-img-l" style="display:inline;box-shadow: 8px 8px 24px rgba(0,0,0,0.2);"></img>
        
        <br><br>
    
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
        <input type="hidden" name="cmd" value="_s-xclick">
        <input type="hidden" name="hosted_button_id" value="ZMU5DJ72YCE9N">
        <input type="hidden" name="custom" value="<?php echo $ad_id;?>"/>
        <input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_paynow_SM.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
        <img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
        </form>

    </div>
    
    
      <?php
    } else {
      $msg = 'Unsupported file';
    }
  } else{
    $msg = 'The files should each be smaller than 500KB';
  }

} else {
    
}

?>

    <?php if(isset($msg)){echo $msg; echo '<br><br><br>';} ?>
    
    <div id="add-ad-1"> 
        <h4>Step 1: create advertising</h4>
        <form action="" method="post" enctype="multipart/form-data">
            
          <div class="form-group">
            <label for="inputText">Advertising title</label>
              <input class="form-control" name="title" placeholder="">
          </div>
            
          <div class="form-group">
            <label for="link">Advertised link</label>
            <div class="input-group">
                <div class="input-group-addon">http://</div>
                <input class="form-control" name="link" placeholder="">
            </div>
          </div>
            
          <div class="form-group">            
              <label>Thumbnail which will show on the circular icons, recommond jpg/jpeg/png.</label>
              <input type="file" name="thumbnail" accept="image/*" />
          </div>
            
          <div class="form-group">            
              <label>Big advertising image, recommond jpg/jpeg/png, max file size 500kb</label>
              <input type="file" name="image" accept="image/*" />
          </div>
            
            
          <div class="form-group">
            <label for="inputBusiness">Your business name</label>
            <input class="form-control" name="business" placeholder="Your business name">
          </div>
            
          <input type="submit" value="Next step" />
        </form>        
    </div>
        
        </div>
    </div>
</div>

<?php get_footer(); ?>
