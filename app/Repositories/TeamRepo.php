<?php

#namespace BusinessLogic;
namespace App\Repositories;

use Doctrine\ORM\Query;
use LaravelDoctrine\ORM\Facades\EntityManager;
use App\Repositories\BaseRepo;
use App\Entities\Teams;
use App\Entities\TeamResources;
use Validator;


class TeamRepo extends BaseRepo{

    // Basic Methods
	public static function check(){
		print "hello world";
	}
	
    public static function buildQuery($filters, $order_by) {


		$dsql = 'SELECT  team,tr,count(tr.id) as total_memeber FROM App\\Entities\\Teams team  LEFT JOIN team.team_resources tr';

        $where_field_map = [		  
          "default" => [true, " team.deletedBy IS NULL "],
          "teamid" => [true, " team.teamid = :teamid "],
          "name" => [true, " team.name like CONCAT('%',:name,'%') "],
        ];
		
        $order_by_field_map = [
          "teamid" => " team.id __order__ ",
        ];

        
        $filter_obj = self::getWhereClause($filters, $where_field_map);
      //  $order_clause = self::getOrderClause($order_by, $order_by_field_map);
        $dsql .= $filter_obj['where_clause'] . " GROUP BY tr.team_id "  ;
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
		

       // $sql_obj = self::buildQuery($filters, $orderby);
		//$sql_obj['use_output_walkers']=false;

        //$resultSet = $this->getRows($sql_obj, $orderby, $paging);
		//dd($resultSet);
	
		$where ='';
		if(isset($filters['name']) && $filters['name']!=''){
			$like_this = $filters['name'];
			$where = " AND (t.name like '%$like_this%')";
		}
		//$userid = $filters['userid'];
		
		$sql = "SELECT  t.id, t.name,t.status,count(tr.id) as total_memeber FROM teams t LEFT JOIN team_resources tr  on t.id=tr.team_id   WHERE t.deleted_by IS NULL $where GROUP BY (t.id) ";
		$result_set = $this->paginateNative($sql, $paging['page_size'], $paging['page_num']);
		$result_set['code']  = 200;
		$result_set['status'] ='ok';
		return $result_set;

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
	
	public function getTeamById($id)
    {

        $query = $this->db->getConnection('db_conn')->createQuery("SELECT PARTIAL team.{id, name, status}
                                                    FROM App\\Entities\\Teams team
        WHERE team.id =:id ")->setParameter('id', $id);

        try {
            return $query->getSingleResult(Query::HYDRATE_ARRAY);
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
	
	public function getTeamResourcesByTeamId($id)
    {
		if($id == "") return [];  // No resource for '' or 0, 
		$sql = "select * from team_resources where team_id = $id AND deleted_by IS NULL";
		
		$query=$this->db->executeNative($sql, 'db_conn');
		$result = $query->fetchAll();
		//dd($result);
		$userids = [0];  // must be at least one userid exist
		foreach($result as $row)
		{
			$userids[] = $row['user_id'];
		}
		
        $query = $this->db->getConnection('db_conn')->createQuery("SELECT PARTIAL user.{id, name, email,  status,profileImage}
                                                    FROM App\\Entities\\Users user
        WHERE user.id in (".implode($userids, ','). ")");

        try {
            $result =  $query->getResult(Query::HYDRATE_ARRAY);
			return $result;
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
		
		$sql_obj['dql'] = "UPDATE App\\Entities\\Teams u set
                                u.name = :name
								
                               where u.id = :id";
		$sql_obj['values'] = $arr;
		$response = $this->db->runSQL($sql_obj['dql'], $sql_obj['values']);
		return $response;
	}
	
	public function getTeamFormValidator($data)
	{
		Validator::extend('teamnamedup', function($attribute, $value, $parameters)
		{
			$query = $this->db->getConnection('db_conn')->createQuery("SELECT PARTIAL team.{id, name, status}
                                                    FROM App\\Entities\\Teams team
			WHERE team.name =:name ")->setParameter('name', $value);
			//dd($value);
			try {
				$res =  $query->getResult(Query::HYDRATE_ARRAY);
				//dd('in verifying',$res);
				return count($res) == 0;
			} catch (\Doctrine\ORM\NoResultException $e) {
				dd($e);
				return true;
			}
			return $value == 'foo';
		});
		//$validator = Validator::make($request->all(),$test->rules);
		
		$rules = [ 'name' => "required" ];
		//dd($data);
		if($data['id'] == 0)
		{
			$rules['name'] = "required|teamnamedup:{$data['name']}";
		}
		
		
		//$validator = Validator::make(['name' => "xy"], ['name' => 'required']);
		$validator = Validator::make($data, $rules, ['teamnamedup' => 'Team name already exists.']);
		
		return $validator;
	}
	
	public function updateTeamResources($teamid, $userids, $deleted_by)
	{
		if(!is_array($userids)) $userids = [0]; // a blank array with 0 id
		foreach($userids as $userid)
		{
			$sql = "select * from team_resources where team_id = $teamid AND user_id = $userid";
			//dd($sql);
			$query=$this->db->executeNative($sql , 'db_conn');
			$response = $query->fetchAll();
			if(count($response) == 0)  // Not found than Insert
			{
				$sql2 = "INSERT INTO team_resources SET team_id = $teamid, 
				user_id = $userid, created_by = $deleted_by, created_on = now()";  // the deleter is also creator
				echo "<br>$sql2<br>";
				$query2 = $this->db->executeNative($sql2 , 'db_conn');
			}
			else // If found UNDELETE (soft delete removed) it
			{
				$sql2 = "UPDATE team_resources SET deleted_by = null, deleted_on = null WHERE team_id = $teamid AND user_id = $userid";  // the deleter is also creator
				echo "<br>$sql2<br>";
				$query2 = $this->db->executeNative($sql2 , 'db_conn');
			}
			
		}
		//dd('break');
		
		// REMOVE (SOFT DELETE) ALL  NOT IN $userids
			
		$sql3 = "UPDATE team_resources SET  deleted_by = $deleted_by, deleted_on = now()  WHERE team_id = $teamid AND user_id NOT IN (".implode($userids,",").")";  // the deleter is also creator
		echo "<br>$sql3<br>";
		$query3 = $this->db->executeNative($sql3 , 'db_conn');
		//exit;
	}
	/*
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
	*/
	
	public function saveTeamResources($teamid, $userids, $created_by = 1) // array of userids
	{
		//dd($teamid, $userids);
		if(is_array($userids))
		{
			foreach($userids as $userid)
			{
				$team_res = new \App\Entities\TeamResources();
				//$aa->setAdcenterProfiles($this->db->getConnection()->getReference('BusinessObject\\AdcenterProfiles', $data['userid']));
				$team_res->setTeam($this->db->getConnection()->getReference('App\\Entities\\Teams', $teamid));
				$team_res->setUser($this->db->getConnection()->getReference('App\\Entities\\Users', $userid));
				$team_res->setUser($this->db->getConnection()->getReference('App\\Entities\\Users', $userid));
				$team_res->setCreatedBy($created_by);
				$team_res->setCreatedOn(new \DateTime());
				$this->db->getConnection()->persist($team_res);
				$this->db->getConnection()->flush();
			}
		}
	}
	
	public function delete($id, $deleted_by)
	{
		$sql = "update teams u set
                                u.deleted_by = $deleted_by,
								u.deleted_on = now()
                               where u.id = $id";
							   //dd($sql);
									
	    $query = $this->db->executeNative($sql , 'db_conn');
		//$sql_obj['values']['id'] = $id;
		//$sql_obj['values']['deleted_on'] = new \DateTime();
		//$response = $this->db->runSQL($sql_obj['dql'], $sql_obj['values']);
		//return $response;
		//return $query;
	}
	
	
}
