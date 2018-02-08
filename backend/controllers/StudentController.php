<?php

namespace backend\controllers;

use common\components\TimeTable;
use common\models\Subject;
use common\models\Times;
use frontend\models\SignupForm;
use Yii;
use common\models\Student;
use common\models\StudentSearch;
use backend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\User;

/**
 * StudentController implements the CRUD actions for Student model.
 */
class StudentController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Student models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Student model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Student model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Student();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Student model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Student model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionCreateStudent() {
        $session = Yii::$app->session;
        if(!$session->has('create-student')) {
//            $session->set('create-student',1);
            return $this->render('create-student');
        } else {

        }
        return $this->referrer();
    }

    public function actionSaveUser() {
        if($post = Yii::$app->request->post()) {

//            $this->dump($post);

            $model = new Student();
            $user = new SignupForm();
            $user->load($post);
            $user->password = SignupForm::generateRandomPassword();
            $id = $user->save();

            $model->load($post);
            if(empty($model->errors) && $id != false) {
                Yii::$app->session->set('new-student',['user_id' => $id,'fname' => $model->fname, 'lname' => $model->lname, 'passport' => $model->passport]);
                Yii::$app->session->set('step-1',1);
                Yii::$app->session->setFlash('success', Yii::t('main','Foydalanuvchi saqlandi!'));
                return $this->render('create_student_2', ['model' => $model]);
            }
            if(!empty($model->errors)) {
                foreach ($model->errors as $error) {
                    Yii::$app->session->addFlash('danger', Yii::t('main',$error[0]));
                }
            }
            if(!empty($user->errors)) {
                foreach ($user->errors as $error) {
                    Yii::$app->session->addFlash('danger', Yii::t('main',$error[0]));
                }
            }

        }
        return $this->referrer();
    }

    public function actionCreateStudent2() {
        $model = new Student();
        if(Yii::$app->session->get('step-1') == 1 || 1) {
            return $this->render('create_student_2',['model' => $model]);
        }
        return $this->redirect(['create-student']);
    }

    public function actionCreateStudent3() {
        $models = Subject::getModelsAsArray();
        return $this->render('create_student_3',['models' => $models]);
    }

    public function actionCreateStudent4() {
        $time = new TimeTable();
        return $this->render('create_student_4',['weekdays' => $time->getWeekDays(), 'hours' => $time->getHours()]);
    }

    public function actionFreeTimes($id) {
        $times = Times::getByParentAndType($id,Times::TYPE_STUDENT);
        $time = new TimeTable();
        if($post = Yii::$app->request->post()) {
            foreach (array_slice($post,1) as $key => $value) {
                $keys = explode('-',$key);
                $weekday = empty($keys[1]) ? 0 : $keys[1];
                $hour = empty($keys[2]) ? 0 : $keys[2];
                if($value == 1) {
                   if(!empty($time->getWeekDays()[$weekday]) && !empty($time->getHours()[$hour]) && !Times::find()->andFilterWhere(['parent_id' => $id, 'type' => Times::TYPE_STUDENT, 'weekday' => $weekday, 'time' => $hour])->exists()) {
                       $model = new Times();
                       $model->type = Times::TYPE_STUDENT;
                       $model->parent_id = $id;
                       $model->weekday = $weekday;
                       $model->time = $hour;
                       if(!$model->save())  {
                           Yii::$app->session->addFlash('danger',Yii::t('main','Ma\'lumotlartni saqlashda xatolik! Programmistlarga murojaat qiling!'));
                           return $this->referrer();
                       }
                   }

                } else {
                    Times::deleteAll(['parent_id' => $id, 'type' => Times::TYPE_STUDENT, 'weekday' => $weekday, 'time' => $hour]);
                }
            }
            Yii::$app->session->addFlash('success',Yii::t('main','Bo\'sh vaqtlar muvaffaqqiyatli saqlandi!'));
            return $this->redirect(['view', 'id' => $id]);

        }
//        $this->dump(Times::hasTime($times,99,3));
        return $this->render('free_times',[
                'times' => $times,
                'weekdays' => $time->getWeekDays(),
                'hours' => $time->getHours(),
                'parent' => $id,
                'type' => Times::TYPE_STUDENT
            ]);
    }
    /**
     * Finds the Student model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Student the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Student::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('main', 'The requested page does not exist.'));
    }
}
