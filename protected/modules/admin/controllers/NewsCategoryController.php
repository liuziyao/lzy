<?php

class NewsCategoryController extends Controller{
    //put your code here
    public function actionIndex() {
        $this->breadcrumbs = array('新闻资讯', '分类管理');
        $name = Yii::app()->request->getParam('name','');
        $criteria = new CDbCriteria();
        $criteria->order = "sorting asc";
        if($name){
            $criteria->addSearchCondition('name',$name);
        }
        $model = NewsCategory::model()->findAll($criteria);
        $this->render('index', array('model' => $model));
    }

    public function actionCreate() {
        $this->breadcrumbs = array('新闻资讯', '添加分类');
        $model = new NewsCategory();
        $this->render('_form', array('model' => $model));
    }

    public function actionSave() {
        $id = Yii::app()->request->getParam('id', 0);
        if ($id) {
             $model = NewsCategory::model()->find('id=:id', array(':id' => $id));
        } else {
            $model = new NewsCategory();
        }
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'id-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        $model->created = time();
        $model->attributes = $_POST['NewsCategory'];
        
        if ($model->save()) {
            $this->success('保存成功！', $this->createUrl('index'));
        } else {
            $this->error(UtilD::getFirstError($model->errors));
        }
    }
    public function actionUpdate(){
        $id = Yii::app()->request->getParam('id',0);
        $model = NewsCategory::model()->find('id=:id',array(":id"=>$id));
        $this->render('_form',array('model'=>$model));
    }
    
    public function actionDelete() {
        $id = Yii::app()->request->getParam('id', 0);
        if ($id) {
            $id = explode(",",$id);
        }
        $model = new NewsCategory();
        $criteria = new CDbCriteria();
        
        $criteria->addInCondition('id', $id);

        if ($model->deleteAll($criteria)) {
            $this->success('删除成功！');
        } else {
            $this->error('操作失败！');
        }
    }



}
