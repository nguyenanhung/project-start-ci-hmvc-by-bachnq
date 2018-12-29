<?php
/**
 * Created by PhpStorm.
 * User: bachnq
 * Date: 6/13/2018
 * Time: 8:21 AM
 */

class Category extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('auth/user_model', 'user');
        $this->load->model('post/post_model', 'posts');
        $this->load->model('category/category_model', 'category');
//        $this->load->model('cate/post_model', 'posts');
        $this->load->model('admin/setting_model', 'setting');
        $this->load->helper(array(
            'form',
            'url'
        ));
        $this->load->library(array(
            'session'
        ));
    }

    public function index()
    {

    }

    public function create()
    {
        if (!isset($this->session->token)) {
            return redirect(site_url('auth/login'));
        }
        $data['active'] = 'category';
        $data['sub'] = 'add_category';
        $data['action'] = 'Create';
        $data['categories'] = $this->category->getAllActiveCategories();
        $this->load->view('layouts/admin/main', $data);
    }
    public function update($id)
    {
        if (!isset($this->session->token)) {
            return redirect(site_url('auth/login'));
        }
        $data['active'] = 'category';
        $data['sub'] = 'add_category';
        $data['action'] = 'Update';
        $data['category'] = $this->category->getCategory($id);
        $data['categories'] = $this->category->getAllActiveCategories(array($id));
        if(!isset($data['category'])) {
            $error = array(
                'heading' => 'Not found',
                'message' => 'not found'
            );
            $this->load->view('errors/html/error_404',$error);
            return;
        }
        $this->load->view('layouts/admin/main', $data);
    }
}