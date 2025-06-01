<?php

namespace app\modules\account\controllers;

use app\models\Location;
use app\models\Tool;
use app\models\ToolHistory;
use app\models\ToolStatus;
use app\models\User;
use app\modules\account\models\ToolSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ToolController implements the CRUD actions for Tool model.
 */
class ToolController extends Controller
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
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Tool models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ToolSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $model_return = null;

        if ($dataProvider->count) {
            $model_return = $dataProvider->models[0];
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'statuses' => ToolStatus::getEntities(),
            'users' => User::getEntities(),
            'locations' => Location::getEntities(),
            'model_return' => $model_return,
            'myTools' => false,
        ]);
    }


    /**
     * Lists all Tool models.
     *
     * @return string
     */
    public function actionMyTools()
    {
        $searchModel = new ToolSearch();
        $dataProvider = $searchModel->search($this->request->queryParams, true);

        $model_return = null;

        if ($dataProvider->count) {
            $model_return = $dataProvider->models[0];
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model_return' => $model_return,
            'locations' => Location::getEntities(),
            'statuses' => ToolStatus::getEntities(),
            'users' => User::getEntities(),
            'myTools' => true,
        ]);
    }

    /**
     * Displays a single Tool model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
            'locations' => Location::getEntities(),
            'lastUser' => ToolHistory::getLastUser($id),
        ]);
    }

    public function actionWork($id, $view = false)
    {
        $model = new ToolHistory();
        $model->tool_id = $id;
        $model->tool_status_id = ToolStatus::getEntityId('В работе');
        $model->user_id = Yii::$app->user->id;

        if ($model->save()) {
            if ($view) {
                return $this->asJson(['status' => true]);
            } else {
                return $this->redirect(['view', 'id' => $id]);
            }
        }
    }

    public function actionReturn($id)
    {
        $model_return = $this->findModel($id);
        $locations = Location::getEntities();

        if ($this->request->isPost && $model_return->load($this->request->post())) {

            $toolHistory = new ToolHistory();
            $toolHistory->tool_id = $id;
            $toolHistory->tool_status_id = ToolStatus::getEntityId('Доступен');
            $toolHistory->user_id = Yii::$app->user->id;

            if ($toolHistory->save() && $model_return->save(false)) {
                return $this->renderAjax('_form-modal', [
                    'model' => $model_return,
                    'locations' => $locations,
                ]);
            }
        }

        return $this->renderAjax('_form-modal', [
            'model' => $model_return,
            'locations' => $locations,
        ]);
    }

    public function actionRepair($id, $view = false)
    {
        $model = new ToolHistory();
        $model->tool_id = $id;
        $model->tool_status_id = ToolStatus::getEntityId('В ремонте');
        $model->user_id = Yii::$app->user->id;

        if ($model->save()) {
            if ($view) {
                return $this->asJson(['status' => true]);
            } else {
                return $this->redirect(['view', 'id' => $id]);
            }
        }
    }

    public function actionBroken($id, $view = false)
    {
        $model = new ToolHistory();
        $model->tool_id = $id;
        $model->tool_status_id = ToolStatus::getEntityId('Сломан');
        $model->user_id = Yii::$app->user->id;

        if ($model->save()) {
            if ($view) {
                return $this->asJson(['status' => true]);
            } else {
                return $this->redirect(['view', 'id' => $id]);
            }
        }
    }

    public function actionLoss($id, $view = false)
    {
        $model = new ToolHistory();
        $model->tool_id = $id;
        $model->tool_status_id = ToolStatus::getEntityId('Утерян');
        $model->user_id = Yii::$app->user->id;

        if ($model->save()) {
            if ($view) {
                return $this->asJson(['status' => true]);
            } else {
                return $this->redirect(['view', 'id' => $id]);
            }
        }
    }

    /**
     * Deletes an existing Tool model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tool model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Tool the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tool::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
