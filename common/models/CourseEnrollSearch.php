<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Student;

/**
 * StudentSearch represents the model behind the search form of `common\models\Student`.
 */
class CourseEnrollSearch extends Student
{
    /**
     * @inheritdoc
     */

    public $fullName;

    public function rules()
    {
        return [
            [['id', 'parent_id'], 'integer'],
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
    public function search($params, $course)
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
                'avatarImage'
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->where(['in','id',CourseEnroll::getByCourse($course)]);
        // grid filtering conditions
        $query->andFilterWhere([
            'student.id' => $this->id,
            'student.bdate' => $this->bdate,
//            'parent_id' => $this->parent_id,
//            'created_at' => $this->created_at,
//            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'student.code', $this->code])
//            ->andFilterWhere(['like', 'student.fname', $this->fname])
//            ->andFilterWhere(['like', 'student.lname', $this->lname])
            ->andFilterWhere(['like', 'student.email', $this->email])
            ->andFilterWhere(['like', 'student.passport', $this->passport])
//            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'student.phone', $this->phone]);
//            ->andWhere(['course_enroll.course_id' => $course]);

        $query->andWhere('fname LIKE "%' . $this->fullName . '%" ' . //This will filter when only first name is searched.
            'OR lname LIKE "%' . $this->fullName . '%" '. //This will filter when only last name is searched.
            'OR CONCAT(lname, " ", fname) LIKE "%' . $this->fullName . '%"' //This will filter when full name is searched.
        );

        return $dataProvider;
    }
}
