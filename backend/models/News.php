<?php

namespace backend\models;

use yii\db\ActiveRecord;

class News extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%new}}';
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок сторінки',
            'image' => 'Головне зображення',
            'text' => 'Текст новини',
            'publication_date' => 'Дата публікації',
            'meta_keywords' => 'Meta keywords',
            'meta_description' => 'Meta description'
        ];
    }

    public function rules()
    {
        return [
            [['title', 'text'], 'required', 'message' => 'Необхідно заповнити "{attribute}"'],
            [['title', 'text', 'meta_keywords', 'meta_description'], 'string', 'min' => 5],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['publication_date'], 'safe']
        ];
    }

    public function uploadImage()
    {
        if ($this->validate()) {
            $this->image->saveAs(\Yii::getAlias('@frontend') . '/web/upload/images/news/' . $this->image->baseName . '.' . $this->image->extension);
            return true;
        }

        return false;
    }
}