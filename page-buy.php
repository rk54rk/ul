<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');  //On or Off
// settings
$valid_exts = array('jpeg', 'jpg', 'png', 'gif');

//globals
$file_S = "";
$file_L = "";
$ad_id = "";

get_header();
session_start();
?>


<script>
jQuery(function () {
  jQuery('[data-toggle="tooltip"]').tooltip()
})
</script>

<div class="container">
  <div class="row">
    <div class="col-sm-6" style="padding-right:100px;">
        <h2 style="margin-top:-4px">Buy our front page advertising</h2>
        <h4>Here you can put up a new advert on the front page of Unlimited Limited. Currently we charge £1 per advertising.</h4>
        <h5>Our front page will only display 50 latest advertisings. That means your ad could be replaced by new ones after a while, however it will be stored in our archive indefinately. You ad could also randomly appear on the printed matters of the Unlimited Limited.</h5>
    </div>
        
    <div id="add_ad_forms" class="col-sm-6">
    
<?php
$post_data = "";
$files = "";

// post-redirect-get: redirect step
if(count($_POST) > 0) {
    
  $_SESSION['post_data'] = $_POST;
  
  if (isset($_FILES)){
    $_SESSION['files'] = $_FILES;

    // move the php temp files to a custom temp folder
    foreach ($_SESSION['files'] as $uploader => $file){
      // get the file to upload
      $fromfile=$_SESSION['files'][$uploader]['tmp_name'];

      // get just the filename
      $filename = pathinfo($fromfile, PATHINFO_FILENAME) . '.' . pathinfo ($fromfile, PATHINFO_EXTENSION);

      // give it a new path
      $tofile = ABSPATH . 'wp-content/uploads/ad/temp/'. $filename;

      // store the new temp location
      $_SESSION['files'][$uploader]['tmp_name'] = $tofile;

      // move the files to a temp location
      if (!is_dir(pathinfo($tofile,PATHINFO_DIRNAME))) {
          mkdir(pathinfo($tofile,PATHINFO_DIRNAME), 0777, true);
      }
      move_uploaded_file($fromfile,$tofile);
      
      unlink($fromfile);
      unset($file);
      unset($uploader);
    }
  }
  
  // redirect
  header("HTTP/1.1 303 See Other");
  header("Location: http://$_SERVER[HTTP_HOST]/buy"); //change this line remove static ref
  die();
}

// post-redirect-get: get step
else if (isset($_SESSION['post_data']) AND isset($_SESSION['files'])){
  $post_data = $_SESSION['post_data'];
  $files = $_SESSION['files'];
  
  ul_add_ad_save_and_insert();
  ul_destroy_session();
}

    
    if ($post_data == "" AND $files == ""){
      ul_add_ad_render_step1();
    }
    else {
      if(isset($msg)){
        echo $msg; 
        echo '<br><br><br>';
        ul_destroy_session();
        exit();
      }
      ul_add_ad_render_step2();
    }?>
        
    </div>
  </div>
</div>





<?php 
get_footer(); 


function ul_add_ad_render_step1(){
?>
    <div id="add-ad-1"> 
        <h4>Step 1: Advertising info</h4>
        <form action="" method="post" enctype="multipart/form-data">
            
          <div class="form-group">
            <label for="inputText">Advertising description, 100 charaters max.</label>
              <input class="form-control" name="title" placeholder="">
          </div>
            
          <div class="form-group">
            <label for="inputBusiness">Your business name, 50 characters max.</label>
            <input class="form-control" name="business" placeholder="">
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
              <span class="badge" data-toggle="tooltip" data-placement="top" title="The thumbnail image can be in either jpg, png or gif format. Maximum file size is 20kb, either side of the image should be no more than 200 pixels.">?</span>
              <input type="file" name="thumbnail" accept="image/*" />
          </div>
          <div class="form-group">            
              <label>Main advertising image.</label>
              <span class="badge" data-toggle="tooltip" data-placement="top" title="The main image can be jpg, png or gif. Maximum file size is 200kb, either side of the image should not be more than 600 pixels. (This image will be displayed within a 300 * 300 pixel box, while HD displays will benefit from an image larger than this size.)">?</span>
              <input type="file" name="image" accept="image/*" />
          </div>
          <div style="font-size:11px">Your uploaded images won't be resized or cropped by the server to ensure best image quality. However, you may need to edit your image before upload, with Photoshop or other image editor such as <a style="font-size:11px;" href="http://apps.pixlr.com/editor/">Pixelr</a>. You will find a preview of your advertising during the next step.</div>
            <br>            
          <input type="submit" value="Next step" />
        </form>        
    </div>
<?php
}


