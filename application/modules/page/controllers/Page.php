<?php
/**
 * Created by PhpStorm.
 * User: bachnq
 * Date: 6/13/2018
 * Time: 1:34 PM
 */

class Page extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('auth/user_model', 'auth');
        $this->load->model('post/post_model', 'posts');
        $this->load->model('category/category_model', 'category');
        $this->load->model('category/post_category_model', 'post_cat');
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

    public function contact()
    {
        $data['sub'] = 'page/contact';
        $this->load->view('layouts/website/main',$data);
    }

    public function about(){
        $data['sub'] = 'page/about';
        $this->load->view('layouts/website/main',$data);
    }


}