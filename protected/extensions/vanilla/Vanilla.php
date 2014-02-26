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
        $users = array();
        $data = $this->request('users','multi',$params);

        foreach($data->Users as $index => $user) {
            $users[$index] = (array)$user;
            $profile = Yii::app()->vanilla->getUserProfile($user->UserID);

            if (isset($user->Location)) {
                $loc = explode(',',$user->Location);
                if (isset($loc[0]))
                    $users[$index]['City'] = $loc[0];
                if (isset($loc[1]))
                    $users[$index]['Country'] = $loc[1];
            }

            $users[$index]['UserRoles'] = isset($profile['UserRoles']) ? implode(',',$profile['UserRoles']) :'';
            $users[$index]['RankLabel'] = Yii::app()->vanilla->getUserRankByID($user->RankID);
            $users[$index]['Online'] = (isset($user->Online) && $user->Online == true) ? 'Yes' : 'No';
        }
        return $users;
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

    public function getFilteredUsers($Users,$filters)
    {
        foreach ($Users AS $rowIndex => $row) {
            foreach ($filters AS $key => $searchValue) {
                if (!is_null($searchValue) AND $searchValue !== '') {
                    $compareValue = null;
                    $key = ucfirst($key);

                    if (!array_key_exists($key, $row))
                        continue;

                    $compareValue = $row[$key];
                    if (stripos($compareValue, $searchValue) === false) {
                        unset($Users[$rowIndex]);
                    }
                }
            }
        }
        return $Users;
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