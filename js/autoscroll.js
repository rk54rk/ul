
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

//smoth scroll
jQuery(function() {
  jQuery('body').find('a[href*=#]').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = jQuery(this.hash);
      target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        jQuery('html,body').animate({
          scrollTop: target.offset().top
        }, 500);
        return false;
      }
    }
  });
});