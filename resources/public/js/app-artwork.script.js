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

		itemSelector: '.placeholder-art',

        isFitWidth: true

	});

	function exHomeplaceholder() {

		$(".ex-home-placeholder").hide();

		$("#home-content").show();
		
		appMasonry();
	}
	setTimeout(exHomeplaceholder, 3000);

	function exArtworkplaceholder() {

		$(".exart-display-placeholder").hide();

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

			
			history.pushState(null, 'Home', rootlink);

		});

	}

    /*function appArtMasonry() {

		$(artDpSimili).imagesLoaded(function() {

		    $(artDpSimili).masonry({
			    		
				columnWidth: 244,

				itemSelector: '.exart',

				isAnimated: false,

				animateed: false,

		        isFitWidth: true,

		        transitionDuration: 0

			});

		});

    }*/




	/** infinite scroll:   application du système de chargement continue de contenu   */
    artworkStart = 0;

    artworkLimit = 18;

    /*exNewstart = 0;

    exNewlimit = 50;*/

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

						/**/

						$(exArtcontainer).each(function() {

							exartbox = $(this).find("div.exart");

							$(exartbox).each(function() {
			
								ajaxLikeBox = $(this).find("#ajax-liker-box");


								uLc = $(ajaxLikeBox).attr("accesskey");


								haid =  $(ajaxLikeBox).attr("class");


								if(uLc !== "1") {
								
									$(ajaxLikeBox).html('<button class="btn btn-sm exart-like" title="liker" id="ajax-like-btn" accesskey="' + haid + '"><i class="far fa-lg fa-heart"></i></button>');
								
								} else {
									
									$(ajaxLikeBox).html('<button class="btn btn-sm exart-like" title="disliker" id="ajax-like-btn" accesskey="' + haid + '"><i class="fas fa-lg fa-heart text-expozart-pink"></i></button>');		

								}


								aLb = $(ajaxLikeBox).find("button#ajax-like-btn");

								$(aLb).click(function() {

									_aid_ = $(this).attr("accesskey");

									exartart = $(this).parent().parent();

									hartworktasteLikecounter = $(exartart).find("span#ajax-likes-counter");


									if($(this).attr("title") === "liker") {

										$.post(ajaxlink + 'Art/parts/artwork-like.ajax.php', {aid:_aid_}, function(dataLikerresponse) {
									
											if(dataLikerresponse !== 'not-liked') {

												console.log('liked');
		
												hartworktasteLikecounter.html(dataLikerresponse + ' <i class="fas fa-sm fa-heart"></i>');

											}

										});
										
										$(this).attr('title', 'disliker');

										$(this).html('<i class="fas fa-lg fa-heart text-expozart-pink"></i>');

										$(this).parent().attr('accesskey', '1');

									} else {

										$.post(ajaxlink + 'Art/parts/artwork-dislike.ajax.php', {aid:_aid_}, function(dataDislikerresponse) {
									
											if(dataDislikerresponse !== 'not-disliked') {

												console.log('disliked');

												hartworktasteLikecounter.html(dataDislikerresponse + ' <i class="fas fa-sm fa-heart"></i>');
											
											}

										});
										
										$(this).attr('title', 'liker');

										$(this).html('<i class="far fa-lg fa-heart"></i>');

										$(this).parent().attr('accesskey', '0');

									}

								});

							});	

						});

						$('a.open-artwork-ajax').on('click', function(e) {

							e.preventDefault();

							a = $(this);

							par1 = $(a).parent();
								
								artworktasteLikecounter = $(par1).find("#ajax-likes-counter");

								cardlikebtn = $(par1).find("#ajax-liker-box");

								ajaxLB = $(cardlikebtn).find("button#ajax-like-btn");


							url = a.attr('href');

							if(isHistoryAvailable) {
								
								history.pushState({key: 'value'}, 'Artwork', url);

							}
							
							artworkLoad(url);

							setTimeout(exArtworkplaceholder, 3000);

						});

						$("#close").click(function(e) {

							e.preventDefault();

							$('body').removeClass('locked-body');

							$(artworkDisplayer).removeClass('ex-dp-block');

							getUserArtworksTastes();

							history.pushState(null, 'Home', rootlink);

						});

						/** artworkLoad:   application du système d'overlay quand on clique sur une tuile   */
						function artworkLoad(url) {

							exSetModal();

							$.get(url, {}, function(artworkResponseData) {

								$(".exart-display").imagesLoaded(function() {

									$("#json-avatar-link").attr('title', artworkResponseData.username);

									$("#json-avatar-link").attr('href', rootlink + artworkResponseData.username);

									if(artworkResponseData.avatar == true) {
										
										$("#json-avatar").attr('src', artworkResponseData.useravatar);

										$("#json-avatar-name").hide();

									} else {

										$("#json-avatar-name").text(artworkResponseData.useravatar);

										$("#json-avatar").hide();

									}




									$("#json-username").attr('href', rootlink + artworkResponseData.username);

									$("#json-username").attr('title', artworkResponseData.username);

									$("#json-username").text(artworkResponseData.username);

									$("#json-post-ago").html(artworkResponseData.created);
									
									$("#json-post-likes").html(artworkResponseData.likes + ' <i class="fas fa-sm fa-heart"></i>');
									
									$("#json-menu-artwork-access").attr('action', rootlink + 'art/' + artworkResponseData.arthash);




									$("#json-post-username").html(artworkResponseData.username);

									$("#json-post-username").attr('title', artworkResponseData.username);

									$("#json-post-username").attr('href', rootlink + artworkResponseData.username);

									$("#json-post-content").html(artworkResponseData.artcontent);




									if(artworkResponseData.userliked == 0) {
									
										$("#json-liker-box").html('<button class="btn btn-sm exart-like" title="liker" id="ajax-liker"><i class="far fa-lg fa-heart"></i></button>');

									} else {

										$("#json-liker-box").html('<button class="btn btn-sm exart-like" title="disliker" id="ajax-disliker"><i class="fas fa-lg fa-heart text-expozart-pink"></i></button>');

									}

									$("#ajax-liker").click(function(e) {

										e.preventDefault();

										console.log("Liker");

										$.post(ajaxlink + 'Art/parts/artwork-like.ajax.php', {aid:artworkResponseData.ID}, function(likerDataresponse) {
										
											if(likerDataresponse !== 'not-liked') {
												
												artworkLoad(url);
												
												artworktasteLikecounter.html(likerDataresponse + ' <i class="fas fa-sm fa-heart"></i>');

											}

										});

										$("#json-liker-box").html('<button class="btn btn-sm exart-like" title="liker" id="ajax-disliker"><i class="fas fa-lg fa-heart text-expozart-pink"></i></button>');

										$(cardlikebtn).attr('accesskey', '1');
										
										$(ajaxLB).attr('title', 'disliker');

										$(ajaxLB).html('<i class="fas fa-lg fa-heart text-expozart-pink"></i>');

									});

									$("#ajax-disliker").click(function(e) {

										console.log("Disliker");

										$.post(ajaxlink + 'Art/parts/artwork-dislike.ajax.php', {aid:artworkResponseData.ID}, function(dislikerDataresponse) {
										
											if(dislikerDataresponse !== 'not-disliked') {

												artworkLoad(url);

												artworktasteLikecounter.html(dislikerDataresponse + ' <i class="fas fa-sm fa-heart"></i>');

											}

										});

										$("#json-liker-box").html('<button class="btn btn-sm exart-like" title="disliker" id="ajax-liker"><i class="far fa-lg fa-heart"></i></button>');
										
										$(cardlikebtn).attr('accesskey', '0');
										
										$(ajaxLB).attr('title', 'liker');

										$(ajaxLB).html('<i class="far fa-lg fa-heart"></i>');

									});	




									$("#json-image").attr('src', artworkResponseData.newfileroad);

									$("#json-post-content").html(artworkResponseData.artcontent);




									if(artworkResponseData.next) {

										$("#next").show();

										$("#next").attr('href', rootlink + 'art/' + artworkResponseData.next.arthash);

									} else { $("#next").hide(); }




									if(artworkResponseData.prev) {

										$("#prev").show();

										$("#prev").attr('href', rootlink + 'art/' + artworkResponseData.prev.arthash);

									} else { $("#prev").hide(); }

					    		});

							});

						}

						/** Historique:   gère l'historique   */
						window.addEventListener('popstate', function(e) {

					    	if(e.state == null) {

								$('body').removeClass('locked-body');

								$(artworkDisplayer).removeClass('ex-dp-block');

								getUserArtworksTastes();

					    	} else {
							
					    		artworkLoad(window.location.href);

								setTimeout(exArtworkplaceholder, 3000);

								if(window.location.href == rootlink) { getUserArtworksTastes(); }

					    	}

					    });

    				}

    			}

    		});

	    

    }


});