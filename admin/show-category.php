<?php 
	session_start();
	include('../include/config.php');
	include('session-verify.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Category</title>
   <?php include('script.php');?>

   <script type="text/javascript">
function loading_show(){
	$('#loading').html("<img src='images/loading.gif'/>").fadeIn('fast');
	}
		function loading_hide(){
			$('#loading').fadeOut('fast');
		}                
				function loadData(page){

                    loading_show();     

					
					var name = $("#name").val();
					$.ajax
					({
						type: "POST",
						url: "load_category_data.php",
						data: "page="+page+"&name="+name,
						success: function(msg)
						{
							
							loading_hide();
							$("#container").html(msg);
						}
						});
				}

            $(document).ready(function(){
				
				loadData(1);  // For first time page load default results
				$('#container').on('click','li.active',function(){
					var page = $(this).attr('p');
					loadData(page);
					});           

                $('#go_btn').on('click' ,function(){

                    var page = parseInt($('.goto').val());
					var no_of_pages = parseInt($('.total').attr('a'));
					if(page != 0 && page <= no_of_pages){
						loadData(page);

                    }else{

                        alert('Enter a PAGE between 1 and '+no_of_pages);
						$('.goto').val("").focus();
						return false;
					}
				});
				$('#search').on('click',function(){
					loadData(1);

               });

            });
   </script>
   </head>
   <?php
########## 
$Action  = isset($_REQUEST['action'])  ? $_REQUEST['action'] : "";
$field   = isset($_REQUEST['field'])   ? $_REQUEST['field']  : "";
$category_id      = isset($_REQUEST['category_id'])      ? $_REQUEST['category_id'] : "";
 
##########
if($Action == 'delete'){
	global $db;
	$sqlnew   = "UPDATE bhrgjovdrr_category SET status = '0' WHERE category_id = ".$category_id."";
	$querynew = $db->query($sqlnew);
	if($querynew){
		$msg = "<div><span class='notification n-success'>Record successfully deleted.</span></div>";	}
} ?>

<body class="skin-blue">
<?php include('header.php'); ?>
   <div class="content-wrapper">
     <section class="content">
       <div class="row">
         <div class="col-md-12">
           <?php if(isset($msg)) echo $msg; ?>
           <div class="module">
            <input type="text" name="name" id="name" placeholder="Enter Name" />
             <input type="button" name="search" id="search" value="Search" />
             <div class="module-table-body">
               <div id="loading"></div>
               <div id="container">
                 <div class="data"></div>
                 <div class="col-xs-6"></div>
                 <div style="clear: both"></div>
               </div>
               
               <!-- End .module-table-body --> 
               
             </div>
             <div style="clear:both;"></div>
           </div>
         </div>
       </div>
     </section>
   </div>
   <?php include_once("footer.php");?>
</body>
</html>