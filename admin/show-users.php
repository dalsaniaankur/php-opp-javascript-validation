<?php 
	include('../include/config.php');
	include('session-verify.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>info.phpzo | Show Users</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <?php include "script.php"; ?>
	<script type="text/javascript">
	function loading_show(){
		jQuery('#loading').html("<img src='images/loading.gif'/>").fadeIn('fast');
	}
	function loading_hide(){
		jQuery('#loading').fadeOut('fast');
	}                
	function loadData(page){

		loading_show();     

		var name = jQuery("#name").val();
		jQuery.ajax
		({
			type: "POST",
			url: "load_user_data.php",
			data: "page="+page+"&name="+name,
			success: function(msg)
			{
				
				loading_hide();
				$("#container").html(msg);
			}
		});
	}

	jQuery(document).ready(function(){
		
		loadData(1);  // For first time page load default results
		jQuery('#container').on('click','li.active',function(){
			var page = $(this).attr('p');
			loadData(page);
			});           

		jQuery('#go_btn').on('click' ,function(){

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
		jQuery('#search').on('click',function(){
			loadData(1);

	   });

	});
   </script>
  </head>
 
  <body class="skin-blue">
    <div class="wrapper">
      <?php include "header.php"; ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

		<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>  Users  </h1>
          
        </section>

        <!-- Main content -->
        <section class="content">
           <div class="box">
                <div class="box-body">
				   <div class="module">
					<input type="text" name="name" id="name" placeholder="Enter Email" />
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
                </div><!-- /.box-body -->
              </div><!-- /.box -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include "footer.php"; ?>
    </div><!-- ./wrapper -->

  </body>
</html>