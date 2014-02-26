<?php

class Vanilla extends CComponent
{
    private $_token;
    private $_method;
    private $_domain;

    public function init()
    {
        $this->_token  = Yii::app()->params['vanilla_api_token'];
        $this->_method = Yii::app()->params['vanilla_api_method'];
        $this->_domain = Yii::app()->params['vanilla_api_domain'];
    }

    public function usersMultiByUserID($id)
    {
        $data = $this->request('users','multi',array('UserID'=>$id));
        return $data->Users;
    }

    public function getUsers($params=array())
    {
        $data = $this->request('users','multi',$params);
        return $data->Users;
    }

    public function getUserProfile($userID)
    {
        $data = $this->request('users','get',array('UserID'=>$userID));
        if (isset($data->Profile))
            return (array)$data->Profile;
        else
            return null;
    }

    public function getRolesList()
    {
        $roles = array();
        $data = $this->request('roles','list');

        foreach($data->Roles as $role)
            $roles[$role->RoleID] = $role->Name;

        return $roles;
    }

    public function getUserRanks()
    {
        return array(
            '1'=>'New Member',
            '2'=>'Member',
            '3'=>'Contributor',
            '4'=>'Top Contributor',
            '5'=>'Expert'
        );
    }

    public function getUserRankByID($id)
    {
        $ranks = $this->getUserRanks();
        return isset($ranks[$id])?$ranks[$id]:'';
    }

    protected function request($category,$method,$params=array())
    {
        $url = 'https://'
            .$this->_domain
            .'.vanillaforums.com/api/v1/'
            .$category
            .'/'
            .$method
            .'.'
            .$this->_method
            .'?access_token='
            .$this->_token.'&'
            .http_build_query($params);

        return json_decode( file_get_contents($url) );
    }
} 