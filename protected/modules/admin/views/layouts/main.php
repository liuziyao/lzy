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
        <link rel="stylesheet" href="/static/mp/css/public.css" type="text/css" media="screen" /> 
        <link rel="stylesheet" href="/static/admin/css/public.css" type="text/css" media="screen" /> 
        <!--<link rel="stylesheet" href="/static/admin/css/ace.min.css" type="text/css" media="screen" />--> 
        <link rel="stylesheet" type="text/css" href="/static/area/css/area.css"  />
        <script type="text/javascript" src="/static/admin/js/common.js"></script>
        <script type="text/javascript" src="/static/area/js/popt.js"></script>
        <script type="text/javascript" src="/static/area/js/city_set.js"></script>
        <script type="text/javascript" src="/static/area/js/city_json.js"></script>
    </head>
    <body>
        <div class="mynavbar clear">
            <div class="f_left logo">
                <a href="<?php echo $this->createAbsoluteUrl('/') ?>">搜景观总管理后台</a>
            </div>
            <div class="f_right">
                <ul class="right user-info">
                    <li class="user-info-user">
                        <a class="user-info-username" href="javascript:void(0)"><?php echo Yii::app()->user->name ?>&nbsp;&nbsp;<i style="top:3px;" class="glyphicon glyphicon-triangle-bottom"></i></a>
                        <a class="logout" href="<?php echo $this->createUrl('/admin/login/logout') ?>">退出登录</a>
                    </li> 
                </ul>
            </div> 
        </div>
        <div class="layouts_content clear">
            <div class="layouts_content_left">
                <div class="li_main li_close"><a href="#"><i class="glyphicon"></i>新闻资讯<i class="glyphicon glyphicon-cog setting"></i></a></div>
                <ul>
                    <li class="li_sub"><a href="<?php echo $this->createUrl('/admin/newscategory') ?>"><i class="glyphicon glyphicon-th"></i>分类管理</a></li>
                    <li class="li_sub"><a href="<?php echo $this->createUrl('/admin/news'); ?>"><i class="glyphicon glyphicon-th"></i>资讯管理</a></li>

                </ul>
            </div>
            <div class="layouts_content_right f_left">
                <h3 class="page-header"><?php $this->widget('zii.widgets.CBreadcrumbs', array('links' => $this->breadcrumbs, 'homeLink' => CHtml::link('管理中心', $this->createUrl('/admin/')),)); ?></h3>
                <?php echo $content; ?>
            </div>
            <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                'id' => 'dialog',
                'options' => array(
                    'autoOpen' => false,
                    'width' => '600', //宽度 
                    'buttons' => array(
                        '提交' => 'js:function(){ dialog_ok($(this))}', //关闭按钮 
                        '关闭' => 'js:function(){ $(this).dialog("close");}', //关闭按钮 
                    ),
                ),
            ));
            $this->endWidget('zii.widget.jui.CJuiDialog');
            ?>
        </div>
        <!-- Bootstrap core JavaScript
    ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="/static/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
        <script src="/static/bootstrap/docs/assets/js/vendor/holder.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="/static/bootstrap/docs/assets/js/ie10-viewport-bug-workaround.js"></script>
        <!-- 配置文件 -->
        <script type="text/javascript" src="/static/ueditor/ueditor.config.js"></script>
        <!-- 编辑器源码文件 -->
        <script type="text/javascript" src="/static/ueditor/ueditor.all.js"></script>
        <!-- 实例化编辑器 -->
        <script type="text/javascript">
            var ue = UE.getEditor('container', {
                initialFrameWidth: 800,
                initialFrameHeight: 300
            });
        </script>
        <script type="text/javascript">
            var screen_width = document.body.clientWidth;
            var layouts_content_right_width = (screen_width - 220) + 'px';
            $(".layouts_content_right").css({
                width: layouts_content_right_width
            });
            $(function () {
                var op_msg = "<?php echo Yii::app()->user->getFlash('op_msg') ?>";
                if (op_msg) {
                    alert_msg(op_msg);
                }
            });
        </script>
    </body>
</html>