<?php

namespace App\Repositories;

use Doctrine\ORM\Query;
use LaravelDoctrine\ORM\Facades\EntityManager;
use App\Repositories\BaseRepo;
use App\Entities\History;

class HistoryRepo extends BaseRepo{

	public function addHistory($data){
		$history = new History();
		$history->setIssue($this->db->getConnection()->getReference('App\Entities\Issues',$data['issue_id']));
		$history->setComment($data['comment']);
		$history->setCreatedOn(new \DateTime());
		$history->setCreatedBy(isset($data['userid'])?$data['userid']:1);
		EntityManager::persist($history);
		EntityManager::flush();
		return array("code"=>200,'status'=>"ok","msg"=>"History created successfully");
	}	
	
	public function getHistory($data){
	
	$issue_id = $data['issue_id'];
	
		$sql = "SELECT his.id, his.comment,his.created_on,u.name as username  FROM history his, users u  WHERE his.issue_id=$issue_id and u.id=his.created_by order by his.created_on desc ";
		  try {
				$query = $this->db->executeNative($sql);
				$res ['rows']= $query->fetchAll();
				$res['code'] = 200;
				$res['status'] = 'ok';
				return $res;
			}catch(\Exception $e){ return ['code'=>1000,'status'=>'error','msg'=> $e->getMessage(),];}

	}
	
}


