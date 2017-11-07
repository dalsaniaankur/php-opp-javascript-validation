<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>info.phpzo</title>
<?php
include('../include/config.php');
include('../Class/Framework.php');
$obj_framework = new Framework(); 
include("script.php");?>

</head>
<?php 
$obj_framework->framework_id = $_REQUEST['framework_id'];
$framework_detail = $obj_framework->byframework_id();
$framework_id = $_REQUEST['framework_id'];

?>
<?php
if(isset($_POST['update']))
{
	$obj_framework->framework_id = $_REQUEST['framework_id'];
	$obj_framework->name = $_POST['name'];
	$obj_framework->status = 1;

	if($obj_framework->update())
	{
		$message = "Framework Edit Successfully";
		$URL = $sitepath."/admin/show-framework.php";
		echo ("<script>location.href='$URL'</script>");	
	}
	else
	{
		$message = "There is some problem"; 
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
              <h2 class="box-title">Edit Framework</h2>
            </div>
            <form role="form" id="framework" method="post" enctype="multipart/form-data">
              <?php if($message)
			  {	  echo $message;  }
			  ?>
              <div class="box-body">
                <div class="box-body">
                
                <div class="form-group">
                  <label for="exampleInputcategory">Enter Framework Name :</label>
                  <input type="text" name="name" id="frameworkName" placeholder="Enter Framework" class="validate[required] form-control" value="<?php echo $framework_detail[0]->name; ?>">
                </div>
               
              </div>
              </div>
              <div class="box-footer">
                <input type="submit" name="update" id="update" value="Update" class="btn btn-lg btn-success btn-block"/>
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
			jQuery("#framework").validationEngine();
			
		});
		</script>
<?php include("footer.php");?>

</body>
</html>
