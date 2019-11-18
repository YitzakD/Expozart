<?php
/**
 *	Expozart
 *	Database config:	connexion à la base de donnéeq
 *	Code:	yitzakD
 */




define("DB_HOST", "localhost");

define("DB_NAME", "u532250745_expozart");

define("DB_USERNAME", "root");

define("DB_PASSWORD", "");




date_default_timezone_set('Africa/Abidjan');




try {

    $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

    die("Erreur : " .$e->getMessage());

}

?>
