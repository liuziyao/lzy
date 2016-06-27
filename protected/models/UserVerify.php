<?php

class UserVerify extends CActiveRecord {

    public function sendSmsVerify($user_id = 0, $mobile = '', $content = "", $is_transaction = true, $session_id = '') {
        if ($session_id) {
            $model = UserVerify::model()->findByAttributes(array('session_id' => $session_id));
        } else {
            if (!$user_id) {
                return UtilD::formatReturn(0, '请指定一个用户！');
            }
            $user_model = User::model()->findByPk($user_id);
            if (!$mobile) {
                $mobile = $user_model->mobile;
            }
            $model = UserVerify::model()->findByAttributes(array('user_id' => $user_id));
        }
        if (!$mobile) {
            return UtilD::formatReturn(0, '请输入手机号！');
        }
        $params = Yii::app()->params;
        $time_gap = $params['user_verify']['send_time_gap'];
        if ($model) {
            //判断是否在60秒内
            if (!$this->canSendSmsVcode($user_id, $model, $session_id))
                return UtilD::formatReturn(0, "对不起，两次发送验证码的时间间隔为{$time_gap}秒，请稍后！");
            //sms_num_limit
            if (date('Ymd') == date('Ymd', $model->send_time) && $model->times >= $params['sms_num_limit'])
                return UtilD::formatReturn(0, "对不起，您今天已经发送过{$params['user_verify']['num_limit']}次短信了！");
        }
        if ($is_transaction) {
            $transaction = Yii::app()->db->beginTransaction();
        }
        try {
            $vcode = UtilD::getVerifyCode();
            $expire_time = time() + $params['user_verify']['expire_time']; // 24小时内
            if ($model) {
                $send_time = $model->send_time;
                $model = $this->operateVerify($user_id, $vcode, $expire_time, 0, $mobile, $model, $session_id);
            } else {
                $send_time = 0;
                $model = $this->operateVerify($user_id, $vcode, $expire_time, 0, $mobile, null, $session_id);
            }
            if (!$model)
                throw new Exception('系统繁忙，请稍后再试！');
            if ($content) {
                $content = str_replace('vcode', $vcode, $content);
                //$content = str_replace('mobileLast4', substr($mobile, -4), $content);
            } else {
                $content = "您好，您的验证码为{$vcode}";
            }
            $rs = UtilD::sendSms($mobile, $content);
            if (!$rs['status'])
                throw new Exception($rs['message']);

            if (!$model->times) {
                $model->times = 1;
            } else {
                if (date('Y-m-d') != date('Y-m-d', $send_time)) {
                    $model->times = 1;
                } else {
                    $model->times = $model->times + 1;
                }
            }
            $rs = $model->save();
            if (!$rs)
                throw new Exception('系统繁忙，请稍后再试！');
            if ($is_transaction) {
                $transaction->commit();
            }
            return UtilD::formatReturn(1, '验证码发送成功！');
        } catch (Exception $e) {
            if ($is_transaction) {
                $transaction->rollback();
            }
            return UtilD::formatReturn(0, $e->getMessage());
        }
    }

