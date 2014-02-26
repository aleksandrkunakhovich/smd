<?php

class SearchForm extends CFormModel
{
    public $name;
    public $city;
    public $country;
    public $RankID;
    public $role;
    public $area;
    public $knowledge;
    public $online;

    public function rules()
    {
        return array(
            array('name,city,country,RankID,role,area,knowledge,online','safe')
        );
    }

    public function attributeLabels()
    {
        return array(
            'name'      => 'Name',
            'city'      => 'City',
            'country'   => 'Country',
            'RankID'    => 'Forum Credentials',
            'role'      => 'Role',
            'area'      => 'Area of Expertise',
            'knowledge' => 'Platform Knowledge',
            'online'    => 'Available for Hire'
        );
    }
}