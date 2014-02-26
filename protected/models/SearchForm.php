<?php

class SearchForm extends CFormModel
{
    public $name;
    public $city;
    public $country;
    public $rank;
    public $role;
    public $area;
    public $knowledge;
    public $online;

    public function rules()
    {
        return array(
            array('name,city,country,rank,role,area,knowledge,online','safe')
        );
    }

    public function attributeLabels()
    {
        return array(
            'name'      => 'Name',
            'city'      => 'City',
            'country'   => 'Country',
            'rank'      => 'Forum Credentials',
            'role'      => 'Role',
            'area'      => 'Area of Expertise',
            'knowledge' => 'Platform Knowledge',
            'online'    => 'Available for Hire'
        );
    }
}