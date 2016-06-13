<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class WebsiteControllerD extends IndexControllerD {
    public $user_info;
    public $currren_module_name;
    public $current_title;
    public $branch_company = array();
    public $link;
    public function init() { 
        parent::init();
        $this->layout = "website";
        $this->pageTitle = '搜景观';
        $this->user_info = $this->getUserInfo();
        $this->branch_company = array_filter(UtilD::object2array(BranchCompany::model()->findAllByAttributes(array('user_id'=>$this->user_info['model']->id))));
        //print_r($this->user_info);exit;
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
        $user['model']->view_count = $user['model']->view_count + 1;
        $user['model']->save();
        return $user;
    }
    
    public function checkModule($action_id = ''){
        if(!in_array($this->getAction()->getId(), $this->user_info['open_module'])){
            $this->error('会员未开放此模块，无权访问',$this->createUrl('/index/'));
        }
        //浏览增加积分
        PointLog::model()->addPointLog($this->user_info['model']->id, 'view_user');
    }
}
