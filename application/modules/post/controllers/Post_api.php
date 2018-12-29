<?php
/**
 * Created by PhpStorm.
 * User: bachnq
 * Date: 6/12/2018
 * Time: 5:10 PM
 */

class Post_api extends CI_Controller
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

    public function create()
    {
        if (!isset($this->session->token)) {
            return redirect(site_url('auth/login'));
        }

        $data = array(
            'title' => $this->input->post('title', true),
            'content' => $this->input->post('content', true),
            'excerpt' => $this->input->post('excerpt', true),
            'slug' => $this->input->post('slug'),
            'status' => $this->input->post('status'),
        );
        $category = $this->input->post('category');
        if ($data['title'] == '' || $data['content'] == '' || $data['excerpt'] == '' || $data['slug'] == '') {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'success' => 0
                )));
        }
        $config['upload_path'] = './uploads/feature/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1000;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('feature_img')) {
            $data['feature_img'] = site_url('uploads/default.jpg');
        } else {
            $upload = $this->upload->data();
            $data['feature_img'] = site_url('uploads/feature/') . $upload['file_name'];

        }
        $id = $this->posts->createPost($data);
        if (!$id) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'success' => 0
                )));
        }

        $post_cat = array(
            'postid' => $id,

        );
        $category = explode(',',$category);
        foreach ($category as $cat) {
            if ($cat == 0) {
                $post_cat['categoryid'] = 0;
                break;
            }
            $c = $this->category->getCategory($cat);
            if (isset($c)) {
                if ($c->status) {
                    $post_cat['categoryid'] = $c->id;
                }
                $this->post_cat->add($post_cat);
            }

        }


        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                'success' => $id
            )));
    }

    public
    function update($id)
    {
        if (!isset($this->session->token)) {
            return redirect(site_url('auth/login'));
        }
        $data = array(
            'title' => $this->input->post('title', true),
            'content' => $this->input->post('content', true),
            'excerpt' => $this->input->post('excerpt', true),
            'slug' => $this->input->post('slug'),
            'status' => $this->input->post('status')
        );

        $category = $this->input->post('category');
        if ($data['title'] == '' || $data['content'] == '' || $data['excerpt'] == '' || $data['slug'] == '') {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'success' => 0
                )));
        }
        $config['upload_path'] = './uploads/feature/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1000;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('feature_img')) {
            $upload = $this->upload->data();
            $data['feature_img'] = site_url('uploads/feature/') . $upload['file_name'];
        }
        $rs = $this->posts->updatePost($id, $data);
        $post_cat = array(
            'postid' => $id,

        );
        $category = explode(',',$category);
        foreach ($category as $cat) {
            if ($cat == 0) {
                $post_cat['categoryid'] = 0;
                break;
            }
            if ($this->post_cat->checkExist($id, $cat)) {
                continue;
            }
            $c = $this->category->getCategory($cat);
            if (isset($c)) {
                if ($c->status) {
                    $post_cat['categoryid'] = $c->id;
                }
                $this->post_cat->add($post_cat);
            }

        }
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                'success' => $id
            )));
    }

    public
    function delete()
    {
        if ($this->input->method() == 'post') {
            $id = $this->input->post('id');
            if (isset($id)) {
                $result = $this->posts->delete($id);
                if ($result) {
                    return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(200)
                        ->set_output(json_encode(array(
                            'success' => $result
                        )));
                } else {
                    return $this->output
                        ->set_content_type('application/json')
                        ->set_status_header(200)
                        ->set_output(json_encode(array(
                            'success' => 0
                        )));
                }

            }

        }
    }
}