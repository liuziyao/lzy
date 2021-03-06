<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SojgTool
 *
 * @author Administrator
 */
class SojgTool {
 
    public static function getUserType($key = '', $gettype = '') {

        if ($gettype == 'project_cooperation') {
            $return = $return = array(
                -1 => '全部',
                0 => '个人会员',
                1 => '企业会员',
            );
        } else {
            $return = array(
                0 => '个人会员',
                1 => '企业会员',
            );
        }
        if ($key !== '' && key_exists($key, $return)) {
            return $return[$key];
        }
        return $return;
    }

    /**
     * json格式
     * @param type $status
     * @param type $message
     * @param type $data
     * @param type $isJson
     * @return type
     */
    public static function handleResult($status, $message, $data = array(), $isJson = true) {
        $return = array(
            'status' => $status,
            'message' => $message,
            'data' => $data
        );
        if ($isJson) {
            $return = json_encode($return);
        }
        exit($return);
    }

    /**
     * 获取数据是否公开的共用数组
     * @param type $key
     * @return string
     */
    public static function getIsPrivate($key = '') {
        $data = array(
            1 => '公开',
            0 => '不公开',
        );
        if ($key !== '' && key_exists($key, $data)) {
            return $data[$key];
        }
        return $data;
    }

    /**
     * 获取是否公开的select
     * @param type $name
     * @param type $class
     */
    public static function getIsPrivateIsSelected($name, $user_private, $class = 'input-inline form-control') {
        $html = "<select name='$name' class='" . $class . "'>";
        $selected = 1;
        if ($user_private && key_exists($name, $user_private)) {
            $selected = $user_private[$name];
        }
        $data = self::getIsPrivate();
        foreach ($data as $k => $v) {
            if ($k == $selected) {
                $html .= "<option value='$k' selected='selected'>$v</option>";
            } else {
                $html .= "<option value='$k'>$v</option>";
            }
        }
        $html .= "</select>";
        return $html;
    }

    /**
     * 获取用户性别
     * @param type $key
     * @return string
     */
    public static function getGender($key = '', $type = '') {
        $data = array(
            0 => '保密',
            1 => '男',
            2 => '女',
        );
        if ($type == 'job') {
            $data[0] = '全部';
        }
        if ($key !== '' && key_exists($key, $data)) {
            return $data[$key];
        }
        return $data;
    }

    /**
     * 获取行业
     */
    public static function getNewsTag($key = '') {
        $data = array(
            1 => '原创',
            2 => '热点',
            4 => '组图',
            8 => '爆料',
            16 => '头条',
            32 => '幻灯',
            64 => '滚动',
            128 => '推荐',
        );
        if ($key != '') {
            $return = array();
            foreach (array_reverse($data, true) as $k => $v) {
                if ($key <= 0) {
                    return $return;
                }
                if ($k <= $key) {
                    $return[$k] = $v;
                    $key = $key - $k;
                }
            }
            return $return;
        }
        return $data;
    }

    /**
     * 获取审核结果
     * @param type $key
     * @return string
     */
    public static function getApproveState($key = '') {
        $data = array(
            -2 => '已删除',
            -1 => '审核不通过',
            0 => '审核中',
            1 => '审核通过',
        );
        if ($key !== '' && key_exists($key, $data)) {
            return $data[$key];
        }
        return $data;
    }

    /**
     * 参与活动必要资料
     * @param type $key
     * @return string|array
     */
    public static function getActiveNecessary($key = '') {
        $data = array(
            1 => '真实姓名',
            2 => '性别',
            4 => '手机',
            8 => '证件类型',
            16 => '证件号',
            32 => '居住地',
            64 => 'qq',
        );
        if ($key != '') {
            $return = array();
            foreach (array_reverse($data, true) as $k => $v) {
                if ($key <= 0) {
                    return $return;
                }
                if ($k <= $key) {
                    $return[$k] = $v;
                    $key = $key - $k;
                }
            }
            return $return;
        }
        return $data;
    }

    /**
     * 取无限级
     */
    public static $unlimit_data = array();

