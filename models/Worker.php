<?php

namespace app\modules\order\models;

use Yii;

/**
 * This is the model class for table "worker".
 *
 * @property int $id
 * @property string $surname
 * @property string $name
 */
class Worker extends \yii\db\ActiveRecord
{

    public $fullName;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'worker';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['surname', 'name'], 'required'],
            [['surname', 'name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'surname' => 'Фамилия',
            'name' => 'Имя',
            'fullname' => 'Работник',
        ];
    }

    public function getFullName() {
        return $this->surname . ' ' . $this->name;
    }
}
