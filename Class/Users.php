<?php
/*

Class File For Users.

*/

class Users

{
	var $userId;
	var $email;
	var $password;
	var $newPassword;
	var $lastLoginDatetime;
	var $LastLoginIp;
	var $status;
	var $sitepath;
	
		public function __construct()
		{
			$this->userId=0;
	
			$argv = func_get_args();

			switch( func_num_args() ) {

				case 1:

					self::__construct1($argv[0]);

					break;
			}
		}

		public function __construct1($userId)
		{
			$users_details = $db->get_results("select * from bhrgjovdrr_users where userId=".$userId."",ARRAY_N);
		}

		public function byuserId()
		{
			global $db;
			$row = $db->get_results("select * from bhrgjovdrr_users WHERE userId = '".$this->userId."'");
			if($row && count($row)>0)
			{
				$UserList=array();
				$users = new Users();
				$users->userId = $row[0]->userId;
				$users->email = $row[0]->email;
				$users->password = $row[0]->password;
				$users->lastLoginDatetime = $row[0]->lastLoginDatetime;
				$users->LastLoginIp = $row[0]->LastLoginIp;
				$users->status = $row[0]->status;

				$UserList[] = $users;
				return $UserList;

			}
		}

		public function getRows($where,$arr)
		{
			global $db;
			$query = '';
			$query .= "select * from bhrgjovdrr_users where 1=1 ".$where;
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
				$UserList=array();

				for($i=0;$i<count($row);$i++)
				{
					$users = new Users();
					$users->userId = $row[$i]->userId;
					$users->email = $row[$i]->email;
					$users->password = $row[$i]->password;
					$users->lastLoginDatetime = $row[$i]->lastLoginDatetime;
					$users->LastLoginIp = $row[$i]->LastLoginIp;
					$users->status = $row[$i]->status;

					$UserList[] = $users;

				}
					
				return $UserList;
			}
		}

		public function login()
		{	
			global $db;
			$row = $db->get_results("select * from bhrgjovdrr_users WHERE email = '".$this->email."' AND password = '".$this->password."' AND status = '1'");
			if($row && count($row)>0)
			{
				 $UserList=array();
				 $users = new Users();
				 $users->userId = $row[0]->userId;
				 $users->email = $row[0]->email;
				 $users->status = $row[0]->status;
				 $UserList[] = $users;
				  
				 $users->updateLoginData();
				 return $row;
			}
			else
			{
				 return false;
			}
		}
		
		function updateLoginData()
		{
			global $db;	
			return $db->query("UPDATE bhrgjovdrr_users SET lastLoginDatetime = '".date('Y-m-d H:i:s')."',LastLoginIp = '".$_SERVER['REMOTE_ADDR']."'  WHERE  userId = '".$this->userId."'");
		}

		function updatePassword()
		{
			 global $db;
			 return $db->query("UPDATE bhrgjovdrr_users SET password = '" . $this->newPassword . "' WHERE  userId = '" . $this->userId . "'");
		}
}

?>