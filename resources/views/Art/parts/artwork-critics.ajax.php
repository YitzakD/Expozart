<?php
/**
 *	Expozart
 *	artwork-last critics ajax app:	gère les commentaires
 *	Code:	yitzakD
 */




/** Constantes d'environnement	*/
$WEBROOT = dirname(dirname(dirname(__FILE__)));

$ROOT = dirname(dirname($WEBROOT));

$DS = DIRECTORY_SEPARATOR;

$CORE = $ROOT.$DS.'core';


$URI = $_SERVER["HTTP_REFERER"];

$URL = array_filter(explode('http://', $URI));

$URL = explode('/', $URI, -1);

$WURI = $URL[0] . '//' . $URL[2];


session_start();

include_once $CORE.$DS.'database/db-config.php';

include_once $CORE.$DS.'app/global.func.php';

include_once $CORE.$DS.'app/auth.func.php';

include_once $CORE.$DS.'includes/account.var.php';

if(isset($_POST["aid"]) && is_numeric($_POST["aid"])) {

	extract($_POST);

	if(ex_cellcount("ex_comments", "aID", $aid, "AND cTYPE='1'") > 0) {

		$q = $db->prepare("SELECT * FROM ex_comments WHERE aID=:aID AND cTYPE=:cTYPE ORDER BY ID DESC LIMIT 0,2");

		$q->execute([
	        'aID' => $aid,
	        'cTYPE' => '1'
	    ]);

	    $data = $q->fetchAll(PDO::FETCH_OBJ);

    	if($q) {

    		$lastCritics = $data;
        
    		foreach ($lastCritics as $item) {
    			
    			$userinfo = ex_findone("ex_users", "ID", $item->uID);

    			if(!$userinfo) { $criticname = "Expozart"; } else { $criticname = $userinfo->username; }

    		?>
    	
    		<div class="critics-self">
    		
    			<a href="<?= $WURI . '/' . strtolower($criticname) ?>"><?= ucfirst($criticname) ?></a>&nbsp;<span><?= $item->commentbody ?></span>

    		</div>

    		<?php

    		}

            if(ex_cellcount("ex_comments", "aID", $aid, "AND cTYPE='1'") > 2) {
                
                $artworkinfo = ex_findone("ex_arts", "ID", $aid);

                ?>
                
                <div class="d-block mt-2 pt-2 border-top text-center">
                    
                    <a href="<?= $WURI . '/art/' . $artworkinfo->arthash ?>">Voir plus...</a>

                </div>

                <?php

            }

    	} else { exit("nothing's found"); }
	
	}

}
