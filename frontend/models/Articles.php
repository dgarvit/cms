<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "articles".
 *
 * @property integer $id
 * @property string $publicationDate
 * @property string $title
 * @property string $summary
 * @property string $content
 */
class Articles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'articles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'summary', 'content'], 'required'],
            [['publicationDate'], 'safe'],
            [['summary', 'content'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'publicationDate' => 'Publication Date',
            'title' => 'Title',
            'summary' => 'Summary',
            'content' => 'Content',
        ];
    }
}