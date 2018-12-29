<?php
/**
 * Created by PhpStorm.
 * User: bachnq
 * Date: 6/13/2018
 * Time: 8:22 AM
 */

class Category_model extends CI_Model
{
    private $table_name = 'categories';

    public function __construct()
    {
        parent::__construct();

    }

    public function getAllCategories()
    {
        $query = $this->db->get($this->table_name);
        return $query->result();
    }

    public function getAllActiveCategories($except = array())
    {
        $this->db->where( array('status' => 1));
        if(!empty($except)){
            $this->db->where_not_in('id',$except);
        }
        $query = $this->db->get($this->table_name);
        return $query->result();
    }

    public function getParents(){
        $this->db->where('parent',0);
        $this->db->where('status',1);
        $query = $this->db->get($this->table_name);
        return $query->result();
    }

    public function getChildren($parent){
        if($parent == 0) return false;
        $this->db->where('parent',$parent);
        $this->db->where('status',1);
        $query = $this->db->get($this->table_name);
        return $query->result();
    }

    public function getCategoryBySlug($slug = ''){
        $this->db->where('slug',$slug);
        $this->db->where('status',1);
        $query = $this->db->get($this->table_name);
        return $query->row();
    }

    public function getCategory($id)
    {
        $query = $this->db->get_where($this->table_name, array('id' => $id));
        return $query->row();
    }

    public function add($data)
    {
        if($this->check_value_exist('slug',$data['slug'])){
            return false;
        }
        $this->db->insert($this->table_name, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table_name, $data);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table_name);
        if (count($this->db->affected_rows())) {
            return $id;
        } else {
            return false;
        }
    }
    private function check_value_exist($field = '', $value = '')
    {
        $query = $this->db->get_where($this->table_name, array($field => $value));
        $result = $query->row();
        if (isset($result)) {
            return $result;
        } else {
            return false;
        }
    }
}