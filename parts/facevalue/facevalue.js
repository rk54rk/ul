var fv = document.getElementById('facevalue');
var data = JSON.parse(data_json);
var font = JSON.parse(font_json);

fv_show();

function fv_show(){
	var numbers = data.value.split("");
	var output = "";
	var output_character = "";
	
	console.debug(numbers);
	
	for (i = 0; i < numbers.length; i++){
		output_character = render_character(numbers[i]); 
		output = output.concat(output_character);
	}	
	
	fv.innerHTML = output;
}

function render_character(character){
	var output;
	output = character;
	
	return output;
}