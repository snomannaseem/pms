<?php

#namespace BusinessLogic;
namespace App\Repositories;

use Doctrine\ORM\Query;
use LaravelDoctrine\ORM\Facades\EntityManager;
use App\Repositories\BaseRepo;
use App\Entities\Teams;
use Validator;


class TeamRepo extends BaseRepo{

    // Basic Methods
	public static function check(){
		print "hello world";
	}
	
    public static function buildQuery($filters, $order_by) {


		$dsql = 'SELECT PARTIAL team.{id, name, status}
                                                    FROM App\\Entities\\Teams team';

        $where_field_map = [		  
          "teamid" => [true, " team.teamid = :teamid "],
          "name" => [true, " team.name like CONCAT('%',:name,'%') "],
        ];
		
        $order_by_field_map = [
          "teamid" => " team.id __order__ ",
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

    public function getTeamsList(
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

    public function getListAdminPage(){

    }
	/*
	public function getUserById($id)
	{
		$dsql = 'SELECT PARTIAL user.{id, name, email, password, desigId, status}
                                                    FROM App\\Entities\\Users user';
		
		try {
            return $query->getSingleResult(Query::HYDRATE_OBJECT);
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
	}
	*/
	
	public function getUserById($id)
    {

        $query = $this->db->getConnection('db_conn')->createQuery("SELECT PARTIAL user.{id, name, email, password, desigId, status}
                                                    FROM App\\Entities\\Users user
        WHERE user.id =:id ")->setParameter('id', $id);

        try {
            return $query->getSingleResult(Query::HYDRATE_ARRAY);
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
	
	public function save(\App\Entities\Teams $team)
	{
		$this->db->getConnection()->persist($team);
		$this->db->getConnection()->flush();
	}
	
	public function update($arr)
	{
		$arr['password'] = bcrypt($arr['password']);
		$sql_obj['dql'] = "UPDATE App\\Entities\\Users u set
                                u.name = :name,
								u.email = :email,
								u.password = :password
                               where u.id = :id";
		$sql_obj['values'] = $arr;
		$response = $this->db->runSQL($sql_obj['dql'], $sql_obj['values']);
		return $response;
	}
	
	public function getUserFormValidator($data)
	{
		Validator::extend('useremaildup', function($attribute, $value, $parameters)
		{
			$query = $this->db->getConnection('db_conn')->createQuery("SELECT PARTIAL user.{id, name, email, password, desigId, status}
                                                    FROM App\\Entities\\Users user
			WHERE user.email =:email ")->setParameter('email', $value);
			
			try {
				$res =  $query->getSingleResult(Query::HYDRATE_ARRAY);
				
				return count($res) == 0;
			} catch (\Doctrine\ORM\NoResultException $e) {
				return true;
			}
			return $value == 'foo';
		});
		//$validator = Validator::make($request->all(),$test->rules);
		
		$rules = [ 'name' => 'required' ];
		if($data['id'] == 0)
		{
			$rules['email'] = "useremaildup:{$data['email']}";
		}
		
		//$validator = Validator::make(['name' => "xy"], ['name' => 'required']);
		$validator = Validator::make($data, $rules, ['useremaildup' => 'custom error message for email duplication']);
		
		return $validator;
	}
	
	public function delete($id)
	{
		$sql_obj['dql'] = "UPDATE App\\Entities\\Users u set
                                u.status = 0
								
                               where u.id = :id";
		$sql_obj['values']['id'] = $id;
		$response = $this->db->runSQL($sql_obj['dql'], $sql_obj['values']);
		return $response;
	}
	
	public function getTeamFormValidator($data)
	{
		Validator::extend('teamnamedup', function($attribute, $value, $parameters)
		{
			$query = $this->db->getConnection('db_conn')->createQuery("SELECT PARTIAL team.{id, name}
                                                    FROM App\\Entities\\Teams team
			WHERE team.name =:name ")->setParameter('name', $value);
			
			try {
				$res =  $query->getSingleResult(Query::HYDRATE_ARRAY);
				
				return count($res) == 0;
			} catch (\Doctrine\ORM\NoResultException $e) {
				return true;
			}
			return $value == 'foo';
		});
		
		
		$rules = [ 'name' => "required|teamnamedup:{$data['email']}" ];
		//if($data['id'] == 0)
		//{
			//$rules['name'] = "teamnamedup:{$data['email']}";
		//}
		
		//$validator = Validator::make(['name' => "xy"], ['name' => 'required']);
		$validator = Validator::make($data, $rules, ['useremaildup' => 'custom error message for email duplication']);
		
		return $validator;
	}
	
	public function saveTeamResources($teamid, $userids) // array of userids
	{
		$team_res = new \App\Entities\Teams();
		$team_res->setName($name);
		$this->db->getConnection()->persist($team);
		$this->db->getConnection()->flush();
	}
	
	
}
