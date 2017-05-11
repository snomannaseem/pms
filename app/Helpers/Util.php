<?php
namespace App\Helpers;

use Doctrine\ORM\Query;
use LaravelDoctrine\ORM\Facades\EntityManager;
use App\Repositories\BaseRepo;

class Util extends BaseRepo
{
	/*
	* havePermission function is supposed to check permission no other function should handle checking permission
	*/
	public function havePermission($module_actions, $route)
	{
		
		/*select rp.is_active is_active, ma.url url, ma.description description, m.name module_name, a.name action_name from role_permissions rp, module_actions ma, modules m, actions a
where
rp.module_permission_id = ma.id AND ma.module_id = m.id AND ma.action_id = a.id AND rp.role_id = 2*/
		foreach($module_actions as $action)
		{
			if($action['url'] == $route)
			{
				return true;
			}
		}
		return false;

		$sql_obj['dql'] = "SELECT p, rp
        FROM App\\Entities\\RolePermissions rp
        LEFT JOIN rp.permission p";
		try
		{
			$result = $this->getRows($sql_obj,
				['sort_by' => "", 'order' => ""],
				["page_num" => 1, "page_size" => 0],
				false,
				QUERY::HYDRATE_ARRAY);
		}
		catch(\Exception $e)
		{
			dd('result');
			return $result;
		}
		//dd($result, $route);
		foreach($result['rows'] as $row)
		{
			if($row['permission']['permission'] == $route)
			{
				return true;
			}
		}
		return false;
		
	}
	
	public function isSuperAdmin($user_id)
	{
		try
		{
			$sql = "SELECT * FROM global_admins where user_id = $user_id";
			
			$query=$this->db->executeNative($sql , 'db_conn');
			$response = $query->fetchAll();
			if(count($response) > 0)
				return true;
			else
				return false;
		}
		catch(\Exception $e)
		{
			dd($e);
		}
		
		return $response;
	}
	
	public function getModuleActions($role_id)
	{
		try
		{
			$sql = "select rp.is_active is_active, ma.url url, ma.description description, m.name module_name, a.name action_name from role_permissions rp, module_actions ma, modules m, actions a
	where
	rp.module_permission_id = ma.id AND ma.module_id = m.id AND ma.action_id = a.id AND rp.role_id = $role_id";
			//exit($sql);
			$query=$this->db->executeNative($sql , 'db_conn');
			$response = $query->fetchAll();
		}
		catch(\Exception $e)
		{
			dd($e);
		}
		
		return $response;
	}
}
?>