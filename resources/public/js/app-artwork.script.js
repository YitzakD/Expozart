/**
 * Copyright: Expozart
 * Code by Yitzak DEKPEMOU
 */

$(document).ready(function() {

	/**	Liens vers le dossiers des vues	 */
	ajaxlink = "http://localhost/www.expozart.com/resources/views/";

	rootlink = "?r=home/";




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
    artDisplayer = $('.ex-display-container');

	artDpOverlay = $('.exart-display-overlay');

	artDP = $('<div/>').attr('class', 'exart-display');
	
	artDpSimili = $('<div/>').attr('class', 'exart-art-simili');

	function extoggleModal() {

		$('body').toggleClass('locked-body');

		$(artDisplayer).toggleClass('ex-dp-block');

	}

	getArtEscaped();
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

    }




	/** ArtLoad:   application du système d'overlay quand on clique sur une grille   */
	function ArtLoad(xURI, x) {

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

	}




	/** infinite scroll:   application du système de chargement continue de contenu   */
    exStart = 0;

    exLimit = 18;

    exNewstart = 0;

    exNewlimit = 50;

    exReachedMax = false;

	$(window).scroll(function() {

	    docHeight = $(document).height();

		winHeight = $(window).height();
	
		if($(window).scrollTop() === docHeight - winHeight) {

			gethomeArts();

		}

	});

    gethomeArts();
    function gethomeArts() {

    	if(exReachedMax)

    		return;

    		$.ajax({

    			url: ajaxlink + 'home/contents/userhome.ajax.php',

    			method: 'POST',

    			dataType: 'text',

    			data: {

    				gethomeArts: 1,

    				exStart: exStart,

    				exLimit: exLimit
    			},

    			success: function(userhomeresponse) {

    				if(userhomeresponse === "exReachedMax")

    					exReachedMax = true;

    				else {

    					exStart += exLimit;

						$(exArtcontainer).append(userhomeresponse).masonry('reloadItems').masonry();

						exArtitem = $(exArtcontainer).find("a.open-exart-ajax");

						$(exArtitem).on('click', function(e) {

							e.preventDefault();

							x = $(this).attr("accesskey");
							
							xURI = $(this).attr("href");

							history.pushState({key: 'value'}, 'Artwork', xURI);

							ArtLoad(xURI, x);

						});

    				}

    			}

    		});

	    window.onpopstate = function(event) {

	    	if(event.state == null) {

		    	$('body').toggleClass('locked-body');

				$(artDisplayer).toggleClass('ex-dp-block');

				artDP.remove();

				artDpSimili.remove();

	    	} else {

	    		ArtLoad(document.location.pathname, x);

	    	}

	    	// console.log(event);

	    }

    }





	/** uc_affiliation:   indique le nomdre d'affiliations de l'utilisateur  */
	uc_affiliation();
	function uc_affiliation() {

		tootltip = $("#uc-tooltip");

		$.get(ajaxlink + 'categories/choice/chosen.ajax.php', function(ucAffiliationData) {

			tootltip.html(ucAffiliationData);

		});

	}




	/** count_uc_affiliation:   indique le nomdre d'affiliations de l'utilisateur  */
	count_uc_affiliation();
	function count_uc_affiliation() {

		tootltipcounter = $("#count-uc-tooltip");

		$.get(ajaxlink + 'categories/choice/counter.ajax.php', function(ucCounterData) {

			tootltipcounter.html(ucCounterData);

		});

	}




	/** add_c_affiliation:   ajjout et suppression d'affiliations utilisateur  */
	add_c_affiliation();
	function add_c_affiliation() {

		card = $(".js-card");

		exCheck = '<span class="card-checked"><i class="fas fa-check-circle fa-lg"></i></span>';			
		
		
		card.click(function(e) {

			e.preventDefault();

			cToAffiliate = $(this).attr("accesskey");

			function removeCxT() {

				$.post(ajaxlink + 'categories/choice/remove.ajax.php', {cToAffiliate:cToAffiliate}, function(removeData) {
            		
            	});
			}


			if($(this).hasClass("js-card-checked")) {
	            
	            $(this).removeClass("js-card-checked");

	            jsCC = $(this).find("span.card-checked");

	            jsCC.remove();

	            removeCxT();

				uc_affiliation();
				
				count_uc_affiliation();

	        } else {
	            
	            $(this).addClass("js-card-checked");
            	
        		$(this).prepend(exCheck);
            	
            	$.post(ajaxlink + 'categories/choice/choose.ajax.php', {cToAffiliate:cToAffiliate}, function(choosenData) {

					uc_affiliation();
				
					count_uc_affiliation();

            	});

	        }

		});



	}




    /** shPassword:   afficher ou cacher le mot de passe  */

});