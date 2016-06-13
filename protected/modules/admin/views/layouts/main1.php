<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
        <title></title>
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
        <script type="text/javascript" src="/static/laydate/laydate.js"></script>
        <link href="/static/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="/static/admin/css/dashboard.css" rel="stylesheet">
        <!--[if lt IE 9]><script src="/static/bootstrap/docs/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="/static/bootstrap/docs/assets/js/ie-emulation-modes-warning.js"></script>
        <!--[if lt IE 9]>
          <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/static/admin/css/public.css" type="text/css" media="screen" /> 
        <script type="text/javascript" src="/static/admin/js/common.js"></script>
    </head>

    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top noprint">
            <div class="container-fluid">
                <div class="navbar-header">          
                    <a class="navbar-brand" href="<?php echo $this->createUrl('/admin') ?>">搜景观管理后台</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?php echo $this->createAbsoluteUrl('/') ?>">前台首页</a></li>
                        <li><a href="<?php echo $this->createUrl('/admin/login/logout') ?>">注销</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    <ul class="nav nav-sidebar">
                        <li <?php if (Yii::app()->controller->id == 'index'): ?>class="active"<?php endif; ?>><a href="<?php echo Yii::app()->controller->createAbsoluteUrl('/admin') ?>">后台首页</a></li>
                    </ul>
                    <div class="li_main">项目管理</div>
                    <ul class="nav nav-sidebar">
                        <li <?php if (Yii::app()->controller->id == ''): ?>class="active"<?php endif; ?>><a href="<?php echo Yii::app()->controller->createAbsoluteUrl('/') ?>">项目管理</a></li>
                    </ul>
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <h4 class="page-header"><?php $this->widget('zii.widgets.CBreadcrumbs', array('links' => $this->breadcrumbs, 'homeLink' => CHtml::link('管理中心', $this->createUrl('/admin/')),)); ?></h4>
                    <?php echo $content; ?>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="/static/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
        <script src="/static/bootstrap/docs/assets/js/vendor/holder.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="/static/bootstrap/docs/assets/js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>
