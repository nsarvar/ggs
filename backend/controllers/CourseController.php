<?php

namespace backend\controllers;

use common\models\CourseEnroll;
use common\models\CourseEnrollSearch;
use common\models\Schedule;
use common\models\Student;
use common\models\StudentEnrollSearch;
use common\models\StudentSearch;
use Yii;
use common\models\Course;
use common\models\CourseSearch;
use backend\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

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

        $searchModel = new StudentEnrollSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id);

        Yii::$app->session->set('courseId',$id);
        $searchModel2 = new CourseEnrollSearch();
        $dataProvider2 = $searchModel2->search(Yii::$app->request->queryParams,$id);

        return $this->render('enroll',[
            'course' => $course,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModel2' => $searchModel2,
            'dataProvider2' => $dataProvider2,
            ]);

    }


    public function actionDeleteEnroll() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if($post = Yii::$app->request->post()) {
            $student = $post['student'];
            $course = $post['course'];

            if(CourseEnroll::deleteModel($course,$student)) {
                return [
                    'status' => 1,
                    'message' => Yii::t('main','O\'quvchi kursdan o\'chirildi!')
                ];
            } else {
                return [
                    'status' => 0,
                    'message' => Yii::t('main','O\'chirishda xatolik!')
                ];
            }
        }
        return json_encode([
            'status' => 0,
            'message' => Yii::t('main','Ruxsat berilmagan!')
        ]);
    }

    public function actionAddEnroll() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if($post = Yii::$app->request->post()) {
            $student = $post['student'];
            $course = $post['course'];
            $courseModel = Course::findOne($course);

            if(empty($courseModel))
                return [
                    'status' => 0,
                    'message' => Yii::t('main','Kurs topilmadi!')
                ];
            if($courseModel->diff < 1)
                return [
                    'status' => 0,
                    'message' => Yii::t('main','Kurs to\'lgan!')
                ];
            if(CourseEnroll::saveModel($course,$student)) {
                return [
                    'status' => 1,
                    'message' => Yii::t('main','O\'quvchi kursga qo\'shildi!')
                ];
            } else {
                return [
                    'status' => 0,
                    'message' => Yii::t('main','Qo\'shishda xatolik!')
                ];
            }
        }
        return json_encode([
            'status' => 0,
            'message' => Yii::t('main','Ruxsat berilmagan!')
        ]);
    }

    public function actionAddEnrolls() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if($post = Yii::$app->request->post()) {
            $enrolls = $post['enroll'];
            $course = $post['course'];
            $courseModel = Course::findOne($course);

            if(empty($courseModel))
                return [
                    'status' => 0,
                    'message' => Yii::t('main','Kurs topilmadi!')
                ];

            $count = 0;
            $message = false;
            $message2 = false;
            $countEnroll = count($enrolls);
            foreach ($enrolls as  $value) {
                if( $courseModel->diff < 1) {
                    $message2 = Yii::t('main','{count} ta o\'quvchi kurs to\'lganligi sababli kursga qo\'shilmadi!',['count' => $countEnroll - $count]);
                    break;
                }
                if(CourseEnroll::saveModel($course,$value))
                    $count++;
            }
            if($count>0)
                $message = Yii::t('main','{count} ta o\'quvchi kursga qo\'shildi!',['count' => $count]);

            if($message && $message2)
                return [
                    'status' => 2,
                    'message' => $message,
                    'message2' => $message2
                ];
            if($message)
                return [
                'status' => 1,
                'message' => $message
            ];
            if($message2)
                return [
                'status' => 0,
                'message' => $message2
            ];

            return [
                'status' => 0,
                'message' => Yii::t('main','Serverda xatolik')
            ];
        }
        return json_encode([
            'status' => 0,
            'message' => Yii::t('main','Ruxsat berilmagan!')
        ]);
    }

    public function actionDeleteEnrolls() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if($post = Yii::$app->request->post()) {
            $enrolls = $post['enroll'];
            $course = $post['course'];
            $countSuccess = 0;
            $countError = 0;
            $message = false;
            $message2 = false;
            foreach ($enrolls as  $value) {
                if(CourseEnroll::deleteModel($course, $value))
                    $countSuccess++;
                else
                    $countError++;
            }
            if($countSuccess > 0)
                $message = Yii::t('main','{count} ta o\'quvchi kursdan o\'chirildi!',['count' => $countSuccess]);
            if($countError > 0)
                $message2 = Yii::t('main','{count} ta o\'quvchini kursdan o\'chirishda xatolik yuz berdi!');

            if($message && $message2)
                return [
                    'status' => 2,
                    'message' => $message,
                    'message2' => $message2
                ];
            if($message)
                return [
                    'status' => 1,
                    'message' => $message
                ];
            if($message2)
                return [
                    'status' => 0,
                    'message' => $message2
                ];

            return [
                'status' => 0,
                'message' => Yii::t('main','Serverda xatolik')
            ];
        }
        return json_encode([
            'status' => 0,
            'message' => Yii::t('main','Ruxsat berilmagan!')
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

    public function actionSchedule($id) {
        $course = Course::findOne($id);
        if(empty($course)) {
            Yii::$app->session->addFlash('danger', Yii::t('main','Kurs topilmadi!'));
            return $this->referrer();
        }
        $model = new Schedule();
        if($post = Yii::$app->request->post()) {
            if(!$course->getHasDayCount($post['Schedule']['day']))
                Yii::$app->session->addFlash('danger', Yii::t('main','Bir kunga ko\'pi bilan {count} ta vaqt qo\'shish mumkin',['count' => Course::DAY_LIMIT]));
            elseif(!$course->getHasScheduleCount())
                Yii::$app->session->addFlash('danger', Yii::t('main','Bitta kursga ko\'pi bilan {count} ta vaqt qo\'shish mumkin',['count' => Course::SCHEDULE_LIMIT]));
            else {
                $model->load($post);
                if(!$model->validDate)
                    Yii::$app->session->addFlash('danger', Yii::t('main','Noto\'g\'ri vaqt kiritildi!'));
                elseif($model->save())
                    Yii::$app->session->addFlash('success', Yii::t('main','Ma\'lumot qo\'shildi'));
                else
                    Yii::$app->session->addFlash('success', Yii::t('main','Ma\'lumot qo\'shishda xatolik!'));
            }
            return $this->referrer();
        }
        return $this->render('schedule',['model' => $model, 'course' => $course]);
    }

    public function actionDeleteSchedule($id) {
        $model = Schedule::findOne($id);
        if($model && $model->delete())
            Yii::$app->session->addFlash('success', Yii::t('main','Ma\'lumot o\'chdi!'));
        else
            Yii::$app->session->addFlash('success', Yii::t('main','Ma\'lumotni o\'chirishda xatolik!'));
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
