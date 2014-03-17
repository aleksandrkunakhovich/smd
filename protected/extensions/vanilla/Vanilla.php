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

    public function getUserProfile($userID)
    {
        $data = $this->request('users','get',array('UserID'=>$userID));
        if (isset($data->Profile))
            return $data->Profile;
        else
            return null;
    }

    public function parseProfile($userID)
    {
        $data = array();
        $url = $this->getProfileLink($userID);
        $profilePage = file_get_contents($url);

        preg_match('/<dd class="ProfileExtend ProfileCountryDirectory">([a-z\s]+)/imu',$profilePage,$country);
        $data['country'] = isset($country[1]) ? $country[1] : null;

        preg_match('/<dd class="ProfileExtend ProfileCityDirectory">([a-z\s]+)/imu',$profilePage,$city);
        $data['city'] = isset($city[1]) ? $city[1] : null;

        preg_match('/<dd class="Roles">(.+)<\/dd>/imu',$profilePage,$roles);
        $data['roles'] = isset($roles[1]) ? $roles[1] : null;
        $data['roles'] = explode(',', strip_tags($data['roles']) );

        # primary and other areas in area_experience
        preg_match('/<dd class="ProfileExtend ProfilePrimaryExpertiseDirectory">(.+?)<\/dd>/imu',$profilePage,$primary_area);
        $data['area_experience'] = isset($primary_area[1]) ? '<p><b>'.$primary_area[1].'</b></p>' : null;
        preg_match('/<dd class="ProfileExtend ProfileOtherExpertiseDirectory">(.+?)<\/dd>/imu',$profilePage,$other_area);
        $data['area_experience'] .= isset($other_area[1]) ? '<p>'.$other_area[1].'</p>' : null;

        preg_match('/<dd class="ProfileExtend ProfilePlatformKnowledgeDirectory">(.+?)<\/dd>/imu',$profilePage,$platform_knowledge);
        $data['platform_knowledge'] = isset($platform_knowledge[1]) ? $platform_knowledge[1] : null;

        return $data;
    }

    public function getRoles()
    {
        $roles = array();
        $data = $this->request('roles','list');

        foreach($data->Roles as $role)
            $roles[$role->RoleID] = $role->Name;

        return $roles;
    }

    public function getUserRanks()
    {
        /*return array(
            '1'=>'New Member',
            '2'=>'Member',
            '3'=>'Contributor',
            '4'=>'Top Contributor',
            '5'=>'Expert'
        );*/
        return array(
            '1'=>'Level 1',
            '2'=>'Level 2',
            '3'=>'Level 3',
            '4'=>'Level 4',
            '5'=>'Level 5'
        );
    }

    public function getUserRankByID($id)
    {
        $ranks = $this->getUserRanks();
        return isset($ranks[$id])?$ranks[$id]:'';
    }

    public function getProfileLink($UserID)
    {
        $url = 'https://'.$this->_domain.'.vanillaforums.com/api/v1/profile/'.$UserID
            .'/ANY_STRING?access_token='.$this->_token;

        return $url;
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

    public function geoCoding($string){

        $string = str_replace (" ", "+", urlencode($string));
        $details_url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$string."&sensor=false";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $details_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = json_decode(curl_exec($ch), true);

        // If Status Code is ZERO_RESULTS, OVER_QUERY_LIMIT, REQUEST_DENIED or INVALID_REQUEST
        if ($response['status'] != 'OK') {
            return null;
        }

        $geometry = $response['results'][0]['geometry'];

        $array = array(
            'latitude' => $geometry['location']['lat'],
            'longitude' => $geometry['location']['lng'],
        );

        return $array;
    }
} 