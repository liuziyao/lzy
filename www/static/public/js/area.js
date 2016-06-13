/* 地区选择函数 */
function regionInit(divId, selected_code, show_CBD, callback, is_admin,first_name) {
    var resource_site_url = "/static/public";
	if (typeof(show_CBD) == 'undefined' || show_CBD == null || show_CBD === '') show_CBD = true; //是否显示商圈级别
	if (typeof(selected_code) == 'undefined' || selected_code == null || selected_code == '') selected_code = '101'; //选中值
	if (typeof(is_admin) == 'undefined' || is_admin == null || is_admin === '') is_admin = false; //是否后台调用
	if (typeof(callback) == 'undefined' || callback == null || callback === '') callback = function() {}; //回调函数
	//加入三个隐藏域，area_code[地区码]，area_name[地区名]，area_names[全名]
	$("#" + divId).append('<input type="hidden" class="select_area_code" value="' + selected_code + '" name="' + divId + '_area_code" id="' + divId + '_area_code" />');
	$("#" + divId).append('<input type="hidden" class="select_area_names" value="" name="' + divId + '_area_names" id="' + divId + '_area_names" />');
	$("#" + divId).append('<input type="hidden" class="select_area_name" value="" name="' + divId + '_area_name" id="' + divId + '_area_name" />');
	if (is_admin) { //后台做异步请求
		areaInit($("#" + divId), selected_code, show_CBD, callback, 1, is_admin);
	} else { //前台不做异步请求
		$.getScript(resource_site_url+"/js/area_data.js", function() {
			if (show_CBD) {
				$.getScript(resource_site_url+"/js/area_data_cbd.js", function() {
					areaFrontInit($("#" + divId), selected_code, show_CBD, callback, first_name);
				});
			} else {
				areaFrontInit($("#" + divId), selected_code, show_CBD, callback, first_name);
			}
		});
	}
}

//前台地区控件
function areaFrontInit(divId, selected_code, show_CBD, callback,first_name) { //初始化地区
	var depth = $(divId).children('select').length + 2;
	var citys = null,
		countys = null,
		cbds = null;
	if (depth == 2) {
		var select;
		select = $('<select class="'+$(divId).attr('id')+' input-inline form-control"></select>');
                if(first_name == undefined){
                    select.append("<option value='101'>-请选择-</option>");
                }else{
                    select.append("<option value='101'>"+first_name+"</option>");
                }
		$(divId).append(select);
		var selectFlag = '',
			reg = '';
		for (var key in areaProvince) {
			reg = eval('/^' + key + '\\d*/');
			if (reg.test(selected_code)) {
				citys = areaCity[key];
				selectFlag = " selected='true'";
				$(divId).children('.select_area_names').val(areaProvince[key]);
				$(divId).children('.select_area_name').val(areaProvince[key]);
			} else {
				selectFlag = "";
			}
			select.append("<option" + selectFlag + " value='" + key + "'>" + areaProvince[key] + "</option>");
		}
		select.change(function() {
			regionChange(this, show_CBD, callback, 0)
		});
	} else {
		citys = areaCity[selected_code];
	}
	if (citys != null) {
		var select;
		select = $('<select class="'+$(divId).attr('id')+' input-inline form-control"></select>');
		select.append("<option value='101'>-请选择-</option>");
		$(divId).append(select);
		for (var k in citys) {
			reg = eval('/^' + k + '\\d*/');
			if (reg.test(selected_code)) {
				countys = areaCounty[k];
				selectFlag = " selected='true'";
				$(divId).children('.select_area_names').val($(divId).children('.select_area_names').val()+"\t"+citys[k]);
				$(divId).children('.select_area_name').val(citys[k]);
			} else {
				selectFlag = "";
			}
			select.append("<option" + selectFlag + " value='" + k + "'>" + citys[k] + "</option>");
		}
		select.change(function() {
			regionChange(this, show_CBD, callback, 0)
		});

	} else {
		countys = areaCounty[selected_code];
	}
	if (countys != null) {
		var select;
		select = $('<select class="'+$(divId).attr('id')+' input-inline form-control" value="101"></select>');
		select.append("<option>-请选择-</option>");
		$(divId).append(select);
		for (var k in countys) {
			reg = eval('/^' + k + '\\d*/');
			if (reg.test(selected_code)) {
				if (show_CBD) {
					cbds = areaCbd[k];
				}
				selectFlag = " selected='true'";
				$(divId).children('.select_area_names').val($(divId).children('.select_area_names').val()+"\t"+countys[k]);
				$(divId).children('.select_area_name').val(countys[k]);
			} else {
				selectFlag = "";
			}
			select.append("<option" + selectFlag + " value='" + k + "'>" + countys[k] + "</option>");
		}
		select.change(function() {
			regionChange(this, show_CBD, callback, 0)
		});
	} else {
		if (show_CBD) {
			cbds = areaCbd[selected_code];
		}
	}

	if (show_CBD && cbds != null) {
		var select;
		select = $('<select class="'+$(divId).attr('id')+' input-inline form-control" value="101"></select>');
		select.append("<option>-请选择-</option>");
		$(divId).append(select);
		for (var k in cbds) {
			reg = eval('/^' + k + '\\d*/');
			if (reg.test(selected_code)) {
				selectFlag = " selected='true'";
				$(divId).children('.select_area_names').val($(divId).children('.select_area_names').val()+"\t"+cbds[k]);
				$(divId).children('.select_area_name').val(cbds[k]);
			} else {
				selectFlag = "";
			}
			select.append("<option" + selectFlag + " value='" + k + "'>" + cbds[k] + "</option>");
		}
		select.change(function() {
			regionChange(this, show_CBD, callback, 0)
		});
	}
	return select;
}