function ul_add_ad_render_step2(){
  global $post_data, $files, $valid_exts, $ad_id, $file_S, $file_L;
  ?>
    <div id="add-ad-2"> 
        <h4>Step 2: Confirmation</h4>
        <br>
        <span style="font-size:11px">Please pay here once you are happy with the preview.</span>
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
                <div class='fv_caption_title' style="font-size:6px;padding:5px 0;"><?php echo $post_data['title']; ?></div>
                <div class='fv_caption_bname' style="padding:5px 0;font-size:6px;color:#BBB"><?php echo $post_data['business']; ?></div>
            </div>
            <img class="bigpic_img" src="<?php echo $file_L;?>" class="ad-img-l" style="margin-left:140px;background-color:#fff;display:inline;box-shadow: 4px 12px 36px rgba(0,0,0,0.3);position:absolute;z-index:2;margin-top:10px;max-width:300px;max-height:300px"></img>
        </div>
        <br>

    </div>
<?php
}


function ul_add_ad_save_and_insert(){
  global $post_data, $files, $valid_exts, $ad_id, $file_S, $file_L;
  
  //save images and database insert
  
  $title = $post_data['title'];
  $link = $post_data['link'];
  $business = $post_data['business'];

  // get file extension
  $ext_l = strtolower(pathinfo($files['image']['name'], PATHINFO_EXTENSION));
  $ext_s = strtolower(pathinfo($files['thumbnail']['name'], PATHINFO_EXTENSION));
  
  // validation
  if ($title == ""){
    ul_destroy_session();
    exit('Please enter the advertising description.');
  } else if (strlen($title) > 100){
    ul_destroy_session();
    exit('Please make sure the advertising description is under 100 characters.');
  }
  
  if ($link == ""){
    ul_destroy_session();
    exit('Please enter the advertising link.');
  } else if (strlen($link) > 200){
    ul_destroy_session();
    exit('Your advertising link is too long. (it can not be more than 200 characters)');
  }
  
  if ($business == ""){
    ul_destroy_session();
    exit('Please enter the name of your business.');
  } else if (strlen($business) > 50){
    ul_destroy_session();
    exit('Please make sure the business name you entered is under 50 characters.');
  }
  
  if ($files['thumbnail']['name'] == ""){
    ul_destroy_session();
    exit('Please choose a thumbnail image.');
  }
  
  if (!in_array($ext_l, $valid_exts)){
    ul_destroy_session();
    exit('File format of the main advertising image is not supported. (must be either jpg, png, or gif)');
  }
  
  if (!in_array($ext_s, $valid_exts)){
    ul_destroy_session();
    exit('File format of the thumbnail is not supported. (must be either jpg, png, or gif)');
  }
  
  if ($files['image']['name'] == ""){
    ul_destroy_session();
    exit('Please choose a main advertising image file.');
  }
  
  // size and dimension check for thumbnails
  list($w, $h) = getimagesize($files['thumbnail']['tmp_name']);
  if( $files['thumbnail']['size'] > 1024*50 ){
    ul_destroy_session();
    exit('Thumbnail size can not be more than 50kb');
  } 
  if ( $w > 200 || $h > 200 ){
    ul_destroy_session();
    exit('Thumbnail both sides should not be more than 200 pixels. Currently '.$w.'/'.$h.' pixels.');
  }
    
  // size and dimension check for main pictures
  list($w, $h) = getimagesize($files['image']['tmp_name']);
  if( $files['image']['size'] > 1024*200 ){
    ul_destroy_session();
    exit('Main image size can not be more than 200kb');
  } 
  if ( $w > 600 || $h > 600 ){
    ul_destroy_session();
    exit('Main image both sides should not be more than 600 pixels. Currently '.$w.'/'.$h.' pixels.');
  }
    
  // pass validation    
  // add new database entry, get the id of the entry.
  $ad_id = ul_ad_add($title, $link, $business, $ext_l, $ext_s);
        
  if ($ad_id == 0){
    ul_destroy_session();
    exit('Error writting to database.');
      
  } else {
  
  /* resize and save images */
  $file_L = ul_ad_saveimg($ad_id, $title, $files['image'], $ext_l, 'l');
  $file_S = ul_ad_saveimg($ad_id, $title, $files['thumbnail'], $ext_s, 's');
  }
}

function ul_destroy_session(){
    session_unset();
    session_destroy();
}
?>