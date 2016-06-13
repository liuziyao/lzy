<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;
        public $email_code = "";

	private $_identity;
        //public $verifyCode;

        /**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username', 'required','message'=>'管理员账号不能为空！'),
                        array('username','isDisabled'),
                        array('email_code','validate_email_code'),
			array('password', 'required','message'=>'密码不能为空！'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate'),
                        //array('verifyCode', 'captcha', 'on'=>'login', 'allowEmpty'=> !extension_loaded('gd')), 
		);
	}
        /**
         * 管理是否被禁用验证器
         * @param type $attribute
         * @param type $params 
         */
        public function isDisabled($attribute,$params){
            $admin = Admin::model()->findByAttributes(array('username'=>$this->username));
            if(isset($admin) && $admin->status == 0){
                $this->addError($attribute, '此账户已被禁用！');
            }
        }
        /**
         * 验证后台登录邮箱
         * @param type $attribute
         * @param type $params
         */
        public function validate_email_code($attribute,$params){
            if(Yii::app()->params['admin_login_is_email']){
                $code = Yii::app()->cache->get("admin_login_email_code_".$this->email_code);
                if(!isset($code) || !$code){
                    $this->addError($attribute, '验证码错误！');
                }
            }
        }
        /**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			//'rememberMe'=>'Remember me next time',
                        'username' => '管理员帐号',
                        'password' => '密码',
                        //'verifyCode' => '验证码'
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate())
				$this->addError('password','用户名或者密码错误.');
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);             
			return true;
		}
		else
			return false;
	}
}
