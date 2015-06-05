
function home_autoscroll(){
    jQuery(document).ready(function(){
         jQuery('body,html').animate({scrollTop: jQuery(document).height()-jQuery(window).height()}, 500); 
    });
}


function home_autoscroll_top(){
    jQuery(document).ready(function(){
         jQuery('body,html').animate({scrollTop: jQuery(document).height()-jQuery(document).height()}, 500); 
    });
}
