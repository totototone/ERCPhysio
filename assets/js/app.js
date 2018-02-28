// assets/js/app.js
require('../css/style.css');
const $ = require('jquery');

$(document).ready(function(){
   	$(".champs").click(function(){
   		var data = $(this).data('name');
		console.log(data);
	});
});


$(document).ready(function(){
	$(".afficherCategorie").click(function(){
		$(this).children(".categories").show();								
	});
});

$(document).ready(function(){
	$(".afficherSousCategorie").click(function(){
		$(".sous_categories").children("ul").show();						
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