<?php
$page = $_POST['page'];
$cur_page = $page;
$page -= 1;
$per_page = 50;
$previous_btn = true;
$next_btn = true;
$first_btn = true;
$last_btn = true;
$start = $page * $per_page;
include('../include/config.php');
include('../Class/Category.php');
$obj_category = new Category();
include('../Class/Maincategory.php');
$obj_maincategory = new Maincategory();


$content ='';
$content.='<form action="">
				<table id="example2" class="table table-bordered table-hover">
					<thead>
						<tr >
							<th style="width:5%;text-align: center;">#</th>
							<th style="width:45%;text-align: center;">Name</th>
							<th style="width:40%;text-align: center;">Main Category</th>
							<th style="width:10%;text-align: center;"></th>
						</tr>
					</thead>
					<tbody>';

$query = 'AND status = "1"';
if($_POST['name'] != '')
{
	$query .= " AND  name LIKE '%".$_POST['name']."%'";
}

$category_details = $obj_category->getRows($query,$arr=array("start"=>$start,"per_page"=>$per_page));

$j = $start;
$total_records = count($category_details);

if($total_records > 0)
{
	
	for($i=0;$i<$total_records;$i++)
	{
		$j = $j + 1;
		
		$content.='<tr>
		<td align="center">'.$j.'</td>
		<td align="center">'.$category_details[$i]->name.'</td>
		<td align="center">'.$category_details[$i]->main_category_id.'</td>
		
		<td align="center">';
		$content.='<a href="edit-category.php?main_category_id='.$category_details[$i]->category_id.'"><img src="images/pencil.gif" width="16" height="16" alt="edit" />
			<a href="show-category.php?action=delete&main_category_id='.$category_details[$i]->category_id.'"><img src="images/delete.gif" width="16" height="16" title="delete"  /></a>';
		
		 $content.='</td></tr>';
	}
}
else
{
	$content.='<tr>
	<td align="center" colspan="5">No results Found</td>
	</tr>'; 
}
$content.="</table>";	
$msg = "<div class='data'>" . $content . "</div>"; // Content for Data
$no_count = $obj_category->getRows($query);
$count =count($no_count);
$no_of_paginations = ceil($count / $per_page);
include("pagination.php");
echo $msg;exit;
?>
