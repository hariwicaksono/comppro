<?php
/**
 * Created by Mojtaba Khodakhah.
 * Date: 17-May-19
 * Time: 9:24 AM
 * Project: NodCMS
 * Website: http://www.nodcms.com
 */

defined('BASEPATH') OR exit('No direct script access allowed');
class Users_model extends NodCMS_Model
{
    function __construct()
    {
        $table_name = "users";
        $primary_key = "user_id";
        $fields = array(
            'user_id'=>"int(10) unsigned NOT NULL AUTO_INCREMENT",
            'username'=>"varchar(50) DEFAULT NULL",
            'password'=>"varchar(50) DEFAULT NULL",
            'fullname'=>"varchar(255) DEFAULT NULL",
            'firstname'=>"varchar(255) DEFAULT NULL",
            'lastname'=>"varchar(255) DEFAULT NULL",
            'email'=>"varchar(50) DEFAULT NULL",
            'group_id'=>"tinyint(3) DEFAULT NULL",
            'created_date'=>"int(11) unsigned NOT NULL DEFAULT '0'",
            'reset_pass_exp'=>"int(11) unsigned NOT NULL DEFAULT '0'",
            'status'=>"int(1) unsigned NOT NULL DEFAULT '0'",
            'active_register'=>"int(1) unsigned NOT NULL DEFAULT '0'",
            'active'=>"int(1) unsigned NOT NULL DEFAULT '0'",
            'active_code'=>"varchar(255) DEFAULT NULL",
            'active_code_expired'=>"int(10) DEFAULT NULL",
            'user_unique_key'=>"varchar(255) DEFAULT NULL",
            'avatar'=>"varchar(255) DEFAULT NULL",
            'mobile'=>"varchar(20) DEFAULT NULL",
            'facebook'=>"varchar(255) DEFAULT NULL",
            'google_plus'=>"varchar(255) DEFAULT NULL",
            'linkedin'=>"varchar(255) DEFAULT NULL",
            'website'=>"varchar(255) DEFAULT NULL",
            'contact_email'=>"varchar(255) DEFAULT NULL",
            'user_agent'=>"text",
            'keep_me_time'=>"int(11) unsigned NOT NULL DEFAULT '0'",
            'language_id'=>"int(11) unsigned NOT NULL DEFAULT '1'",
        );
        $foreign_tables = null;
        $translation_fields = null;
        parent::__construct($table_name, $primary_key, $fields, $foreign_tables, $translation_fields);
    }

    /**
     * Generate unique code for user accounts
     *
     * @return string
     */
    public function generateUniqueKey()
    {
        $unique_key = md5(time()+rand(100000,999999));
        while ($this->getCount(array("user_unique_key"=>$unique_key))!=0){
            $unique_key = md5(time()+rand(100000,999999));
        }
        return $unique_key;
    }

    /**
     * Some filter on create user account
     *
     * @param $data
     */
    public function add($data)
    {
        $default_data = array(
            "user_unique_key"=>$this->generateUniqueKey(),
            "firstname"=>"",
            "lastname"=>"",
            "email"=>"",
            "username"=>"",
            "password"=>"",
            "group_id"=>20,
            "active_register"=>0,
            "active"=>1,
            "status"=>0
        );

        $data = array_merge($default_data, $data);

        if(!key_exists('fullname', $data)) {
            $data['fullname'] = "$data[firstname] $data[lastname]";
        }

        $data['password'] = md5($data['password']);

        parent::add($data);
    }

    /**
     * Set some filter before update an user account
     *
     * @param int $id
     * @param array $data
     */
    public function edit($id, $data)
    {
        $_data = $this->getOne($id);
        if(!is_array($_data) || count($_data) == 0) {
            return;
        }
        $data = array_merge(array(
            'firstname'=>$_data['firstname'],
            'lastname'=>$_data['lastname'],
        ), $data);

        if(!key_exists('fullname', $_data)) {
            $data['fullname'] = "$data[firstname] $data[lastname]";
        }

        if(key_exists('password', $_data)) {
            $data['password'] = md5($data['password']);
        }

        parent::edit($id, $data);
    }
}