    public static function getUnlimit($model) {
        //print_r($model);exit;
        $data = array();
        if ($model) {
            foreach ($model as $k => $v) {
                $data[$v->id] = $v->name;
                if ($v->pid == 0) {
                    self::$unlimit_data[$v->id]['name'] = $v->name;
                } else {
                    if (!isset(self::$unlimit_data[$v->pid]['sub']) || !self::$unlimit_data[$v->pid]['sub']) {
                        self::$unlimit_data[$v->pid]['sub']['all_' . $v->pid] = '全部';
                    }
                    self::$unlimit_data[$v->pid]['sub'][$v->id] = $v->name;
                }
            }
        }
        $return = self::$unlimit_data;
        self::$unlimit_data = array();
        return array('unlimit_data' => $return, 'data' => $data);
    }

    /**
     * 
     * @param type $key
     * @param type $gettype job职位要求的婚姻状态
     * @return string
     */
    public static function getMariStatus($key = '', $gettype = '') {
        $data = array(
            0 => $gettype == 'job' ? '全部' : '',
            1 => '未婚',
            2 => '已婚',
            3 => '离婚',
        );
        if ($key !== '' && key_exists($key, $data)) {
            return $data[$key];
        }
        return $data;
    }

    /**
     * 获取个人简历内容
     * @param type $key
     */
    public static function getCollectContentName($key = '') {
        $data = array(
            'education' => '教育经历',
            'school' => '校内经历',
            'work' => '工作经历',
            'project' => '项目经历',
            'prize' => '获奖情况',
            'speciality' => '个人技能',
            'evaluate' => '自我评价',
        );
        if ($key !== '' && key_exists($key, $data)) {
            return $data[$key];
        }
        return $data;
    }

    /**
     * 获取学历信息
     */
    public static function getDegree($key = '', $type = '') {
        $data = array(
            0 => $type == 'front' ? '请选择学历' : '无',
            1 => '高中',
            2 => '中专',
            3 => '大专',
            4 => '本科',
            5 => '硕士',
            6 => '博士',
        );
        if ($key !== '' && key_exists($key, $data)) {
            return $data[$key];
        }
        return $data;
    }

    public static function getResumeIsOpen($key = '') {
        $data = array(
            0 => '保密',
            1 => '公开',
        );
        if ($key !== '' && key_exists($key, $data)) {
            return $data[$key];
        }
        return $data;
    }

    /**
     * 获取年龄
     * @param type $birthday 出生日期时间戳
     */
    public static function getAge($birthday = 0) {
        if ($birthday > time()) {
            return '';
        }
        return intval(date('Y-m-d', time())) - intval(date('Y-m-d', $birthday));
    }

    /**
     * 获取用户头像
     * @param type $member_id
     * @return string
     */
    public static function getUserAvatar($member_id) {
        if (!$member_id)
            return '/static/public/images/avatar_default.jpg';
        $avatar_path = dirname(Yii::app()->basePath) . '/www/upload/avatar/avatar_' . $member_id . '.jpg';
        //echo $avatar_path;
        if (is_file($avatar_path)) {
            return '/upload/avatar/avatar_' . $member_id . '.jpg';
        } else {
            return '/static/public/images/avatar_default.jpg';
        }
    }

    /**
     * 自定义工资 或者 列表工资
     * @param type $key 
     * @return string
     */
    public static function getSalaryRange($key = '') {
        $data = array(
            1 => '4.5万(月均3.5K)以下',
            2 => '4.5-8万(月均3.5-6K)',
            3 => '8-11万(月均6-9K)',
            4 => '11-15万(月均9-12K)',
            5 => '15-18万(月均12-15K)',
            6 => '18-25万(月均15-20K)',
            7 => '25-40万(月均20-30K)',
            8 => '40万以上',
        );
        if ($key !== '') {
            return key_exists($key, $data) ? $data[$key] : $key;
        }
        return $data;
    }

    /**
     * 排序工资字段
     * @param type $key
     */
    public static function getOrderSalary($key = '') {
        if (!is_numeric($key) || $key == 0) {
            return 0;
        }
        $arr = self::getSalaryRange();
        if (!in_array($key, $arr)) {
            return $key;
        }
        if (strpos('-', $arr[$key]) !== false) {
            $temp = explode('-', $arr[$key]);
            $temp = $temp[1];
        } else {
            $temp = strpos('以上', $arr[$key]) !== false ? 999999999 : 0;
        }
        return $temp;
    }

