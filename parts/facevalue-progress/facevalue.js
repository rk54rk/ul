var displayport = document.getElementById('facevalue');
var display_type = JSON.parse(display_type);
var display_type_characters = display_type.value.split("");

//setting the kerning and margin around the type, in grid unites
var grid_margin = 2;
var kerning = 1;

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
        fv_render(font);
    });
});



function fv_init(font){
    
    //get total number of columns and rows of grid units of the type (not including kerning and margins)

    for (i = 0; i < display_type.value.length; i++){
        //for each character
        var current_char = display_type_characters[i];
        columns = columns + font.characters[current_char].character_width;
        rows = font.info.font_height; 
    }

    //including kerning in column calculation
    columns = columns + kerning * (display_type.value.length - 1);
    
    //including grid margins in grid calculation
    columns = columns +(grid_margin*2);
    rows = rows + (grid_margin*2);
  
	//generate grid unit size css according to numbers of columns
	var sheets = document.styleSheets;
	var sheet = document.styleSheets[0];
	grid_unit_size = (displayport.clientWidth) / (columns);
	
    //generate the grid as an array;
    for (x = 0; x < (rows); x++){
        var subarray = [];
        for (y = 0; y < (columns); y++){
            grid.push([x, y]);
        }
    }
    
  
//    console.log(grid);

    //write CSS rules
	sheet.insertRule(".fv_pixel{height:" + grid_unit_size*2 + "px;width:" + grid_unit_size*2 + "px;border-radius: " + grid_unit_size + "px;}", 1);
    
	sheet.insertRule(".fv_char{width:" + grid_unit_size*3 + "px;}", 1);
	sheet.insertRule(".fv_kerning{width:" + grid_unit_size + "px;height:" + grid_unit_size*10 + "px;}", 1);

}




//generate an array of 'on' dots
function fv_calculate_dots(font){
    var current_column = grid_margin;   
    
    
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
            new_dot[1] = current_dot[1] + grid_margin;  
            
            //add dot coordinate to dot_matrix
            render_matrix.push(new_dot);
            
        }
        
        current_column = current_column + font.characters[current_char].character_width;
    }
}



function fv_render(font){

    for (i = 0; i < render_matrix.length; i++){
        
        output = output + "<div class='fv_pixel' style='left:" + render_matrix[i][0] * grid_unit_size + "px;top:" + render_matrix[i][1] * grid_unit_size + "px'></div>";
    }
    
	displayport.innerHTML = output;
}