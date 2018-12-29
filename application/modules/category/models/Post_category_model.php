<?php
/**
 * Created by PhpStorm.
 * User: bachnq
 * Date: 6/13/2018
 * Time: 8:24 AM
 */

class Post_category_model extends CI_Model
{
    private $table_name = 'post_categories';

    public function __construct()
    {
        parent::__construct();

    }

    public function getPostCategories($postid)
    {
        $where = array(
            'postid' => $postid,

        );
        $query = $this->db->get_where($this->table_name, $where);
        return $query->result();
    }

    public function checkExist($postid, $catid)
    {
        $where = array(
            'postid' => $postid,
            'categoryid' => $catid

        );
        $query = $this->db->get_where($this->table_name, $where);
        $result = $query->row();
        if (isset($result)) return true;
        else return false;
    }

    public function getPostsInCategory($category, $limit = '',$offset='')
    {

        $this->db->select('posts.*,categories.name,categories.slug as cat_slug');
        if ($limit != '') {
            if($offset != ''){
                $this->db->limit($limit,$offset);
            }
            $this->db->limit($limit);
        }
        $this->db->join('posts', 'posts.id = post_categories.postid');
        $this->db->join('categories', 'post_categories.categoryid = categories.id');
        $where = array(
            'post_categories.categoryid' => $category,
            'posts.status' => 1
        );
        $this->db->where($where);
        $this->db->order_by('posts.created_at', 'DESC');
        $query = $this->db->get($this->table_name);
        $result = $query->result();
        if (count($result) == 0) return false;
        else return $result;
    }

    public function getNumberPostInCategory($catid){
        $this->db->select('posts.*');
        $this->db->join('posts', 'posts.id = post_categories.postid');
        $where = array(
            'post_categories.categoryid' => $catid,
            'posts.status' => 1
        );
        $this->db->where($where);
        $query = $this->db->get($this->table_name);
        $result = $query->result();
        return count($result);
    }

    public function add($data)
    {
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
}