//后台地区控件
function areaInit(divId, selected_code, show_CBD, callback, is_admin) { //初始化地区
	var url = is_admin ? "?act=common&op=getJsUserArea" : "?act=area&op=getJSArea";
	var load = $('<span id="preLoadArea">地区列表加载中...</span>');
	$(divId).append(load);
	$.ajax({
		type: "GET",
		url: url,
		dataType: 'script',
		async: true,
		success: function(data) {
			eval(data);
			areaFrontInit(divId, selected_code, show_CBD, callback);
			load.hide();
		} //end success
	});
}

function regionChange(_this, show_CBD, callback, is_admin) {
	_this = $(_this);
	// 删除后面的select
	_this.nextAll("select").remove();
	// 计算当前选中到id和拼起来的name
	var selects = _this.siblings("select").andSelf();
	var id = '';
	var names = new Array();
	for (i = 0; i < selects.length; i++) {
		sel = selects[i];
		if (sel.value > 0) {
			id = sel.value;
			name = sel.options[sel.selectedIndex].text;
			names.push(name);
		}
	}
	_this.siblings(".select_area_code").val(id);
	_this.siblings(".select_area_name").val(name);
	_this.siblings(".select_area_names").val(names.join("\t"));
	if (!show_CBD && (/^(101101|101102|101103|101104)\d{3,20}$/.test(_this.val()) || _this.prevAll('select').length >= 2)) {
		callback();
		return true;
	}
	if (_this.val() > 0) { //下级地区
		var selected_code = _this.val();
		if (is_admin) {
			areaInit(_this.parent(), selected_code, show_CBD, callback, 0, is_admin); //初始化地区
		} else {
			areaFrontInit(_this.parent(), selected_code, show_CBD, callback); //初始化地区
		}
	}
	callback();
	_this.trigger("u-change");

};
/**
 * [initArea 添加选择城市公共函数]
 * @param  {[type]} area        [按字母排列的城市json对象]
 * @param  {[type]} bindDom     [需要绑定的dom节点]
 * @param  {[type]} selectAreas [已选择的城市]
 * @return {[type]}             [无返回]
 */
function initArea(area, bindDom, selectAreas) {
	var i = 0,
		j, alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ",
		areastr, areaArr = [],
		areas, selectArea = [];
	$("body").append('<div id="a_area" style="display:none">' +
		'<div>' +
		'<h3>己选城市</h3>' +
		'<div id="select_area"></div>' +
		'<button id="select_cancel">取消</button>' +
		'<button id="select_ok">确定</button>' +
		'</div>' +
		'<h3>主要城市</h3>' +
		'<ul id="areaList">' +
		'<li class="areaList"><ul id="areaList1"></ul></li>' +
		'<li class="areaList"><ul id="areaList2"></ul></li>' +
		'</ul>' +
		'</div>');
	areaArr.push('<li><span class="alpha">&nbsp;</span><a class="area-name" id="area_code_101" data-code="101" data-name="全国">全国</a></li>');
	for (; i < 26; i++) {
		areas = area[alphabet.charAt(i)] ? area[alphabet.charAt(i)] : 0;
		if (areas) {
			areastr = '';
			areastr += '<li><span class="alpha">' + alphabet.charAt(i) + '</span><span class="city">';
			for (j = 0; j < areas.length; j++) {
				areastr += '<a class="area-name" data-code="' + areas[j]["area_code"] + '" data-name="' + areas[j]["site_name"].replace(/^\s*|\s*$/g, "") + '">' +
					areas[j]["site_name"].replace(/^\s*|\s*$/g, "") + '</a>';
			}
			areastr += '</span></li>';
			areaArr.push(areastr);
		}
	}
	$("#areaList1").append(areaArr.slice(0, 12).join(""));
	$("#areaList2").append(areaArr.slice(12).join(""));
	if (selectAreas) {
		for (i = 0; i < selectAreas.length; i++) {
			$("#select_area").append($("a[data-code=" + selectAreas[i] + "]").clone());
			selectArea.push("" + selectAreas[i]);
		}
	}
	$("#areaList").on("click", function(e) {
		var tar = e.target || e.srcElement,
			cityLength = initArea.cityLength ? initArea.cityLength : 5;
		if (tar.nodeName == "A") {
			if (selectArea.length >= cityLength) {
				alert("最多选择" + cityLength + "个城市!");
				return false;
			}
			if ($.inArray($(tar).attr("data-code"), selectArea) != -1) {
				alert("该城市己选择!");
				return false;
			} else {
				selectArea.push($(tar).attr("data-code"));
			}
			$("#select_area").append('<li>' + tar.outerHTML);
		}
	});
	$("#select_area").on("click", function(e) {
		var target = e.target || e.srcElement;
		if (target.nodeName == "A") {
			$(target).remove();
		}
		selectArea.splice($.inArray($(this).attr("data-code")), 1);
	});
	$("#select_cancel").on("click", function() {
		$("#a_area").hide();
	});
	$(bindDom).click(function() {
		$("#a_area").show();
	});
	$("#select_ok").on("click", function() {
		$("input[name=area_code]").val(
			$("#select_area .area-name").map(function() {
				return $(this).attr("data-code");
			}).get().join(","));
		$(bindDom).val(
			$("#select_area .area-name").map(function() {
				return $(this).attr("data-name");
			}).get().join(" "))
		$("#a_area").hide();
	});
}


