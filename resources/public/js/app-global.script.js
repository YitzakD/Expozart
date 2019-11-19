/**
 *	Expozart
 *	global script:	gére le fonctionnement de façon globale
 *	Code:	yitzakD
 */




$(document).ready(function() {

	/**	Liens vers le dossiers des vues	 */
	ajaxlink = "http://localhost:8000/resources/views/";




	/** ucaffiliation:   indique le nomdre d'affiliations de l'utilisateur  */
	ucaffiliation();
	function ucaffiliation() {

		tootltip = $("#uc-tooltip");

		$.get(ajaxlink + 'Categories/parts/chosen.ajax.php', function(dataResponse) {

			tootltip.html(dataResponse);

		});

	}




	/** count_ucaffiliation:   indique le nomdre d'affiliations de l'utilisateur  */
	count_ucaffiliation();
	function count_ucaffiliation() {

		tootltipcounter = $("#count-uc-tooltip");

		$.get(ajaxlink + 'Categories/parts/counter.ajax.php', function(dataResponse) {

			tootltipcounter.html(dataResponse);

		});

	}




	/** add_ucaffiliation:   ajjout et suppression d'affiliations utilisateur  */
	add_ucaffiliation();
	function add_ucaffiliation() {

		card = $(".js-card");

		exCheck = '<span class="card-checked"><i class="fas fa-check-circle fa-lg"></i></span>';			
		
		
		card.click(function(e) {

			e.preventDefault();

			cToAffiliate = $(this).attr("accesskey");

			function remove_ucaffiliation() {

				$.post(ajaxlink + 'Categories/parts/remove.ajax.php', {cToAffiliate:cToAffiliate}, function(removeData) {
            		
            	});
			}


			if($(this).hasClass("js-card-checked")) {
	            
	            $(this).removeClass("js-card-checked");

	            jsCC = $(this).find("span.card-checked");

	            jsCC.remove();

	            remove_ucaffiliation();

				ucaffiliation();
				
				count_ucaffiliation();

	        } else {

    			alreadyused = false;
	            
	            $(this).addClass("js-card-checked");
            	
        		$(this).prepend(exCheck);

        		$.ajax({

        			url: ajaxlink + 'Categories/parts/choice.ajax.php',

	    			method: 'POST',

	    			dataType: 'text',

	    			data: {

	    				cToAffiliate: cToAffiliate

	    			},

	    			success: function(choiceData) {

	    				if(choiceData === "alreadyused") {
	    					
	    					alreadyused = true;

	    				} else {

	    					ucaffiliation();
				
							count_ucaffiliation();

	    				}

	    			}

        		});
            	
            	/*$.post(ajaxlink + 'Categories/parts/choose.ajax.php', {cToAffiliate:cToAffiliate}, function(chooseData) {

					ucaffiliation();
				
					count_ucaffiliation();

            	});*/

	        }

		});

	}

});