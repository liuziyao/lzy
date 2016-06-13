function change_code(obj){
	$("#verify").attr("src",varifyURL+'/'+Math.random());
	return false;
}
//登录验证  1为空   2为错误
var validate={Admin_Name:1,Password:1,verify:1}
$(function(){
	$("#login").submit(function(){
		if(validate.Admin_Name==0 && validate.Password==0 && validate.verify==0){
			return true;
		}
		//验证用户名
		$("input[name='Admin_Name']").trigger("blur");
		//验证密码
		$("input[name='Password']").trigger("blur");
		//验证验证码
		$("input[name='verify']").trigger("blur");
		return false;
	})
})
$(function(){
	//验证用户名
	$("input[name='Admin_Name']").blur(function(){
		var Admin_Name = $("input[name='Admin_Name']");
		if(Admin_Name.val().trim()==''){
			Admin_Name.parent().find("span").remove().end().append("<span class='error'>用户名不能为空</span>");
			return ;
		}
		$.post(CONTROL+"/checkAdmin_Name",{Admin_Name:Admin_Name.val().trim()},function(stat){
			if(stat==1){
				validate.Admin_Name=0;
				Admin_Name.parent().find("span").remove();
			}else{
				Admin_Name.parent().find("span").remove().end().append("<span class='error'>用户不存在</span>");
			}

		})
	})
	//验证密码
	$("input[name='Password']").blur(function(){
		var Password = $("input[name='Password']");
		var Admin_Name=$("input[name='Admin_Name']");
		if(Admin_Name.val().trim()==''){
			return;
		}
		if(Password.val().trim()==''){
			Password.parent().find("span").remove().end().append("<span class='error'>密码不能为空</span>");
			return ;
		}
		$.post(CONTROL+"/checkpassword",{Password:Password.val().trim(),Admin_Name:Admin_Name.val().trim()},function(stat){
			if(stat==1){
				validate.Password=0;
				Password.parent().find("span").remove();
			}else{
				Password.parent().find("span").remove().end().append("<span class='error'>密码错误</span>");
			}

		})
	})
	//验证验证码
	$("input[name='verify']").blur(function(){
		var verify = $("input[name='verify']");
		if(verify.val().trim()==''){
			verify.parent().find("span").remove().end().append("<span class='error'>验证码不能为空</span>");
			return ;
		}
		$.post(CONTROL+"/checkcode",{verify:verify.val().trim()},function(stat){
			if(stat==1){
				validate.verify=0;
				verify.parent().find("span").remove();
			}else{
				verify.parent().find("span").remove().end().append("<span class='error'>验证码错误</span>");
			}

		})
	})
})

