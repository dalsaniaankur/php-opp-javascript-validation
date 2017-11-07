<?php
error_reporting(0);
session_start();
include_once 	"ez_sql_core.php";
include_once 	"ez_sql_mysql.php";
// at the same time - db_user / db_password / db_name / db_host
$db = new ezSQL_mysql('root','','phpzocom_info_ftrkhfpwe5','localhost');
if(!$db){ die('Could not connect: ' . mysql_error());}
define("SITE_PATH","http://localhost/info.phpzo");
$sitepath = SITE_PATH;
?>