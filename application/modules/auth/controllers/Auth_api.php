<?php
/**
 * Created by PhpStorm.
 * User: bachnq
 * Date: 6/12/2018
 * Time: 11:25 AM
 */

class Auth_api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('user_model', 'auth');
        $this->load->helper(array(
            'form',
            'url'
        ));
        $this->load->library('session');
    }

    public function register()
    {
        if ($this->input->method() != 'post') {
            return;
        }
        $data = array(
            'username' => $this->input->post('username',true),
            'password' => $this->input->post('password',true),
            'fullname' => $this->input->post('fullname',true),
            'email' => $this->input->post('email',true),
        );
        $user = $this->auth->createUser($data);
        if($user){
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('token' => $user->token)));
        }else{
            return false;
        }
    }

    public function login(){
        if ($this->input->method() != 'post') {
            return;
        }
        $data = array(
            'username' => $this->input->post('username',true),
            'password' => $this->input->post('password',true),
        );
        $token = $this->auth->login($data);
        if($token){
            $this->session->token = $token;
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('token' => $token)));
        }else{
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('token' => $token)));
        }
    }
}