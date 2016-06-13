<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
        <meta name="description" content="">
        <meta name="author" content="">
        <title>登录</title>
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
        <link href="/static/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="/static/admin/css/signin.css" rel="stylesheet">
        <script src="/static/bootstrap/docs/assets/js/ie-emulation-modes-warning.js"></script>
    </head>

    <body>

        <div class="container">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'id-form',
                'enableClientValidation' => true,
                'enableAjaxValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
                'htmlOptions' => array(
                    'class' => 'form-signin'
                ),
            ));
            ?>
            <h2 class="form-signin-heading">搜景观管理平台</h2>
            <?php echo $form->textField($model, 'username', array('class' => 'form-control username', 'placeholder' => '请输入管理账号')); ?>
            
            <?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'placeholder' => '请输入管理密码')); ?>
            <button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
            <?php echo $form->error($model, 'password', array('class' => 'alert alert-danger')); ?>      
        <?php $this->endWidget(); ?>
    </div> 
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/static/bootstrap/docs/assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
