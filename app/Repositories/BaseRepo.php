<?php

namespace App\Repositories;

use ArrayIterator;
use Doctrine\ORM\Tools\Pagination\Paginator;
use App\Repositories\Db;
use Doctrine\ORM\Query;

abstract class BaseRepo
{
    protected $db_conn;
    protected $phone_db;
    protected $statement;
    protected $db;

    public function __construct()
    {
        $this->db = new Db();
    }

    public function paginate($query, $page_size = 10, $page_num = 1, $fetch_join_collection = false)
    {

        $paginator = new Paginator($query, false);//$fetch_join_collection);

        $paginator
          ->getQuery()
          ->setFirstResult($page_size * ($page_num - 1))// set the offset
          ->setMaxResults($page_size); // set the limit

        $total_rows = count($paginator);
        $pages_count = ceil($total_rows / $page_size);

        //dd($paginator->getIterator());

        return array(
          "object_array" => $paginator->getIterator(),
          "page_size" => $page_size,
          "page_num" => $page_num,
          "total_rows" => $total_rows,
          "pages_count" => $pages_count
        );
    }

    public function getRows(
        $sql_obj,
        $orderby = ['sort_by' => "", 'order' => ""],
        $paging = ["page_num" => 1, "page_size" => 0],
        $fetch_join_collection = false,
        $res_type = QUERY::HYDRATE_OBJECT
    ) {

        //$paging["page_size"] = 0;

        if (!isset($sql_obj['conn_name'])) {
            $sql_obj['conn_name'] = 'db_conn';
        }
        $conn_name = $sql_obj['conn_name'];
        //print_r($sql_obj["values"]);
        //dd($sql_obj["dql"]);
        $query = $this->db->getConnection($conn_name)->createQuery($sql_obj["dql"]);

        if (isset($sql_obj["values"])) {
            $query->setParameters($sql_obj["values"]);
        }

        if (isset($sql_obj["max_results"])) {
            $query->setMaxResults($sql_obj["max_results"]);
        }

        $query->setHint(Query::HINT_FORCE_PARTIAL_LOAD, true);

        if ($paging['page_size'] == 0) {
            return array(
              "rows" => $query->getResult($res_type),
              "page_size" => $paging['page_size'],
              "page_num" => $paging['page_num'],
              "total_rows" => 0,
              "pages_count" => 1
            );
        }
        //dd($paging);
        return $this->paginate($query, $paging['page_size'], $paging['page_num'], $fetch_join_collection);

    }

    public function paginateNative($sql, $page_size = 10, $page_num = 1, $conn_name = "db_conn")
    {
        $query=$this->db->executeNative($sql, $conn_name);
        $total_rows = $query->rowCount();
        $sql .= " LIMIT " . ($page_size * ($page_num - 1)) . ", $page_size";
        $query=$this->db->executeNative($sql, $conn_name);
        $result = $query->fetchAll();
        $pages_count = ceil($total_rows / $page_size);

        return array(
          "rows" => $result,
          "page_size" => $page_size,
          "page_num" => $page_num,
          "total_rows" => $total_rows,
          "pages_count" => $pages_count
        );
    }


    public function csv($title_array = array(), $args = array())
    {
        $user_simple_array = array();
        $user_simple_array[] = $title_array;
        $user_result_set = $this->getListAdminPage($args['filters'], $args['order_by'], $args['paging']);

        $user_object_array = $user_result_set['rows'];
        //dd($user_object_array);
        foreach ($user_object_array['object_array'] as $key => $profile_staff_object) {
            //dd($profile_staff_object);
            $user_simple_array[] = Helper::getProfileArrayForCsv($profile_staff_object);


        }
        $filename = isset($args['filename']) ? $args['filename'] : "export";
        //dd($user_simple_array);
        header('Content-Disposition: attachment; filename="'.$filename.'.csv"');
        //header("Cache-control: private");
        header("Content-type: csv");
        //header("Content-transfer-encoding: binary\n");

        $out = fopen('php://output', 'w');
        //fputcsv($out, $title_array);
        foreach ($user_simple_array as $simple_array) {
            fputcsv($out, $simple_array);
        }
        fclose($out);

        //exit;

    }

    // /**
    // * Prepare insert, and update statement for phone database with placeholder at value injection points.
    // * @param string $dml_stmt
    // * @throws InvalidArgumentException
    // */

    public static function getWhereClause($filters = [], $field_map = [])
    {


        $clause = array();
        $values = array();
        if (isset($field_map['default'])) {
            $clause[] = $field_map['default'][1];
        }
        foreach ($filters as $field => $value) {
            if ($value != "") {
                $field = strtolower($field);
                if (isset($field_map[$field])) {
                    $clause[] = $field_map[$field][1];
                    if ($field_map[$field][0]) {
                        $values[$field] = $value;
                    }
                }
            }
        }

        // if only a single invalid field is defined in filter then
        if (count($clause) == 0) {
            return [
              "where_clause" => "",
              "values" => []
            ];
        }

        return [
          "where_clause" => " WHERE " . implode(' AND ', $clause),
          "values" => $values
        ];
    }

    public static function getOrderClause($order_by = ['sort_by' => '', 'order' => ''], $field_map = [])
    {

        $sort_by = strtolower(trim($order_by['sort_by']));
        $order = strtoupper(trim($order_by['order']));

        // Return if there is no order by parameter.
        if (empty($sort_by)) {
            return "";
        }
        if (!in_array($order, ['ASC', 'DESC'])) {
            $order = "ASC";
        }

        return " ORDER BY " . str_replace('__order__', $order, $field_map[$sort_by]);
    }
}