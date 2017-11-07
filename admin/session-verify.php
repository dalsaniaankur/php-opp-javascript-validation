<?php
//print_r($_SESSION);
if($_SESSION['userId'] == "")
{
	$URL= $sitepath."/admin/logout.php";
	echo ("<script>location.href='$URL'</script>");
}
?>