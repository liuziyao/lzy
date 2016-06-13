<?php
/**
 * Description of AdminControllerD
 *
 * @author lzh
 */
class AdminControllerD extends Controller{
    public $admin_module = '';
    //put your code here
    public function init() {
        parent::init();
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
}
