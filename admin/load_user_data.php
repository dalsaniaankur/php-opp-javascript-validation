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
include('../Class/Users.php');
$obj_user = new Users();

$content ='';
$content.='<form action="">
				<table id="example2" class="table table-bordered table-hover">
					<thead>
						<tr >
							<th style="width:5%;text-align: center;">#</th>
							<th style="width:30%;text-align: center;">Email</th>
							<th style="width:30%;text-align: center;">Last login Date</th>
							<th style="width:25%;text-align: center;">Last login Ip</th>
						</tr>
					</thead>
					<tbody>';

$query = 'AND status = "1"';
if($_POST['name'] != '')
{
	$query .= " AND  email LIKE '%".$_POST['name']."%'";
}

$user_details = $obj_user->getRows($query,$arr=array("start"=>$start,"per_page"=>$per_page));

$j = $start;
$total_records = count($user_details);

if($total_records > 0)
{
	
	for($i=0;$i<$total_records;$i++)
	{
		
		$j = $j + 1;
		$content.='<tr>
		<td align="center">'.$j.'</td>
		<td align="center">'.$user_details[$i]->email.'</td>
		<td align="center">'.$user_details[$i]->lastLoginDatetime.'</td>
		<td align="center">'.$user_details[$i]->LastLoginIp.'</td>
		
		</tr>';
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
$no_count = $obj_user->getRows($query);
$count =count($no_count);
$no_of_paginations = ceil($count / $per_page);
include("pagination.php");
echo $msg;exit;
?>
