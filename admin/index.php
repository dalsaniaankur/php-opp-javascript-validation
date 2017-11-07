<?php
 	
	include('../include/config.php'); 
	include('../Class/Users.php');
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Login</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<?php include('script.php');?>
</head>

<?php
$obj_users = new Users();

if(isset($_POST['login']))
{	
	$email = $_POST['email'];
	$password = md5($_POST['password']);  
	if($email == '' || $password == '')
	{
		
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
			$URL = $sitepath."/admin/dashboard.php";
			echo ("<script>location.href='$URL'</script>");
		}
	
	}
}
?>
<body class="login-page">
<div class="login-box">
  <div class="login-logo"> <a href="#"><b>Admin</b></a> </div>
  <!-- /.login-logo -->
  
  <div class="login-box-body">
   
 <!-- form start -->
	
	<form role="form" id="user" method="post" enctype="multipart/form-data">
	  <div class="box-body">
		<div class="form-group">
		  <label for="exampleInputEmail1">Email address</label>
		  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email">
		</div>
		<div class="form-group">
		  <label for="exampleInputPassword1">Password</label>
		  <input type="password" class="form-control" id="exampleInputPassword" placeholder="Password" name="password">
		</div>
	  </div><!-- /.box-body -->

	  <div class="box-footer">
		<input type="submit" class="btn btn-primary" id="submit" name="login" value="Login">
	  </div>
	</form>
</div>
  <!-- /.login-box-body --> 
  
</div>
<!-- /.login-box --> 
</body>
</html>