    public function sendEmailVerify($user_id = 0, $email = '', $content = "", $is_transaction = true, $session_id = '') {
        if ($session_id) {
            $model = UserVerify::model()->findByAttributes(array('session_id' => $session_id));
        } else {
            if (!$user_id) {
                return UtilD::formatReturn(0, '请指定一个用户！');
            }
            $user_model = User::model()->findByPk($user_id);
            if (!$email) {
                $email = $user_model->email;
            }
            $model = UserVerify::model()->findByAttributes(array('user_id' => $user_id));
        }
        if (!$email) {
            return UtilD::formatReturn(0, '请输入邮箱！');
        }
        $params = Yii::app()->params;
        $time_gap = $params['user_verify']['send_time_gap'];
        if ($model) {
            //判断是否在60秒内
            if (!$this->canSendSmsVcode($user_id, $model, $session_id))
                return UtilD::formatReturn(0, "对不起，两次发送验证码的时间间隔为{$time_gap}秒，请稍后！");
            //sms_num_limit
            if (date('Ymd') == date('Ymd', $model->send_time) && $model->times >= $params['user_verify']['num_limit'])
                return UtilD::formatReturn(0, "对不起，您今天已经发送过{$params['user_verify']['num_limit']}次邮件了！");
        }
        if ($is_transaction) {
            $transaction = Yii::app()->db->beginTransaction();
        }
        try {

            $vcode = UtilD::getVerifyCode();
            $expire_time = time() + $params['user_verify']['expire_time']; // 24小时内
            if ($model) {
                $send_time = $model->send_time;
                $model = $this->operateVerify($user_id, $vcode, $expire_time, 1, $email, $model, $session_id);
            } else {
                $send_time = 0;
                $model = $this->operateVerify($user_id, $vcode, $expire_time, 1, $email, null, $session_id);
            }
            if (!$model)
                throw new Exception('系统繁忙，请稍后再试！');
            if ($content) {
                $content = str_replace('vcode', $vcode, $content);
                //$content = str_replace('mobileLast4', substr($mobile, -4), $content);
            } else {
                $content = "您好，您的验证码为{$vcode}";
            }
            $title = "搜景观--邮箱验证";
            $rs = UtilD::sendMail($email, $title, $content);
            if (!$rs['status']) {
                throw new Exception('邮件发送失败！');
            }

            if (!$model->times) {
                $model->times = 1;
            } else {
                if (date('Y-m-d') != date('Y-m-d', $send_time)) {
                    $model->times = 1;
                } else {
                    $model->times = $model->times + 1;
                }
            }
            $rs = $model->save();
            if (!$rs)
                throw new Exception('系统繁忙，请稍后再试！');
            if ($is_transaction) {
                $transaction->commit();
            }
            return UtilD::formatReturn(1, '验证码发送成功！');
        } catch (Exception $e) {
            if ($is_transaction) {
                $transaction->rollback();
            }
            return UtilD::formatReturn(0, $e->getMessage());
        }
    }

    public function operateVerify($user_id, $vcode, $expire_time, $verify_type, $verify_content, $model = null, $session_id = '') {
        if (!$model) {
            if ($session_id) {
                $model = UserVerify::model()->findByAttributes(array('session_id' => $session_id));
            } elseif ($user_id) {
                $model = UserVerify::model()->findByAttributes(array('user_id' => $user_id));
            }
        }

        if (!$model) {
            $model = new UserVerify();
            $model->user_id = $user_id;
            $model->session_id = $session_id;
        }

        $model->sta = 0;
        $model->expire_time = $expire_time;
        $model->vcode = trim($vcode);
        $model->verify_type = $verify_type;
        $model->verify_content = trim($verify_content);
        $model->send_time = time();

        if ($model->save()) {
            return $model;
        } else {
            return false;
        }
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'user_verify';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('uid, verify_type', 'required'),
            array('uid, verify_type, expire_time, verify_time, send_time, times, sta, created', 'numerical', 'integerOnly' => true),
            array('verify_content', 'length', 'max' => 32),
            array('vcode', 'length', 'max' => 8),
            array('session_id', 'length', 'max' => 128),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, uid, verify_type, verify_content, vcode, expire_time, verify_time, send_time, times, sta, session_id, created', 'safe', 'on' => 'search'),
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
            'uid' => '用户ID',
            'verify_type' => '0手机，1邮箱',
            'verify_content' => '手机号或者邮箱号',
            'vcode' => '验证码',
            'expire_time' => '过期时间',
            'verify_time' => '验证时间',
            'send_time' => '发送时间',
            'times' => '当天验证次数',
            'sta' => '认证状态（-1 未通过验证，0 未验证，1 通过验证）',
            'session_id' => 'session',
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
        $criteria->compare('uid', $this->uid);
        $criteria->compare('verify_type', $this->verify_type);
        $criteria->compare('verify_content', $this->verify_content, true);
        $criteria->compare('vcode', $this->vcode, true);
        $criteria->compare('expire_time', $this->expire_time);
        $criteria->compare('verify_time', $this->verify_time);
        $criteria->compare('send_time', $this->send_time);
        $criteria->compare('times', $this->times);
        $criteria->compare('sta', $this->sta);
        $criteria->compare('session_id', $this->session_id, true);
        $criteria->compare('created', $this->created);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return UserVerify the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
