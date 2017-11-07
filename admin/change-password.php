<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Phpzo.com</title>
<?php 
	include('../include/config.php');
	include('session-verify.php');
	include('../Class/Users.php');
	$obj_users = new Users(); 
	include("script.php");
?>
</head>
<?php
	$obj_users->userId = $_REQUEST['userId'];
	$user_detail = $obj_users->byuserId();
	$userId =$_SESSION['userId'];
?>
<?php
if(isset($_POST['update']))
{
	$obj_users->userId = $_SESSION['userId'];
	$obj_users->password = MD5($_POST['password']);
	$obj_users->newPassword = MD5($_POST['new-password']);
	$result = $obj_users->getRows("AND userId='".$_SESSION['userId']."' AND password ='".$obj_users->password."'");
	if($result)
	{
			
		if($obj_users->updatePassword())
		{
			$message = "Change password Successfully";
			
		}
		else
		{
			$message = "There is some problem"; 
		}
	}
	else
	{
		$message = "Wrong current password";
	}
}
?>

<body class="skin-blue">
<?php include('header.php'); ?>
<div class="wrapper">
  <div class="content-wrapper"> 
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header">
              <h2 class="box-title">Change Password</h2>
            </div>
            <form role="form" id="change-password" method="post" enctype="multipart/form-data">
              <?php if($message)
			  {
				  echo "<span style='font-weight: bold;margin-left: 12px;'>";
					echo $message;
					echo "</span>";
				  
				  }
			  ?>
              <div class="box-body">
                <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputcategory">Current Password :</label>
                  <input type="password" name="password" id="password" placeholder="Enter Current Password" class="validate[required,minSize[6],maxSize[20]] form-control" value="">
                </div>								
				<div class="form-group">
                  <label for="exampleInputcategory">Confirm Password :</label>
                  <input type="password" name="con-password" id="conf-password" placeholder="Enter Confirm Password" class="validate[required,,minSize[6],maxSize[20]] form-control" value="">
                </div>				
                <div class="form-group">
                  <label for="exampleInputcategory">New Password :</label>
                  <input type="password" name="new-password" id="new-password" placeholder="Enter New Password" class="validate[required,equals[password]] form-control" value="">
                </div>
              
              </div>
              </div>
              <div class="box-footer">
                <input type="submit" name="update" id="update" value="Change Password" class="btn btn-lg btn-success btn-block"/>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
  <script>
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#change-password").validationEngine();
			
		});
</script>

<?php include("footer.php");?>
</body>
</html>
