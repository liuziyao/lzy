<?php

class News extends CActiveRecord {

    public function getKv($key = "") {
        $return = array(
            '0' => '隐藏',
            '1' => '显示'
        );
        if (key_exists($key, $return)) {
            return $return[$key];
        }
        return $return;
    }

    public function getNewsCategory() {
        $newscategory = NewsCategory::model()->findAll();
        $cate = array();
        if ($newscategory) {
            foreach ($newscategory as $v) {
                $cate[$v->id] = $v->name;
            }
        }
        return $cate;
    }

    public function getUserName() {
        $username = User::model()->findAll();
        $name = array();
        if ($username) {
            foreach ($username as $v) {
                $name[$v->id] = $v->username;
            }
        }
        return $name;
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'news';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('content', 'required'),
            array('sorting, user_id, admin_id, cat_id, status, approve_state, fav_count, view_count, eval_count, like_count, dislike_count, created', 'numerical', 'integerOnly' => true),
            array('title, image', 'length', 'max' => 128),
            array('user_name, admin_name, origin', 'length', 'max' => 64),
            array('theme_ids, active_ids, cp_category_ids', 'length', 'max' => 512),
            array('headline', 'length', 'max' => 256),
            array('original_author, tag, tab, area_code, source', 'length', 'max' => 32),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, sorting, user_id, user_name, admin_id, admin_name, cat_id, theme_ids, active_ids, cp_category_ids, headline, image, content, status, origin, original_author, tag, approve_state, fav_count, view_count, eval_count, like_count, dislike_count, tab, created, area_code, source', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
         return array(
            'category' => array(self::BELONGS_TO, 'NewsCategory', 'cat_id'),
            'user'=>array(self::BELONGS_TO,'User','user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => '标题',
            'sorting' => '排序',
            'user_id' => '会员ID',
            'user_name' => '用户名称',
            'admin_id' => 'Admin',
            'admin_name' => '审核管理员',
            'cat_id' => '分类ID',
            'theme_ids' => '相关专题',
            'active_ids' => '相关活动',
            'cp_category_ids' => '相关企业',
            'headline' => '摘要',
            'image' => '封面图',
            'content' => '新闻内容',
            'status' => '状态',
            'origin' => '来源地址',
            'original_author' => '原作者',
            'tag' => '聚合标签',
            'approve_state' => '审核状态',
            'fav_count' => '收藏量',
            'view_count' => '浏览量',
            'eval_count' => '评论量',
            'like_count' => '爱看',
            'dislike_count' => '不爱看',
            'tab' => 'Tab',
            'created' => '发布时间',
            'area_code' => '新闻地点',
            'source' => '新闻来源',
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
        $criteria->compare('title', $this->title, true);
        $criteria->compare('sorting', $this->sorting);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('user_name', $this->user_name, true);
        $criteria->compare('admin_id', $this->admin_id);
        $criteria->compare('admin_name', $this->admin_name, true);
        $criteria->compare('cat_id', $this->cat_id);
        $criteria->compare('theme_ids', $this->theme_ids, true);
        $criteria->compare('active_ids', $this->active_ids, true);
        $criteria->compare('cp_category_ids', $this->cp_category_ids, true);
        $criteria->compare('headline', $this->headline, true);
        $criteria->compare('image', $this->image, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('origin', $this->origin, true);
        $criteria->compare('original_author', $this->original_author, true);
        $criteria->compare('tag', $this->tag, true);
        $criteria->compare('approve_state', $this->approve_state);
        $criteria->compare('fav_count', $this->fav_count);
        $criteria->compare('view_count', $this->view_count);
        $criteria->compare('eval_count', $this->eval_count);
        $criteria->compare('like_count', $this->like_count);
        $criteria->compare('dislike_count', $this->dislike_count);
        $criteria->compare('tab', $this->tab, true);
        $criteria->compare('created', $this->created);
        $criteria->compare('area_code', $this->area_code, true);
        $criteria->compare('source', $this->source, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return News the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function getList(){
        $criteria = new CDbCriteria();
        $criteria->with = array('user');
        $criteria->compare('user.approve_state', 1);
        return $model = News::model()->findAll($criteria);
    }

}