    /**
     * 获取公司规模
     * @param type $key
     * @return string
     */
    public static function getCompanyScale($key = '') {

        $data = array(
            1 => '9人以下',
            2 => '10-29人',
            3 => '30-49人',
            4 => '50-99人',
            5 => '100-199人',
            6 => '200-499人',
            7 => '500-999人',
            8 => '1000人以上',
        );
        if ($key !== '') {
            return key_exists($key, $data) ? $data[$key] : '';
        }
        return $data;
    }

    /**
     * 获取注册资本
     * @param type $key
     * @return string
     */
    public static function getCompanyRegMoney($key = '') {

        $data = array(
            1 => '99万以下',
            2 => '100-499万',
            3 => '500-999万',
            4 => '1000-1999万',
            5 => '2000-4999万',
            6 => '5000-9999万',
            7 => '10000万以上',
        );
        if ($key !== '') {
            return key_exists($key, $data) ? $data[$key] : '';
        }
        return $data;
    }

    public static function getCompanyOrderScale($key = '') {
        $arr = self::getCompanyScale();
        if (!array_key_exists($key, $arr)) {
            return 50;
        }
        $data = array(
            1 => '50',
            2 => '100',
            3 => '500',
            4 => '2000',
            5 => '9999999999',
        );
        return $data[$key];
    }

    /**
     * 工作经验
     * @param type $key
     * @return string
     */
    public static function getWorkYear($key = '') {
        $data = array(
            1 => '一年以下',
            2 => '1-2年',
            3 => '3-5年',
            4 => '6-9年',
            5 => '10-14年',
            6 => '15年以上',
        );
        if ($key !== '') {
            return key_exists($key, $data) ? $data[$key] : '';
        }
        return $data;
    }

    /**
     * 工作状态
     * @param type $key
     * @return string
     */
    public static function getJobState($key = '') {
        $data = array(
            1 => '全职',
            2 => '找工作',
            3 => '兼职',
            4 => '顾问',
            5 => '自由从业者',
            6 => '个人工作室',
            7 => '其他',
        );
        if ($key !== '') {
            return key_exists($key, $data) ? $data[$key] : '';
        }
        return $data;
    }

    /**
     * 分包
     * @param type $key
     * @return string
     */
    public static function getIsSubcontract($key = '') {
        $data = array(0 => '否', 1 => '是');
        if ($key !== '' && key_exists($key, $data)) {
            return $data[$key];
        }
        return $data;
    }

    public static function getFriendGroup($key = '') {
        $data = array(
            1 => '我的好友',
            2 => '熟识朋友',
            3 => '同事',
            4 => '亲人',
            5 => '合作伙伴',
        );
        if ($key !== '') {
            if (key_exists($key, $data)) {
                return $data[$key];
            } else {
                return '未分组';
            }
        }
        return $data;
    }

    /**
     * 项目面积
     * @param type $key
     * @return string
     */
    public static function getMiAcreageUnit($key = '') {
        $data = array(0 => '平方米', 1 => '亩', 2 => '公顷', 3 => '平方公里');
        if ($key !== '' && key_exists($key, $data)) {
            return $data[$key];
        }
        return $data;
    }

    /**
     * 企业性质
     * @param type $key
     * @return string
     */
    public static function getCompanyType($key = '') {
        $data = array(
            1 => '外资（欧美）',
            2 => '外资（非欧美）',
            3 => '合资',
            4 => '国企',
            5 => '民营公司',
            6 => '上市公司',
            7 => '创业公司',
            8 => '外企代表处',
            9 => '政府机关',
            10 => '事业单位',
            11 => '非营利机构',
        );
        if ($key !== '') {
            return key_exists($key, $data) ? $data[$key] : '';
        }
        return $data;
    }

    /**
     * 公共标签 推荐 置顶 精华
     * @param type $key
     * @return string|array
     */
    public static function getCommonTab($key = '') {
        $data = array(
            1 => '推荐',
            2 => '置顶',
            4 => '精华',
            8 => '幻灯',
        );
        if ($key != '') {
            $return = array();
            foreach (array_reverse($data, true) as $k => $v) {
                if ($key <= 0) {
                    return $return;
                }
                if ($k <= $key) {
                    $return[$k] = $v;
                    $key = $key - $k;
                }
            }
            return $return;
        }
        return $data;
    }

