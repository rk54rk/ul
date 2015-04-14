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

<div class="page-title" style="text-align:center;position:relative;top:-45px">Buy advertising</div>

<div class="container">
    <div>
    <br><br>
    Here you can pay GBP 10 to put up a new advert on the front page of Unlimited Ltd.
    <br><br>
    </div>

<?php
// image uploader settings
$max_file_size = 1024*500; // 500kb
$valid_exts = array('jpeg', 'jpg', 'png', 'gif');

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_FILES['image'])) {
  if( $_FILES['image']['size'] < $max_file_size ){
    // get file extension
    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    if (in_array($ext, $valid_exts)) {
        
      // add new database entry, get the id of the entry.
      $title = $_POST['title'];
      $link = $_POST['link'];
      $id_new = ul_ad_add($title, $link, 'jpg');
        
      /* resize and save images */
      $file_S = ul_ad_saveimg($id_new, $title, 'jpg', 's');
      $file_L = ul_ad_saveimg($id_new, $title, 'jpg', 'l');
      
      
      // show second screen: confirmation page and Paypal button.
      ?>
    <style>
        #add-ad-1{display:none;}
    </style>
    
    <div id="add-ad-2"> 
        Step 2: Confirmation
        
        <br><br>
        
        <div class="ad-img-s" style="height:50px;width:50px;border-radius: 50%;box-shadow: 5px 5px 5px #CCC;background-size:cover;background-image: url('<?php echo $file_S;?>')"></div>
        
        <br><br>
        
        <div class="ad-img-l" style="height:250px;width:250px;box-shadow: 10px 10px 10px #CCC;background-size:cover;background-image: url('<?php echo $file_L;?>')"></div>
        
        <br><br>
    
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
        <input type="hidden" name="cmd" value="_s-xclick">
        <input type="hidden" name="hosted_button_id" value="ZMU5DJ72YCE9N">
        <input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_paynow_SM.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
        <img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
        </form>
    </div>
    
    
      <?php
    } else {
      $msg = 'Unsupported file';
    }
  } else{
    $msg = 'Please upload image smaller than 500KB';
  }

}

?>

    <?php if(isset($msg)){echo $msg; echo '<br><br><br>';} ?>
    
    <div id="add-ad-1"> 
        Step 1: Basic information
        <form action="" method="post" enctype="multipart/form-data">
            
          <div class="form-group">
            <label for="inputTitle">Advertising title</label>
            <input class="form-control" name="title" placeholder="Enter title">
          </div>
            
          <div class="form-group">
            <label for="exampleInputEmail1">Advertised link</label>
            <input class="form-control" name="link" placeholder="Enter URL">
          </div>
            
          <div class="form-group">            
              <label><span>Advertising image, recommond jpeg/png 600 x 600 px, max size 500kb</span></label>
              <input type="file" name="image" accept="image/*" />
          </div>
            
          <input type="submit" value="Next step" />
        </form>        
    </div>

</div>

<?php get_footer(); ?>
