<?php

#namespace BusinessLogic;
namespace App\Repositories;

use Doctrine\ORM\Query;
use LaravelDoctrine\ORM\Facades\EntityManager;
use App\Repositories\BaseRepo;
use App\Entities\Modules;
use Validator;


class ModuleRepo extends BaseRepo{

    // Basic Methods
	// public static function check(){
		// print "hello world";
	// }
	
    public static function buildQuery($filters, $order_by) {

		$dsql = 'SELECT PARTIAL mod.{id, name}
                FROM App\\Entities\\Modules mod';

        $where_field_map = [
          "userid" => [true, " mod.userid = :userid "],
          "name" => [true, " mod.name like CONCAT('%',:name,'%') "],
        ];
		
        $order_by_field_map = [
          "userid" => " mod.id __order__ ",
        ];

        //dd($filters);
        $filter_obj = self::getWhereClause($filters, $where_field_map);
        $order_clause = self::getOrderClause($order_by, $order_by_field_map);
        $dsql .= $filter_obj['where_clause'] . $order_clause;
        //dd($dsql);
        return [
          "dql" => $dsql,
          "values" => $filter_obj['values']
        ];
    }

    public function getModuleList(
      $filters = [],
      $orderby = ['order' => "", 'sort_by' => ""],
      $paging = ["page_num" => 1, "page_size" => 0]
    ) {

        $sql_obj = self::buildQuery($filters, $orderby);
        $resultSet = $this->getRows($sql_obj, $orderby, $paging);
		
        $resultSet['resultSet'] = $resultSet;
        $resultSet['code'] = 200;
		return $resultSet;
		/*
        return [
            'code' => 200,
            'status' => 'ok',
            'resultSet' => $resultSet
        ];
		*/

    }

    public function getListAdminPage(){

    }
	
    public function createModule($data){
        //dd($data);
		$check_module = $this->checkModuleName($data);
        //dd($check_module['rows']);
		$msg = "Successfully added";
        
		if(empty($check_module['rows'])){
			$modules = new Modules();
            //dd($check_module['name']);
			if(isset($data['id']) and $data['id'] != ''){                
				$msg = "Successfully updated";
				$modules  = EntityManager::getRepository('App\Entities\Modules')->findOneBy(array('id'=>$data['id']));
			}
            
			$modules->setName($data['name']);
			EntityManager::persist($modules);
			EntityManager::flush();
			
			
			  return array(
				  'code' => '200',
				  'status' => 'ok',
				  'msg' => $msg
			  );
		}
		 return array(
            'code'      => '401',
            'status'    => 'error',
            'msg'       => "Module Name already exist."
        );
	}
    
	public function checkModuleName($data){
		$sql_obj['dql'] = "SELECT a FROM App\Entities\Modules a WHERE a.name=:name";
		$sql_obj['values'] = ["name" => $data['name']];
        
		// for Update
		 if(isset($data['id']) and $data['id']!=''){
			$sql_obj['dql'] = "SELECT a FROM App\Entities\Modules a WHERE a.name=:name and a.id!=:id";
			$sql_obj['values'] = ["name" => $data['name'],'id'=>$data['id']];
		}
		return  $this->getRows($sql_obj);
	}
    
	public function getModuleById($id)
    {
        $query = $this->db->getConnection('db_conn')->createQuery("SELECT PARTIAL mod.{id, name}
                                                                    FROM App\\Entities\\Modules mod
        WHERE mod.id =:id ")->setParameter('id', $id);

        try {
            return $query->getSingleResult(Query::HYDRATE_ARRAY);
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
	
	// public function save(\App\Entities\Categories $cat)
	// {
		// $this->db->getConnection()->persist($cat);
		// $this->db->getConnection()->flush();
	// }
	
	// public function update($arr)
	// {
		// $sql_obj['dql'] = "UPDATE App\\Entities\\Categories u set
                                // u.name = :name,
								// u.status = :status
                               // where u.id = :id";
		// $sql_obj['values'] = $arr;
		// $response = $this->db->runSQL($sql_obj['dql'], $sql_obj['values']);
		// return $response;
	// }
	
	
	
	public function delete($id)
	{
		$sql_obj['dql'] = "DELETE App\\Entities\\Modules m where m.id = :id";
		$sql_obj['values']['id'] = $id;
		$response = $this->db->runSQL($sql_obj['dql'], $sql_obj['values']);
		return $response;
	}
	
	public function getUserFormValidator($data)
	{
		$rules = [ 'name' => 'required' ];
		
		
		//$validator = Validator::make(['name' => "xy"], ['name' => 'required']);
		$validator = Validator::make($data, $rules, ['useremaildup' => 'custom error message for email duplication']);
		
		return $validator;
	}

}