    /**
     * 搜索标签
     * @param type $tab
     * @param type $type
     */
    public static function getCommonTabRelation($tab, $type = 'tab') {
        if ($type == 'tab') {
            $data = self::getCommonTab();
        } else {
            $data = self::getNewsTag();
        }
        $data = array_keys($data);
        $count = count($data);
        $return = array();
        for ($i = $count; $i >= 1; $i--) {
            $return = array_merge($return, self::getCombinationToString($data, $i, $tab));
        }
        $rtn = array($tab);
        foreach ($return as $k => $v) {
            $p = explode('-', $v);
            if (count($p) > 1) {
                if (array_search($tab, $p) !== false) {
                    $rtn[] = array_sum($p);
                }
            }
        }
        return $rtn;
    }

    /**
     * 排序算法 
     * @param type $arr
     * @param type $m
     * @return string
     */
    public static function getCombinationToString($arr, $m, $tab) {
        if ($m == 1) {
            return $arr;
        }
        $result = array();

        $tmpArr = $arr;
        unset($tmpArr[0]);
        for ($i = 0; $i < count($arr); $i++) {
            $s = $arr[$i];
            $ret = self::getCombinationToString(array_values($tmpArr), ($m - 1), $tab);
            foreach ($ret as $row) {
                if ($row > $s) {
                    $result[] = $s . '-' . $row;
                }
            }
        }

        return $result;
    }

    /**
     * 工作性质
     * @return string
     */
    public static function getJobTerm($key = '') {
        $data = array(
            1 => '全职',
            2 => '兼职',
            3 => '实习',
            4 => '全/兼职',
        );
        if ($key !== '') {
            return key_exists($key, $data) ? $data[$key] : '';
        }

        return $data;
    }

    /**
     * 联系方式
     * @param type $key
     * @return string
     */
    public static function getContactKey($key = '') {
        $data = array(
            'mobile' => '手机',
            'qq' => 'QQ',
            'email' => 'E-mail',
        );
        if ($key !== '') {
            return key_exists($key, $data) ? $data[$key] : '';
        }
        return $data;
    }

    public static function getSource() {
        $data = array(
            //1 => $key1value,
            //2 => 'VIP会员',
            3 => '全部朋友圈',
            4 => '一级朋友圈',
            5 => '二级朋友圈'
        );
        return $data;
    }

    /**
     * 朋友圈
     */
    public static function getFriendType() {
        if (Yii::app()->user->id) {
            $data = array(
                0 => '请选择朋友圈',
                2 => 'VIP会员',
                3 => '全部朋友圈',
                4 => '一级朋友圈',
                5 => '二级朋友圈'
            );
        } else {
            $data = array(
                0 => '请选择朋友圈',
                2 => 'VIP会员',
            );
        }
        return $data;
    }

    public static function getSystemArticleType($type = '') {
        $data = array(
            1 => '网站底部文章',
        );
        if (key_exists($type, $data)) {
            return $data[$type];
        }
        return $data;
    }

    /**
     * 企业年份
     * @param type $key
     * @return int
     */
    public static function getCompanyYear($key = '') {
        $data = array();
        for ($i = 1990; $i < 2025; $i++) {
            $data[] = $i;
        }
        if (key_exists($key, $data)) {
            return $data[$key];
        }
        return $data;
    }

    /**
     * 关键词筛选
     * @param type $criteria
     * @param type $kw_type 搜索的类型
     * @param type $kw_field 搜索的数据库对应字段
     * @param type $keyword
     * @return type
     */
    public static function selectKeyword($criteria, $kw_value, $kw_type = '', $kw_field = '', $keyword) {
        $like_text = "";
        if ($kw_value) {
            $selected_kw_values = array();
            if (strstr(implode(',', $kw_value), 'all')) {
                $all_value = "";
                $all_key = "";
                foreach ($kw_value as $k => $v) {
                    if (strstr($v, 'all')) {
                        $temp = explode('_', $v);
                        $all_value = $temp;
                        $all_key = $v;
                    }
                }
                $selected_kw_values = $keyword[$kw_type]['unlimit_data'][$all_value[1]]['sub'];
                unset($selected_kw_values[$all_key]);
            } else {
                foreach ($kw_value as $k => $v) {
                    $selected_kw_values[$k] = $keyword[$kw_type]['data'][$v];
                }
            }
            $i = 1;
            foreach ($selected_kw_values as $k => $v) {
                if($v == '其它'){
                    continue;
                }
                if ($i == 1) {
                    $like_text .= " $kw_field like '%$v%'";
                    //$criteria->addSearchCondition($kw_field, $v);
                } else {
                    $like_text .= " OR $kw_field like '%$v%'";
                    //$criteria->addSearchCondition($kw_field, $v, true, 'OR');
                }
                $i++;
            }
        }
        if ($like_text) {
            $criteria->addCondition($like_text);
        }
//        if ($kw_value && $kw_type == 'user_type') {
//            $criteria->compare('t.source_type', 0);
//        }
        return $criteria;
    }

