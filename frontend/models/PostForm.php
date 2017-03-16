<?php
namespace frontend\models;
//文章表单模型
use yii\base\Model;
class PostForm extends Model{
    public  $id;
    public $title;
    public $cat_id;
    public $label_img;
    public $content;
    public $tags;  
    public $_lasterror="";
    
    /*
     *  创建场景
     * SCENARIOS_CREATE创建
     * SCENARIOS_UPDATE更新    
     */
    const SCENARIOS_CREATE='create';
    const SCENARIOS_UPDATE='update';
    
//    场景设置
    public function scenarios() {
        $scenarios=[
        self::SCENARIOS_CREATE=>['title','cate','label_img','content','tags'],
            self::SCENARIOS_UPDATE=>['title','cate','label_img','content','tags'],
        ];
        return array_merge(parent::scenarios(),$scenarios);
    }

    public function rules() {
        return[
            [['id','title','content','cat_id'],'required'],
            [['id','cat_id'],'integer'],
            ['title','string','min'=>4,'max'=>50],
        ];
    }
    
    public function attributeLabels() {
        return[
            'id'=>'编码',
            'title'=>'标题',
            'cat_id'=>'分类',
            'label_img'=>'标签图',
            'content'=>'内容',
            'tags'=>'标签',
        ];
    }
}
