<div class="bg_f4f4f3 top_head">
    <div class="wrap clearfix">
        <a href=""><img src="/static/front/img/public/logo.png" /></a><span class="f22 heiti c999 m_l20">新用户注册</span>
        <span class="right c999 f14  a-underline m_t10">已有账号，<a class="blue" href="<?php echo $this->createUrl('/mp/login') ?>">直接登录</a></span>
    </div>
</div>
<style>
    input,label { vertical-align:middle;} 
</style>
<div class="wrap p_t40 clearfix">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'id-form',
        'action' => $this->createUrl('save'),
        //'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
            'class' => 'form-inline'
        ),
    ));
    ?>
    <ul class="register_form left " >
        <li>
            <span class="label">用户类型</span>  
            <?php echo $form->radioButtonList($model,'user_type',  SojgTool::getUserType(),array('separator'=>'&nbsp;&nbsp;&nbsp;&nbsp;','name'=>'user_type')); ?>
        </li>
        <li><span class="label">账号</span><?php echo $form->textField($model,'username',array('placeholder'=>'输入邮箱','class'=>'f_text','name'=>'username')); ?><a href="javascript:void(0)"  class="get-vcode bg_4ca6ff button m_l20">点击获取验证码</a></li>
        <li><span class="label">密码</span><?php echo $form->passwordField($model,'password',array('placeholder'=>'输入6-12个字符，字母区分大小写','class'=>'f_text','name'=>'password')); ?></li>
        <li><span class="label">确认密码</span><?php echo $form->passwordField($model,'password2',array('placeholder'=>'请再次输入密码','class'=>'f_text','name'=>'password2')); ?></li>
        <li><span class="label">验证码</span><?php echo $form->textField($model,'vcode',array('placeholder'=>'请输入邮箱验证码','class'=>'f_text','name'=>'vcode')); ?></li>
        <li><span class="label">&nbsp;</span><input type="button" value="注册"  class="long-btn bg_4ca6ff cfff reg"/></li>
        <li class="c666 "><span class="label">&nbsp;</span><input type="checkbox" name="is_agree" value="1" checked="checked" />阅读并接受<a href="<?php echo $this->createUrl('/systemarticle/index',array('id'=>6)) ?>" class="blue">《搜景观服务协议》</a></li>
    </ul>
    <?php $this->endWidget(); ?>

    <div class="right  borderline p_40 m_t50 m_r100 p_b20">
        <img src="/static/front/img/public/code.png" />
        <p class="m_t10 c999 text_c">搜景观微信公众号</p>
    </div>
</div>	
<script type="text/javascript">
    $(function(){
        $(".get-vcode").bind('click',function(){
            alert_msg('正在获取验证码，请稍候');
            var url = "<?php echo $this->createUrl('send_vcode'); ?>";
            $.post(url,{username:$("#username").val()},function(data){
                if(data.status == 1){
                    alert_msg(data.message);
                }else{
                    alert_warming_msg(data.message);
                }
            },'json');
        });
        $(".reg").bind('click',function(){
            var url = "<?php echo $this->createUrl('index'); ?>";
            $.post(url,$("#id-form").serialize(),function(data){
                if(data.status == 1){
                    alert_msg(data.message);
                    window.location.href = data.message;
                }else{
                    alert_msg(data.message);
                }
            },'json');
        });
    });
</script>