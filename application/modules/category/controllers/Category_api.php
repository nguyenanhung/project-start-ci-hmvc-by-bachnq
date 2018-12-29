<?php
/**
 * Created by PhpStorm.
 * User: bachnq
 * Date: 6/13/2018
 * Time: 8:22 AM
 */

class Category_api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('auth/user_model', 'user');
        $this->load->model('post/post_model', 'posts');
        $this->load->model('category/category_model', 'category');
//        $this->load->model('cate/post_model', 'posts');
        $this->load->helper(array(
            'form',
            'url'
        ));
        $this->load->library(array(
            'session'
        ));
    }

    public function create()
    {
        if (!isset($this->session->token)) {
            return redirect(site_url('auth/login'));
        }
        if ($this->input->method() != 'post') {
            return;
        }

        $data = array(
            'name' => $this->input->post('name', true),
            'slug' => $this->input->post('slug', true),
            'description' => $this->input->post('description', true),
            'parent' => $this->input->post('parent', true),
            'status' => $this->input->post('status', true)
        );
        if($data['name'] == '' || $data['slug'] ==''){
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('success' => 0)));
        }
        $id = $this->category->add($data);
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('success' => $id)));
    }
    public function update($id)
    {
        if (!isset($this->session->token)) {
            return redirect(site_url('auth/login'));
        }
        if ($this->input->method() != 'post') {
            return;
        }

        $data = array(
            'name' => $this->input->post('name', true),
            'slug' => $this->input->post('slug', true),
            'description' => $this->input->post('description', true),
            'parent' => $this->input->post('parent', true),
            'status' => $this->input->post('status', true)
        );
        if($data['name'] == '' || $data['slug'] ==''){
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('success' => 0)));
        }
         $this->category->update($id,$data);
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('success' => $id)));
    }

    public function delete(){
        if (!isset($this->session->token)) {
            return redirect(site_url('auth/login'));
        }
        if ($this->input->method() != 'post') {
            return;
        }
        $id = $this->input->post('id');
        $category = $this->category->getCategory($id);
        if(isset($category)){
            $result = $this->category->delete($id);
        }
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('success' => $result)));
    }

}