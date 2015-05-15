<?php

function ul_ad_add($title, $link, $business, $ext_l, $ext_s){
    global $wpdb;
    $wpdb->insert( 
        'ul_ad', 
        array( 
            'title' => $title,
            'link' => 'http://'.$link,
            'business_name' => $business
        ), 
        array( 
            '%s',
            '%s',
            '%s'
        ) 
    ); 
    
    $id_new = $wpdb->insert_id;
    
    $wpdb->update( 
        'ul_ad', 
        array( 
            'thumbnail' => date('Y').'/'.$id_new.'_s.'.$ext_s,
            'bigpic' => date('Y').'/'.$id_new.'_l.'.$ext_l
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


function ul_ad_saveimg($id_new, $title, $file, $ext, $size){
  /* new file name */
  $path = ABSPATH . 'wp-content/uploads/ad/'.date('Y').'/'.$id_new.'_'.$size.'.'.$ext;
  
    if (!file_exists(ABSPATH . 'wp-content/uploads/ad/'.date('Y'))) {
        mkdir(ABSPATH . 'wp-content/uploads/ad/'.date('Y'), 0774, true);
    }
  
    //this is not right, should be move file.
    rename($file['tmp_name'], $path);

  $url = site_url() . '/wp-content/uploads/ad/'.date('Y').'/'.$id_new.'_'.$size.'.'.$ext;
  return $url;
    
}


?>