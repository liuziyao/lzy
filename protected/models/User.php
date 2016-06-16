<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $mobile
 * @property string $password
 * @property integer $user_type
 * @property string $qq
 * @property string $wechat
 * @property string $fax
 * @property string $avatar
 * @property string $realname
 * @property string $nickname
 * @property string $birthday
 * @property integer $gender
 * @property integer $login_num
 * @property integer $last_login
 * @property string $last_ip
 * @property string $reg_ip
 * @property string $work_area_code
 * @property string $work_area_name
 * @property string $work_address
 * @property string $personal_signature
 * @property string $user_private
 * @property integer $is_vip
 * @property integer $company_id
 * @property string $refuse_friend_list
 * @property integer $fans_count
 * @property integer $view_count
 * @property integer $view_home_count
 * @property integer $fav_home_count
 * @property integer $fav_count
 * @property integer $zuopin_count
 * @property string $ukw_type_ids
 * @property string $ukw_type_values
 * @property string $ukw_style_ids
 * @property string $ukw_style_values
 * @property string $ukw_major_ids
 * @property string $ukw_major_values
 * @property string $ukw_project_ids
 * @property string $ukw_project_values
 * @property integer $jb_year
 * @property string $website_module_ids
 * @property integer $point
 * @property integer $approve_state
 * @property integer $created
 * @property integer $vip_expire_time
 * @property integer $vip_apply_state
 * @property integer $sorting
 */
