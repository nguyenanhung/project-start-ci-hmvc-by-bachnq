<?php
/**
 * Created by PhpStorm.
 * User: bachnq
 * Date: 6/12/2018
 * Time: 2:14 PM
 */

class Post extends CI_Controller
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

    public function create()
    {
        $data['active'] = 'post';
        if (!isset($this->session->token)) {
            return redirect(site_url('auth/login'));
        }
        $data['sub'] = 'add_post';
        $data['action'] = 'Create';
        $data['categories'] = $this->category->getAllActiveCategories();
        $this->load->view('layouts/admin/main', $data);
    }

    public function update($id)
    {
        $data['active'] = 'post';
        if (!isset($this->session->token)) {
            return redirect(site_url('auth/login'));
        }
        $post = $this->posts->getPost($id);
        $post_cats = $this->post_cat->getPostCategories($id);
        $data['sub'] = 'add_post';
        $data['action'] = 'Update';
        $data['post'] = $post;
        if (!isset($data['post'])) {
            $error = array(
                'heading' => 'Not found',
                'message' => 'not found'
            );
            $this->load->view('errors/html/error_404', $error);
            return;
        }
        $data['categories'] = $this->category->getAllActiveCategories();
        $checked = array();
        foreach ($post_cats as $postcat) {
            $checked[] = $postcat->categoryid;
        }
        $data['checked'] = $checked;
        $this->load->view('layouts/admin/main', $data);


    }

    public function category($slug)
    {
        $setting = $this->setting->getAllSetting();
        if (!isset($setting['num_post_per_page'])) {
            $setting['num_per_page'] = 10;
        }
        $slug = '/' . $slug;
        $category = $this->category->getCategoryBySlug($slug);
        if (!isset($category)) {
            $data['heading'] = 'Page Not Found ';
            $data['message'] = $slug;
            $this->load->view('errors/html/error_404', $data);
            return 0;
        }
        $page = $this->input->get('p', true);
        if ($page != '' && !is_numeric($page)) {
            $data['heading'] = 'Page Not Found ';
            $data['message'] = $slug;
            $this->load->view('errors/html/error_404', $data);
            return 0;
        }
        if (isset($page)) {
            $offset = intval($page) * $setting['num_post_per_page']-1;
        } else {
            $offset = '';
            $page = 1;
        }

        $posts = $this->post_cat->getPostsInCategory($category->id, $setting['num_post_per_page'], $offset);
        $numposts = $this->post_cat->getNumberPostInCategory($category->id);
        $data['number_page'] = intval($numposts / $setting['num_post_per_page']) <=  1 ? 1: intval($numposts / $setting['num_post_per_page'])+1  ;
        $data['setting'] = $setting;
        $data['recentPosts'] = $this->posts->getRecentPosts(isset($setting['recent_post']) ? $setting['recent_post'] : 10);
        $data['posts'] = $posts;
        $data['category'] = $category;
        $data['current_page'] = intval($page);
        $data['categories'] = $this->category->getParents();
        $data['sub'] = 'archive';
        $this->load->view('layouts/website/main', $data);

    }

    public function singlePost($slug)
    {
        $slug = trim($slug);
        $post = $this->posts->getPostBySlug($slug);
        if (!isset($post)) {
            $data['heading'] = 'Page Not Found ';
            $data['message'] = $post;
            $this->load->view('errors/html/error_404', $data);
            return 0;
        }
        $data['setting'] = $this->setting->getAllSetting();
        $data['recentPosts'] = $this->posts->getRecentPosts(10);
        $data['categories'] = $this->category->getParents();
        $data['post'] = $post;
        $data['sub'] = 'single-post';
        $this->load->view('layouts/website/main', $data);
    }


}