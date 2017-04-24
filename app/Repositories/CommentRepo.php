<?php

namespace App\Repositories;

use Doctrine\ORM\Query;
use LaravelDoctrine\ORM\Facades\EntityManager;
use App\Repositories\BaseRepo;
use App\Entities\Comments;
use App\Entities\Issues;
use App\Repositories\HistoryRepo;
class CommentRepo extends BaseRepo{

	public function addComment($data){
	
		$msg = "Successfully added";
	
		$comment = new Comments();
		if(isset($data['commentid']) and $data['commentid']!=''){
			$msg = "Successfully updated";
			$comment  = EntityManager::getRepository('App\Entities\Comments')->findOneBy(array('id'=>$data['commentid']));
		}
		
		$comment->setIssue($this->db->getConnection()->getReference('App\Entities\Issues',$data['issue_id']));
		$comment->setIsDeleted(0);
		$comment->setDetail($data['comment']);
		
		if(isset($data['commentid']) and $data['commentid']!=''){
			$comment->setUpdatedOn(new \DateTime());
			$comment->setUpdatedBy(isset($data['userid'])?$data['userid']:1);
		}else{
			$comment->setCreatedOn(new \DateTime());
			$comment->setCreatedBy(isset($data['userid'])?$data['userid']:1);
		}
		EntityManager::persist($comment);
		EntityManager::flush();
		
		/*History call*/
		$data['comment'] ="Comment has been added";
		if(isset($data['commentid']) and $data['commentid']!=''){
			$data['comment'] ="Comment has been updated";
		}
		$this->history 	= new HistoryRepo();
		$this->history->addHistory($data);
		/*End of History Call*/
		$comment_data = $this->getCommentByCoomentId($comment->getId());
		
		
		return array(
			  'code' 	=> '200',
			  'status' 	=> 'ok',
			  'msg' 	=> $msg,
			  'data'	=>	$comment_data[0]
		  );
	
	}
	
	public function getCommentById($id){
		$sql= 	"SELECT com.id,com.type_id,com.detail,com.is_deleted,com.created_by,com.created_on,com.updated_by,com.updated_on ,u.id as userid,u.name as username,u.email as user_email
				FROM comments com ,users u
				WHERE com.created_by= u.id and com.issue_id = $id and com.is_deleted!=1";
		$res =  $this->db->executeNative($sql);
		return $res->fetchAll();
	}
	
	public function getCommentByCoomentId($id){
		$sql= 	"SELECT com.id,com.type_id, com.issue_id, com.detail,com.is_deleted,com.created_by,com.created_on,com.updated_by,com.updated_on ,u.id as userid,u.name as username,u.email as user_email
				FROM comments com ,users u
				WHERE com.created_by= u.id and com.id = $id";
		$res =  $this->db->executeNative($sql);
		return $res->fetchAll();
	}
	public function deleteComment($data){
		
		$comment  = EntityManager::getRepository('App\Entities\Comments')->findOneBy(array('id'=>$data['commentid']));
		$comment->setIsDeleted(1);
		$comment->setUpdatedOn(new \DateTime());
		$comment->setUpdatedBy(isset($data['userid'])?$data['userid']:1);
		EntityManager::persist($comment);
		EntityManager::flush();
		
		$data['comment'] ="Comment has been deleted";
		$this->history 	= new HistoryRepo();
		$this->history->addHistory($data);
	}

}


