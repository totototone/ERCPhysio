// assets/js/app.js
require('../css/style.css');
const $ = require('jquery');


$(document).ready(function(){
	$(".afficherCategorie").click(function(){	
		$(".champs").css("background-color", "#B7B6B6");		
		$(this).css("background-color", "#5B4394");
		$(".champs").css("color", "black");
		$(this).css("color", "white");
		$(".liste").css("color", "black");									
	});
});

$(document).ready(function(){
	$(".afficherCategorie").click(function(){
		console.log($(this).children());		
		$(".champs").children().children("ul").hide();
		//$(".catego").children().children("ul").hide();
		$(this).children().children("ul").show();								
	});
});

$(document).ready(function(){
	$(".afficherSousCategorie").click(function(){	
		console.log($(this).children());
		$(".catego").children().children("ul").hide();	
		$(this).children().children("ul").show();						
	});
});
			
/*$.ajax({
    url: "/getcat/1",
    type: 'POST',
    success: function(data){
        console.log(data);
        alert(data);
    },
});

	/*document.getElementById("afficherCategorie").addEventListener("click",afficherCategorie);
	function afficherCategorie() {
	    document.getElementById("liste").style.visibility="visible";
	}
	//$("#categories").children("liste")	
});*/