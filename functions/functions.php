<?php


//export paypal balance to a file.
function ul_balance_update_static(){
    //var data = '{ "value" : "£0.00" }';
    $content = "var display_type = '{ %22value%22 : %22£".get_paypal_balance()."%22 }'";
    $path = ABSPATH.'wp-content/themes/ul/parts/facevalue/data.js';
    file_put_contents($path , rawurldecode($content));
}

//export recent ads to a static file for facevalue.js to load.
function ul_ad_data_update_static(){
    $content = json_encode(ul_ad_data_get(100));
    $path = ABSPATH.'wp-content/themes/ul/parts/facevalue/data_ad.json';
    file_put_contents($path , $content);
}

//get recent advertising data from database ul_ad table
function ul_ad_data_get($entries){
    global $wpdb;
    
    $results = $wpdb->get_results( 
	"  
    SELECT ID, title, link, thumbnail, bigpic
    FROM ul_ad
    WHERE status = 'paid'
    ORDER BY ID DESC
    LIMIT $entries;
	",
    ARRAY_A
    );
    
    return $results; 
}

?>