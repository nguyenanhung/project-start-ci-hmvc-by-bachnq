<?php
/**
 * Created by PhpStorm.
 * User: bachnq
 * Date: 6/14/2018
 * Time: 3:33 PM
 */

class Setting_model extends CI_Model
{
    private $table_name = 'setting';

    public function __construct()
    {
        parent::__construct();

    }

    public function getAllSetting(){
        $query = $this->db->get($this->table_name);
        $result = $query->result();
        $setting = array();
        foreach ($result as $row){
            $setting[$row->name] = $row->value;
        }
        return $setting;
    }

    public function save($name,$data){
        if ($this->setting->check_value_exist('name', $name)) {
            $result = $this->setting->update($name, $data);
        } else {
            $result = $this->setting->add($data);
        }
        return $result;
    }

    public function add($data)
    {
        if($this->check_value_exist('name',$data['name'])){
            return false;
        }
        $this->db->insert($this->table_name, $data);
        return $this->db->insert_id();
    }

    public function update($name, $data)
    {
        $this->db->where('name', $name);
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
    public function check_value_exist($field = '', $value = '')
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