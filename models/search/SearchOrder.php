<?php

namespace app\modules\order\models\search;

use app\modules\order\models\Factory;
use app\modules\order\models\Status;
use app\modules\order\models\Worker;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\order\models\Order;

/**
 * SearchOrder represents the model behind the search form of `app\modules\order\models\Order`.
 */
class SearchOrder extends Order
{
    public $worker;
    public $status;
    public $factory;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'factory_id', 'status_id', 'user_id'], 'integer'],
            [['name', 'worker', 'status', 'factory'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Order::find()
            ->joinWith([Status::tableName(), Factory::tableName(), Worker::tableName()]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'worker' => [
                        'asc' => [Worker::tableName().'.surname' => SORT_ASC],
                        'desc' => [Worker::tableName().'.surname' => SORT_DESC]
                    ],
                    'name' => [
                        'asc' => [Order::tableName().'.name' => SORT_ASC],
                        'desc' => [Order::tableName().'.name' => SORT_DESC]
                    ],
                    'status' => [
                        'asc' => [Status::tableName().'.name' => SORT_ASC],
                        'desc' => [Status::tableName().'.name' => SORT_DESC],
                    ],
                    'factory' => [
                        'asc' => [Factory::tableName().'.name' => SORT_ASC],
                        'desc' => [Factory::tableName().'.name' => SORT_DESC]
                    ],
                    'id' => [
                        'asc' => [Order::tableName().'.id' => SORT_ASC],
                        'desc' => [Order::tableName().'.id' => SORT_DESC]
                    ],
                    'created_at' => [
                        'asc' => [Order::tableName().'.created_at' => SORT_ASC],
                        'desc' => [Order::tableName().'.created_at' => SORT_DESC]
                    ]

                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
//        $query->andFilterWhere([
//            'id' => $this->id,
//            'factory_id' => $this->factory_id,
//            'status_id' => $this->status_id,
//            'user_id' => $this->user_id,
//            'created_at' => $this->created_at,
//        ]);

        $query->andFilterWhere(['like', Order::tableName().'.name', $this->name]);

        return $dataProvider;
    }
}
