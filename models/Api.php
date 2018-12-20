<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "api".
 *
 * @property int $id
 * @property string $key
 * @property int $hits
 */
class Api extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'api';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key'], 'required'],
            [['hits'], 'integer'],
            [['key'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => 'Key',
            'hits' => 'Hits',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ApiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ApiQuery(get_called_class());
    }
}
