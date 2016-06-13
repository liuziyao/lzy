<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public $_id;
    public $_name;
    private $user;
    public $error_desc;
    public $type = 'mp';

    public function authenticate() {
        $criteria = new CDbCriteria();
        $criteria->addCondition("username='{$this->username}' OR mobile = '{$this->username}' OR email = '{$this->username}' OR qq='{$this->username}'");
        $users = User::model()->find($criteria);
        if($this->type == 'admin'){
            if($users->is_vip == 1 && $users->vip_expire_time < time()){//vip过期
                $users->is_vip = 0;
                $users->save();
            }
            $this->user = $users;
            Yii::app()->session['user'] = $users;
            $this->_id = $users->id;
            $this->_name = User::model()->getUserName($users);
            $this->errorCode = self::ERROR_NONE;
            return !$this->errorCode;
        }
        if (!isset($users))
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        elseif ($users->password !== UtilD::password($this->password))
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        elseif ($users->approve_state != 1) {
            $this->error_desc = '账号状态异常';
        }
        else {
            if($users->is_vip == 1 && $users->vip_expire_time < time()){//vip过期
                $users->is_vip = 0;
                $users->save();
            }
            $this->user = $users;
            Yii::app()->session['user'] = $users;
            $this->_id = $users->id;
            $this->_name = User::model()->getUserName($users);
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    public function getId() {
        return $this->_id;
    }
    
    public function getName(){
        return $this->_name;
    }

    public function afterLogin(User $user = null) {
        $user_login = array(
            'username' => $this->user->username,
            'password' => $this->password,
        );
        $user_login_text = UtilD::authcode(serialize($user_login), 'ENCODE', 'sojg');
        $cookie = new CHttpCookie('user_login', $user_login_text);
        $cookie->expire = time() + 60 * 60 * 24 * 7;  //有限期30天
        Yii::app()->request->cookies['user_login'] = $cookie;
        $user = $user ? $user : $this->user;
        $user->login_num = $user->login_num + 1;
        $user->last_login = time();
        $user->last_ip = Yii::app()->request->userHostAddress;
        $user->save();
        PointLog::model()->addPointLog($user->id, 'login');
    }

}