    /**
     * 已筛选的关键词
     * @param type $keyword
     * @return array
     */
    public static function getFilterText($keyword, $get) {
        $filter_text = "";
        $filter_arr = array();
        unset($get['search_text']);
        unset($get['search_type']);
        if ($get) {
            if (isset($get['search_text']) && $get['search_text']) {
                //$filter_text .= "<a href='" . $this->createUrl('/image') . "'>" . $get['search_text'] . "×</a>";
            }
            foreach ($get as $k => $v) {
                if (key_exists($k, $keyword)) {
                    foreach ($v as $kk => $vv) {
                        $filter_text = "";
                        if (!strstr($vv, 'all')) {
                            $filter = $keyword[$k]['list_data'][$vv];
                            if ($filter['pid'] > 0) {
                                $filter_type = $k . '_' . $filter['pid'];
                                $filter_text = "<a href=\"javascript:no_filter_sub('{$filter_type}')\">" . $keyword[$k]['list_data'][$filter['pid']]['name'] . "×：</a>";
                                $id = "cb_{$k}_{$vv}";
                                $filter_arr[$filter_type]['top'] = $filter_text;
                                $filter_text = "<a href=\"javascript:no_filter('{$id}')\">" . $filter['name'] . "×</a> ";
                                $filter_arr[$filter_type]['sub'][] = $filter_text;
                            } else {
                                $id = "cb_{$k}_{$vv}";
                                $filter_text = "<a href=\"javascript:no_filter('{$id}')\">" . $filter['name'] . "×</a> ";
                                $filter_arr[$id] = $filter_text;
                            }
                        } else {
                            $temp = explode('_', $vv);
                            $pid = $temp[1];
                            $filter_type = $k . '_' . $pid;
                            $filter_text .= "<a href=\"javascript:no_filter_sub('{$filter_type}')\">" . $keyword[$k]['list_data'][$pid]['name'] . "：全部×</a> ";
                            $filter_arr[$filter_type] = $filter_text;
                        }
                    }
                }
            }
        }
        $filter_text = "<ul class='clearfix'>";
        if ($filter_arr) {
            foreach ($filter_arr as $k => $v) {
                $filter_text .= "<li style='border:1px solid #CCC;margin-right:5px;float:left'>";
                if (is_array($v)) {
                    $filter_text.= $v['top'];
                    $filter_text.= implode(" ", $v['sub']);
                } else {
                    $filter_text .= $v;
                }
                $filter_text .= "</li>";
            }
        }
        $filter_text .= "</ul>";
        return $filter_text;
    }

    /**
     * 个人中心和后台 项目添加关键词
     * @param type $model
     * @param type $keyword
     * @param type $input_field
     * @param type $keyword_field
     * @param type $id_field
     * @param type $value_field
     * @return type
     */
    public static function saveKeyword($model, $keyword, $input_field, $keyword_field, $id_field, $value_field, $relation_model = null, $relation_method = 'miOp') {
        $id_relation = array();
        $kw_values = array();
        if ($input_field) {
            foreach ($input_field as $k => $v) {
                if (strstr($v, 'all')) {
                    $sub_info = self::getKeywordSubByAll($v, $keyword, $keyword_field);
                    $kw_values = array_merge($kw_values, $sub_info['kw_values']);
                    $sub_key = $sub_info['sub_key'];
                    $id_relation = array_merge($id_relation, $sub_key);
                } else {
                    $kw_values[] = $keyword[$keyword_field]['data'][$v];
                    $id_relation[] = $v;
                }
            }
        }
        $model->$id_field = $input_field ? implode(',', $input_field) : "";
        $model->$value_field = $kw_values ? implode(',', $kw_values) : "";
        if ($relation_model) {
            $relation = $relation_model->$relation_method($model->id, $id_relation);
            if (!$relation['sta']) {
                throw new Exception($relation['msg']);
            }
        }
        return $model;
    }

