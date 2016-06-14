<?php

class NewsController extends Controller {

    //put your code here
    public function actionIndex() {
        $this->breadcrumbs = array('资讯管理');
        $criteria = new CDbCriteria();
        $criteria->order = 'sorting asc';
        $model = News::model()->findAll($criteria);
        $this->render('index', array('model' => $model));
    }

    public function actionCreate() {
        $this->breadcrumbs = array('添加资讯');
        $cate = News::model()->getNewsCategory();
        $model = new News();
        $this->render('_form', array('model' => $model, 'cate' => $cate));
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
        $this->render('_form',array('model'=>$model,'cate'=>$cate));
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