class User extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('email', 'email', 'on' => 'reg,send,admin_reg', 'allowEmpty' => true, 'message' => '邮箱格式错误'),
            array('personal_signature, user_private, website_module_ids', 'required'),
            array('user_type, gender, login_num, last_login, is_vip, company_id, fans_count, view_count, view_home_count, fav_home_count, fav_count, zuopin_count, jb_year, point, approve_state, created, vip_expire_time, vip_apply_state, sorting', 'numerical', 'integerOnly' => true),
            array('username, nickname, work_area_name', 'length', 'max' => 64),
            array('email, password, work_area_code', 'length', 'max' => 32),
            array('mobile, qq, fax, realname, last_ip, reg_ip', 'length', 'max' => 16),
            array('wechat, work_address', 'length', 'max' => 256),
            array('avatar, ukw_type_ids, ukw_style_ids, ukw_major_ids, ukw_project_ids', 'length', 'max' => 128),
            array('birthday', 'length', 'max' => 8),
            array('ukw_type_values, ukw_style_values, ukw_major_values, ukw_project_values', 'length', 'max' => 512),
            array('refuse_friend_list', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, username, email, mobile, password, user_type, qq, wechat, fax, avatar, realname, nickname, birthday, gender, login_num, last_login, last_ip, reg_ip, work_area_code, work_area_name, work_address, personal_signature, user_private, is_vip, company_id, refuse_friend_list, fans_count, view_count, view_home_count, fav_home_count, fav_count, zuopin_count, ukw_type_ids, ukw_type_values, ukw_style_ids, ukw_style_values, ukw_major_ids, ukw_major_values, ukw_project_ids, ukw_project_values, jb_year, website_module_ids, point, approve_state, created, vip_expire_time, vip_apply_state, sorting', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'username' => '用户名',
            'email' => '邮箱',
            'mobile' => '手机',
            'password' => '密码',
            'user_type' => '0普通，1企业',
            'qq' => 'qq',
            'wechat' => '微信二维码',
            'fax' => '传真',
            'avatar' => '头像',
            'realname' => '真实姓名',
            'nickname' => '昵称',
            'birthday' => '出生年月',
            'gender' => '0保密，1男，2女',
            'login_num' => '登录次数',
            'last_login' => '上次登录时间',
            'last_ip' => '上次登录IP',
            'reg_ip' => '注册IP',
            'work_area_code' => '工作地点',
            'work_area_name' => '工作地点',
            'work_address' => '工作地址',
            'personal_signature' => '个性签名',
            'user_private' => '用户对外权限',
            'is_vip' => '是否是VIP',
            'company_id' => '公司id',
            'refuse_friend_list' => '拒绝好友申请的会员ID',
            'fans_count' => '关注量',
            'view_count' => '官网浏览量',
            'view_home_count' => '个人主页浏览量',
            'fav_home_count' => '个人主页搜藏量',
            'fav_count' => '个人主页浏览量',
            'zuopin_count' => '作品数量',
            'ukw_type_ids' => '企业或者精英类别',
            'ukw_type_values' => 'Ukw Type Values',
            'ukw_style_ids' => '擅长风格',
            'ukw_style_values' => 'Ukw Style Values',
            'ukw_major_ids' => '擅长专业',
            'ukw_major_values' => 'Ukw Major Values',
            'ukw_project_ids' => '擅长项目',
            'ukw_project_values' => 'Ukw Project Values',
            'jb_year' => '工作年限',
            'website_module_ids' => '开启模块',
            'point' => '会员积分',
            'approve_state' => '状态：-2-已删除 -1-审核未通过 0-审核中 1-审核通过',
            'created' => '注册时间',
            'vip_expire_time' => 'vip过期时间',
            'vip_apply_state' => 'vip申请状态 0-未申请 1-已申请',
            'sorting' => '积分',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('mobile', $this->mobile, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('user_type', $this->user_type);
        $criteria->compare('qq', $this->qq, true);
        $criteria->compare('wechat', $this->wechat, true);
        $criteria->compare('fax', $this->fax, true);
        $criteria->compare('avatar', $this->avatar, true);
        $criteria->compare('realname', $this->realname, true);
        $criteria->compare('nickname', $this->nickname, true);
        $criteria->compare('birthday', $this->birthday, true);
        $criteria->compare('gender', $this->gender);
        $criteria->compare('login_num', $this->login_num);
        $criteria->compare('last_login', $this->last_login);
        $criteria->compare('last_ip', $this->last_ip, true);
        $criteria->compare('reg_ip', $this->reg_ip, true);
        $criteria->compare('work_area_code', $this->work_area_code, true);
        $criteria->compare('work_area_name', $this->work_area_name, true);
        $criteria->compare('work_address', $this->work_address, true);
        $criteria->compare('personal_signature', $this->personal_signature, true);
        $criteria->compare('user_private', $this->user_private, true);
        $criteria->compare('is_vip', $this->is_vip);
        $criteria->compare('company_id', $this->company_id);
        $criteria->compare('refuse_friend_list', $this->refuse_friend_list, true);
        $criteria->compare('fans_count', $this->fans_count);
        $criteria->compare('view_count', $this->view_count);
        $criteria->compare('view_home_count', $this->view_home_count);
        $criteria->compare('fav_home_count', $this->fav_home_count);
        $criteria->compare('fav_count', $this->fav_count);
        $criteria->compare('zuopin_count', $this->zuopin_count);
        $criteria->compare('ukw_type_ids', $this->ukw_type_ids, true);
        $criteria->compare('ukw_type_values', $this->ukw_type_values, true);
        $criteria->compare('ukw_style_ids', $this->ukw_style_ids, true);
        $criteria->compare('ukw_style_values', $this->ukw_style_values, true);
        $criteria->compare('ukw_major_ids', $this->ukw_major_ids, true);
        $criteria->compare('ukw_major_values', $this->ukw_major_values, true);
        $criteria->compare('ukw_project_ids', $this->ukw_project_ids, true);
        $criteria->compare('ukw_project_values', $this->ukw_project_values, true);
        $criteria->compare('jb_year', $this->jb_year);
        $criteria->compare('website_module_ids', $this->website_module_ids, true);
        $criteria->compare('point', $this->point);
        $criteria->compare('approve_state', $this->approve_state);
        $criteria->compare('created', $this->created);
        $criteria->compare('vip_expire_time', $this->vip_expire_time);
        $criteria->compare('vip_apply_state', $this->vip_apply_state);
        $criteria->compare('sorting', $this->sorting);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