    /**
     * 取出提交的表单中有 all_123类似字样 ，拆出来。其子id和子value
     * @param type $all
     * @param type $keyword
     * @param type $keyword_field
     * @return type
     */
    public static function getKeywordSubByAll($all, $keyword, $keyword_field) {
        $temp = explode('_', $all);
        $top_id = $temp[1];
        $kw_values = $keyword[$keyword_field]['unlimit_data'][$top_id]['sub'];
        $sub_key = array_keys($kw_values);
        array_shift($sub_key);
        return array('sub_key' => $sub_key, 'kw_values' => $kw_values);
    }

    public static function getImageResolution($img) {
        if (!$img) {
            return "0 x 0";
        }
        $absolute_url = dirname(Yii::app()->basePath) . '/www' . $img;
        if (!is_file($absolute_url)) {
            return "0 x 0";
        }
        $image_info = getimagesize($absolute_url);
        return $image_info[0] . ' x ' . $image_info[1];
    }

    public static function getImageType($k = '') {
        $return = array(
            1 => '实景照片',
            2 => '效果图',
            3 => '平面图',
            4 => '手绘图',
            5 => '立面剖面图',
            6 => '分析图'
        );
        if ($k === "") {
            return $return;
        } else {
            if (key_exists($k, $return)) {
                return $return[$k];
            } else {
                return "图片类别";
            }
        }
    }

    public static function getYear() {
        $return = array();
        $year = date('Y');
        $s_year = 1980;
        $e_year = $year;
        $return[0] = "--请选择--";
        for ($i = $s_year; $i <= $e_year; $i ++) {
            $return[$i] = $i;
        }
        return $return;
    }

    public static function getKwText($cate, $ids, $is_link = false, $nav = '', $field = '') {
        $id_arr = explode(',', $ids);
        //UtilD::printr($ids);
        $text_final = "";
        if ($id_arr) {
            $id_arr_tmp = array();
            foreach ($id_arr as $k => $v) {
                if (strstr($v, 'all')) {
                    list($all, $op_id) = explode("_", $v);
                    if (!isset($id_arr_tmp[$op_id])) {
                        $id_arr_tmp[$op_id] = array();
                    }
                    $id_arr_tmp[$op_id][] = $op_id;
                } else {
                    $top_id = key_exists($v, $cate['list_data']) ? $cate['list_data'][$v]['top_id'] : 0;
                    if ($top_id) {
                        if (!isset($id_arr_tmp[$top_id])) {
                            $id_arr_tmp[$top_id] = array();
                        }
                        $id_arr_tmp[$top_id][] = $v;
                    }
                }
            }
            foreach (array_filter($id_arr_tmp) as $k => $v) {
                $text = "";
                if (isset($v) && $v && $v[0] != $k) {
                    if ($is_link) {
                        if (key_exists($k, $cate['data']) && $cate['data'][$k]) {
                            $text .= "<a target='_blank' href='/{$nav}/index/{$field}[]/all_{$k}'>" . $cate['data'][$k] . "</a>:";
                        }
                    } else {
                        if (key_exists($k, $cate['data']) && $cate['data'][$k]) {
                            $text .= $cate['data'][$k] . ':';
                        }
                    }
                }
                foreach ($v as $kk => $vv) {
                    if ($k == $vv) {
                        if ($is_link) {
                            if (key_exists($k, $cate['data']) && $cate['data'][$k]) {
                                $text .= "<a target='_blank'  href='/{$nav}/index/{$field}[]/{$k}'>" . $cate['data'][$k] . "</a>,";
                            }
                        } else {
                            if (key_exists($k, $cate['data']) && $cate['data'][$k]) {
                                $text .= rtrim($cate['data'][$k], ';') . ';';
                            }
                        }
                    } else {
                        if ($is_link) {
                            if (key_exists($vv, $cate['data']) && $cate['data'][$vv]) {
                                $text .= "<a target='_blank' href='/{$nav}/index/{$field}[]/{$vv}' >" . $cate['data'][$vv] . "</a>,";
                                //$text .= $cate['data'][$vv].",";
                            }
                        } else {
                            if (key_exists($vv, $cate['data']) && $cate['data'][$vv]) {
                                $text .= $cate['data'][$vv] . ',';
                            }
                        }
                    }
                }
                //var_dump($text);exit;
                $text = rtrim($text, ',');
                $text = $text ? rtrim($text, ';') . ";" : "";
                //file_put_contents("D:/a.txt", $text.PHP_EOL,FILE_APPEND);
                $text_final .= $text;
            }
            $text_final = rtrim($text_final, ';');
           //     file_put_contents("D:/a.txt", $text_final.PHP_EOL,FILE_APPEND);
        }
        return $text_final;
    }

