<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndexControllerD
 *
 * @author Administrator
 */
class IndexControllerD extends Controller {

    public function init() {
        parent::init();
        $this->pageTitle = '搜景观';
        if (Yii::app()->user->isGuest) {
            //自动登录
            $cookie = Yii::app()->request->getCookies();
            $user_info_temp = isset($cookie['user_login']) && isset($cookie['user_login']->value) && $cookie['user_login']->value ? $cookie['user_login']->value : "";
            if ($user_info_temp) {
                $user_info = unserialize(UtilD::authcode($user_info_temp, 'DECODE', 'sojg'));
                $login_form = new LoginForm();
                $login_form->username = $user_info['username'];
                $login_form->password = $user_info['password'];
                $login_form->login();
            }
        }
    }

}

?>
