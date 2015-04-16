<?php

function ul_ad_add($title, $link, $ext){
    global $wpdb;
    $wpdb->insert( 
        'ul_ad', 
        array( 
            'title' => $title,
            'link' => 'http://'.$link,
        ), 
        array( 
            '%s',
            '%s'
        ) 
    ); 
    
    $id_new = $wpdb->insert_id;
    
    $wpdb->update( 
        'ul_ad', 
        array( 
            'thumbnail' => date('Y').'/'.$id_new.'_'.str_replace(' ', '-', $title).'_s.'.$ext,
            'bigpic' => date('Y').'/'.$id_new.'_'.str_replace(' ', '-', $title).'_l.'.$ext
        ), 
        array( 'ID' => $id_new ), 
        array( 
            '%s',	
            '%s'	
        ), 
        array( '%d' ) 
    );
    
    return $id_new;
}


function ul_ad_saveimg($id_new, $title, $ext, $size){
  //define sizes
  if ($size == 'l'){
      $height = 600;
      $width = 600;
  } else if ($size == 's'){
      $height = 100;
      $width = 100;      
  }
    
  /* Get original image x y*/
  list($w, $h) = getimagesize($_FILES['image']['tmp_name']);
  /* calculate new image size with ratio */
  $ratio = max($width/$w, $height/$h);
  $h = ceil($height / $ratio);
  $x = ($w - $width / $ratio) / 2;
  $w = ceil($width / $ratio);
  /* new file name */
  $path = ABSPATH . 'wp-content/uploads/ad/'.date('Y').'/'.$id_new.'_'.str_replace(' ', '-', $title).'_'.$size.'.'.$ext;
  /* read binary data from image file */
  $imgString = file_get_contents($_FILES['image']['tmp_name']);
  /* create image from string */
  $image = imagecreatefromstring($imgString);
  $tmp = imagecreatetruecolor($width, $height);
  imagecopyresampled($tmp, $image,
    0, 0,
    $x, 0,
    $width, $height,
    $w, $h);
    
  /* Save image */
  
  if (!file_exists(ABSPATH . 'wp-content/uploads/ad/'.date('Y'))) {
    mkdir(ABSPATH . 'wp-content/uploads/ad/'.date('Y'), 0774, true);
  }
    
  switch ($_FILES['image']['type']) {
    case 'image/jpeg':
      imagejpeg($tmp, $path, 90);
      break;
    case 'image/png':
      imagejpeg($tmp, $path, 90);
      break;
    case 'image/gif':
      imagejpeg($tmp, $path, 90);
      break;
    default:
      exit;
      break;
  }

  /* cleanup memory */
  imagedestroy($image);
  imagedestroy($tmp);

  $url = site_url() . '/wp-content/uploads/ad/'.date('Y').'/'.$id_new.'_'.str_replace(' ', '-', $title).'_'.$size.'.'.$ext;
  return $url;
    
}


function ul_paypal_paid($payment_amount, $payer_email, $txn_id){
    global $wpdb;
    $wpdb->insert( 
        'ul_ad', 
        array(  
            'payer_email' => $payer_email,
            'txn_id' => $txn_id
        ), 
        array( 
            '%s',
            '%d'
        ) 
    );
}
?>