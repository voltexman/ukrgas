<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Новини';

?>

<div class="row">
    <div class="box-body">
        <?= Html::a('Додати новину', Url::toRoute('new/add'), ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'tableOptions' => [
        'class' => 'table table-bordered table-striped dataTable',
        'id' => 'news'
    ],
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn',
            'headerOptions' => ['width' => '50'],
        ],
        [
            'label' => 'Зображення',
            'attribute' => 'image',
            'format' => 'raw',
            'headerOptions' => ['width' => '100'],
            'value' => function ($data) {
                if ($data->image) {
                    return Html::img('../../frontend/web/upload/images/news/' . $data->image, [
                        'style' => 'width:80px;'
                    ]);
                }
                return Html::img('../../backend/web/images/no-image.jpg', [
                    'style' => 'width:80px;'
                ]);
            }
        ],
        [
            'label' => 'Заголовок новини',
            'attribute' => 'title'
        ],
        [
            'label' => 'Дата публікації',
            'attribute' => 'publication_date'
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => 'Дії',
            'headerOptions' => ['width' => '100'],
            'template' => '{update} {delete}',
        ],
    ]
]);

?>
