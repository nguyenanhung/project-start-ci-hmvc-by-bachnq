<?php
/**
 * Created by PhpStorm.
 * User: bachnq
 * Date: 6/12/2018
 * Time: 2:22 PM
 */

class Post_model extends CI_Model
{
    private $table_name = 'posts';
    public function __construct()
    {
        parent::__construct();

    }
    public function getAllPosts(){
        $query = $this->db->get($this->table_name);
        return $query->result();
    }

    public function getPost($id){
        $query = $this->db->get_where($this->table_name,array('id'=>$id));
        return $query->row();
    }

    public function createPost($data){
        $this->db->insert($this->table_name,$data);
        return $this->db->insert_id();
    }

    public function updatePost($id,$data){
        $this->db->where('id',$id);
        $this->db->update($this->table_name,$data);
        return $this->db->affected_rows();
    }

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete($this->table_name);
        if(count($this->db->affected_rows())){
            return $id;
        }
        else {
            return false;
        }
    }

    public function getRecentPosts($numpost){
        $this->db->where('status',1);
        $this->db->order_by('created_at','DES');
        $this->db->limit($numpost);
        $query = $this->db->get($this->table_name);
        return $query->result();
    }

    public function getPostBySlug($slug){
        $this->db->where('slug',$slug);
        $this->db->where('status',1);
        $query = $this->db->get($this->table_name);
        return $query->row();
    }

    public function getRandomPosts($limit){
        $this->db->where('status',1);
        $this->db->order_by('RAND()');
        $this->db->limit($limit);
        $query = $this->db->get($this->table_name);
        $result = $query->result();
        return $result;
    }


}