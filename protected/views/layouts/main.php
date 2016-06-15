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
        <title>行业新闻-列表页</title>
        <link rel="stylesheet" type="text/css" href="css/public.css"  />
        <link rel="stylesheet" type="text/css" href="css/main.css"  />
    </head>

    <body>
        <div class="grey_bg" style="display:none;"></div>
        <div class="pop" style="display:none;" id="pop_password_id">
            <h4 class="bg_f4f4f3"><a class="p_close right m_t5" onclick="common.popHide('pop_password_id')"></a><span class="m_block"></span>找回密码</h4>
            <ul class="p_40 register_form m_li15 f_w100">
                <li><input type="text" placeholder="输入邮箱账号" class="f_text"/></li>
                <li><input type="password" placeholder="输入下面的验证码" class="f_text"/></li>
                <li class="a-underline"><img src="img/public/c_code.png" /> <a  class="blue">看不清，换一张</a></li>
                <li><input type="button" value="确定"  class="long-btn bg_4ca6ff cfff m_t20"/></li>
            </ul>
        </div>


        <div class="pop"  style="display:none;"  id="pop_login_id">
            <h4 class="bg_f4f4f3"><a class="p_close right m_t5" onclick="common.popHide('pop_login_id')"></a><span class="m_block"></span>账号登录</h4>
            <ul class="p_40 register_form m_li15 f_w100">
                <li><input type="text" placeholder="输入邮箱账号" class="f_text"/></li>
                <li><input type="password" placeholder="输入下面的验证码" class="f_text"/></li>
                <li class="a-underline text_r"> <a  class="blue" onclick="common.popShow('pop_password_id')">忘记密码？</a> <a  class="blue" onclick="common.popShow('pop_register_id')">立即注册</a></li>
                <li><input type="button" value="登陆"  class="long-btn bg_4ca6ff cfff "/></li>
                <li class="clearfix p_t10">
                    <div class="left">
                        <p class="c999 p_b20">或使用以下方式登录：<p>
                            <a><img src="img/public/qq.png"></a>
                            <a><img src="img/public/weixin.png"></a>
                    </div>
                    <div class="right">
                        <img src="img/public/l_code.png">
                        <p class="text_c">官方微信<p>
                    </div>
                </li>
            </ul>
        </div>

        <div class="pop"  style="display:none;"  id="pop_register_id">
            <h4 class="bg_f4f4f3"><a class="p_close right m_t5" onclick="common.popHide('pop_register_id')"></a><span class="m_block"></span>账号注册</h4>
            <ul class="register_form left m_t20" >
                <li><span class="label">用户类型</span>  <input type="checkbox" value="" /><span class="c666">个人会员</span>  <input type="checkbox" value="" /><span class="c666">企业会员</span></li>
                <li><span class="label">账号</span><input type="text" value="" class="f_text" placeholder="输入邮箱"/></li>
                <li><span class="label">密码</span><input type="password" value=""  class="f_text" placeholder="输入6-12个字符，字母区分大小写"//></li>
                <li><span class="label">确认密码</span><input type="password" value="" class="f_text" placeholder="请再次输入密码"//></li>
                <li><span class="label">验证码</span><input type="text" value=""  class="f_text" placeholder="输入下面验证码，不区分大小写"//></li>
                <li class="a-underline"><span class="label">&nbsp;</span><img src="img/public/c_code.png" /> <a href="" class="blue">看不清，换一张</a></li>
                <li><span class="label">&nbsp;</span><input type="button" value="注册"  class="long-btn bg_4ca6ff cfff"/></li>
                <li class="c666 "><span class="label">&nbsp;</span><input type="checkbox" value="" />阅读并接受<a class="blue" >《搜景观注册协议》</a>和<a class="blue">《隐私权相关政策》</a></li>
            </ul>

            <div class="right  borderline p_40 m_t50 m_r100 p_b20">
                <img src="img/public/code.png" />
                <p class="m_t10 c999 text_c">搜景观官方微信</p>
            </div>
        </div>


        <div class="top_nav ">
            <div class="wrap clearfix c999">
                <div class="left">只做最专业的景观行业搜索平台！合作热线：0755-12345678</div>
                <div class="right a_l20"><span id="top_info"></span>   <a class="pop_login" onclick="common.popShow('pop_login_id')">登陆</a>   <a>退出</a></div>
            </div>
        </div>	

        <div class="query wrap p_t50 clearfix">
            <img src="img/public/big_logo.png"  class="left"/>
            <div class="left m_l90 query">
                <select class="q_btn f14" style="margin-left:-45px; margin-right:-10px;" >
                    <option>精品图片</option>
                    <option>精品项目</option>
                    <option>知名企业</option>
                    <option>景观精英</option>
                </select>
                <input type="text" value="" class="q_text f14" placeholder="请输入关键字"/><input type="submit" value="搜索" class="q_btn f14 " />
            </div>
            <input type="button" value="我要加入" class="m_l30 btn f14 btn-gray c999" />
        </div>
        <div class="wrap p_t10 a-underline  c999 a_r10 ">
            <span class="query-hot-key">
                热门搜索：<a>居住区</a>  <a>屋顶花园  <a>别墅庭院</a>  <a>公园</a>  <a>招牌</a>
            </span>
        </div>

        <div class="nav m_t35 m_b30">
            <div class="wrap c333 f14">
                <a href="boutique-image-list-1.html">精品图片</a>
                <a href="boutique-project-list-2.html">精品项目</a>
                <a href="famous-enterprise.html">知名企业</a>
                <a href="landscape-elite.html">景观精英</a>
                <a href="project-cooperation.html">项目合作</a>
                <a href="job.html">找工作</a>
                <a href="talent.html">聘人才</a>
                <a href="active.html">行业活动</a>
                <a class="active" href="new.html">行业新闻</a>
            </div>
        </div>


        <?php echo $content; ?>


    </body>

</html>