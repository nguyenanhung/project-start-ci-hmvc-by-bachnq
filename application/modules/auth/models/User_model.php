<?php
/**
 * Created by PhpStorm.
 * User: bachnq
 * Date: 6/12/2018
 * Time: 10:58 AM
 */

class User_model extends CI_Model
{
    private $table_name = 'user';
    private $id;
    private $username;
    private $password;
    private $fullname;
    private $email;
    private $token;
    private $created_at;
    private $modified_at;

    public function __construct()
    {
        parent::__construct();

    }

    private function check_value_exist($field = '', $value = '')
    {
        $query = $this->db->get_where($this->table_name, array($field => $value));
        $result = $query->row();
        if (isset($result)) {
            return $result;
        } else {
            return false;
        }
    }

    public function createUser($data)
    {
        if (!$this->check_value_exist('username', $data['username']) || !$this->check_value_exist('email', $data['email'])) {
            return false;
        }
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $this->db->insert($this->table_name, $data);
        return $this->db->insert_row();
    }

    public function login($data)
    {
        $user = $this->check_value_exist('username', $data['username']);
        if ($user) {
            if (password_verify($data['password'],$user->password)) {
                $token = $this->create_token($user->ID);
                return $token;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    private function create_token($id)
    {
        $header = json_encode(array('typ' => 'JWT', 'alg' => 'HS256'));
        $payload = json_encode(array('userid' => $id));
        $base64UrlHeader = str_replace(array('+', '/', '='), array('-', '_', ''), base64_encode($header));
        $base64UrlPayload = str_replace(array('+', '/', '='), array('-', '_', ''), base64_encode($payload));
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, 'bachnguyen', true);
        $base64UrlSignature = str_replace(array('+', '/', '='), array('-', '_', ''), base64_encode($signature));
        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
        return $jwt;
    }

    private function check_token($token){
        $user = $this->check_value_exist('token',$token);
        if($user){
            return $user;
        }else{
            return false;
        }
    }
}