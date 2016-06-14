<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property integer $id
 * @property string $title
 * @property integer $sorting
 * @property integer $cat_id
 * @property string $content
 * @property integer $status
 * @property integer $pv
 * @property integer $created
 */
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
            array('title','required'),
            array('content', 'required'),
            array('sorting, cat_id, status, pv, created', 'numerical', 'integerOnly' => true),
            array('title', 'length', 'max' => 32),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, sorting, cat_id, content, status, pv, created', 'safe', 'on' => 'search'),
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
            'cat_id' => '分类名称',
            'content' => '新闻内容',
            'status' => '状态',
            'pv' => '浏览量',
            'created' => '创建时间',
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
        $criteria->compare('cat_id', $this->cat_id);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('pv', $this->pv);
        $criteria->compare('created', $this->created);

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

}
