<?php
/**
 * User: Farhan khalid
 * Date: 9/28/2015
 * Time: 8:51 PM
 */

namespace App\Repositories;

use LaravelDoctrine\ORM\Facades\EntityManager;
use LaravelDoctrine\ORM\Facades\Registry;
use Doctrine\ORM\Query;
use Log;

class Db
{

    private $pdo;
    private $statement;

    public function __construct()
    {
        $this->db_conn = Registry::getManager("default");
    }

    /**
     * Execute last prepared statement on phone database with values injected through key:value associative array
     * @param array $values
     */
    public function getConnection($conn_name = "db_conn")
    {
        return $this->$conn_name;
    }

    public function runSQL($dml_stmt = "", $values = null, $conn_name = "db_conn")
    {
        //$this->prepareSQL($dml_stmt,$conn_name);
        return $this->executeSQL($dml_stmt, $values,$conn_name);
    }

	public function prepareSQL($dml_stmt = "", $conn_name = "db_conn") {

	    if ($dml_stmt == "")
            throw new \InvalidArgumentException("SQL statement cannot be empty.");

		try{
			$this->pdo = $this->$conn_name->getConnection();
			$this->statement = $this->pdo->prepare($dml_stmt);

		} catch(\Exception $e){
			throw new \InvalidArgumentException("SQL statement cannot be prepared: ".$e->getMessage());
		}
    }

    private function executeSQL($dml_stmt, $values = null, $conn_name = "db_conn")
    {
        // if ($values == null) {
            // throw new \InvalidArgumentException("SQL parameters list cannot be Empty.");
        // }
		
		$dml_stmt = str_replace("\n", " ", $dml_stmt);
        try {
            $query = $this->$conn_name->createQuery($dml_stmt);
			if ($values != null){
				$query->setParameters($values);
			}
			
            $rows=$query->execute();
            $result['code'] = '200';
            $result['status'] = 'ok';
            $result['rows_effected'] = $rows;
            return $result;
        } catch (\Exception $e) {
            return [
                'code'=>1000,
                'status'=>'error',
                'msg'=>$e->getMessage()
            ];
        }
    }

    public function executeNative($dml_stmt, $conn_name = "db_conn"){

        try{
            $this->prepareSQL($dml_stmt, $conn_name);
            $this->statement->execute();
            return $this->statement;
        } catch(\Exception $e){
         	 return $e->getMessage();
	    }

    }

}
