$(document).ready(function(){
	setTimeout(function(){
			$(".alert-dis").hide(100);
	},3000);  

	$(".btn-copy-link").click(function(){
		var base_url = window.location.origin;
			if(window.location.host=="localhost"){
					base_url += "/vid/igrabber";
			}
			console.log(base_url);
			var ty = $("#type_shr").val();
			var va = encodeURIComponent($("#val_shr").val());
			var share_link = base_url+"/index.php?sht="+ty+"&va="+va;
			
			copyTextToClipboard(share_link);
			prompt ("Copy link, then click OK.", share_link);
	});

});



/*function modal_view(ini) {
	var src = $(ini).attr("data-href");
	var type = $(ini).attr("data-type");
	var p = $(ini).attr("data-shr");
	$('#modalView').modal('show');
	var cont = "";
	if(type=="true"){
		cont = '<video controls width="100%">';
				cont += '<source type="video/mp4" src="'+src+'">'; 
		cont += '</video>';
	}else{
		cont = get_image(src);
		//cont = '<img class="img-responsive" src="'+src+'" alt="preview">';
	}
	
	cont += '<input type="hidden" id="type_shr" value="'+type+'">';
	cont += '<input type="hidden" id="val_shr" value="'+src+'">';

	$(".modal-preview").html(cont);
	
	if(p=="post"){
		$(".btn-copy-link").hide();
	}
}*/



function modal_view(ini) {
	var src = $(ini).attr("data-href");
	var type = $(ini).attr("data-type");
	var p = $(ini).attr("data-shr");
	$('#modalView').modal('show');
	$(".modal-preview").html('<img class="img-responsive" style="margin:0 auto;" src="assets/img/loading_world.svg" >');
	get_image(src, type, function(img){
		var cont = "";
		cont = img;
		/*if(type=="true"){
			cont = '<video controls width="100%">';
					cont += '<source type="video/mp4" src="'+src+'">'; 
			cont += '</video>';
		}else{
			cont = img;
			//cont = '<img class="img-responsive" src="'+src+'" alt="preview">';
		}*/
		
		cont += '<input type="hidden" id="type_shr" value="'+type+'">';
		cont += '<input type="hidden" id="val_shr" value="'+src+'">';
		console.log()
		$(".modal-preview").html(cont);
		
		if(p=="post"){
			$(".btn-copy-link").hide();
		}
	})
}

function get_image(src, type, callback) {
	$.ajax({
        type : 'GET',
        url : 'func.php?load_img='+src+'&type='+type,
        success : callback
	});
}


function share_post(code) {
		var base_url = window.location.origin;
		if(window.location.host=="localhost"){
				base_url += "/vid/igrabber";
		}
		var share_link = base_url+"/index.php?sht=post&va="+code;
		console.log(share_link);
		copyTextToClipboard(share_link);
}

/*function copyTextToClipboard(text) {
	if (!navigator.clipboard) {
		fallbackCopyTextToClipboard(text);
		return;
	}
	navigator.clipboard.writeText(text).then(function() {
		console.log('Async: Copying to clipboard was successful!');
		alert("copying to clipboard!");
	}, function(err) {
		console.error('Async: Could not copy text: ', err);
		alert("Async: Could not copy text:");
	});
}
*/

function copyTextToClipboard(text) {
	var textArea = document.createElement("textarea");
	textArea.style.position = 'fixed';
	textArea.style.top = 0;
	textArea.style.left = 0;

	// Ensure it has a small width and height. Setting to 1px / 1em
	// doesn't work as this gives a negative w/h on some browsers.
	textArea.style.width = '2em';
	textArea.style.height = '2em';

	// We don't need padding, reducing the size if it does flash render.
	textArea.style.padding = 0;

	// Clean up any borders.
	textArea.style.border = 'none';
	textArea.style.outline = 'none';
	textArea.style.boxShadow = 'none';

	// Avoid flash of the white box if rendered for any reason.
	textArea.style.background = 'transparent';


	textArea.value = text;

	document.body.appendChild(textArea);
	textArea.focus();
	textArea.select();

	try {
			var successful = document.execCommand('copy');
			var msg = successful ? 'successful' : 'unsuccessful';
			console.log('Copying text command was ' + msg);
			console.log('Copying text is ' + textArea.value);
		
	} catch (err) {
			console.log('Oops, unable to copy');
	}

	document.body.removeChild(textArea);
}