<?php

//export recent ads to a static file for facevalue.js to load.
function ul_ad_data_update_static(){
    $content = json_encode(ul_ad_data_get(100));
    $path = ABSPATH.'wp-content/themes/ul/parts/facevalue/data_ad.json';
    file_put_contents($path , $content);
    echo 'new data_ad.json generated';
}

//get recent advertising data from database ul_ad table
function ul_ad_data_get($entries){
    global $wpdb;
    
    $results = $wpdb->get_results( 
	"  
    SELECT * FROM ul_ad
    ORDER BY ID DESC
    LIMIT $entries;
	",
    ARRAY_A
    );
    
    return $results; 
}

?>