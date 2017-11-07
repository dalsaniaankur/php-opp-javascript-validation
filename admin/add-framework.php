<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Framework</title>

<?php 
	include('../include/config.php'); 
	include('session-verify.php');
	include('../Class/Framework.php');
	$obj_framework = new Framework(); 
	include('script.php');
	
?>

</head>
<?php 
if(isset($_POST['submit']))
{	
	$obj_framework->name = $_POST['name'];
	$obj_framework->status = 1;
	
	
	if($obj_framework->insert())
	{
		$message = "Framework insert successfully";
		$URL = $sitepath."/admin/show-framework.php";
		echo ("<script>location.href='$URL'</script>");
	}
	else
	{
		$message = "There is some problem.";
	}
	
}
?>
<body class="skin-blue">
<?php include('header.php'); ?>
<div class="wrapper">
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header">
              <h2 class="box-title">Add Framework</h2>
            </div>
            <form role="form" id="framework" method="post">
              <?php 
			    if($message != '')
				{
				echo "<span style='color: #028A02;font-weight: bold;margin-left: 12px;'>";
				echo $message;
				echo "</span>";
				}
				
				?>
				
              <div class="box-body">
                
                <div class="form-group">
                  <label for="exampleInputcategory">Enter Framework Name :</label>
                  <input type="text" name="name" placeholder="Enter First Name" class="validate[required] form-control" value="<?php echo $obj_framework->name?>">
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <input type="submit"  class="btn btn-lg btn-success btn-block" id="submit" name="submit" value="Submit" />
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content --> 
    
  </div>
  <!-- /.content-wrapper --> 
  
</div>
<!-- ./wrapper -->

<script>
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#framework").validationEngine();
			
		});
		
</script>
<?php include('footer.php'); ?>

</body>
</html>