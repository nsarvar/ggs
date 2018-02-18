<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Student;

/**
 * StudentSearch represents the model behind the search form of `common\models\Student`.
 */
class StudentSearch extends Student
{
    public $fullName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'gender'], 'integer'],
            [['code', 'fname', 'lname', 'bdate', 'email', 'passport', 'address', 'phone', 'created_at', 'updated_at'], 'safe'],
            [['fullName'], 'safe']
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
        $query = Student::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'fullName' => [
                    'asc' => ['fname' => SORT_ASC, 'lname' => SORT_ASC],
                    'desc' => ['fname' => SORT_DESC, 'lname' => SORT_DESC],
                    'label' => 'Full Name',
                    'default' => SORT_ASC
                ],
                'bdate',
                'email',
                'passport',
                'address',
                'phone',
                'avatar',
                'parent_id',
                'created_at',
                'updated_at',
                'avatarImage',
                'gender'
            ]
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
            'bdate' => $this->bdate,
            'parent_id' => $this->parent_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'gender' => $this->gender,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'fname', $this->fname])
            ->andFilterWhere(['like', 'lname', $this->lname])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'passport', $this->passport])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'phone', $this->phone]);

        $query->andWhere('fname LIKE "%' . $this->fullName . '%" ' . //This will filter when only first name is searched.
            'OR lname LIKE "%' . $this->fullName . '%" '. //This will filter when only last name is searched.
            'OR CONCAT(lname, " ", fname) LIKE "%' . $this->fullName . '%"' //This will filter when full name is searched.
        );


        return $dataProvider;
    }
}
