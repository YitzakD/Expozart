/**
 *	Expozart
 *	artwork script:	gére le fonctionnement des tuiles, et les actions associées
 *	Code:	yitzakD
 */




$(document).ready(function() {

	/**	Liens vers le dossiers des vues	 */
	ajaxlink = "http://localhost:8000/resources/views/";

	rootlink = "http://localhost:8000/";

	artworkID = $(".self-artwork").attr("accesskey");




    /**	Système de Like Utilisateur - Artwork */
    jsonLikerBox = $("#json-liker-box");

	uLc = $(jsonLikerBox).attr("accesskey");

	haid =  $(jsonLikerBox).attr("class");

	if(uLc !== "1") {
								
		$(jsonLikerBox).html('<button class="btn btn-sm exart-like-btn" title="liker" id="ajax-like-btn" accesskey="' + haid + '"><i class="far fa-lg fa-heart"></i></button>');
	
	} else {
		
		$(jsonLikerBox).html('<button class="btn btn-sm exart-like-btn" title="disliker" id="ajax-like-btn" accesskey="' + haid + '"><i class="fas fa-lg fa-heart text-expozart-pink"></i></button>');		

	}

	aLb = $(jsonLikerBox).find("button#ajax-like-btn");

	$(aLb).click(function() {

		_aid_ = $(this).attr("accesskey");

		hartworktasteLikecounter = $("span#json-post-likes");


		if($(this).attr("title") === "liker") {

			$.post(ajaxlink + 'Art/parts/artwork-like.ajax.php', {aid:_aid_}, function(dataLikerresponse) {
		
				if(dataLikerresponse !== 'not-liked') {

					console.log('liked');

					hartworktasteLikecounter.html('<i class="far fa-sm fa-heart"></i> ' + dataLikerresponse);

				}

			});
			
			$(this).attr('title', 'disliker');

			$(this).html('<i class="fas fa-lg fa-heart text-expozart-pink"></i>');

			$(this).parent().attr('accesskey', '1');

		} else {

			$.post(ajaxlink + 'Art/parts/artwork-dislike.ajax.php', {aid:_aid_}, function(dataDislikerresponse) {
		
				if(dataDislikerresponse !== 'not-disliked') {

					console.log('disliked');

					if(dataDislikerresponse == "0") { hartworktasteLikecounter.html(""); }

					else {
						
						hartworktasteLikecounter.html('<i class="far fa-sm fa-heart"></i> ' + dataDislikerresponse);

					}	

				
				}

			});
			
			$(this).attr('title', 'liker');

			$(this).html('<i class="far fa-lg fa-heart"></i>');

			$(this).parent().attr('accesskey', '0');

		}

	});




	/**	Sytème de commentaire Utilisateur - Artwork */
	$("#ajax-comment-box").keyup(function(e) {

		crticMsg = $(this).val();
		
		crticMsg = $.trim(crticMsg);

		if(e.keyCode === 13 && crticMsg !== "") {

			criticsender();
					
			getCritics();
			
		}

	});

	getCritics();
	function getCritics() {

		$.post(ajaxlink + 'Art/parts/self-artwork-critics.ajax.php', {aid:haid}, function(lastcriticsDataresponse) {

			if(lastcriticsDataresponse !== "nothing's found") { $("#ajax-post-critics").html(lastcriticsDataresponse); }
		
		});

	};
	function criticsender() {

		$.post(ajaxlink + 'Art/parts/artwork-critic-sender.ajax.php',{msg:crticMsg,artworkid:haid},function(criticsenderData) {
			
			if(criticsenderData !== "critic-not-send") {
				
				$("#ajax-comment-box").val("");

				critics = $("#json-post-critics-counter").attr("accesskey");

				if(criticsenderData > 1) {
										
					$("#json-post-critics-counter").html(criticsenderData + ' critiques');

				} else {

					$("#json-post-critics-counter").html(criticsenderData + ' critique');

				}

			}

		});

	}

});