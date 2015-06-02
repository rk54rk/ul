var displayport = document.getElementById('facevalue');


//settings, canvas margin and show grid for debugging
var left_margin = 2;
var top_margin = 4;
var show_grid = false;
var popup_on_load = 50; //how many random ad on page load?
var no_popup_areas = ['#fv_home_text', '#home-all-ads', '#home-about', '#navbar-logo', '#navbar-menu'];


//declearing variables
var ad_count;
var grid_unit_size;
var columns;
var rows;
var grid;
var render_matrix;
var display_type;
var display_type_characters;
var window_width
var window_height


//render everything
fv_init();
fv_main();

//when window is resized, refresh the page
jQuery(window).bind('resize', function(e)
{
    window.resizeEvt;
    jQuery(window).resize(function()
    {
        clearTimeout(window.resizeEvt);
        window.resizeEvt = setTimeout(function()
        {
            
            //render everything again
            displayport.innerHTML = "";
            fv_init();
            fv_main();
            
        }, 250);
    });
});






function fv_init(){
    ad_count = 0;
    grid_unit_size = 0;
    columns = 0;
    rows = 0;
    grid = [];
    render_matrix = [];
    display_type = "";
    display_type_characters = "";
    window_width = jQuery(window).width();
    window_height = jQuery(window).height();
}


function fv_main(){
    //Load JSON files, main process inside
    jQuery.getJSON("wp-content/themes/ul/parts/facevalue/data_ad.json", function (ads) {
        jQuery.getJSON("wp-content/themes/ul/parts/facevalue/font.json", function (font) {
            jQuery.getJSON("wp-content/themes/ul/parts/facevalue/data.json", function (data) {

                display_type = data.type;
                display_type_characters = display_type.split("");

                fv_setup_grid(font);
                fv_calculate_dots(font);
                fv_render(font, ads);

                fv_popup_random_ad(ads, popup_on_load);

            });
        });
    });
}


function fv_setup_grid(font){
//get total number of columns and rows of grid units of the type (not including margins)

    for (i = 0; i < display_type.length; i++){
        //for each character
        var current_char = display_type_characters[i];
        columns = columns + font.characters[current_char].character_width;
        rows = font.info.font_height; 
    }
    
    //including grid margins in grid calculation
    columns = columns +(left_margin*2);
    rows = rows + (top_margin*2);
  
	//generate grid unit size css according to numbers of columns
	grid_unit_size = (displayport.clientWidth) / (columns);
	
    //generate the document grid as an array;
    for (x = 0; x < (columns); x++){
        var subarray = [];
        for (y = 0; y < ((columns * document.body.clientHeight)/displayport.clientWidth - 2); y++){
            grid.push([x, y]);
        }
    }
    
    //write CSS rules for the dots
    jQuery('#addedCSS').remove();
    jQuery('head').append('<style id="addedCSS" type="text/css">.fv_dot{position:absolute;height:' + grid_unit_size*2 + 'px;width:' + grid_unit_size*2 + 'px;border-radius: ' + grid_unit_size + 'px;}</style>');
}


//generate an array of 'on' dots
function fv_calculate_dots(font){
    var current_column = left_margin;   
        
    //calculate top_offset, in order to vertically center the type artwork
    var top_offset = Math.floor((window_height / grid_unit_size - font.info.font_height) / 2);
    
    for (i = 0; i < display_type.length; i++){
    //for each character of the display type string
        var current_char = display_type_characters[i];
        
        var current_char_matrix = font.characters[current_char].dot_matrix;
               
        //for each dot[x] add current column
        for (j = 0; j < current_char_matrix.length; j++){
            var current_dot = current_char_matrix[j];
            var new_dot = [];
            //add 'current column' offset to x, add margin to y.

            new_dot[0] = current_dot[0] + current_column;
            new_dot[1] = current_dot[1] + top_offset;  
            
            //add dot coordinate to dot_matrix
            render_matrix.push(new_dot);
            
        }
        
        current_column = current_column + font.characters[current_char].character_width;
    }
}


