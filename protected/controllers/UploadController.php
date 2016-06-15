<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CommonController
 *
 * @author lzh
 */
class UploadController extends IndexControllerD {

    //put your code here
    public function actionUe_upload_image() {
        if (isset($_FILES['upfile']['tmp_name']) && !empty($_FILES['upfile']['tmp_name'])) {
            $upload = new Upload();
            $rs = $upload->uploads('upfile');
            if ($rs) {
                echo CJSON::encode(array('url' => $upload->file_url, 'title' => '', 'state' => 'SUCCESS'));
            } else {
                $data['error'] = $upload->getError();
                $data['status'] = 0;
                echo CJSON::encode($data);
            }
        }
    }

    public function actionUploadify() { 
        if (isset($_FILES['Filedata']['tmp_name']) && !empty($_FILES['Filedata']['tmp_name'])) { 
            $upload = new Upload();     
            if(isset($_POST['t']) && $_POST['t'] == 'avatar'){ 
                $avatar = 'avatar_'.Yii::app()->user->id.'.jpg';
                $rs = $upload->upload_avatar('Filedata',$avatar);
            }else{
                $thumb_type = Yii::app()->request->getParam('thumb_type','');
                $thumb_mode = Yii::app()->request->getParam('thumb_mode',1);
                if($thumb_type && key_exists($thumb_type, Yii::app()->params['thumb'])){
                    $upload->is_thumb = true;
                    $upload->thumb_type = $thumb_type;
                    $upload->thumb_mode = $thumb_mode;
                }
                $rs = $upload->uploads('Filedata',isset($_POST['type']) && $_POST['type'] ? $_POST['type'] : 'image');
            }
            if ($rs) {
                echo CJSON::encode(array('url' => $upload->file_url, 'file_name' => $upload->file_name, 'title' => '', 'state' => 'SUCCESS'));
            } else {
                $data['error'] = $upload->getErr();
                $data['status'] = 0;
                echo CJSON::encode($data);
            }
        }
    }

}
