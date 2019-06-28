<?php

namespace backend\controllers;

use Yii;
use backend\models\News;
use yii\base\Controller;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;

class NewController extends Controller
{
    public function actions()
    {
        return [
            'images-get' => [
                'class' => 'vova07\imperavi\actions\GetImagesAction',
                'url' => 'http://localhost/ukrgas/frontend/web/upload/images/news/', // Directory URL address, where files are stored.
                'path' => '@frontend/web/upload/images/news', // Or absolute path to directory where files are stored.
                'options' => ['only' => ['*.jpg', '*.jpeg', '*.png', '*.gif', '*.ico']], // These options are by default.
            ],
            'image-upload' => [
                'class' => 'vova07\imperavi\actions\UploadFileAction',
                'url' => 'http://localhost/ukrgas/frontend/web/upload/images/news/', // Directory URL address, where files are stored.
                'path' => '@frontend/web/upload/images/news', // Or absolute path to directory where files are stored.
            ],
            'file-delete' => [
                'class' => 'vova07\imperavi\actions\DeleteFileAction',
                'url' => 'http://localhost/ukrgas/frontend/web/upload/images/news/',// Directory URL address, where files are stored.
                'path' => '@frontend/web/upload/images/news', // Or absolute path to directory where files are stored.
            ]
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => News::find(),
            'pagination' => [
                'pageSize' => 25
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionAdd()
    {
        return $this->render('add', [
            'model' => (new News())
        ]);
    }

    public function actionUpdate()
    {
        $id = Yii::$app->request->get('id');
        $form = Yii::$app->request->post();
        $model = News::findOne(['id' => $id]);

        if (Yii::$app->request->isPost) {
            if ($model->load($form) && $model->validate()) {
//                $model->image = UploadedFile::getInstance($model, 'image');
                if ($model->image = UploadedFile::getInstance($model, 'image')) {
//                    $model->save();
                    $model->uploadImage();
                }
                $model->save();
            }
            return Yii::$app->response->redirect(['new/index']);
        }

        return $this->render('update', [
            'model' => $model
        ]);
    }

    public function actionDelete()
    {
        return;
    }

    public function actionUploadImage()
    {
        return;
    }
}