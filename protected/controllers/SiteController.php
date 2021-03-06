<?php

class SiteController extends Controller
{
    public function actionIndex()
    {
        $model = new User('search');

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
        }

        $provider = $model->search();
        $userPerPage = Yii::app()->params['users_per_page'];
        $countUsers  = count($provider->data);

        $gridParams = array(
            'dataProvider' => $provider,
            'emptyText'    => 'No users found',
            'summaryText'  => false,
            'cssFile'      => false,
            'columns'      => array(
                array('header'=>'Name & Location','type'=>'raw','value'=>function($data){
                        return '<h3>' . $data->name . '</h3>' . '<p>' . $data->location . '</p>';
                }),
                array('header'=>'Role & Credentials','type'=>'raw','value'=>function($data) {
                        $roles = '';
                        if ($data->roles) {
                            foreach($data->roles as $r)
                                $roles .= ','.$r->title;
                        }
                        return '<p>' . ltrim($roles,',') . '</p><p>' . Yii::app()->vanilla->getUserRankByID($data->forum_credentials) . '</p>';
                }),
                array('header'=>'Expertise','type'=>'raw','value'=>'$data->area_experience'),
                array('header'=>'Platform Knowledge','type'=>'raw','value'=>'$data->platform_knowledge'),
                array('header'=>'Available?','type'=>'raw','value'=>'($data->online==1)?"Yes":"No"','htmlOptions'=>array('style'=>'min-width: 60px;')),
                array('header'=>'Learn More & Contact','type'=>'raw','value'=>function($data){
                        return CHtml::link('See Full Profile',Yii::app()->vanilla->getProfileLink($data->id));
                }),
            )
        );

        $this->render('index',array(
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

    public function actionTest()
    {

        #$data = Yii::app()->vanilla->getUserProfile(205);
        $data = Yii::app()->vanilla->parseProfile(14);
        #$data = Yii::app()->vanilla->getUsers(array('Users.ID'=>'204,205'));
        #$data = Yii::app()->vanilla->getUserGeo(200);

        CVarDumper::dump($data,10,true);
    }

	/**
	 * Displays the contact page
	 */
	/*public function actionContact()
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
	/*public function actionLogin()
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
	/*public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}*/

    /**
     * This is the default 'index' action that is invoked
     * 'UserID' => '202'
    'Name' => 'DavidRosenberg'
    'Title' => null
    'Location' => 'MEMBER HAS LEFT THE COMMUNITY - Boulder, CO'
    'About' => null
    'Email' => 'drosenalex@hotmail.com'
    'Gender' => 'u'
    'CountVisits' => '74'
    'CountInvitations' => '0'
    'CountNotifications' => '0'
    'Admin' => '0'
    'Verified' => '0'
    'Banned' => '0'
    'Deleted' => '0'
    'Points' => '18'
    'CountDiscussions' => '4'
    'CountComments' => '73'
    'CountBookmarks' => null
    'CountBadges' => '0'
    'RankID' => null
    'UserRoles' => ''
    'RankLabel' => ''
     * when an action is not explicitly requested by users.
     */
    /*public function actionIndex()
    {
        $model = new SearchForm;
        $users = Yii::app()->vanilla->getUsers(array('Users.ID'=>implode(',',range(200,255))));
#CVarDumper::dump($users,10,true);exit;
        if (isset($_POST['SearchForm'])) {
            $model->attributes = $_POST['SearchForm'];
            $users = Yii::app()->vanilla->getFilteredUsers($users,$_POST['SearchForm']);
        }

        $userPerPage = Yii::app()->params['users_per_page'];
        $countUsers  = count($users);
        $dataProvider = new CArrayDataProvider($users,array(
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
                array('header'=>'Available?','type'=>'raw','value'=>'$data["Online"]'),
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
    }*/
}