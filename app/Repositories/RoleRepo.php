<?php

#namespace BusinessLogic;
namespace App\Repositories;

use Doctrine\ORM\Query;
use LaravelDoctrine\ORM\Facades\EntityManager;
use App\Repositories\BaseRepo;
use App\Entities\Users;
use Validator;


class RoleRepo extends BaseRepo{

	public function getRoles()
	{
		$query = $this->db->getConnection('db_conn')->createQuery("SELECT PARTIAL role.{id, role, createdOn, updatedOn, deletedOn}
                                                    FROM App\\Entities\\Roles role
			 ");
			
		try {
			$res =  $query->getResult(Query::HYDRATE_ARRAY);
			
			return $res;
		} catch (\Doctrine\ORM\NoResultException $e) {
			Log::error();
			return ['code' => 1000, 'status' => 'cancel', 'msg' => 'error while in getRoles'];
		}
	}
}
