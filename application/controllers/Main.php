<?php
/**
 * Created by PhpStorm.
 * User: bachnq
 * Date: 6/13/2018
 * Time: 1:34 PM
 */

class Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('auth/user_model', 'auth');
        $this->load->model('post/post_model', 'posts');
        $this->load->model('category/category_model', 'category');
        $this->load->model('category/post_category_model', 'post_cat');
        $this->load->model('admin/setting_model', 'setting');
        $this->load->helper(array(
            'form',
            'url'
        ));
        $this->load->library(array(
            'session'
        ));
    }
    public function index(){
        $data['random_posts'] = $this->posts->getRandomPosts(8);
        $data['setting'] = $this->setting->getAllSetting();
        $data['recentPosts'] = $this->posts->getRecentPosts(10);
        $data['categories'] = $this->category->getParents();
        $data['sub'] = 'homepage';
        $this->load->view('layouts/website/main',$data);
    }



}