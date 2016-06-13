<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();
    public $notice_count = 0;

    public function init() {
        parent::init(); 
        $this->pageTitle = "";
    }

    public function checkEmpty(&$data) {
        if (empty($data)) {
            $this->error('找不到相应记录！');
        }
    }

    /**
     * 成功提示
     * @param type $msg 提示信息
     * @param type $jumpurl 跳转url
     * @param type $wait 等待时间
     */
    public function success($msg = "", $jumpurl = "", $wait = 1) {
        self::_jump($msg, $jumpurl, $wait, 1);
        exit;
    }

    public function jsonSuccess($msg = "", $jumpurl = "", $wait = 1) {
        if ($jumpurl === "") {
            $jumpurl = $_SERVER['HTTP_REFERER'];
        }
        echo $this->jsonHandle(1, $msg, $jumpurl, $wait);
        exit;
    }

    public function jsonError($msg = "", $jumpurl = "", $wait = 3) {
        echo $this->jsonHandle(0, $msg, $jumpurl, $wait);
        exit;
    }

    function jsonHandle($status, $message, $jumpurl = "", $wait = 3) {
        return CJSON::encode(array(
                    'status' => $status, 'message' => $message, 'jumpurl' => $jumpurl, 'wait' => $wait));
    }

    /**
     * 错误提示
     * @param type $msg 提示信息
     * @param type $jumpurl 跳转url
     * @param type $wait 等待时间
     * @param type $vip 是否提示需要开通vip
     */
    public function error($msg = "", $jumpurl = "", $wait = 3, $vip = '') {

        self::_jump($msg, $jumpurl, $wait, 0, $vip);
        exit;
    }

    /**
     * 最终跳转处理
     * @param type $msg 提示信息
     * @param type $jumpurl 跳转url
     * @param type $wait 等待时间
     * @param int $type 消息类型 0或1
     * @param type $vip 是否提示需要开通vip
     */
    static private function _jump($msg = "", $jumpurl = "", $wait = 1, $type = 0, $vip = '') {
        $info = array('msg' => $msg,
            'jumpurl' => $jumpurl,
            'wait' => $wait,
            'type' => $type,
            'vip' => $vip
        );

        Yii::app()->user->setFlash('showmessage', $info);
        if (isset(Yii::app()->controller->module)) {
            if (Yii::app()->controller->module->id == 'admin') {
                Yii::app()->runController("Site/ShowMessage");
            } elseif (Yii::app()->controller->module->id == 'mp') {
                Yii::app()->runController("Site/MpShowMessage");
            } else {
                Yii::app()->runController("Site/FrontShowMessage");
            }
        }else{
            Yii::app()->runController("Site/FrontShowMessage");
        }
    }

    public function url($route, $params = array()) {
        $return = "";
        if (strpos($route, '/') !== false) {
            return $this->createUrl($route, $params);
        }
        if (isset($this->module->id) && !empty($this->module->id)) {
            $module_id = $this->module->id;
            $return .= '/' . $module_id;
        }
        if (isset($this->id) && !empty($this->id)) {
            $return .= '/' . $this->id;
        }
        return $this->createUrl($return . '/' . $route, $params);
    }

    public function handleResult($sta, $msg = '', $data = array()) {
        $data = array(
            'sta' => $sta,
            'msg' => $msg,
            'data' => $data,
        );
        die(CJSON::encode($data));
    }

}
