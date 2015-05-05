<?php
/* Load WP functions */
define('WP_USE_THEMES', false);
require('../../../../../wp-blog-header.php');

    //generate static JSON files for displaying front page
    ul_ad_data_update_static();
    ul_balance_update_static();

echo 'sucess';
?>