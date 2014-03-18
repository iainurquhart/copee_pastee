$.fn.ffMatrix.onDisplayCell.copee_pastee = function(cell, FFM) {

    $(".matrix table").each(function(){
    	if($(this).is('.matrix table', this)){
        	var newLabel = $('.clipboard span', this).text();
			$('.clipboard span', this).each(function(i){
		        $(this).text(newLabel).text(+(i+1)+'}');
		    });
		}
	});
};

$(".matrix table .clipboard").live('click', function(event) { 

    var clip = new ZeroClipboard.Client();

    var thisTd = $(this).parent();
    var parentRow = thisTd.parent("tr");

    clip.glue(thisTd[0]);

	var txt = $(parentRow).find('div.clipboard').text();
	clip.setText(txt);

	clip.addEventListener('complete', function(client, text) {
		//  alert("Copied text to clipboard:\n" + text);
       	clip.destroy();
		$(parentRow).find('div.copee-notification').show().fadeOut(1200);
		
    });
});