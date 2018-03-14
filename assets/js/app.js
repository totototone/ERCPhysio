// assets/js/app.js
require('../css/style.scss');
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


$(document).ready(function(){
	$(".afficherTest").click(function(){
		console.log($(this).children());
		$(".sous_catego").children().children("ul").hide();
		$(this).children().children("ul").show();
	});
});


/*$(document).ready(function(){
	$(".container").click(function(){
		$(".catego").children().children("ul").hide();
	});
});*/


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


$(document).ready(function () {
    $('#pres').click(function(){
        $('#pres').hide();
    });
});

$(document).ready(function () {
    $('#truebutton').click(function(){
        $('#truescreen').hide();
    });
});

$(document).ready(function () {
    $('#falsebutton').click(function(){
        $('#falsescreen').hide();
    });
});

$(document).ready(function () {
    $('#content').on("click",function(e){
        $this = $(e.target);
        if($(e.target).hasClass("num")) {
            console.log($this.attr('id'));
            if ($this.css('background-color') == "rgb(255, 192, 203)") {
                $this.css('background-color', "rgba(0, 0, 0, 0)");
                $this.data("checked", 0);
            } else {
                $this.css('background-color', "rgb(255, 192, 203)");
                $this.data("checked", 1);
            }
        }

    });
});

$(document).ready(function () {
    $('#content').on("click",function(e){
        $this = $(e.target);
        if($(e.target).is("#buttonq")) {

            var juste = $("#buttonq").data("juste");
            var liste = $("#buttonq").data("liste");
            var justecheck = [];
            var listecheck = [];

            console.log(juste);
            console.log(liste);

            for (var i = 0; i < liste.length; i++) {
                x = "num" + liste[i];
                listecheck.push(x);
            }
            console.log(listecheck);

            for (var i = 0; i < juste.length; i++) {
                x = "num" + juste[i];
                justecheck.push(x);
            }
            console.log(justecheck);




            var q = $this.data("q");

            var x = $this.data("x");
            x++;

            var check = [];

            $(".num").each(function() {
                if ($(this).data("checked") == 1) {
                    check.push($(this).attr("id"));
                }
            });

            check.sort();
            justecheck.sort();

            var score = $('#buttonq').data('score');
            var total;

            if (total.length < 1) {
                var total = $('#buttonq').data('total');
            }

            console.log(total);

            if (check.length == justecheck.length) {
                if(JSON.stringify(check)==JSON.stringify(justecheck)) {

                    score++;
                    $('#truescreen').css("visibility", "visible");
                }
            } else {
                $('#falsescreen').css("visibility", "visible");
            }
            var idTest = $("#element").data("idtest");
                $.ajax({
                    url: "/ERCPhysio/public/getQuestion/"+q+"/"+x,
                    type: "POST",
                    data: 'score=' + score,
                    success: function(data){
                        $("#content").html(data);
                    },
                    error: function() {
                        $.ajax({
                            url: "/ERCPhysio/public/end/"+score+"/"+total,
                            type: "POST",
                            success: function(data){
                                $("#end").html(data);
                            }
                        })
                        $('#bigend').css("visibility", "visible");
                    }
                });

        };
    });
});
