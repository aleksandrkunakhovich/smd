<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

    public function actionTest()
    {
        $data = Yii::app()->vanilla->getUsers(array('Role.ID'=>'2'));
        CVarDumper::dump($data,10,true);
    }

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
        $model = new SearchForm;

        if (isset($_POST['SearchForm'])) {
            $model->attributes = $_POST['SearchForm'];
            $users = Yii::app()->vanilla->getUsers(array('Users.ID'=>implode(',',range(200,250)))); //TODO add filters
        } else {
            $users = Yii::app()->vanilla->getUsers(array('Users.ID'=>implode(',',range(200,205))));
        }

        $usersArray = array();
        foreach($users as $index => $user) {
            $usersArray[$index] = (array)$user;
            $profile = Yii::app()->vanilla->getUserProfile($user->UserID);
            $usersArray[$index]['UserRoles'] = (isset($profile['UserRoles'])) ? implode(',',$profile['UserRoles']) : '';
            $usersArray[$index]['RankLabel'] = Yii::app()->vanilla->getUserRankByID($user->RankID);
        }

#CVarDumper::dump($usersArray,10,true);exit;
        $userPerPage = Yii::app()->params['users_per_page'];
        $countUsers  = count($usersArray);
        $dataProvider = new CArrayDataProvider($usersArray,array(
            'keyField'=>'UserID',
            'pagination'=>array(
                'pageSize'=>$userPerPage,
            ),
        ));

        $gridParams = array(
            'dataProvider' => $dataProvider,
            'emptyText'    => 'No users found',
            'summaryText'  => false,
            'cssFile'      => false,
            'columns'      => array(
                array('header'=>'Name & Location','type'=>'raw','value'=>function($data){
                    return '<h3>' . $data["Name"] . '</h3>' . '<p>' . $data["Location"] . '</p>';
                }),
                array('header'=>'Role & Credentials','type'=>'raw','value'=>function($data){
                        return '<p>' . $data['UserRoles'] . '</p>' . '<p>' . $data['RankLabel'] . '</p>';
                }),
                array('header'=>'Available?','type'=>'raw','value'=>function($data) {
                        if (isset($data['Online']))
                            return ($data['Online'])? 'Yes':'No';
                        else
                            return 'No';
                }),
                array('header'=>'Learn More & Contact','type'=>'raw','value'=>function($data){
                        return CHtml::link('See Full Profile','https://'.Yii::app()->params['vanilla_api_domain'].'.vanillaforums.com/profile/reactions/'.$data['UserID']);
                })
            )
        );

		$this->render('index', array(
            'users'      => $users,
            'model'      => $model,
            'gridParams' => $gridParams,
            'countUsers' => $countUsers,
            'countDisplayedUsers' => ($countUsers > $userPerPage) ? $userPerPage : $countUsers
        ));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}