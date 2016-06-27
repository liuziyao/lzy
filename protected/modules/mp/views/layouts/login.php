<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="Content-Language" content="zh-cn" />
        <meta name="robots" content="all" />
        <meta name="author" content="" />
        <meta name="Copyright" content="" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <title>搜景观-登陆</title>
        <link rel="stylesheet" type="text/css" href="/static/front/css/public.css"  />
        <link rel="stylesheet" type="text/css" href="/static/front/css/main.css"  />
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
        <script type="text/javascript" src="/static/laydate/laydate.js"></script>
        <script type="text/javascript" src="/static/mp/js/common.js"></script>
    </head>

    <body>
        <?php echo $content; ?>
        <?php
//        $criteria = new CDbCriteria();
//        $criteria->compare('type', 1);
//        $criteria->order = "sorting desc";
//        $model = SystemArticle::model()->findAll($criteria);
        ?>
        <div class="foot a-underline a_l10 m_t20 c999">        
            <p>
                <?php if (!empty($model) && is_array($model)): ?>
                    <?php foreach ($model as $key => $val): ?>
                        <a href="<?php echo $this->createUrl('/systemarticle/index', array('id' => $val->id)) ?>" target="_blank"><?php echo $val->title ?></a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </p>
            <p class="m_10">
                客服电话：111111
                <a href=''>客服QQ：11111</a>
                <a class='weixin'  style="position: relative;">客服微信:11111<img class='weixin_img' style='display:none;max-width: 150px !important;position: absolute;top: -150px;left: -5px;'/></a>
                <a target="_blank" href="">搜景观QQ群:11111</a>
                <a class='weixin'  style="position: relative;">搜景观微信公众号:111111<img class='weixin_img' style='display:none;max-width: 150px !important;position: absolute;top: -150px;left: -5px;' /></a>
                <a>111111</a>
            </p>
        </div>	
        <div class="alert_success_msg alert_msg">

        </div>
        <div class="alert_warming_msg alert_msg">

        </div>
        <script type='text/javascript'>
            /*$(function () {
             $('.weixin').hover(function () {
             $('.weixin_img').show();
             }, function () {
             $('.weixin_img').hide();
             });
             })*/
            $(function () {
                $('.weixin').hover(function () {
                    $(this).find('.weixin_img').toggle();
                });
            });
        </script>
    </body>
</html>