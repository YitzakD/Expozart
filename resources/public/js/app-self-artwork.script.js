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

			$.post(ajaxlink + 'Artwork/parts/artwork-like.ajax.php', {aid:_aid_}, function(dataLikerresponse) {
		
				if(dataLikerresponse !== 'not-liked') {

					console.log('liked');

					hartworktasteLikecounter.html('<i class="far fa-sm fa-heart"></i> ' + dataLikerresponse);

				}

			});
			
			$(this).attr('title', 'disliker');

			$(this).html('<i class="fas fa-lg fa-heart text-expozart-pink"></i>');

			$(this).parent().attr('accesskey', '1');

		} else {

			$.post(ajaxlink + 'Artwork/parts/artwork-dislike.ajax.php', {aid:_aid_}, function(dataDislikerresponse) {
		
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

	$("#ajax-set-on-comment-box").click(function() { $("#ajax-comment-box").focus(); });




	/**	Sytème de commentaire Utilisateur - Artwork */
	$("#ajax-comment-box").keyup(function(e) {

		crticMsg = $(this).val();
		
		crticMsg = $.trim(crticMsg);

		if(e.keyCode === 13 && crticMsg !== "") {

			criticsender();
			
		}

	});

	getCritics();
	function getCritics() {

		$.post(ajaxlink + 'Artwork/parts/self-artwork-critics.ajax.php', {aid:haid}, function(lastcriticsDataresponse) {

			if(lastcriticsDataresponse !== "nothing's found") {

				$("#ajax-post-critics").html(lastcriticsDataresponse);

				mycritic = $("#ajax-post-critics").find("span#ajax-critic");

				mycriticCloser = $("#ajax-post-critics").find("span#ajax-critic-close");
				
				thiscritic = $(mycritic);

				thiscloser = $(mycriticCloser);

				function criticClicked() {

				    divHtml = $(this).html();

				    divAccesskey = $(this).attr("accesskey");

				    editableText = $("<input />").attr("type", "text").attr("accesskey", divAccesskey).attr("class", "form-control critic-edit-box").attr("data-length", "102");

				    spanCounter = $("<span>").attr("id", "ajax-critic-counter").attr("class", "critic-counter");




				    editableText.val(divHtml);

				    $(this).replaceWith(editableText);

				    editableText.keyup(function(evnt) { checkTextAreaMaxLength(this, evnt); });
					
					function checkTextAreaMaxLength(textBox, e) { 
					    
					    var maxLength = parseInt($(textBox).data("length"));
					    
					  
					    if (!checkSpecialKeys(e)) {

					        if (textBox.value.length > maxLength - 1) {

					        	textBox.value = textBox.value.substring(0, maxLength);
			   				 	
			   				 	$(spanCounter).insertAfter(editableText);

			   				 	$(spanCounter).html("Vous êtes à la limite de saisi de texte");

					        } else {

							    $(spanCounter).remove();

					        }
					   	}
					    
					    return true;
					    
					}
					function checkSpecialKeys(e) { 
					    if (e.keyCode != 8 && e.keyCode != 46 && e.keyCode != 37 && e.keyCode != 38 && e.keyCode != 39 && e.keyCode != 40) 
					        return false; 
					    else 
					        return true; 
					}

				    editableText.focus();
				    // setup the blur event for this new textarea
				    editableText.blur(editableTextBlurred);

				}

				function editableTextBlurred() {

				    html = $(this).val();

				    htmlAccesskey = $(this).attr("accesskey");


				    if(html !== "") {

					    $.post(ajaxlink + 'Artwork/parts/artwork-critic-updater.ajax.php',{aid:htmlAccesskey,commentbody:html},function(dataUpdateresponse) {
			
							if(dataUpdateresponse !== 'not-updated') {

								console.log('updated');

							}

						});
															
					} else {

						criticSelf = $(this).parent();

						$(criticSelf).fadeOut(1000);

						$.post(ajaxlink + 'Artwork/parts/artwork-critic-remove.ajax.php', {aid:htmlAccesskey}, function(dataRemoveCriticRresponse) {
		
							if(dataRemoveCriticRresponse !== 'not-removed') {

								$("#json-post-critics-counter").html(dataRemoveCriticRresponse);

								getArtwork(url);
							
							}

						});

					}

				    viewableText = $("<span>").attr("id", "ajax-critic").attr("accesskey", htmlAccesskey).attr("title", "cliquer ppour modifier");

				    spanCounter = $("#ajax-critic-counter");
				    
				    viewableText.html(html);

				    $(this).replaceWith(viewableText);
				    spanCounter.remove();

				    // setup the click event for this new div
				    $(viewableText).click(criticClicked);

				}
			
				thiscritic.click(criticClicked);

				thiscloser.click(function() {

					haid = $(this).attr("accesskey");

					criticSelf = $(this).parent();

					$(criticSelf).fadeOut(1000);

					$(criticSelf).remove();


					$.post(ajaxlink + 'Artwork/parts/artwork-critic-remove.ajax.php', {aid:haid}, function(dataRemoveCriticRresponse) {
		
						if(dataRemoveCriticRresponse !== 'not-removed') {

							$("#json-post-critics-counter").html(dataRemoveCriticRresponse);
					
							getCritics();
						
						}

					});

				});

			}
		
		});

	};
	function criticsender() {

		$.post(ajaxlink + 'Artwork/parts/artwork-critic-sender.ajax.php',{msg:crticMsg,artworkid:haid},function(criticsenderData) {
			
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