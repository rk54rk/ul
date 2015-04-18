
function home_autoscroll(){
    jQuery(document).ready(function(){
         jQuery('body,html').animate({scrollTop: jQuery(document).height()-jQuery(window).height()}, 500); 
    });
}
