<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Administrator
 */
class HomeControllerD extends IndexControllerD {
    public $user_info;
    public function init() {
        parent::init();
        $this->layout = 'home';
        $this->pageTitle = '搜景观个人主页';
        $this->user_info = $this->getUserInfo();
    }
    
    public function getUserInfo(){
        $uid = Yii::app()->request->getParam('uid',0);
        $user = User::model()->getUserInfo($uid);
        $this->checkEmpty($user['model']);
        $website_module = array();
        $check_module = array();
        if(!empty($user['website_module']) && is_array($user['website_module'])){
            foreach ($user['website_module'] as $key=>$val){
                if(key_exists($val['sort'], $website_module)){
                    $website_module[] = $val;
                }else{
                    $website_module[$val['sort']] = $val;
                }
                $check_module[] = $val['module_info']->action_name;
            }
        }
        if(is_array($website_module)){
            ksort($website_module);
        }
        $user['website_module'] = $website_module;
        $user['open_module'] = $check_module;
   
        $user['model']->view_home_count = $user['model']->view_home_count + 1;
        $user['model']->save();
        return $user;
    }
    
}

?>
