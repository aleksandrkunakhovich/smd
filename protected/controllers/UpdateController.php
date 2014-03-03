<?php

class UpdateController extends Controller
{
    public function actionRoles()
    {
        $roles = Yii::app()->vanilla->getRoles();
        if (empty($roles))
            exit('Unable to download a list of roles with api.');

        foreach($roles as $id => $title) {
            $role = new Role;
            $role->id = $id;
            $role->title = $title;
            $role->save();
        }

        echo 'Updated list of roles.';
    }

    public function actionUsers($start,$end)
    {
        $UsersID = range( (int)$start, (int)$end);

        foreach($UsersID as $id) {
            $profile = Yii::app()->vanilla->getUserProfile($id);
            if (is_null($profile))
                continue;

            $user = User::model()->findByPk($id);

            if ($user === NULL) {
                $user = new User;
                $user->id = $profile->UserID;
            }

            if (isset($profile->Name))
                $user->name = $profile->Name;

            $data = Yii::app()->vanilla->parseProfile($id);
            if (isset($data['country']))
                $user->country = $data['country'];

            if (isset($data['city']))
                $user->city = $data['city'];

            if (isset($profile->Location))
                $user->location = $profile->Location;

            if (isset($profile->RankID))
                $user->forum_credentials = $profile->RankID;

            if (isset($data['roles'])) {
                foreach($data['roles'] as $item) {
                    $item = trim($item);
                    $role = Role::model()->findByAttributes(array('title'=>$item));
                    if ($role) {
                        $relation = UserRole::model()->findByAttributes(array('user_id'=>$user->id,'role_id'=>$role->id));
                        if ($relation === NULL) {
                            $relation = new UserRole;
                            $relation->user_id = $user->id;
                            $relation->role_id = $role->id;
                            $relation->save();
                        }
                    }
                }
            }

            if (isset($data['area_experience'])) {
                $user->area_experience = $data['area_experience'];
            }

            if (isset($data['platform_knowledge'])) {
                $user->platform_knowledge = $data['platform_knowledge'];
            }

            if (isset($profile->online)) {
                $user->online = $profile->online;
            }

            $user->save();
        }
        echo 'Insert or update users complete';
    }
} 