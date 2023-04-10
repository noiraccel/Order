<?php

namespace app\modules\order\models;

use Yii;

/**
 * This is the model class for table "factory".
 *
 * @property int $id
 * @property string $name
 */
class Factory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'factory';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Фабрика',
        ];
    }
}
