<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Installment;

/**
 * InstallmentSearch represents the model behind the search form of `app\models\Installment`.
 */
class InstallmentSearch extends Installment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'item_id', 'customer_id', 'notes', 'is_made_payment', 'total'], 'integer'],
            [['date', 'cheque_number'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Installment::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'item_id' => $this->item_id,
            'customer_id' =>  $this->customer['name'],
            'customer'=>  $this->customer['name'],
            'date' => $this->date,
            'notes' => $this->notes,
            'is_made_payment' => $this->is_made_payment,
            'total' => $this->total,
        ]);

        $query->andFilterWhere(['like', 'cheque_number', $this->cheque_number]);

        return $dataProvider;
    }
}
