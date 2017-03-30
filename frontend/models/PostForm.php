<?php

namespace frontend\models;

//文章表单模型
use Yii;
use yii\base\Model;
use common\models\PostModel;

class PostForm extends Model {

    public $id;
    public $title;
    public $cat_id;
    public $label_img;
    public $content;
    public $tags;
    public $_lastError = "";

    /*
     *  创建场景
     * SCENARIOS_CREATE创建
     * SCENARIOS_UPDATE更新    
     * EVENT_AFTER_CREATE创建之后的事件
     * EVENT_AFTER_UPDATE更新之后的事件
     */

    const SCENARIOS_CREATE = 'create';
    const SCENARIOS_UPDATE = 'update';
    const EVENT_AFTER_CREATE = 'eventAfterCreate';
    const EVENT_AFTER_UPDATE = 'eventAfterUpdate';

//    场景设置
    public function scenarios() {
        $scenarios = [
            self::SCENARIOS_CREATE => ['title', 'cat_id', 'label_img', 'content', 'tags'],
            self::SCENARIOS_UPDATE => ['title', 'cat_id', 'label_img', 'content', 'tags'],
        ];
        return array_merge(parent::scenarios(), $scenarios);
    }

    public function rules() {
        return[
                [['id', 'title', 'content', 'cat_id'], 'required'],
                [['id', 'cat_id'], 'integer'],
                ['title', 'string', 'min' => 4, 'max' => 50],
        ];
    }

    public function attributeLabels() {
        return[
            'id' => '编码',
            'title' => '标题',
            'cat_id' => '分类',
            'label_img' => '标签图',
            'content' => '内容',
            'tags' => '标签',
        ];
    }

    //文章创建
    public function create() {
        //事务（保证数据的完整性）
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $model = new PostModel();
            $model->setAttributes($this->attributes);
            $model->summary = $this->_getSummary();
            $model->user_id = Yii::$app->user->identity->id;
            $model->user_name = Yii::$app->user->identity->username;
            $model->is_valid = PostModel::IS_VALID;
            $model->created_at = time();
            $model->updated_at = time();
            if (!$model->save()) {
                throw new Exception('文章保存失败');
            }//
            $this->id = $model->id;

            //调用事件
            $data = array_merge($this->getAttributes(), $model->getAttributes());
            $this->_eventAfterCreate($data);
            
            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
            $this->_lastError = $e->getMessage();
            return false;
        }
    }

//截取文章摘要
    private function _getSummary($s = 0, $e = 90, $char = 'utf-8') {
        if (empty($this->content)) {
            return null;
        }
        return (mb_substr(str_replace('&nbsp;', '', strip_tags($this->content)), $s, $e, $char));
    }

    //创建完成后调用的事件方法
    public function _eventAfterCreate($data) {
        //添加事件
        $this->on(self::EVENT_AFTER_CREATE,[$this,'_eventAddTag'],$data);
        //触发事件
        $this->trigger(self::EVENT_AFTER_CREATE);
    }
    
    //添加标签
    public function _eventAddTag(){
        
    }
    

}
