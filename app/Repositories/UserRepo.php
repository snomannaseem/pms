<?php

#namespace BusinessLogic;
namespace App\Repositories;

use Doctrine\ORM\Query;
use LaravelDoctrine\ORM\Facades\EntityManager;
use App\Repositories\BaseRepo;
use App\Entities\Users;


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

		$dsql = 'SELECT PARTIAL user.{id, name, email, password, desigId, status}
                                                    FROM App\\Entities\\Users user';

        $where_field_map = [
          "userid" => [true, " user.userid = :userid "],
          "name" => [true, " user.name like CONCAT('%',:name,'%') "],
          
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

        $query = $this->db->getConnection('db_conn')->createQuery("SELECT PARTIAL user.{id, name, email, password, desigId, status}
                                                    FROM App\\Entities\\Users user
        WHERE user.id =:id ")->setParameter('id', $id);

        try {
            return $query->getSingleResult(Query::HYDRATE_OBJECT);
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
	
	public function save(\App\Entities\Users $user)
	{
		$this->db->getConnection()->persist($user);
		$this->db->getConnection()->flush();
	}
	/*
    public function updateField($fields_values = [])
    {

        if (empty($fields_values['userid']) || empty($fields_values['field'])) {
            return [
              'code' => '1000',
              'status' => 'error',
              'msg' => "userid or field missing."
            ];
        }

        $dql_obj['dql'] = "update BusinessObject\AdcenterProfiles p set p." . $fields_values['field'] . " = :value where p.userid = :userid ";
        $dql_obj['values']['userid'] = $fields_values['userid'];
        $dql_obj['values']['value'] = $fields_values['value'];
        $this->db->runSQL($dql_obj['dql'], $dql_obj['values']);

        return [
          'code' => '200',
          'status' => 'ok',
          'msg' => "Profile updated successfully."
        ];
    }


    public function convertUserToStaff($params)
    {
        $dsql = 'SELECT PARTIAL user.{username, userid, email,  firstname, lastname, telephone, telephone_ext, status, email_verify_status, publish_status, create_timestamp, city, state, staff_account_flag}

                                                    FROM BusinessObject\\AdcenterProfiles user
                                                    WHERE user.userid = :userid
                                                    ';
        $sql_obj = ["dql" => $dsql, "values" => ['userid' => $params['userid']]];
        $resultSet = $this->getRows($sql_obj);
        $profile = $resultSet['rows'][0];
        $email = $profile->getEmail();
        $dsql = 'SELECT PARTIAL staff.{email, staffid, firstname, lastname  }

                                                    FROM BusinessObject\\AdcenterStaff staff
                                                    WHERE staff.email = :email
                                                    ';
        $sql_obj = ["dql" => $dsql, "values" => ['email' => $email]];
        $resultSet2 = $this->getRows($sql_obj);
        //dd($resultSet2['rows']);
        if (count($resultSet2['rows']) == 0) {
            // No Record in adcenter_staff table so please insert one
            $staff = new \BusinessObject\AdcenterStaff();
            $staff->setFirstname($profile->getFirstname());
            $staff->setLastname($profile->getLastname());
            $staff->setEmail($profile->getEmail());
            $staff->setTelephone($profile->getTelephone());
            $staff->setTelephoneExt($profile->getTelephoneExt());
            $this->db->getConnection()->persist($staff);
            $this->db->getConnection()->flush();

            $image_name = env('CDN_URL')."/images/no-image.png";
            $image_name_chk =  $_SERVER['DOCUMENT_ROOT'].'/staff_pics/staffpic-'.$staff->getStaffId().'.png';
            if(!file_exists($image_name_chk)) {
                copy(env('CDN_URL')."/images/no-image.png", $_SERVER['DOCUMENT_ROOT']."/staff_pics/staffpic-".$staff->getStaffId().".png");
                $file_data = new FileDataServiceProvider();
                $upd_response = $file_data->updateContent('staffpic', "staffpic-".$staff->getStaffId().".png", "",
                  'STAFF_IMAGE_UPLOAD_PATH');
            }


        }

        // Update Record in adcenter_profile table
        $profile->setStaffAccountFlag(1);
        $this->db->getConnection()->persist($profile);
        $this->db->getConnection()->flush();
        return [
            'code' => 200,
            'status' => 'ok',
            'msg' => 'Record Updated successfully'
        ];
    }


    public function getUserSearchList($filters)
    {
        $filters['username']=str_replace('_', '\_', $filters['username']);
        try {
            $sql_obj['dql'] = "SELECT PARTIAL user.{username, userid, firstname, lastname} FROM BusinessObject\\AdcenterProfiles user
                          WHERE user.username like CONCAT('%',:username,'%') or concat( user.firstname,' ', user.lastname) like CONCAT('%',:username,'%')";
            $sql_obj['values'] = $filters;
            $resultSet = $this->getRows($sql_obj, ['sort_by' => "", 'order' => ""],
              ["page_num" => 1, "page_size" => 0]);
            return $resultSet['rows'];
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

    }

    public function getRecentUsers($userid)
    {
        $sql_obj['dql'] = "SELECT user.userid, user.username, user.firstname,user.lastname FROM BusinessObject\\AdcenterRecentUsers ru
                           inner join ru.adcenter_profiles_related_by_searched_id user
                           WHERE ru.userid=:userid order by ru.id desc ";
        $sql_obj['values'] = ["userid" => $userid];
        $resultSet = $this->getRows($sql_obj);
        return $resultSet;
    }

    public function createRecentUser($userid, $searched_id)
    {
        try {
            $sql_obj['dql'] = "delete FROM BusinessObject\\AdcenterRecentUsers user
                           WHERE user.userid=:userid and user.searched_id=:searched_id";
            $sql_obj['values'] = [
              "userid" => $userid,
              "searched_id" => $searched_id
            ];
            $check_user = $this->getRows($sql_obj);


            $searched_user = $this->db->getConnection()->getReference('BusinessObject\\AdcenterProfiles',$searched_id);
            $user = $this->db->getConnection()->getReference('BusinessObject\\AdcenterProfiles', $userid);
            $recent_user = new \BusinessObject\AdcenterRecentUsers();
            $recent_user->setAdcenterProfilesRelatedByUserid($user);
            $recent_user->setAdcenterProfilesRelatedBySearchedId($searched_user);
            $this->db->getConnection()->persist($recent_user);
            $this->db->getConnection()->flush();



            return [
                'code'=>200,
                'msg'=>'Recent user added'
            ];
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return [
              'code'=>1000,
              'msg'=>'An error occured while adding recent user'
            ];

        }

    }

    public function validateUserId($user_id)
    {
        $messages = [
            'userid.required' => 'We need to know your Userid!'
        ];
        $validator = \Validator::make(['userid' => $user_id], [
            'userid' => 'required'

        ], $messages);

        if ($validator->fails()) {
            $err = "<ul>";
            foreach ($validator->getMessageBag()->toArray() as $error) {
                foreach ($error as $msg) {
                    $err .= "<li>$msg</li>";
                }
            }
            $err .= "</ul>";
            return array(
                'code' => 1000,
                'status' => 'error',
                'msg' => $err
            );
        } else {
            return array(
                'code' => 200,
                'status' => 'ok',
            );

        }
    }

    public function  sendVerificationEmail($userid)
    {
        $udsp = new \BusinessLogic\UserDetailsServiceProvider();
        $response = $udsp->getProfileFields($userid, ['username','password', 'firstname', 'lastname', 'email_verify_string']);
        if($response['code'] == 200)
        {
            $response['rows']['verifycode'] = $response['rows']['email_verify_string']; // template uses verifycode variable
            $response['rows']['from'] = "support@ezanga.com";
            $response['rows']['to'] = $response['rows']['username'];
            $response['rows']['SERVER_PATH'] = env('UI_URL','');
            $response['rows']['subject'] = "eZanga - New Account Verification";
            $res = Helper::sendEmail($response['rows'], ['email_templates/signup_html', 'email_templates/signup_text']);
            if($res['code'] == 200)
                return ['code' => 200, 'msg' => 'Email Sent.', 'status' => 'ok'];
            else
                return ['code' => 1000, 'msg' => 'Email Not Sent.', 'status' => 'cancel'];
        }
        return $response;
    }
	
	*/
}
