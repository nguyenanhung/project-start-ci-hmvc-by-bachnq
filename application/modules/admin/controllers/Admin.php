<?php
/**
 * Created by PhpStorm.
 * User: bachnq
 * Date: 6/12/2018
 * Time: 8:52 AM
 */

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('auth/user_model','user');
        $this->load->model('post/post_model', 'posts');
        $this->load->model('category/category_model', 'category');
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
        if(!isset($this->session->token)){
            return redirect(site_url('auth/login'));
        }
        $data['active'] = 'dashboard';
        $data['sub'] = 'dashboard';
        $this->load->view('layouts/admin/main',$data);
    }

    public function post(){
        if (!isset($this->session->token)) {
            return redirect(site_url('auth/login'));
        }
        $data['active'] = 'post';
        $data['posts'] = $this->posts->getAllPosts();
        $data['sub'] = 'post/admin_posts';
        $this->load->view('layouts/admin/main', $data);
    }

    public function category(){
        if (!isset($this->session->token)) {
            return redirect(site_url('auth/login'));
        }
        $data['active'] = 'category';
        $data['categories'] = $this->category->getAllCategories();
        $data['sub'] = 'category/admin_categories';
        $this->load->view('layouts/admin/main', $data);
    }
}