var displayport = document.getElementById('facevalue');
var display_type = JSON.parse(display_type);
var display_type_characters = display_type.value.split("");

//settings, canvas margin and show grid for debugging
var left_margin = 2;
var top_margin = 4;
var show_grid = false;
var show_ads = true;

//declearing variables
var ad_count = 0;
var grid_unit_size = 0;
var columns = 0;
var rows = 0;
var output = "";
var grid = [];
var render_matrix = [];



//Load JSON files
jQuery.getJSON("wp-content/themes/ul/parts/facevalue/data_ad.json", function (ads) {
    jQuery.getJSON("wp-content/themes/ul/parts/facevalue/font.json", function (font) {
    
        fv_init(font);
        fv_calculate_dots(font);
        fv_render(font, ads);
        
        for (i=1; i<50; i++){fv_popup_random_ad(ads);}
        

    });
});



function fv_init(font){
//get total number of columns and rows of grid units of the type (not including margins)

    for (i = 0; i < display_type.value.length; i++){
        //for each character
        var current_char = display_type_characters[i];
        columns = columns + font.characters[current_char].character_width;
        rows = font.info.font_height; 
    }
    
    //including grid margins in grid calculation
    columns = columns +(left_margin*2);
    rows = rows + (top_margin*2);
  
	//generate grid unit size css according to numbers of columns
	var sheets = document.styleSheets;
	var sheet = document.styleSheets[0];
	grid_unit_size = (displayport.clientWidth) / (columns);
	
    //generate the document grid as an array;
    for (x = 0; x < (columns); x++){
        var subarray = [];
        for (y = 0; y < ((columns * document.body.clientHeight)/displayport.clientWidth - 2); y++){
            grid.push([x, y]);
        }
    }

    //write CSS rules for the dots
	sheet.insertRule(".fv_dot{height:" + grid_unit_size*2 + "px;width:" + grid_unit_size*2 + "px;border-radius: " + grid_unit_size + "px;}", 1);
}



//generate an array of 'on' dots
function fv_calculate_dots(font){
    var current_column = left_margin;   
    
    
    for (i = 0; i < display_type.value.length; i++){
    //for each character of the display type string
        var current_char = display_type_characters[i];
        
        var current_char_matrix = font.characters[current_char].dot_matrix;
               
        //for each dot[x] add current column
        for (j = 0; j < current_char_matrix.length; j++){
            var current_dot = current_char_matrix[j];
            var new_dot = [];
            //add 'current column' offset to x, add margin to y.

            new_dot[0] = current_dot[0] + current_column;
            new_dot[1] = current_dot[1] + top_margin;  
            
            //add dot coordinate to dot_matrix
            render_matrix.push(new_dot);
            
        }
        
        current_column = current_column + font.characters[current_char].character_width;
    }
}



//output the render matrix and fill with ads.
function fv_render(font, ads){

    //display debug grid
    if (show_grid == true) {
        fv_show_grid();
    }
    
    //render type ad dots
    for (i = 0; i < render_matrix.length; i++){
        
        var ad_count = counter(ads.length);
        var thumbnail_path = '/wp-content/uploads/ad/' + ads[ad_count].thumbnail;
        var bigpic_path = '/wp-content/uploads/ad/' + ads[ad_count].bigpic;
        var ad_link = ads[ad_count].link;
        
        //toggle ads for debug
        if (show_ads == true){
            
            //output with ads
            output = output_ad(thumbnail_path, bigpic_path, ad_link, render_matrix[i]);
            
        } else {
            
            //output without ads for debug
            output = output + "<div class='fv_dot' style='left:" + render_matrix[i][0] * grid_unit_size + "px;top:" + render_matrix[i][1] * grid_unit_size + "px;'></div>";
        }
    }

	displayport.innerHTML = output;
}



//pop up a random ad
function fv_popup_random_ad(ads){
    
    //get the dots where is not rendered in type
    
    var empty_space = [];

    jQuery.grep(grid, function(el) {
        if (jQuery.inArray(el, render_matrix) == -1) empty_space.push(el);
    });
    

    var coordinate = empty_space[Math.floor(Math.random() * empty_space.length)];
    
    var ad_count = counter(ads.length);
    var thumbnail_path = '/wp-content/uploads/ad/' + ads[ad_count].thumbnail;
    var bigpic_path = '/wp-content/uploads/ad/' + ads[ad_count].bigpic;
    var ad_link = ads[ad_count].link;
    
    console.log(coordinate);
    
    output = "";
    output = output_ad(thumbnail_path, bigpic_path, ad_link, coordinate);
    
	displayport.innerHTML = displayport.innerHTML + output;
}








//HELPER FUNCTIONS
//output html of a dot
function output_ad(thumbnail_path, bigpic_path, ad_link, coordinate){
    
    output = output + "<div class='fv_dot' style='left:" + coordinate[0] * grid_unit_size + "px;top:" + coordinate[1] * grid_unit_size + "px;background-image:url(" + thumbnail_path + ")'><a href='" + ad_link + "' target='_blank'><div class='fv_bigpic' style='background-image:url(" + bigpic_path + ")'></div></a></div>";
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



//diff function for comparing array grid and render_matrix
Array.prototype.diff = function(a) {
    return this.filter(function(i) {return a.indexOf(i) < 0;});
};

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