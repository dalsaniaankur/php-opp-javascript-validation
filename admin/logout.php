<?php

session_start();

session_destroy();

//unset($_SESSION['users']);

header("location:index.php");

exit;

?>

