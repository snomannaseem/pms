<?php

#namespace BusinessLogic;
namespace App\Repositories;

use Doctrine\ORM\Query;
use LaravelDoctrine\ORM\Facades\EntityManager;
use App\Repositories\BaseRepo;
use App\Entities\Users;
use Validator;


class UserRepo extends BaseRepo{

    // Basic Methods
	public static function check(){
		print "hello world";
	}
	
    public static function buildQuery($filters, $order_by) {
/*
        $dsql = 'SELECT PARTIAL user.{id, name, email, password, design_id, status},
                                                    PARTIAL manager.{id, name, email},
                                                    FROM BusinessObject\\Users
                                                    LEFT JOIN user.desig_id manager';

        $dsql = 'SELECT PARTIAL user.{id, name, email, password, design_id, status}
                                                    FROM App\\Entities\\Users';

		$dsql = 'SELECT PARTIAL user.{id, name, email, password, desigId, status}
                                                    FROM App\\Mappings\\Users user';
	*/

		$dsql = 'SELECT PARTIAL user.{id, name, email, password, roleId, status, createdBy}
                                                    FROM App\\Entities\\Users user';

        $where_field_map = [
		  //"default" => [true, " user.status = 1 "],
          "userid" => [true, " user.userid = :userid "],
          "name" => [true, " user.name like CONCAT('%',:name,'%') "],
          "logged_in_userid" => [true, " user.createdBy = :logged_in_userid "],
          
		  //"username" => [true, " user.username like CONCAT('%',:username,'%') "]
        ];
		
        $order_by_field_map = [
          "userid" => " user.id __order__ ",
          
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

    public function getUsersList(
      $filters = [],
      $orderby = ['order' => "", 'sort_by' => ""],
      $paging = ["page_num" => 1, "page_size" => 0]
    ) {

        $sql_obj = self::buildQuery($filters, $orderby);
        $resultSet = $this->getRows($sql_obj, $orderby, $paging);
        //dd($resultSet);
        //$profileRows = $resultSet["object_array"];
        //$resultSet["object_array"] = $profileRows;//ProfileStaff::CreateProfileStaffArray($profileRows);
		
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

        $query = $this->db->getConnection('db_conn')->createQuery("SELECT PARTIAL user.{id, name, email, password, roleId, status}
                                                    FROM App\\Entities\\Users user
        WHERE user.id =:id ")->setParameter('id', $id);

        try {
            return $query->getSingleResult(Query::HYDRATE_ARRAY);
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
	
	public function save(\App\Entities\Users $user)
	{
		$this->db->getConnection()->persist($user);
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
			$query = $this->db->getConnection('db_conn')->createQuery("SELECT PARTIAL user.{id, name, email, password, roleId, status}
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
	
	public function search($data)
	{
		$term = $data['term'];
		$status = isset($data['status']) ? $data['status'] : 1;
		$limit = isset($data['limit']) ? $data['limit'] : 10;
		$query = $this->db->getConnection('db_conn')->createQuery("SELECT PARTIAL user.{id, name, email, status,profileImage} FROM App\\Entities\\Users user
			WHERE user.status = :status and user.name like CONCAT('%',:term,'%') OR  user.email like CONCAT('%',:term,'%')  ")->setParameters(['status' => $status, 'term' => $term]);
			
		try {
			$res =  $query->getResult(Query::HYDRATE_ARRAY);
			return $res;
		} catch (\Doctrine\ORM\NoResultException $e) {
			dd('error in teamrepo->search');
		}
		
	}
	
}
