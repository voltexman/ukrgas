<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\file\FileInput;
use kartik\date\DatePicker;
use vova07\imperavi\Widget;
use yii\widgets\ActiveForm;

$css = <<<CSS
.mailbox-attachment-icon, .mailbox-attachment-info, .mailbox-attachment-size {
    display: flow-root!important;
}
CSS;

$this->registerCss($css);

?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Загальні дані</h3>
            </div>
            <?php $form = ActiveForm::begin([
                'options' => [
                    'role' => 'form',
                    'enctype' => 'multipart/form-data'
                ],
            ]) ?>
            <div class="box-body">
                <?= $form->field($model, 'title') ?>

                <?php if ($model->image) : ?>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="box">
                                <span class="mailbox-attachment-icon has-img">
                                    <img src="../../frontend/web/upload/images/news/<?= $model->image ?>" alt="">
                                </span>
                                <div class="mailbox-attachment-info">
                                    <a href="#" class="mailbox-attachment-name">
                                        <i class="fa fa-camera"></i> <?= $model->image ?>
                                    </a>
                                    <span class="mailbox-attachment-size">
                                        <a href="#" class="btn btn-danger btn-xs pull-right">
                                            <i class="fa fa-trash"></i> Видалити
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php else : ?>

                    <?= $form->field($model, 'image')->widget(FileInput::className(), [
                        'options' => [
                            'multiple' => false,
                            'accept' => 'image/*'
                        ],
                        'pluginOptions' => [
                            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                            'browseLabel' => 'Вибрати зображення',
//                        'uploadUrl' => Url::to(['new/image-upload']),
                            'showUpload' => false
                        ],
                    ]) ?>

                <?php endif; ?>

                <?= $form->field($model, 'text')->widget(Widget::className(), [
                    'settings' => [
                        'lang' => 'uk',
                        'minHeight' => 400,
                        'imageUpload' => Url::to(['new/image-upload']),
                        'imageDelete' => Url::to(['new/file-delete']),
                        'plugins' => [
                            'counter',
                            'table',
                            'imagemanager',
                            'fontfamily',
                            'fontsize',
                            'fullscreen',
                        ],
                    ],
                ]) ?>

                <div class="row">
                    <div class="col-md-5">
                        <?= $form->field($model, 'publication_date')->widget(DatePicker::className(), [
                            'options' => ['placeholder' => 'Дата публікації'],
                            'language' => 'uk',
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd'
                            ]
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">SEO дані</h3>
            </div>
            <div class="box-body">

                <?= $form->field($model, 'meta_keywords')->textInput(['placeholder' => 'Ключові слова']) ?>

                <?= $form->field($model, 'meta_description')->textarea(['rows' => 5, 'placeholder' => 'Опис']) ?>
            </div>

            <div class="box-footer">
                <?= Html::submitButton($submitButton, ['class' => 'btn btn-primary']) ?>
            </div>
            <?php $form = ActiveForm::end() ?>
        </div>
    </div>
</div>
