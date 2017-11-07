<?php 
include('../include/config.php');
include('../Class/Users.php');
$obj_users = new Users();

if($_POST['action'] == "signin")
{
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	if($email == '' || $password == '')
	{
		echo 'Email and password both field required.';
	}
	else
	{
		$obj_users->email = $email;
		$obj_users->password = $password; 
		$obj_users->status = 1; 
	
		if($users_detail = $obj_users->login())	        
		{
			$_SESSION['userId'] = $users_detail[0]->userId;
			$_SESSION['email'] = $users_detail[0]->email;
			$_SESSION['fname'] = $users_detail[0]->fname;
			echo "Login Successfully.";
			$URL = $sitepath."/admin/dashboard.php";
			echo ("<script>location.href='$URL'</script>");
		}
		else
		{
			echo "Invalid username and password.";
		}
	}
}
?>


