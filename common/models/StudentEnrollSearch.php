<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Student;

/**
 * StudentSearch represents the model behind the search form of `common\models\Student`.
 */
class StudentEnrollSearch extends Student
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id'], 'integer'],
            [['code', 'fname', 'lname', 'bdate', 'email', 'passport', 'address', 'phone', 'created_at', 'updated_at'], 'safe'],
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
    public function search($params, $course)
    {
        $query = Student::find();

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



        $query->where(['not in', 'id', CourseEnroll::getByCourse($course)]);
        // grid filtering conditions
        $query->andFilterWhere([
            'student.id' => $this->id,
            'student.bdate' => $this->bdate,
        ]);


        $query->andFilterWhere(['like', 'student.code', $this->code])
            ->andFilterWhere(['like', 'student.fname', $this->fname])
            ->andFilterWhere(['like', 'student.lname', $this->lname])
            ->andFilterWhere(['like', 'student.email', $this->email])
            ->andFilterWhere(['like', 'student.passport', $this->passport])
            ->andFilterWhere(['like', 'student.phone', $this->phone]);

//        print_r($query);
//        exit;

        return $dataProvider;
    }
}
