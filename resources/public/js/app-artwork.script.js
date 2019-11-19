/**
 *	Expozart
 *	artwork script:	gére le fonctionnement des tuiles, et les actions associées
 *	Code:	yitzakD
 */




$(document).ready(function() {

	/**	Liens vers le dossiers des vues	 */
	ajaxlink = "http://localhost:8000/resources/views/";

	rootlink = "/";




    /** placeholder:   Affiche un placeholder au chargement de la page  */
	$(".ex-home-placeholder").masonry({

		isAnimated: true,

		itemSelector: '.placeholder-art',

        isFitWidth: true

	});

	function explaceholder() {

		$(".ex-home-placeholder").hide();

		$("#home-content").show();
		
		appMasonry();
	}
	setTimeout(explaceholder, 3000);




	/** Grid:   application du système d'affichage en grille   */
    exArtcontainer = $(".ex-home-page");

    function appMasonry() {

		$(exArtcontainer).imagesLoaded(function() {

		    $(exArtcontainer).masonry({
			    		
				columnWidth: 244,

				itemSelector: '.exart',

				isAnimated: false,

				animateed: false,

		        isFitWidth: true,

		        transitionDuration: 0

			});

		});

    }




	/** overlay:   application du système d'overlay quand on clique sur une grille   */
    /*artDisplayer = $('.ex-display-container');

	artDpOverlay = $('.exart-display-overlay');

	artDP = $('<div/>').attr('class', 'exart-display');
	
	artDpSimili = $('<div/>').attr('class', 'exart-art-simili');

	function extoggleModal() {

		$('body').toggleClass('locked-body');

		$(artDisplayer).toggleClass('ex-dp-block');

	}*/

	/*getArtEscaped();
	function getArtEscaped() {

		$(artDpOverlay).click(function() {

			extoggleModal();

			artDP.remove();

			artDpSimili.remove();

			history.pushState(null, 'Home', rootlink);

		});

	}

    function appArtMasonry() {

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




	/** ArtLoad:   application du système d'overlay quand on clique sur une grille   */
	/*function ArtLoad(xURI, x) {

		$.get(ajaxlink + 'home/contents/art.ajax.php', {x:x}, function(singleArtDataResponse) {

			extoggleModal();

			$(artDP).appendTo(artDisplayer).empty();

			setTimeout(getArt, 500);
			function getArt() {

				$(artDP).imagesLoaded(function() {

	    			$(artDP).append(singleArtDataResponse);

	    		});

			}

		});

	}*/




	/** infinite scroll:   application du système de chargement continue de contenu   */
    artworkStart = 0;

    artworkLimit = 18;

    /*exNewstart = 0;

    exNewlimit = 50;*/

    artworksReachedMax = false;

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

						exArtitem = $(exArtcontainer).find("a.open-exart-ajax");

						$(exArtitem).on('click', function(e) {

							e.preventDefault();

							x = $(this).attr("accesskey");
							
							xURI = $(this).attr("href");

							/*history.pushState({key: 'value'}, 'Artwork', xURI);*/

							ArtLoad(xURI, x);

						});

    				}

    			}

    		});

	    /*window.onpopstate = function(event) {

	    	if(event.state == null) {

		    	$('body').toggleClass('locked-body');

				$(artDisplayer).toggleClass('ex-dp-block');

				artDP.remove();

				artDpSimili.remove();

	    	} else {

	    		ArtLoad(document.location.pathname, x);

	    	}

	    	// console.log(event);

	    }*/

    }

});