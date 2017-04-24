<?php

namespace App\Repositories;

use Doctrine\ORM\Query;
use LaravelDoctrine\ORM\Facades\EntityManager;
use App\Repositories\BaseRepo;
use App\Entities\Projects;
use App\Entities\Issues;
use App\Entities\Categories;
use App\Entities\Priorities;
use App\Entities\Users;
use App\Entities\IssueResolutionTypes;
use App\Entities\IssueTypes;


class IssueRepo extends BaseRepo{

    
	/*CREATE PROJECT AND UPDATE PROJECT*/
	public function createIssue($data){
	//	dd($data);
		$msg = "Successfully added";
	
		$issue = new Issues();
		if(isset($data['id']) and $data['id']!=''){
			$msg = "Successfully updated";
			$issue  = EntityManager::getRepository('App\Entities\Issues')->findOneBy(array('id'=>$data['id']));
		}
		
		$issue->setCategory($this->db->getConnection()->getReference('App\Entities\Categories',$data['category']));
		$issue->setPriority($this->db->getConnection()->getReference('App\Entities\Priorities',$data['priorities']));
		$issue->setAssignedTo($this->db->getConnection()->getReference('App\Entities\Users',$data['assigned_to']));
		$issue->setIssueType($this->db->getConnection()->getReference('App\Entities\IssueTypes',$data['issue_type']));
		$issue->setResolution($this->db->getConnection()->getReference('App\Entities\IssueResolutionTypes',$data['resolution']));
		$issue->setProjectId($data['project']);
		$issue->setTitle($data['issue_title']);
		$issue->setDescription($data['description']);
		$issue->setEstTime(isset($data['estimate_time'])?$data['estimate_time']:null);
		$issue->setStatus($data['status']);
		//$issue->setIssueType($data['issue_type']);
		//$issue->setResolution($data['resolution']);
		$issue->setParentIssueId(isset($data['parent_issue_type']) && $data['issue_type']==2?$data['parent_issue_type']:0);
		
		if(isset($data['id']) and $data['id']!=''){
			$issue->setUpdatedOn(new \DateTime());
			$issue->setUpdatedBy(isset($data['userid'])?$data['userid']:1);
		}else{
			$issue->setCreatedOn(new \DateTime());
			$issue->setCreatedBy(isset($data['userid'])?$data['userid']:1);
		}
		
		EntityManager::persist($issue);
		EntityManager::flush();
		  return array(
			  'code' => '200',
			  'status' => 'ok',
			  'msg' => $msg
		  );
		
	}
/******************************GET ISSUE**************************************/
    public function getIssueList(
      $filters = [],
      $orderby = ['order' => "", 'sort_by' => ""],
      $paging = ["page_num" => 1, "page_size" => 0]
    ) {
		
		$where ='';
		if(isset($filters['name']) && $filters['name']!=''){
			$like_this = $filters['name'];
			$where = " AND (iss.title like '%$like_this%'  OR p.title like '%$like_this%' OR ct.name like '%$like_this%' OR irt.name like '%$like_this%' OR it.name like '%$like_this%' OR prt.name like '%$like_this%' )";
		}
		$userid = $filters['userid'];
		
		$sql = "SELECT iss.id as issue_id,iss.title as issue_title,p.title as project_tilte , ct.name as cat_name  ,irt.name as resolution_name ,it.name as issue_type_name, prt.name as pirority_name
				FROM issues iss, projects p , categories ct, issue_resolution_types irt,issue_types it ,priorities prt
				WHERE p.id=iss.project_id
				AND ct.id = iss.category_id
				AND irt.id=iss.resolution_id
				AND it.id=iss.issue_type_id
				AND prt.id=iss.priority_id
				AND iss.created_by=$userid $where  ";
				
		 $result_set = $this->paginateNative($sql, $paging['page_size'], $paging['page_num']);
		 $result_set['code']  = 200;
		 $result_set['status'] ='ok';
		 return $result_set;
}

	/*GET issue detail by id*/
	public function getIssueById($id){
			$sql = "SELECT u.name as create_by,iss.parent_issue_id as parent_issue_id,iss.assigned_to as assigned_to , iss.id as issue_id,iss.title as issue_title,iss.description as description,iss.status as status,iss.est_time as est_time,p.id as project_id,p.title as project_tilte , ct.name as cat_name  ,ct.id as cat_id,irt.id as resolution_id,irt.name as resolution_name ,it.id as issue_type_id,it.name as issue_type_name,prt.id as priority_id, prt.name as pirority_name
				FROM issues iss, projects p , categories ct, issue_resolution_types irt,issue_types it ,priorities prt, users u
				WHERE p.id=iss.project_id
				AND ct.id = iss.category_id
				AND irt.id=iss.resolution_id
				AND it.id=iss.issue_type_id
				AND prt.id=iss.priority_id
				AND u.id=iss.created_by
				AND iss.id=$id";
			  try {
					$query = $this->db->executeNative($sql);
					return $query->fetchAll();
				}catch(\Exception $e){ return ['code'=>1000,'status'=>'error','msg'=> $e->getMessage(),];}
	}
	
	public function delete($id)
	{
		$sql_obj['dql'] = "UPDATE App\\Entities\\Projects p set p.status = 0 where p.id = :id";
		$sql_obj['values']['id'] = $id;
		$response = $this->db->runSQL($sql_obj['dql'], $sql_obj['values']);
		return $response;
	}
	public function getParentIssueLists($pid){
		
			$sql = "SELECT  iss.id as issue_id,iss.title as issue_title
			FROM issues iss
			WHERE iss.project_id= $pid";
		  try {
				$query = $this->db->executeNative($sql);
				$res ['rows']= $query->fetchAll();
				$res['code'] = 200;
				$res['status'] = 'ok';
				return $res;
			}catch(\Exception $e){ return ['code'=>1000,'status'=>'error','msg'=> $e->getMessage(),];}
	}

}
