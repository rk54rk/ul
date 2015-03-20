<?php
//replace default wp_login.php page
function redirect_login_page() {  
    $login_page  = home_url( '/login/' );  
    $page_viewed = basename($_SERVER['REQUEST_URI']);  
  
    if( $page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {  
        wp_redirect($login_page);  
        exit;  
    }  
}
add_action('init','redirect_login_page'); 


//after registration redirect  (redirect_login_page() doesn't work after registration) // UNTESTED
function redirect_login_page_after_registration()
{
    return home_url( '/login/' );
}
add_filter( 'registration_redirect', 'redirect_login_page_after_registration' );


//after log out redirect
function auto_redirect_after_logout(){
  wp_redirect( 'welcome' );
  exit();
}
add_action('wp_logout','auto_redirect_after_logout');


//login failed redirect
function login_failed() {  
    $login_page  = home_url( '/login/' );  
    wp_redirect( $login_page . '?login=failed' );  
    exit;  
}  
add_action( 'wp_login_failed', 'login_failed' );  


//after log in redirect
function my_login_redirect( $redirect_to, $request, $user ) {
	//is there a user to check?
	global $user;
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		//check for admins
		if ( in_array( 'administrator', $user->roles ) ) {
			// redirect them to the default place
			return home_url();
		} else {
			return home_url();
		}
	} else {
		return $redirect_to;
	}
}
add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );
?>