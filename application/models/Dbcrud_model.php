<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author Kunduz Yazılım - Bertuğ Fahri ÖZER
 * @contact kunduzyazilim.com
 * Date: 06 - 07 - 2018
 */
class Dbcrud_model extends CI_Model
{
    public function lists($where = [], $table, $select = '*', $order = 'id')
    {
        return $this -> db -> select($select) -> where($where) -> order_by($order) -> get($table) -> result();
    }

    public function create($table, $data = [])
    {
        $this -> db -> insert($table, $data);
        return $this -> db -> insert_id();
    }

    public function edit($table, $data = [], $where = [])
    {
        return $this -> db -> update($table, $data, $where);
    }

    public function delete($table, $where = [])
    {
        return $this -> db -> delete($table, $where);
    }

    public function selectOne($where = [], $table, $select = '*')
    {
        return $this -> db -> select($select) -> where($where) -> get($table) -> row();

    }

    public function whereInCheckData($att, $where = [], $table)
    {
        return $this -> db -> where_in($att, $where) -> get($table) -> num_rows();

    }

    public function getWhere($table,$where)
    {
        return $this->db -> get_where($table, $where,1) -> num_rows();
    }

    public function count($table, $where = [])
    {
        return $this -> db -> where($where) -> count_all_results($table);
    }

    public function isHave($table, $data)
    {
        return $this -> db -> limit(1) -> get_where($table, $data) -> num_rows();
    }
}
