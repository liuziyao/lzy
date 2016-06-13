<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MpControllerD
 *
 * @author Administrator
 */
class MpControllerD  extends Controller{
    //put your code here
    public $user_id;
    public $username;
    public $usertype;
    public $notice_count;
    public $user_model;
    public function init() {
        parent::init();
        $id = Yii::app()->user->id;
        if($id){
            $this->user_id = $id;
            $this->username = Yii::app()->user->name;
            $this->usertype = Yii::app()->session['user']->user_type;
            //找到未阅读的站内信
            $notice_criteria = new CDbCriteria();
            $notice_criteria->compare('to_uid', $id);
            $notice_criteria->compare('status', 0);
            $this->notice_count = Notice::model()->count($notice_criteria);
            $this->user_model = Yii::app()->session['user'];
        }
    }
    
    public function showMessage($op_msg){
       Yii::app()->user->setFlash('op_msg',$op_msg);
    }
    
    public function handleResult($sta, $msg = '', $data = array(),$is_setflash=true) {
        if($sta == 1 && $is_setflash){
            $this->showMessage($msg);
        }
        parent::handleResult($sta, $msg, $data);
    }
    
    /**
     * 必须vip才能操作项 提示去开通
     */
    public function mustVipOperate(){
        if (Yii::app()->session['user']->is_vip == 0) {
            $model = VipApply::model()->find('user_id=:user_id',array(':user_id'=>$this->user_id));
            $msg = $model ? (Yii::app()->session['user']->vip_expire_time >0 && Yii::app()->session['user']->vip_expire_time < time() ? '您的vip已过期，如需要请重新申请' : '您的vip申请已提交，详情请联系客服') : '您不是VIP会员，不能操作此项！';
            $vip_state = $model && Yii::app()->session['user']->vip_expire_time == 0 ? 'applying' : 'hasnoapply';
            $this->error($msg, $this->createUrl('/mp'),3,$vip_state);
        }
    }
}
