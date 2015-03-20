var fv = document.getElementById('facevalue');
var data = JSON.parse(data_json);
var numbers = data.value.split("");
var font = JSON.parse(font_json);

fv_init();
fv_show();

//render the Face Value module
function fv_show(){
	var output = "";
	var output_character = "";
	
	for (i = 0; i < numbers.length; i++){
		output_character = render_character(numbers[i]); 
		output = output + output_character;
	}	
	
	fv.innerHTML = output;
}

//init function
function fv_init(){
	//generate css according to char count
	var sheets = document.styleSheets;
	var sheet = document.styleSheets[0];
	
	var pixel_size = (fv.clientWidth) / (numbers.length * 3);
	
	console.debug(sheet);
	sheet.insertRule(".fv_pixel{height:" + pixel_size + "px;width:" + pixel_size + "px;border-radius: " + pixel_size/2 + "px;}", 1);
	sheet.insertRule(".fv_char{width:" + pixel_size*3 + "px;}", 1);
}


//render single character
function render_character(character){
	var output = "";
	var map = font[character];
	
	var output= '<div class="fv_char">';
	
	// render the char matrix
	for (x = 1; x <= 30; x++){
		
		// if the dot is in the glyph array.
		if (font[character].indexOf(x) >= 0){
			output = output + '<div class="fv_pixel on"></div>'
		} else {
			output = output + '<div class="fv_pixel off"></div>'
		}
	}
	
	output = output + '</div>';
	return output;
}