<?php

class NewsController extends Controller {

    //put your code here
    public function actionIndex() {
        $this->breadcrumbs = array('资讯管理');
        $criteria = new CDbCriteria();
        $criteria->order = 'sorting asc';
        $title = Yii::app()->request->getParam('title','');
        if($title){
            $criteria->addSearchCondition('title', $title);
        }
        $cat_id = Yii::app()->request->getParam('cat_id',0);
        if($cat_id){
            $criteria->compare('cat_id', $cat_id);
        }
        $user_id = Yii::app()->request->getParam('user_id',0);
        if($user_id){
            $criteria->compare('user_id', $user_id);
        }
        $count = News::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize = 10;
        $pager->applyLimit($criteria);
        $model = News::model()->findAll($criteria);
        $cate = News::model()->getNewsCategory();
        $name = News::model()->getUserName();
        $this->render('index', array('model' => $model,'cate'=>$cate,'pager'=>$pager,'name'=>$name));
    }

    public function actionCreate() {
        $this->breadcrumbs = array('添加资讯');
        $cate = News::model()->getNewsCategory();
        $name = News::model()->getUserName();
        $model = new News();
        $this->render('_form', array('model' => $model, 'cate' => $cate,'name'=>$name));
    }

    public function actionSave() {
        $id = Yii::app()->request->getParam('id', 0);
        if ($id) {
            $model = News::model();
        } else {
            $model = new News();
        }
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'id-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        $model->created = time();
        $model->attributes = $_POST['News'];

        if ($model->save()) {
            $this->success('保存成功！', $this->createUrl('index'));
        } else {
            $this->error(UtilD::getFirstError($model->errors));
        }
    }
    public function actionUpdate(){
        $id = Yii::app()->request->getParam('id',0);
        $model = News::model()->find('id=:id',array(":id"=>$id));
        $cate = News::model()->getNewsCategory();
        $name = News::model()->getUserName();
        $this->render('_form',array('model'=>$model,'cate'=>$cate,'name'=>$name));
    }

    public function actionDelete() {
        $id = Yii::app()->request->getParam('id', 0);
        if ($id) {
            $id = explode(",", $id);
        }
        $model = new News();
        $criteria = new CDbCriteria();

        $criteria->addInCondition('id', $id);

        if ($model->deleteAll($criteria)) {
            $this->success('删除成功！');
        } else {
            $this->error('操作失败！');
        }
    }

}
