<?php


//export paypal balance to a file.
function ul_balance_update_static(){
    $balance = get_paypal_balance();
    $content = "{ %22type%22 : %22£".$balance."%22, %22value%22 : %22".$balance."%22}";
    $path = ABSPATH.'wp-content/themes/ul/parts/facevalue/data.json';
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
    SELECT ID, title, link, business_name, thumbnail, bigpic
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