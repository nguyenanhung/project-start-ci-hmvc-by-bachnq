<?php
/**
 * Created by PhpStorm.
 * User: bachnq
 * Date: 6/12/2018
 * Time: 10:53 AM
 */

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array(
            'form',
            'url'
        ));
        $this->load->library('session');
    }

    public function index(){

    }

    public function login(){
        $data['sub'] = 'auth/login';
        $this->load->view('auth/login',$data);
    }


}