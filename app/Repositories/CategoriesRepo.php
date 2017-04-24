<?php

#namespace BusinessLogic;
namespace App\Repositories;

use Doctrine\ORM\Query;
use LaravelDoctrine\ORM\Facades\EntityManager;
use App\Repositories\BaseRepo;
use App\Entities\Categories;
use Validator;


class CategoriesRepo extends BaseRepo{

    // Basic Methods
	public static function check(){
		print "hello world";
	}
	
    public static function buildQuery($filters, $order_by) {

		$dsql = 'SELECT PARTIAL cat.{id, name, status}
                                                    FROM App\\Entities\\Categories cat';

        $where_field_map = [
		  //"default" => [true, " cat.status = 1 "],
          "userid" => [true, " cat.userid = :userid "],
          "name" => [true, " cat.name like CONCAT('%',:name,'%') "],
          
		  //"username" => [true, " cat.username like CONCAT('%',:username,'%') "]
        ];
		
        $order_by_field_map = [
          "userid" => " cat.id __order__ ",
          
          //"manager" => " concat(manager.username, ' ', manager.lastname) __order__ "
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

    public function getCategoriesList(
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
	
	
	public function getCategoryById($id)
    {

        $query = $this->db->getConnection('db_conn')->createQuery("SELECT PARTIAL cat.{id, name, status}
                                                    FROM App\\Entities\\Categories cat
        WHERE cat.id =:id ")->setParameter('id', $id);

        try {
            return $query->getSingleResult(Query::HYDRATE_ARRAY);
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
	
	public function save(\App\Entities\Categories $cat)
	{
		$this->db->getConnection()->persist($cat);
		$this->db->getConnection()->flush();
	}
	
	public function update($arr)
	{
		$sql_obj['dql'] = "UPDATE App\\Entities\\Categories u set
                                u.name = :name,
								u.status = :status
                               where u.id = :id";
		$sql_obj['values'] = $arr;
		$response = $this->db->runSQL($sql_obj['dql'], $sql_obj['values']);
		return $response;
	}
	
	
	
	public function delete($id)
	{
		$sql_obj['dql'] = "UPDATE App\\Entities\\Categories u set
                                u.status = 0
								
                               where u.id = :id";
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
