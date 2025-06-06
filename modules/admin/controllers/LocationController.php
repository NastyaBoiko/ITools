<?php

namespace app\modules\admin\controllers;

use app\models\Location;
use app\modules\admin\models\LocationSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * LocationController implements the CRUD actions for Location model.
 */
class LocationController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Location models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new LocationSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $modelLocation = new Location();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelLocation' => $modelLocation,
        ]);
    }

    /**
     * Displays a single Location model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionAjaxCreate()
    {
        $model = new Location();

        // Проверяем, что запрос является AJAX
        if (!$this->request->isAjax) {
            throw new \yii\web\NotFoundHttpException('Страница не найдена');
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', 'Вы успешно создали местоположение');

                return $this->asJson([
                    'success' => true,
                    'redirect' => Url::toRoute(['/admin/location/index'])
                ]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->asJson([
            'form' => $this->renderAjax('modal-create', ['model' => $model])
        ]);
    }

    public function actionAjaxUpdate($id)
    {
        $model = $this->findModel($id);

        // Проверяем, что запрос является AJAX
        if (!$this->request->isAjax) {
            throw new \yii\web\NotFoundHttpException('Страница не найдена');
        }

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Вы успешно изменили местоположение');

            return $this->asJson([
                'success' => true,
                'redirect' => Url::toRoute(['/admin/location/index'])
            ]);
        }

        return $this->asJson([
            'form' => $this->renderAjax('modal-update', ['model' => $model])
        ]);
    }

    /**
     * Deletes an existing Location model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete_status = 1;
        if ($model->save(false)) {
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Location model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Location the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Location::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
