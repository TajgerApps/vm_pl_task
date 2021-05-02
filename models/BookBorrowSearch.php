<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BookBorrow;

/**
 * BookBorrowSearch represents the model behind the search form of `app\models\BookBorrow`.
 */
class BookBorrowSearch extends BookBorrow
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'book_id', 'user_id', 'is_returned'], 'integer'],
            [['borrow_date', 'return_date'], 'safe'],
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
        $query = BookBorrow::find();

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
            'book_id' => $this->book_id,
            'user_id' => $this->user_id,
            'borrow_date' => $this->borrow_date,
            'return_date' => $this->return_date,
            'is_returned' => $this->is_returned,
        ]);

        return $dataProvider;
    }
}
