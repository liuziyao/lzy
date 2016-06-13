<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginController
 *
 * @author Administrator
 */
class LoginController extends Controller{
    //put your code here
    public function actionIndex(){
        $this->layout = 'none';
        $model = new LoginForm('login');
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'id-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (Yii::app()->request->isPostRequest) {
            $model->attributes = Yii::app()->request->getParam('LoginForm');
            $validate = $model->validate();
            $login = $model->login();
            if ($validate && $login) {
                $this->redirect($this->createUrl('/admin/index'));
            }else{
                $this->error(UtilD::getFirstError($model->errors));
            }
        }
        $this->render('index', array('model' => $model));
    }
    
    public function actionLogout(){
        Yii::app()->user->logout();
        $this->redirect('/admin/login');
    }
}
