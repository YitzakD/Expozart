/**
 *	Expozart
 *	artwork script:	gére le fonctionnement des tuiles, et les actions associées
 *	Code:	yitzakD
 */




$(document).ready(function() {

	/**	Liens vers le dossiers des vues	 */
	ajaxlink = "http://localhost:8000/resources/views/";

	rootlink = "http://localhost:8000/";




    /** placeholder:   Affiche un placeholder au chargement de page  */
	$(".ex-home-placeholder").masonry({

		isAnimated: true,

		itemSelector: '.masonry-taste-art-placeholder',

        isFitWidth: true

	});

	function exHomeplaceholder() {

		$(".ex-home-placeholder").hide();

		$("#home-content").show();
		
		appMasonry();
	}
	setTimeout(exHomeplaceholder, 3000);

	function exArtworkplaceholder() {

		$(".exart-placeholder-display").hide();

		$("#artwork-content").show();
	}




	/** Grid:   application du système d'affichage en grille   */
    exArtcontainer = $(".ex-home-page");

    function appMasonry() {

		$(exArtcontainer).imagesLoaded(function() {

		    $(exArtcontainer).masonry({

				itemSelector: '.exart',

				isAnimated: false,

				animateed: false,

		        isFitWidth: true,

		        transitionDuration: 0

			});

		});

    }




	/** overlay:   application du système d'overlay quand on clique sur une grille   */
    artworkDisplayer = $('.ex-display-container');

	artworkDisplaypOverlay = $('.exart-display-overlay');

	function exSetModal() {

		$('body').addClass('locked-body');

		$(artworkDisplayer).addClass('ex-dp-block');

	}

	function extoggleModal() {

		$('body').toggleClass('locked-body');

		$(artworkDisplayer).toggleClass('ex-dp-block');

	}

	artworkEscaped();
	function artworkEscaped() {

		$(artworkDisplaypOverlay).click(function() {

			$('body').removeClass('locked-body');

			$(artworkDisplayer).removeClass('ex-dp-block');

			getUserArtworksTastes();
			
			history.pushState(null, 'Home', rootlink);

		});

	}




	/** infinite scroll:   application du système de chargement continue de contenu   */
    artworkStart = 0;

    artworkLimit = 18;


    artworksReachedMax = false;

    isHistoryAvailable = true;

    if(typeof history.pushState === 'undefined') { isHistoryAvailable = false; }

	$(window).scroll(function() {

	    docHeight = $(document).height();

		winHeight = $(window).height();
	
		if($(window).scrollTop() === docHeight - winHeight) {

			getUserArtworksTastes();

		}

	});

    getUserArtworksTastes();
    function getUserArtworksTastes() {

    	if(artworksReachedMax)

    		return;

    		$.ajax({

    			url: ajaxlink + 'Home/parts/artworktaste.ajax.php',

    			method: 'POST',

    			dataType: 'text',

    			data: {

    				getUserArtworksTastes: 1,

    				artworkStart: artworkStart,

    				artworkLimit: artworkLimit
    			},

    			success: function(userArtworksTastesResponseData) {

    				if(userArtworksTastesResponseData === "artworksReachedMax")

    					artworksReachedMax = true;

    				else {

    					artworkStart += artworkLimit;

						$(exArtcontainer).append(userArtworksTastesResponseData).masonry('reloadItems').masonry();

						/** On home */
						getLikeCount();
					    function getLikeCount() {

					    	exArtwork = $(".exart");

					    	exArtwork.each(function() {

					    		__hartworktasteLikecounter = $(this).find("span#ajax-likes-counter");

					    		__hartworktasteLikecounter.each(function() {

					    			__haid = $(this).attr("accesskey");

					    			__hartworktasteLikecounter.load(ajaxlink + 'Art/parts/artworkTaste-like.count.php', {aid:__haid});

					    		});

					    	});

					    }

						$(exArtcontainer).each(function() {

							exartbox = $(this).find("div.exart");

							$(exartbox).each(function() {
			
								ajaxLikeBox = $(this).find("#ajax-liker-box");

								uLc = $(ajaxLikeBox).attr("accesskey");

								haid =  $(ajaxLikeBox).attr("class");


								if(uLc !== "1") {
								
									$(ajaxLikeBox).html('<button class="btn btn-sm exart-like-btn" title="liker" id="ajax-like-btn" accesskey="' + haid + '"><i class="far fa-lg fa-heart"></i></button>');
								
								} else {
									
									$(ajaxLikeBox).html('<button class="btn btn-sm exart-like-btn" title="disliker" id="ajax-like-btn" accesskey="' + haid + '"><i class="fas fa-lg fa-heart text-expozart-pink"></i></button>');		

								}


								aLb = $(ajaxLikeBox).find("button#ajax-like-btn");

								$(aLb).click(function() {

									_aid_ = $(this).attr("accesskey");

									exartart = $(this).parent().parent();

									hartworktasteLikecounter = $(exartart).find("span#ajax-likes-counter");


									if($(this).attr("title") === "liker") {

										$.post(ajaxlink + 'Art/parts/artwork-like.ajax.php', {aid:_aid_}, function(dataLikerresponse) {
									
											if(dataLikerresponse !== 'not-liked') {
		
												hartworktasteLikecounter.html('<i class="far fa-sm fa-heart"></i> ' + dataLikerresponse);

											}

										});
										
										$(this).attr('title', 'disliker');

										$(this).html('<i class="fas fa-lg fa-heart text-expozart-pink"></i>');

										$(this).parent().attr('accesskey', '1');

									} else {

										$.post(ajaxlink + 'Art/parts/artwork-dislike.ajax.php', {aid:_aid_}, function(dataDislikerresponse) {
									
											if(dataDislikerresponse !== 'not-disliked') {

												if(dataDislikerresponse < 1) {

													hartworktasteLikecounter.html("");

												} else {
													
													hartworktasteLikecounter.html('<i class="far fa-sm fa-heart"></i> ' + dataDislikerresponse);

												}

											}

										});
										
										$(this).attr('title', 'liker');

										$(this).html('<i class="far fa-lg fa-heart"></i>');

										$(this).parent().attr('accesskey', '0');

									}

								});

							});	

						});


						/** On selected artwork */
						$('a.open-artwork-ajax').on('click', function(e) {

							e.preventDefault();

							a = $(this);

							url = a.attr('href');

							if(isHistoryAvailable) {
								
								history.pushState({key: 'value'}, 'Artwork', url);

							}

							getParent = $(a).parent();


							function getArtwork(url) {

								exSetModal();

								setTimeout(exArtworkplaceholder, 3000);
								
								artworktasteLikecounter = $(getParent).find("#ajax-likes-counter");

								cardlikebtn = $(getParent).find("#ajax-liker-box");

								ajaxLB = $(cardlikebtn).find("button#ajax-like-btn");


								$.get(ajaxlink + 'Art/parts/artwork-main.ajax.php', {uri:url}, function(artworkResponse) {

									if(artworkResponse !== 'not-founded') {
										
										$("#artwork-content").html(artworkResponse);

										/** Next & Prev btn */
										npB = $("#artwork-content").find("a.open-artwork-ajax");

										/** Close btn */
										closeB = $("#artwork-content").find("a#close");


										/** Like & Dislike sytmem */
										jsonLikerBox = $("#json-liker-box");

										uLc = $(jsonLikerBox).attr("accesskey");

										haid =  $(jsonLikerBox).attr("class");

										$("#json-set-on-comment-box").click(function() { $("#json-comment-box").focus(); });

										if(uLc !== "1") {
								
											$(jsonLikerBox).html('<button class="btn btn-sm exart-like-btn" title="liker" id="ajax-like-btn" accesskey="' + haid + '"><i class="far fa-lg fa-heart"></i></button>');
										
										} else {
											
											$(jsonLikerBox).html('<button class="btn btn-sm exart-like-btn" title="disliker" id="ajax-like-btn" accesskey="' + haid + '"><i class="fas fa-lg fa-heart text-expozart-pink"></i></button>');		

										}

										aLb = $(jsonLikerBox).find("button#ajax-like-btn");

										$(aLb).click(function() {

											_aid_ = $(this).attr("accesskey");

											hartworktasteLikecounter = $("#artwork-content").find("span#json-post-likes");


											if($(this).attr("title") === "liker") {

												$.post(ajaxlink + 'Art/parts/artwork-like.ajax.php', {aid:_aid_}, function(dataLikerresponse) {
											
													if(dataLikerresponse !== 'not-liked') {

														hartworktasteLikecounter.html('<i class="far fa-sm fa-heart"></i> ' + dataLikerresponse);

														artworktasteLikecounter.html('<i class="far fa-sm fa-heart"></i> ' + dataLikerresponse);

														getArtwork(url);

													}

												});
												
												$(this).attr('title', 'disliker');

												$(this).html('<i class="fas fa-lg fa-heart text-expozart-pink"></i>');

												$(this).parent().attr('accesskey', '1');


												$(cardlikebtn).attr('accesskey', '1');
												
												$(ajaxLB).attr('title', 'disliker');

												$(ajaxLB).html('<i class="fas fa-lg fa-heart text-expozart-pink"></i>');

											} else {

												$.post(ajaxlink + 'Art/parts/artwork-dislike.ajax.php', {aid:_aid_}, function(dataDislikerresponse) {
											
													if(dataDislikerresponse !== 'not-disliked') {

														if(dataDislikerresponse < 1) {

															hartworktasteLikecounter.html("");
															
															artworktasteLikecounter.html("");

														} else {
															
															hartworktasteLikecounter.html('<i class="far fa-sm fa-heart"></i> ' + dataDislikerresponse);

															artworktasteLikecounter.html('<i class="far fa-sm fa-heart"></i> ' + dataDislikerresponse);

														}

														getArtwork(url);
													
													}

												});
												
												$(this).attr('title', 'liker');

												$(this).html('<i class="far fa-lg fa-heart"></i>');

												$(this).parent().attr('accesskey', '0');


												$(cardlikebtn).attr('accesskey', '0');
										
												$(ajaxLB).attr('title', 'liker');

												$(ajaxLB).html('<i class="far fa-lg fa-heart"></i>');

											}

										});

										/** When user submit a comment */
										$("#json-comment-box").keyup(function(e) {

											crticMsg = $(this).val();
											
											crticMsg = $.trim(crticMsg);

											if(e.keyCode === 13 && crticMsg !== "") {

												criticsender(haid);
														
												getCritics(haid);
												
											}

										});

										/** getCritics function */
										getCritics(haid);
										function getCritics(thatid) {

											$.post(ajaxlink + 'Art/parts/artwork-critics.ajax.php', {aid:haid}, function(lastcriticsDataresponse) {

												if(lastcriticsDataresponse !== "nothing's found") {

													$("#json-ajax-post-critics").html(lastcriticsDataresponse);

													mycritic = $("#json-ajax-post-critics").find("span#json-critic");

													mycriticCloser = $("#json-ajax-post-critics").find("span#json-critic-close");
				
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

													    editableText.blur(editableTextBlurred);

													}

													function editableTextBlurred() {

													    html = $(this).val();

													    htmlAccesskey = $(this).attr("accesskey");

													    $.post(ajaxlink + 'Art/parts/artwork-critic-updater.ajax.php',{aid:htmlAccesskey,commentbody:html},function(dataUpdateresponse) {
											
															if(dataUpdateresponse !== 'not-updated') {

																console.log('updated');

															}

														});

													    viewableText = $("<span>").attr("id", "ajax-critic").attr("accesskey", htmlAccesskey).attr("title", "cliquer ppour modifier");

													    spanCounter = $("#ajax-critic-counter");
													    
													    viewableText.html(html);

													    $(this).replaceWith(viewableText);
													    spanCounter.remove();

													    $(viewableText).click(criticClicked);

													}

													thiscritic.click(criticClicked);

													thiscloser.click(function() {

														haid = $(this).attr("accesskey");

														criticSelf = $(this).parent();

														$(criticSelf).fadeOut(1000);

														$(criticSelf).remove();


														$.post(ajaxlink + 'Art/parts/artwork-critic-remove.ajax.php', {aid:haid}, function(dataRemoveCriticRresponse) {
											
															if(dataRemoveCriticRresponse !== 'not-removed') {

																$("#json-post-critics-counter").html(dataRemoveCriticRresponse);

																getArtwork(url);
															
															}

														});
														
													});
												
												}
											
											});

										}

										/** sendCritics function */
										function criticsender(getid) {

											$.post(ajaxlink + 'Art/parts/artwork-critic-sender.ajax.php',{msg:crticMsg,artworkid:haid},function(criticsenderData) {
												
												if(criticsenderData !== "critic-not-send") {
				
													$("#json-comment-box").val("");

													if(criticsenderData > 1) {
										
														$("#json-post-critics-counter").html(criticsenderData + ' critiques');

													} else {

														$("#json-post-critics-counter").html(criticsenderData + ' critique');

													}

												}

											});

										}

										
										/** When user click on Next or Prev btn */
										npB.on('click', function(e) {

											e.preventDefault();

											a = $(this);

											url = a.attr('href');

											nhaid = $(this).attr("accesskey");

											if(isHistoryAvailable) {
												
												history.pushState({key: 'value'}, 'Artwork', url);

											}


											var _getParent = document.getElementsByClassName("exart");

											if($(_getParent).attr("accesskey", nhaid)) {

												var getParent = $(_getParent);

											}


											getArtwork(url);

										});

										/** When user click on close btn */
										$(closeB).click(function(e) {

											e.preventDefault();

											$('body').removeClass('locked-body');

											$(artworkDisplayer).removeClass('ex-dp-block');

											getUserArtworksTastes();

											history.pushState(null, 'Home', rootlink);

										});

									} else {

										// Rédirection javascript

									}

								});
							
							}
							getArtwork(url);

							/** History:   gère l'historique   */
							window.addEventListener('popstate', function(e) {

						    	if(e.state == null) {

									$('body').removeClass('locked-body');

									$(artworkDisplayer).removeClass('ex-dp-block');

									getUserArtworksTastes();

						    	} else {
								
						    		getArtwork(window.location.href);

									setTimeout(exArtworkplaceholder, 3000);

									if(window.location.href == rootlink) { getUserArtworksTastes(); }

						    	}

						    });

						});

    				}

    			}

    		});

	    

    }

});
