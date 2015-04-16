var displayport = document.getElementById('facevalue');
var font = JSON.parse(data_font);
var data = JSON.parse(data);
var numbers = data.value.split("");
var ad_count = 0;

jQuery.getJSON("wp-content/themes/ul/parts/facevalue/data_ad.json", function (data_ad) {
    console.log(data_ad); // this will show the info it in firebug console
    
    fv_init(numbers);
    fv_show(numbers, data_ad);
    
});


//init function
function fv_init(numbers){
	//generate css according to char count
	var sheets = document.styleSheets;
	var sheet = document.styleSheets[0];
	
	var pixel_size = (displayport.clientWidth) / (numbers.length * 4 - 1);
	
	sheet.insertRule(".fv_pixel{height:" + pixel_size + "px;width:" + pixel_size + "px;border-radius: " + pixel_size/2 + "px;}", 1);
	sheet.insertRule(".fv_char{width:" + pixel_size*3 + "px;}", 1);
	sheet.insertRule(".fv_kerning{width:" + pixel_size + "px;height:" + pixel_size*10 + "px;}", 1);
}



//render the Face Value module
function fv_show(numbers, data_ad){
	var output = "";
	var output_character = "";
	
	for (i = 0; i < numbers.length; i++){
		output_character = render_character(numbers[i], data_ad); 
		output = output + output_character;
		
		//if not the last character, add kerning
        if (i != numbers.length-1){
		  output = output + '<div class="fv_kerning"><div class="fv_pixel off"></div><div class="fv_pixel off"></div><div class="fv_pixel off"></div><div class="fv_pixel off"></div><div class="fv_pixel off"></div><div class="fv_pixel off"></div><div class="fv_pixel off"></div><div class="fv_pixel off"></div><div class="fv_pixel off"></div><div class="fv_pixel off"></div></div>';
        }
	}	
	
	displayport.innerHTML = output;
}



//render single character
function render_character(character, data_ad){
	var output = "";
	var map = font[character];
	
	var output= '<div class="fv_char">';
	
	// render the char matrix
	for (x = 1; x <= 30; x++){
        
		// if the dot is in the glyph array.
		if (font[character].indexOf(x) >= 0){
            var ad_count = counter(data_ad.length);
            var thumbnail_path = '/wp-content/uploads/ad/' + data_ad[ad_count].thumbnail;
            var bigpic_path = '/wp-content/uploads/ad/' + data_ad[ad_count].bigpic;
            var ad_link = data_ad[ad_count].link;
                
			output = output + "<div class='fv_pixel on' style='background-image:url(" + thumbnail_path + ")'><a href='" + ad_link + "' target='_blank'><div class='fv_bigpic' style='background-image:url(" + bigpic_path + ")'></div></a></div>"
            
		} else {
			output = output + '<div class="fv_pixel off"></div>'
		}
	}
	
	output = output + '</div>';
	
	return output;
}



// a counter for looping entries inside data_ad.json across every "on" dots.
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