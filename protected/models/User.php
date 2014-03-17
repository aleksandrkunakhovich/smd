<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $name
 * @property string $city
 * @property string $country
 * @property string $location
 * @property integer $forum_credentials
 * @property string $area_experience
 * @property string $platform_knowledge
 * @property integer $online
 */
class User extends CActiveRecord
{
    public $role;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			#array('id, name', 'required'),
			array('id, forum_credentials, online', 'numerical', 'integerOnly'=>true, 'allowEmpty'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, city, country, location, forum_credentials, primary_area, other_area, online, area_experience, platform_knowledge, role, latitude, longitude', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
            'UserRole' => array(self::HAS_MANY,'UserRole','user_id'),
            'roles'    => array(self::HAS_MANY,'Role','role_id','through'=>'UserRole'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'city' => 'City',
			'country' => 'Country',
			'location' => 'Location',
			'forum_credentials' => 'Forum Credentials',
			'area_experience' => 'Area of experience',
			'platform_knowledge' => 'Platform knowledge',
			'online' => 'Online',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('forum_credentials',$this->forum_credentials);
        $criteria->compare('area_experience',$this->area_experience,true);
        $criteria->compare('platform_knowledge',$this->platform_knowledge,true);

        if ( ! empty($this->role)) {
            $criteria->with = array('roles'=>array('select'=>'roles.id, roles.title','together'=>true));
            $criteria->compare('roles.id',$this->role);
        }

		$criteria->compare('online',$this->online);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize' => Yii::app()->params['users_per_page'],
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getLocations()
    {
        return Yii::app()->db->createCommand('select name,latitude,longitude from user where latitude is not null and longitude group by location order by id asc')->queryAll();
    }
}
