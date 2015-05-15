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
    <h4>Here you can put up a new advert on the front page of Unlimited Limited. Currently we charge £1 per advertising.</h4>
    <h5>Our front page will only display 50 latest advertisings. That means your ad could be replaced by new ones after a while, however it will be stored in our archive indefinately. You ad could also randomly appear on the printed matters of the Unlimited Limited.</h5>
</div>
        
        
<!--buy ad forms, 2 steps-->
<div class="col-sm-6">

<?php
// image uploader settings
$max_file_size = 1024*500; // 500kb
$valid_exts = array('jpeg', 'jpg', 'png', 'gif');

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_FILES['image']) AND isset($_FILES['thumbnail']) ) {
  
  $title = $_POST['title'];
  $link = $_POST['link'];
  $business = $_POST['business'];

  //check input type
  if ($title == ""){
    exit('Please enter the advertising description.');
  } else if (strlen($title) > 100){
    exit('Please make sure the advertising description is under 100 characters.');
  }
  
  if ($link == ""){
    exit('Please enter the advertising link.');
  } else if (strlen($link) > 200){
    exit('Your advertising link is too long. (it can not be more than 200 characters)');
  }
  
  if ($business == ""){
    exit('Please enter the name of your business.');
  } else if (strlen($business) > 50){
    exit('Please make sure the business name you entered is under 50 characters.');
  }
    
  if( $_FILES['image']['size'] < $max_file_size && $_FILES['thumbnail']['size'] < $max_file_size){
    // get file extension
    $ext_l = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    $ext_s = strtolower(pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION));
    
    // size and dimension check for thumbnails
    list($w, $h) = getimagesize($_FILES['thumbnail']['tmp_name']);
    if( $_FILES['thumbnail']['size'] > 1024*50 ){
        exit('Thumbnail size can not be more than 50kb');
    } 
    if ( $w > 200 || $h > 200 ){
        exit('Thumbnail both sides should not be more than 200 pixels. Currently '.$w.'/'.$h.' pixels.');
    }
    
    // size and dimension check for main pictures
    list($w, $h) = getimagesize($_FILES['image']['tmp_name']);
    if( $_FILES['image']['size'] > 1024*200 ){
        exit('Main image size can not be more than 200kb');
    } 
    if ( $w > 600 || $h > 600 ){
        exit('Main image both sides should not be more than 600 pixels. Currently '.$w.'/'.$h.' pixels.');
    }
    
    //general check if is in a valid image format
    if (in_array($ext_l, $valid_exts) && in_array($ext_s, $valid_exts)) {
        
      // add new database entry, get the id of the entry.
      $ad_id = ul_ad_add($title, $link, $business, $ext_l, $ext_s);
        
      if ($ad_id == 0){
          
          exit('Error writting to database.');
      
      } else {
    
      /* resize and save images */
      $file_L = ul_ad_saveimg($ad_id, $title, 'image', $ext_l, 'l');
      $file_S = ul_ad_saveimg($ad_id, $title, 'thumbnail', $ext_s, 's');
          
      }
      
      // show second screen: confirmation page and Paypal button.
      ?>
    <style>
        #add-ad-1{display:none;}
    </style>
    
    <div id="add-ad-2"> 
        <h4>Step 2: Confirmation</h4>
        
        <br>
        <span class="paypal_button">
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="ZMU5DJ72YCE9N">
            <input type="hidden" name="custom" value="<?php echo $ad_id;?>"/>
            <input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_paynow_SM.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
            <img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
            </form>
        </span>
        
        <br>
        
        <div class="ad-img-s" style="height:50px;width:50px;border-radius: 50%;box-shadow: 4px 4px 12px rgba(0,0,0,0.2);background: url('<?php echo $file_S;?>');background-color:#fff;background-position: center center;background-repeat:no-repeat;background-size:cover;"></div>
        
        <br>
        <div class="bigpic">
            <div class='fv_caption' style="padding:5px 10px;position:absolute;width:150px;background-color:white;box-shadow: 2px 6px 18px rgba(0,0,0,0.3);z-index:1">
                <div class='fv_caption_title' style="font-size:6px;padding:5px 0;"><?php echo $_POST['title']; ?></div>
                <div class='fv_caption_bname' style="padding:5px 0;font-size:6px;color:#BBB"><?php echo $_POST['business']; ?></div>
            </div>
            <img class="bigpic_img" src="<?php echo $file_L;?>" class="ad-img-l" style="margin-left:140px;background-color:#fff;display:inline;box-shadow: 4px 12px 36px rgba(0,0,0,0.3);position:absolute;z-index:2;margin-top:10px;max-width:300px;max-height:300px"></img>
        </div>
        <br>

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
            <label for="inputText">Advertising description, 100 charaters max.</label>
              <input class="form-control" name="title" placeholder="">
          </div>
            
          <div class="form-group">
            <label for="inputBusiness">Your business name, 50 characters max.</label>
            <input class="form-control" name="business" placeholder="Your business name">
          </div>
            
          <div class="form-group">
            <label for="link">Advertised link</label>
            <div class="input-group">
                <div class="input-group-addon">http://</div>
                <input class="form-control" name="link" placeholder="">
            </div>
          </div>
            
          <div class="form-group">            
              <label>Thumbnail which will show on the circular icons.</label>
              <div style="font-size:11px">The thumbnail image can be jpg, png or gif. Maximum file size is 20kb, either side of the image should not be more than 200 pixels.</div>
              <input type="file" name="thumbnail" accept="image/*" />
          </div>
            
          <div class="form-group">            
              <label>Main advertising image.</label>
              <div style="font-size:11px">The main image can be jpg, png or gif. Maximum file size is 200kb, either side of the image should not be more than 600 pixels. (This image will be displayed within a 300 * 300 pixel box, while HD displays will benefit from an image larger than this size.) </div>
              <input type="file" name="image" accept="image/*" />
          </div>
          <div style="font-size:11px">Your uploaded images won't be resized or cropped by the server to ensure best image quality. However, you may need to edit your image before upload, with Photoshop or other image editor such as <a style="font-size:11px;" href="http://apps.pixlr.com/editor/">Pixelr</a>. You will find a preview of your advertising during the next step.</div>
            
            <br>
            
          <input type="submit" value="Next step" />
        </form>        
    </div>
        
        </div>
    </div>
</div>

<?php get_footer(); ?>