    /**
     * 获取精品项目的其他辅助企业或者会员的类别
     * @param type $key
     * @return string
     */
    public static function getMiOtherUser($key = '') {
        $data_all = UkwType::model()->getCate();
        $unlimit_data = $data_all['unlimit_data'];
        $data = array();
        foreach ($unlimit_data as $k => $v) {
            $data[$k] = $v['name'];
        }
        if ($key !== '') {
            if (key_exists($key, $data)) {
                return $data[$key];
            }
            return "";
        }
        return $data;
    }

    /**
     * 拆分用户关键词的父类和子类
     * @param type $ukw_ids
     * @return type
     */
    public static function getUserTypeTopAndSub($ukw_ids) {
        $sub = array();
        $top = array();
        $ukw_type_ids = explode(',', $ukw_ids);
        $ukw_type = UkwType::model()->getCate();
        $list_data = $ukw_type['list_data'];
        $ukw_type_ids = array_filter($ukw_type_ids);
        foreach ($ukw_type_ids as $k => $v) {
            if (!strstr($v, 'all')) {
                $top_id = key_exists($v, $list_data) ? $list_data[$v]['top_id'] : 0;
                if ($top_id == $v) {
                    $top[] = $top_id && key_exists($top_id, $list_data) ? $list_data[$top_id]['name'] : "";
                } else {
                    $top[] = $top_id && key_exists($top_id, $list_data) ? $list_data[$top_id]['name'] : "";
                    $sub[] = key_exists($v, $list_data) ? $list_data[$v]['name'] : "";
                }
            }else{
                $top_id = trim($v,'all_');
                $top[] = $top_id && key_exists($top_id, $list_data) ? $list_data[$top_id]['name'] : "";
            }
        }
        return array(
            'top' => array_unique($top),
            'sub' => array_unique($sub)
        );
    }

    public static function getUserMajorProject($ids, $cate) {
        $rtn = array();
        if ($ids) {
            $ids = explode(',', $ids);
            foreach ($ids as $k => $v) {
                if (strstr($v, "all_")) {
                    $ids[$k] = ltrim($v, 'all_');
                }
            }
            $data = $cate['data'];
            foreach ($ids as $v) {
                if (key_exists($v, $data)) {
                    $rtn[] = $data[$v];
                }
            }
            //$cate
        }
        return $rtn;
    }

    public static function setCateCache($model, $memKey) {
        $criteria = new CDbCriteria();
        $criteria->order = 'pid asc,sort asc,id desc';
        $model = $model->findAll($criteria);
        $data = SojgTool::getUnlimit($model);
        $list_data = UtilD::getUnLimitClass(UtilD::object2array($model));
        $data['list_data'] = array();
        if ($list_data) {
            foreach ($list_data as $k => $v) {
                $data['list_data'][$v['id']] = $v;
            }
        }
        Yii::app()->cache->set($memKey, $data);
        return $data;
    }
    
    //获取父类关键词
    public static function getParentKeyWord ($keyword, $input_field, $keyword_field) {
        $parent_keyword = array();
        $parent_keywords = array();
        if ($input_field) {
            foreach ($input_field as $k => $v) {
                if (strstr($v, 'all')) {
                    $parent_keyword[] = substr($v,4);
                } else {
                    $parent_keywords[] = $keyword[$keyword_field]['list_data'][$v]['top_id'];
                }
            }
            $keyword_ids = array_merge($parent_keyword,$parent_keywords);
            if($keyword_ids){
                foreach($keyword_ids as $kk=>$vv){
                    $keyword_names[] = $keyword[$keyword_field]['data'][$vv];
                }
                return $keyword_names;
            }else{
               return array(); 
            }
        }
        return array();
    }

}
