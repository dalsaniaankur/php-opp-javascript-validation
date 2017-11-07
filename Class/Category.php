<?php
/*

Class File For Category.

*/

class Category

{
	var $category_id;
	var $name;
	var $main_category_id;
	var $status;
	
		public function __construct()
		{
			$this->category_id=0;

			$argv = func_get_args();

			switch( func_num_args() ) {

				case 1:

					self::__construct1($argv[0]);

					break;
			}
		}

		public function __construct1($category_id)
		{
			$category_details = $db->get_results("select * from bhrgjovdrr_category where category_id=".$category_id."",ARRAY_N);
		}

		function insert()
		{
			global $db;
			return $db->query("insert into bhrgjovdrr_category(name,main_category_id,status) values(
				'".$this->name."',
				'".$this->main_category_id."',
				'".$this->status."')");
			
		}
		public function bycategory_id()
		{
			global $db;
			$row = $db->get_results("select * from bhrgjovdrr_category WHERE category_id = '".$this->category_id."'");
			if($row && count($row)>0)
			{
				$categoryList=array();
				$category = new Category();
				$category->category_id = $row[0]->category_id;
				$category->name = $row[0]->name;
				$category->main_category_id = $row[0]->main_category_id;
				$category->status = $row[0]->status;

				$categoryList[] = $category;
				return $categoryList;

			}
		}

		public function getRows($where,$arr)
		{
			global $db;
			$query = '';
			$query .= "select * from bhrgjovdrr_category where 1=1 ".$where;
			if($arr['per_page'] > 0)
			{
					 $query .= " limit " . $arr["start"] . " , " . $arr["per_page"];
			}
			if($arr['orderBy'] != '')
			{
					$query.=" ORDER BY". $arr['orderBy'];
			}
			$row = $db->get_results($query);

			if($row && count($row)>0)
			{
				$categoryList=array();

				for($i=0;$i<count($row);$i++)
				{
					$category = new Category();
					$category->category_id = $row[$i]->category_id;
					$category->name = $row[$i]->name;
					$category->main_category_id = $row[$i]->main_category_id;
					$category->status = $row[$i]->status;

					$categoryList[] = $category;

				}
					
				return $categoryList;
			}
		}
		function update()
		{
			global $db;
			return $db->query("UPDATE bhrgjovdrr_category SET name = '".$this->name."', main_category_id = '".$this->main_category_id."' WHERE  category_id = '".$this->category_id."'");
		}

}

?>