//output the render matrix and fill with ads.
function fv_render(font, ads){
    var output = "";
    
    //display debug grid
    if (show_grid == true) {
        fv_show_grid();
    }
    
    //render type ad dots
    for (i = 0; i < render_matrix.length; i++){
        
        var ad_count = counter(ads.length);
        var thumbnail_path = '/wp-content/uploads/ad/' + ads[ad_count].thumbnail;
        var bigpic_path = '/wp-content/uploads/ad/' + ads[ad_count].bigpic;
        var title = ads[ad_count].title;
        var bname = ads[ad_count].business_name;
        
        var ad_link = ads[ad_count].link;
        
        //output with ads
        output = output + output_ad(title, bname, thumbnail_path, bigpic_path, ad_link, render_matrix[i]);

    }

	displayport.innerHTML = output;
}


//pop up a random ad
function fv_popup_random_ad(ads, total_ads){
    
    //get the dots where is not rendered in type
    var empty_space = [];
    var output = "";
    var output_one = "";

    jQuery.grep(grid, function(el) {
        if (jQuery.inArray(el, render_matrix) == -1) empty_space.push(el);
    });
    
    for (i=0; i<total_ads; i++){
        var coordinate = empty_space[Math.floor(Math.random() * empty_space.length)];

        var ad_count = counter(ads.length);
        var thumbnail_path = '/wp-content/uploads/ad/' + ads[ad_count].thumbnail;
        var bigpic_path = '/wp-content/uploads/ad/' + ads[ad_count].bigpic;
        var ad_link = ads[ad_count].link;
        var title = ads[ad_count].title;
        var bname = ads[ad_count].business_name;

        output_one = "";

        //is the random dot in each of the no popup areas?
        var in_no_popup_area = 0;
        
        for (j = 0; j < no_popup_areas.length; j++){
            
            if (fv_in_no_popup_area(coordinate[0], coordinate[1], no_popup_areas[j]) == true){
                in_no_popup_area = in_no_popup_area + 1;
            }
        }
        
        //if in non of the no popup areas
        if (in_no_popup_area == 0){
            output_one = output_ad(title, bname, thumbnail_path, bigpic_path, ad_link, coordinate);
            output = output + output_one;
        }

    }
    displayport.innerHTML = displayport.innerHTML + output;
}


// is the dot in this no popup area?
function fv_in_no_popup_area(dot_x, dot_y, no_popup_area){
    
    //convert grid x, y to pixel x, y. +1 offset correction to center dots. 
    dot_x = (dot_x + 1) * grid_unit_size;
    dot_y = (dot_y + 1) * grid_unit_size;
    
    area = fv_get_div_area(no_popup_area);

    if ((area['x'] < dot_x && dot_x < (area['x']+area['w'])) && (area['y'] < dot_y && dot_y < (area['y']+area['h'])))
    {
        return true;
        
    } else {
        return false;
        
    }
    
}


// get div area for no popup area.
function fv_get_div_area(targetElement){
    var area = new Object();
        area['x'] = jQuery(targetElement).offset().left - grid_unit_size/2;
        area['y'] = jQuery(targetElement).offset().top - grid_unit_size/2;
        area['h'] = jQuery(targetElement).height() + grid_unit_size;
        area['w'] = jQuery(targetElement).width() + grid_unit_size;
    return area;
}


//output html of a dot
function output_ad(title, bname, thumbnail_path, bigpic_path, ad_link, coordinate){
    
    output = "<a href='" + ad_link + "' target='_blank'><div class='fv_dot' style='left:" + coordinate[0] * grid_unit_size + "px;top:" + coordinate[1] * grid_unit_size + "px;background-image:url(" + thumbnail_path + ")'><div class='fv_bigpic'><div class='fv_caption'><div class='fv_caption_title'>" + title + "</div><div class='fv_caption_bname'>" + bname + "</div></div><img class='fv_bigpic_img' src='" + bigpic_path + "'></img></div></div></a>";
    return output;
}


// show grid
function fv_show_grid(){
    output = output + "<div class='grid'>";
    for (i = 0; i < grid.length; i++){
        output = output + "<div class='grid-dot' style='height:2px;width:2px;background-color:#CCC;position:absolute;left:" + grid[i][0] * grid_unit_size + "px;top:" + grid[i][1] * grid_unit_size + "px'></div>";
    }
    output = output + "</div>";
}


// a looper for looping entries inside data_ad.json across every rendering dots.
function counter(length){
    var current_count;
    current_count = ad_count;
    
    if (ad_count == length - 1){
        ad_count = 0;
    } else {
        ad_count = ad_count + 1;
    }
    
    return current_count;
}