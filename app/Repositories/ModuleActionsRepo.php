<?php

#namespace BusinessLogic;
namespace App\Repositories;

use Doctrine\ORM\Query;
use LaravelDoctrine\ORM\Facades\EntityManager;
use App\Repositories\BaseRepo;
use App\Entities\ModuleActions;
use Validator;


class ModuleActionsRepo extends BaseRepo{

    // Basic Methods
	// public static function check(){
		// print "hello world";
	// }
	
    public static function buildQuery($filters, $order_by) {

		$dsql = 'SELECT  mact,m,a
                FROM App\\Entities\\ModuleActions mact JOIN mact.module m JOIN mact.action a ';

        $where_field_map = [
          "userid"  => [true, " mact.userid = :userid "],
          "url"    => [true, " mact.url like CONCAT('%',:url,'%') "],
        ];
		
        $order_by_field_map = [
          "userid"  => " mact.id __order__ ",
        ];

        //dd($filters);
        $filter_obj     = self::getWhereClause($filters, $where_field_map);
        $order_clause   = self::getOrderClause($order_by, $order_by_field_map);
        $dsql          .= $filter_obj['where_clause'] . $order_clause;
        //dd($dsql);
        
        return [
            "dql"       => $dsql,
            "values"    => $filter_obj['values']
        ];
    }

    public function getModuleActionsList(
        $filters = [],
        $orderby = ['order' => "", 'sort_by' => ""],
        $paging = ["page_num" => 1, "page_size" => 0]
    ) {
        $sql_obj = self::buildQuery($filters, $orderby);
        $resultSet = $this->getRows($sql_obj, $orderby, $paging);
dd(  $resultSet);
        $resultSet['resultSet'] = $resultSet;
        $resultSet['code'] = 200;
        return $resultSet;
    }
	
    public function createModuleAction($data){
        //dd($data);
		$check_module_action = $this->checkModuleActionName($data);
        //dd($check_action['rows']);
		$msg = "Successfully added";
        
		if(empty($check_module_action['rows'])){
			$moduleActions = new ModuleActions();
            //dd($check_module_action['name']);
			if(isset($data['id']) and $data['id'] != ''){                
				$msg = "Successfully updated";
				$moduleActions  = EntityManager::getRepository('App\Entities\ModuleActions')->findOneBy(array('id'=>$data['id']));
			}
            
			$moduleActions->setName($data['name']);
			EntityManager::persist($moduleActions);
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
            'msg'       => "Module Actions Name already exist."
        );
	}
    
	public function checkModuleActionName($data){
		$sql_obj['dql'] = "SELECT a FROM App\Entities\ModuleActions a WHERE a.name=:name";
		$sql_obj['values'] = ["name" => $data['name']];
        
		// for Update
		 if(isset($data['id']) and $data['id']!=''){
			$sql_obj['dql'] = "SELECT a FROM App\Entities\ModuleActions a WHERE a.name=:name and a.id!=:id";
			$sql_obj['values'] = ["name" => $data['name'],'id'=>$data['id']];
		}
		return  $this->getRows($sql_obj);
	}
    
	public function getModuleActionById($id){
        $query = $this->db->getConnection('db_conn')->createQuery("SELECT PARTIAL mact.{id, name}
                                                                    FROM App\\Entities\\ModuleActions mact
        WHERE mact.id =:id ")->setParameter('id', $id);

        try {
            return $query->getSingleResult(Query::HYDRATE_ARRAY);
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
		
	public function delete($id){
		$sql_obj['dql'] = "DELETE App\\Entities\\ModuleActions a where a.id = :id";
		$sql_obj['values']['id'] = $id;
		$response = $this->db->runSQL($sql_obj['dql'], $sql_obj['values']);
		return $response;
	}
	
	public function getUserFormValidator($data){
		$rules = [ 'name' => 'required' ];
		
		//$validator = Validator::make(['name' => "xy"], ['name' => 'required']);
		$validator = Validator::make($data, $rules, ['useremaildup' => 'custom error message for email duplication']);
		
		return $validator;
	}

}
