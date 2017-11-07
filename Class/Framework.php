<?php
/*

Class File For Framework.

*/

class Framework

{
	var $framework_id;
	var $name;
	var $status;
	
		public function __construct()
		{
			$this->framework_id=0;

			$argv = func_get_args();

			switch( func_num_args() ) {

				case 1:

					self::__construct1($argv[0]);

					break;
			}
		}

		public function __construct1($framework_id)
		{
			$framework_details = $db->get_results("select * from bhrgjovdrr_framework where framework_id=".$framework_id."",ARRAY_N);
		}

		function insert()
		{
			global $db;
			return $db->query("insert into bhrgjovdrr_framework(name,status) values(
				'".$this->name."',
				'".$this->status."')");
			
		}
		public function byframework_id()
		{
			global $db;
			$row = $db->get_results("select * from bhrgjovdrr_framework WHERE framework_id = '".$this->framework_id."'");
			if($row && count($row)>0)
			{
				$frameworkList=array();
				$framework = new Framework();
				$framework->framework_id = $row[0]->framework_id;
				$framework->name = $row[0]->name;
				$framework->status = $row[0]->status;

				$frameworkList[] = $framework;
				return $frameworkList;

			}
		}

		public function getRows($where,$arr)
		{
			global $db;
			$query = '';
			$query .= "select * from bhrgjovdrr_framework where 1=1 ".$where;
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
				$frameworkList=array();

				for($i=0;$i<count($row);$i++)
				{
					$framework = new Framework();
					$framework->framework_id = $row[$i]->framework_id;
					$framework->name = $row[$i]->name;
					$framework->status = $row[$i]->status;

					$frameworkList[] = $framework;

				}
					
				return $frameworkList;
			}
		}
		function update()
		{
			global $db;
			return $db->query("UPDATE bhrgjovdrr_framework SET name = '".$this->name."' WHERE  framework_id = '".$this->framework_id."'");
		}

}

?>