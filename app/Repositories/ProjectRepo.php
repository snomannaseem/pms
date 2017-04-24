<?php

namespace App\Repositories;

use Doctrine\ORM\Query;
use LaravelDoctrine\ORM\Facades\EntityManager;
use App\Repositories\BaseRepo;
use App\Entities\Projects;
use App\Entities\Categories;
use App\Entities\Priorities;
use App\Entities\Teams;

class ProjectRepo extends BaseRepo{

    
	/*CREATE PROJECT AND UPDATE PROJECT*/
	public function createProject($data){
		
		$check_project = $this->checkPrjectTile($data);
		 $msg = "Successfully added";
		if(empty($check_project['rows'])){
			$projects = new Projects();
			if(isset($data['id']) and $data['id']!=''){
				$msg = "Successfully updated";
				$projects  = EntityManager::getRepository('App\Entities\Projects')->findOneBy(array('id'=>$data['id']));
			}
			$estimate_date =($data['estimate_deadline'])!=''? new \DateTime(date('y-m-d', strtotime($data['estimate_deadline']))):null;
			$projects->setTeam($this->db->getConnection()->getReference('App\Entities\Teams',isset($data['team_id'])?data['team_id']:1));
			
			//$datae = date('y-m-d', strtotime($data['estimate_deadline']));
			//dd($estimate_date );
			$projects->setTitle($data['title']);
			$projects->setDescription($data['description']);
			$projects->setEstTime(isset($data['estimate_time'])?$data['estimate_time']:null);
			$projects->setEstDeadline($estimate_date);
			$projects->setCreatedOn(new \DateTime());
			$projects->setUpdatedOn(new \DateTime());
			$projects->setCreatedBy(isset($data['userid'])?$data['userid']:1);
			$projects->setUpdatedBy(isset($data['userid'])?$data['userid']:1);
			$projects->setStatus($data['status']);
			EntityManager::persist($projects);
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
            'msg'       => "Project  Title already exist."
        );
	}
	
	
    public static function buildQuery($filters, $order_by) {

		$dsql = 'SELECT PARTIAL proj.{id, title,status,estDeadline,createdOn} FROM App\\Entities\\Projects proj';

        $where_field_map = [
		  //"default" => [true, " cat.status = 1 "],
          "userid" => [true, " proj.createdBy = :userid "],
		   "name" => [true, " proj.title like CONCAT('%',:name,'%') OR  proj.description like CONCAT('%',:name,'%') "],
		 
          //"username" => [true, " cat.username like CONCAT('%',:username,'%') "]
        ];
		
        $order_by_field_map = [
          "id" => " proj.id __order__ ",
          "est_deadline" => " proj.estDeadline __order__ ",
          
          
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

    public function getProjectsList(
      $filters = [],
      $orderby = ['order' => "", 'sort_by' => ""],
      $paging = ["page_num" => 1, "page_size" => 0]
    ) {

        $sql_obj = self::buildQuery($filters, $orderby);
		$resultSet = $this->getRows($sql_obj, $orderby, $paging);
		return $resultSet;
    }

	
	
	public function getProjectById($id)
    {

        $query = $this->db->getConnection('db_conn')->createQuery("SELECT PARTIAL pro.{id, title,status,description,estDeadline,estTime}
                                                    FROM App\\Entities\\Projects pro
        WHERE pro.id =:id ")->setParameter('id', $id);

        try {
            return $query->getSingleResult(Query::HYDRATE_ARRAY);
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
	
	
	public function delete($id)
	{
		$sql_obj['dql'] = "UPDATE App\\Entities\\Projects p set p.status = 0 where p.id = :id";
		$sql_obj['values']['id'] = $id;
		$response = $this->db->runSQL($sql_obj['dql'], $sql_obj['values']);
		return $response;
	}
	public function checkPrjectTile($data){
		$sql_obj['dql'] = "SELECT a  FROM App\Entities\Projects a WHERE a.title=:title  and a.createdBy=:userid";
		$sql_obj['values'] = ["title" => $data['title'],'userid'=>$data['userid']];
		// for Update
		 if(isset($data['id']) and $data['id']!=''){
			$sql_obj['dql'] = "SELECT a  FROM App\Entities\Projects a WHERE a.title=:title and a.id!=:id and a.createdBy=:userid";
			$sql_obj['values'] = ["title" => $data['title'],'id'=>$data['id'],'userid'=>$data['userid']];
		}
		return  $this->getRows($sql_obj);
	}
	/*Issue related functions*/
	
	/*Get Project List of User*/
	public function getProjectByUserId($userid=1){
		$sql_obj['dql'] = "SELECT a  FROM App\Entities\Projects a WHERE a.createdBy=:userid  and a.status=1";
		$sql_obj['values'] = ['userid'=>$userid];
		try{
			return  $this->getRows($sql_obj);
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
	}
		
	public function getCategories(){

		$sql_obj['dql'] = "SELECT a  FROM App\Entities\Categories a WHERE  a.status=1";
		try{
			return  $this->getRows($sql_obj);
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
	}		
	public function getPriorities(){
		$sql_obj['dql'] = "SELECT a  FROM App\Entities\Priorities a";
		try{
			return  $this->getRows($sql_obj);
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
	}
	public function getAssginee($project_id){
		$sql_obj['dql'] = "SELECT user.id,user.name  FROM App\Entities\ProjectsResources pro_res
						JOIN pro_res.project pro 
						JOIN pro_res.user user
						WHERE pro.id=:project_id";
		$sql_obj['values'] = ['project_id' => $project_id];
           
		try{
			$res['code']=200;
			$res['status']='ok';
			$res['data']=$this->getRows($sql_obj);;
			return $res;
		} catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
	}
	
	public function getIssueResolutionType(){
		$sql_obj['dql'] = "SELECT a.id,a.name  from issue_resolution_types a ";
		$res =  $this->db->executeNative($sql_obj['dql']);
		return $res->fetchAll();
	}
	public function getIssueType(){
		$sql_obj['dql'] = "SELECT a.id,a.name  from issue_types a ";
		$res =  $this->db->executeNative($sql_obj['dql']);
		return $res->fetchAll();
	}
	
	
	
	
}


