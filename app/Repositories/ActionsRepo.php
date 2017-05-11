<?php

#namespace BusinessLogic;
namespace App\Repositories;

use Doctrine\ORM\Query;
use LaravelDoctrine\ORM\Facades\EntityManager;
use App\Repositories\BaseRepo;
use App\Entities\Actions;
use Validator;


class ActionsRepo extends BaseRepo{

    // Basic Methods
	// public static function check(){
		// print "hello world";
	// }
	
    public static function buildQuery($filters, $order_by) {

		$dsql = 'SELECT PARTIAL act.{id, name}
                FROM App\\Entities\\Actions act';

        $where_field_map = [
          "userid"  => [true, " act.userid = :userid "],
          "name"    => [true, " act.name like CONCAT('%',:name,'%') "],
        ];
		
        $order_by_field_map = [
          "userid"  => " act.id __order__ ",
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

    public function getactionsList(
        $filters = [],
        $orderby = ['order' => "", 'sort_by' => ""],
        $paging = ["page_num" => 1, "page_size" => 0]
    ) {
        $sql_obj = self::buildQuery($filters, $orderby);
        $resultSet = $this->getRows($sql_obj, $orderby, $paging);

        $resultSet['resultSet'] = $resultSet;
        $resultSet['code'] = 200;
        return $resultSet;
    }
	
    public function createAction($data){
        //dd($data);
		$check_action = $this->checkActionName($data);
        //dd($check_action['rows']);
		$msg = "Successfully added";
        
		if(empty($check_action['rows'])){
			$actions = new Actions();
            //dd($check_action['name']);
			if(isset($data['id']) and $data['id'] != ''){                
				$msg = "Successfully updated";
				$actions  = EntityManager::getRepository('App\Entities\Actions')->findOneBy(array('id'=>$data['id']));
			}
            
			$actions->setName($data['name']);
			EntityManager::persist($actions);
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
            'msg'       => "Action Name already exist."
        );
	}
    
	public function checkActionName($data){
		$sql_obj['dql'] = "SELECT a FROM App\Entities\Actions a WHERE a.name=:name";
		$sql_obj['values'] = ["name" => $data['name']];
        
		// for Update
		 if(isset($data['id']) and $data['id']!=''){
			$sql_obj['dql'] = "SELECT a FROM App\Entities\Actions a WHERE a.name=:name and a.id!=:id";
			$sql_obj['values'] = ["name" => $data['name'],'id'=>$data['id']];
		}
		return  $this->getRows($sql_obj);
	}
    
	public function getActionById($id){
        $query = $this->db->getConnection('db_conn')->createQuery("SELECT PARTIAL act.{id, name}
                                                                    FROM App\\Entities\\Actions act
        WHERE act.id =:id ")->setParameter('id', $id);

        try {
            return $query->getSingleResult(Query::HYDRATE_ARRAY);
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
		
	public function delete($id){
		$sql_obj['dql'] = "DELETE App\\Entities\\Actions a where a.id = :id";
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
