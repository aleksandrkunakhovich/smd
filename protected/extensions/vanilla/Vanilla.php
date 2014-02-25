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