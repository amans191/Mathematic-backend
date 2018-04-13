<?php
error_reporting(0);
session_start();

/* DATABASE CONFIGURATION */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'mathemagic');
define('DB_DATABASE', 'Mathemagic');
define("BASE_URL", "https://46.101.92.158/PHP-Slim-Restful/api/");
define("SITE_KEY", 'SpookSpook');


function getDB() 
{
	$dbhost=DB_SERVER;
	$dbuser=DB_USERNAME;
	$dbpass=DB_PASSWORD;
	$dbname=DB_DATABASE;
	$dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbConnection->exec("set names utf8");
	$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbConnection;
}
/* DATABASE CONFIGURATION END */

/* API key encryption */
function apiToken($session_uid)
{
	$key=md5(SITE_KEY.$session_uid);
	return hash('sha256', $key);
}


?>