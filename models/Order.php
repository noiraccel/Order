<?php

namespace app\modules\order\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $name
 * @property int $factory_id
 * @property int $status_id
 * @property int $user_id
 * @property string $created_at
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'factory_id', 'status_id', 'user_id'], 'required'],
            [['factory_id', 'status_id', 'user_id'], 'integer'],
            [['created_at'], 'default', 'value'=>
                date('Y-m-d H:i:s') // Comment: Для MySQL-а формат
            ],
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
            'name' => 'Наименование заказа',
            'status' => 'Статус',
            'status_id' => 'Статус',
            'factory' => 'Фабрика',
            'factory_id' => 'Фабрика',
            'worker' => 'Работник',
            'worker_id' => 'Работник',
            'created_at' => 'Дата создания',
        ];
    }

    public function getFactory() {
        return $this->hasOne(Factory::class, ['id' => 'factory_id']);
    }

    public function getStatus() {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    public function getWorker() {
        return $this->hasOne(Worker::class, ['id' => 'user_id']);
    }
}
