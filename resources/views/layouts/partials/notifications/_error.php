<?php

#	Gère les alertes d'erreurs
if(isset($error) && count($error) != 0) {

    foreach($error as $value) {

    echo '<div class="ex-alert danger ml-auto exfade exshow ex-content-alert" id="js-ex-alert">';

    		echo '<div class="alert-body"><strong>Erreur!</strong> ' . $value . '</div>';

        echo '<button type="button" class="ex-alert-close" data-dismiss="alert" title="Fermer">';

            echo '<span aria-hidden="true">&times;</span>';

        echo '</button>';

    echo '</div>';
    	
    }

}