<?php

namespace backend\controllers;

use common\components\TimeTable;
use common\models\Subject;
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
            $model = new Student();
            $user = new \common\models\User();
            $user->load($post);
            $user->password = SignupForm::generateRandomPassword();
            $user->save();

            $model->load($post);
            if(empty($model->errors)) {
                Yii::$app->session->set('new-student',['user_id' => $user->id,'fname' => $model->fname, 'lname' => $model->lname, 'passport' => $model->passport]);
                Yii::$app->session->set('step-1',1);
                return $this->render('create_student_2', ['model' => $model]);
            }
            Yii::$app->session->setFlash('errors', $user->errors);
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
