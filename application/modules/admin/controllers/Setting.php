<?php
/**
 * Created by PhpStorm.
 * User: bachnq
 * Date: 6/14/2018
 * Time: 3:36 PM
 */

class Setting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('auth/user_model', 'user');
        $this->load->model('post/post_model', 'posts');
        $this->load->model('admin/setting_model', 'setting');
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
        if (!isset($this->session->token)) {
            return redirect(site_url('auth/login'));
        }
        $data['categories'] = $this->category->getAllActiveCategories();
        $data['setting'] = $this->setting->getAllSetting();
        $data['sub'] = 'setting';
        $data['active'] = 'setting';
        $this->load->view('layouts/admin/main', $data);
    }

    public function save()
    {
        if (!isset($this->session->token)) {
            return redirect(site_url('auth/login'));
        }
        if ($this->input->method() == 'post') {
            $type = $this->input->get_post('type', true);
            switch ($type) {
                case 'gen':
                    $this->save_gen();
                    break;
                case 'post' :
                    $this->save_post();
                    break;
                case 'homepage' :
                    $this->save_homepage();
                    break;
                case 'category' :
                    $this->save_category();
                    break;

            }
        }
    }

    private function save_homepage()
    {
        $data = array(
            'type' => 'homepage'
        );
        $home = $this->input->get_post('home[]', true);
        if (isset($home) && is_array($home) && !empty($home)) {
            $home = implode(',', $home);
            $data['name'] = 'cat_in_home';
            $data['value'] = $home;
            if ($this->setting->check_value_exist('name', $data['name'])) {
                $result = $this->setting->update($data['name'], $data);
            } else {
                $result = $this->setting->add($data);
            }
        }
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                'success' => $result
            )));

    }

    private function save_category()
    {
        $data = array(
            'type' => 'category'
        );
        $home = $this->input->get_post('menu[]', true);
        if (isset($home) && is_array($home) && !empty($home)) {
            $home = implode(',', $home);
            $data['name'] = 'cat_in_menu';
            $data['value'] = $home;
            if ($this->setting->check_value_exist('name', $data['name'])) {
                $result = $this->setting->update($data['name'], $data);
            } else {
                $result = $this->setting->add($data);
            }
        }
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                'success' => $result
            )));


    }

    private function save_post()
    {
        $data = array(
            'type' => $this->input->get_post('type', true),
        );
        $result = 0;
        $recent = $this->input->get_post('recent', true);
        if (isset($recent) && $recent != '') {
            $data['name'] = 'recent_post';
            if (intval($recent) == 0) {
                $data['value'] = 10;
            } else {
                $data['value'] = intval($recent);
            }
            if ($this->setting->check_value_exist('name', $data['name'])) {
                $result = $this->setting->update($data['name'], $data);
            } else {
                $result = $this->setting->add($data);
            }
        }
        $numpost = $this->input->get_post('numpost', true);
        if (isset($recent) && $recent != '') {
            $data['name'] = 'num_post_per_page';
            if (intval($numpost) == 0) {
                $data['value'] = 10;
            } else {
                $data['value'] = intval($numpost);
            }
            if ($this->setting->check_value_exist('name', $data['name'])) {
                $result = $this->setting->update($data['name'], $data);
            } else {
                $result = $this->setting->add($data);
            }
        }
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                'success' => $result
            )));

    }

    private function save_gen()
    {
        $siteName = $this->input->get_post('site-name', true);
        $data = array(
            'type' => 'gen',
            'name' => 'site_name',);
        if ($siteName != '') {
            $data['value'] = $siteName;
        } else {
            $data['value'] = 'Bach Nguyen';
        }
        $result = $this->setting->save($data['name'], $data);

        $tagline = $this->input->get_post('tagline', true);
        if (isset($tagline) && $tagline != '') {
            $data['name'] = 'tagline';
            $data['value'] = $tagline;
            $result = $this->setting->save($data['name'], $data);
        }
        $config['upload_path'] = './uploads/logo/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1000;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('logo')) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                    'success' => 0
                )));
        } else {
            $upload = $this->upload->data();
            $data = array(
                'type' => $this->input->get_post('type'),
                'name' => 'logo_url',
                'value' => site_url('uploads/logo/') . $upload['file_name']
            );
            $result = $this->setting->save($data['name'], $data);
        }
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                'success' => $result
            )));
    }
}