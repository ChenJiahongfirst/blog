<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\TagModel;

class TagForm extends Model{
    public $id;
    public $tags;
    public function rules(){
        return[
            ['tags','required'],
            ['tags','each','rule'=>['string']],
        ];
    }
    //�����ǩ����
    public function saveTags(){
        $ids=[];
        if(!empty($this->tags)){
            foreach($this->tags as $tag){
                $ids[]=$this->_saveTag($tag);
            }
        }
        return $ids;
    }
    //���浥����ǩ
    private function _saveTag($tag){
        $model=new TagModel();
        $res=$model->find()->where(['tag_name'=>$tag])->one();
        if(!$res){//�½���ǩ
            $model->tag_name=$tag;
            $model->post_num=1;
            if(!$model->save()){
                throw new \Exception("���±���ʧ��");
            }
            return $model->id;
        }else{
            $res->updateCounters(['post_num'=>1]);
        }
        return $res->id;
    }
    
}