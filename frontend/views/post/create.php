<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = '创建';
$this->params['breadcrumbs'][] = ['label' => '文章', 'url' => ['post/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-9">
        <div class="panel-title box-title">
            <span>创建文章</span>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin() ?>

            <?= $form->field($model, 'title')->textinput(['maxlength' => true]) ?>
            <!--分类-->
            <?= $form->field($model, 'cat_id')->dropDownList($cats) ?>
            <!--标签图上传-->
            <?=
            $form->field($model, 'label_img')->widget('common\widgets\file_upload\FileUpload', [
                'config' => [
                ]
            ])
            ?>
            <!--富文本编辑器-->
            <?=
            $form->field($model, 'content')->widget('common\widgets\ueditor\Ueditor', [
                'options' => [
                    'initialFrameHeight' => 400,
                ]
            ])
            ?>
            <!--标签-->
            <?= $form->field($model, 'tags')->widget('common\widgets\tags\TagWidget') ?>
            <div class="form-group">
                <?= Html::submitButton("发布", ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="panel-title box-title">
            <span>注意事项</span>
        </div>
        <div class="panel-body">
            <p>1.aaaaaaaa</p>
            <p>2.dddddddd</p>
        </div>
    </div>
</div>


