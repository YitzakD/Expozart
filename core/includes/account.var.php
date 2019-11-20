<?php
/**
 *	Expozart
 *	Auth functions:	les fonctions en rapports avec l'authentification 
 *	Code:	yitzakD
 */




if(exAuth_getsession('userid') && exAuth_getsession('userhash')) {

	/** 
	 *  exVar_usercategoriesAffiliation
	 *  variable de récupération des affiliations utilisateurs - catégories
	 */
	$exVar_usercategoriesAffiliation = ex_findall("ex_usercategories", "WHERE uID = " . exAuth_getsession("userid"));




	/**
	 *  exApp_findalltopicsXmedia()
	 *  permet de récupérer à la volée les catégories et les media associés
	 *  retourne $data
	 */
	if(!function_exists('exApp_findalltopicsXmedia')) {

		function exApp_findalltopicsXmedia()
		{

		    global $db;
		    
		    $q = $db->prepare("SELECT ex_topics.*, ex_media.fileroad_sm FROM ex_topics INNER JOIN ex_media ON ex_topics.ID = ex_media.salt WHERE ex_media.fileusability='2'  ORDER BY ex_topics.topicname ASC");
		    
		    $q->execute();
		    
		    $data = $q->fetchAll(PDO::FETCH_OBJ);

		    $q->closeCursor();

		    return $data;

		}
		
		/** exVar_allcategories:	variable de récupération tableau contenant les nom des pages sans menu 	*/
		$exVar_allcategories = exApp_findalltopicsXmedia();

	}




	/**
	 * 
	 */
}