<?php

namespace backend\controllers;

use common\models\CourseEnroll;
use common\models\CourseEnrollSearch;
use common\models\Student;
use common\models\StudentEnrollSearch;
use common\models\StudentSearch;
use Yii;
use common\models\Course;
use common\models\CourseSearch;
use backend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CourseController implements the CRUD actions for Course model.
 */
class CourseController extends Controller
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
     * Lists all Course models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CourseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Course model.
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
     * Creates a new Course model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Course();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Course model.
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
     * Deletes an existing Course model.
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

    public function actionEnroll($id) {
        $course = Course::findOne($id);
        if(empty($course)) {
            Yii::$app->session->addFlash('danger', Yii::t('main','Kurs topilmadi!'));
            return $this->referrer();
        }
        if($post = Yii::$app->request->post()) {
            if(!empty($post['enroll'])) {
                $countEnroll = count($post['enroll']);
                $count = 0;
                foreach ($post['enroll'] as $key => $value) {
                    if( $course->diff < 1) {
                        Yii::$app->session->addFlash('danger',Yii::t('main','{count} ta o\'quvchi kurs to\'lganligi sababli kursga qo\'shilmadi!',['count' => $countEnroll - $count]));
                        break;
                    }
                    if(CourseEnroll::saveModel($id,$key))
                        $count++;
                }
                if($count>0)
                    Yii::$app->session->addFlash('success',Yii::t('main','{count} ta o\'quvchi kursga qo\'shildi!',['count' => $count]));
            }
            return $this->referrer();
        }

        $searchModel = new StudentEnrollSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id);
        return $this->render('enroll',[
            'course' => $course,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    public function actionEnrollStudent($id) {
        $course = Course::findOne($id);
        if(empty($course)) {
            Yii::$app->session->addFlash('danger', Yii::t('main','Kurs topilmadi!'));
            return $this->referrer();
        }

        if($post = Yii::$app->request->post()) {
            if(!empty($post['enroll'])) {
                $countSuccess = 0;
                $countError = 0;
                foreach ($post['enroll'] as $key => $value) {
                    if(CourseEnroll::deleteModel($id,$key))
                        $countSuccess++;
                    else
                        $countError++;
                }

                if($countSuccess > 0)
                    Yii::$app->session->addFlash('warning', Yii::t('main','{count} ta o\'quvchi kursdan o\'chirildi!',['count' => $countSuccess]));
                if($countError > 0 )
                    Yii::$app->session->addFlash('danger',Yii::t('main', '{count} ta o\'quvchini kursdan o\'chirishda xatolik yuz berdi!'));

                return $this->referrer();
            }
        }

        Yii::$app->session->set('courseId',$id);
        $searchModel = new CourseEnrollSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id);
        return $this->render('enrollStudents',[
            'course' => $course,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    public function actionDeleteFromEnroll($id, $course) {

        if(CourseEnroll::deleteModel($course,$id)) {
            Yii::$app->session->addFlash('info', Yii::t('main','O\'quvchi kursdan o\'chirildi!'));
        } else {
            Yii::$app->session->addFlash('danger', Yii::t('main','O\'chirishda xatolik!'));
        }
        return $this->referrer();
    }

    /**
     * Finds the Course model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Course the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Course::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('main', 'The requested page does not exist.'));
    }
}
