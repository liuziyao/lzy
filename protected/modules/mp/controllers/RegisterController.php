<?php

class RegisterController extends Controller {

    //put your code here
    public function actionIndex() {
        $this->layout = 'login';
        $model = new User('reg');
        $this->render('index', array('model' => $model));
    }

    public function actionSend_vcode() {
        $username = Yii::app()->request->getParam('username');
        $model = new User('send');
        $user_id = 0;
        if (strstr($username, '@')) {
            $model->email = $username;
            $model->validate('email');
        } else {
            die(UtilD::formatReturn(0, '您输入的格式有误', true));
        }
        $r = UserVerify::model()->sendEmailVerify($user_id, $username, '您的验证码为：vcode,感谢您的支持，【搜景观】', true, $user_id ? '' : Yii::app()->session->sessionID);
        die(CJSON::encode($r));
    }

}
