<?php

namespace app\modules\account\controllers;

use app\models\Category;
use app\models\Location;
use app\models\MaterialMadeOf;
use app\models\MaterialUseFor;
use app\models\ToolMaterialUseFor;
use app\models\Project;
use app\models\Tool;
use app\models\ToolHistory;
use app\models\ToolImage;
use app\models\ToolMaker;
use app\models\ToolStatus;
use app\modules\account\models\ToolSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

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
                    'class' => VerbFilter::className(),
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

        // dd(end($dataProvider->getModels()[0]->toolHistories)->toolStatus->title);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionWork($id, $page = 1, $perPage = 8)
    {
        $model = new ToolHistory();
        $model->tool_id = $id;
        $model->tool_status_id = ToolStatus::getEntityId('В работе');
        $model->user_id = Yii::$app->user->id;
        $tool = $this->findModel($id);

        if ($model->save()) {
            return $this->redirect(['index', 'page' => $page, 'per-page' => $perPage]);
        }
    }

    public function actionReturn($id, $page = 1, $perPage = 8)
    {
        $model = new ToolHistory();
        $model->tool_id = $id;
        $model->tool_status_id = ToolStatus::getEntityId('Доступен');
        $model->user_id = Yii::$app->user->id;

        if ($model->save()) {
            return $this->redirect(['index', 'page' => $page, 'per-page' => $perPage]);
        }
    }

    public function actionRepair($id, $page = 1, $perPage = 8)
    {
        $model = new ToolHistory();
        $model->tool_id = $id;
        $model->tool_status_id = ToolStatus::getEntityId('В ремонте');
        $model->user_id = Yii::$app->user->id;

        if ($model->save()) {
            return $this->redirect(['index', 'page' => $page, 'per-page' => $perPage]);
        }
    }

    public function actionBroken($id, $page = 1, $perPage = 8)
    {
        $model = new ToolHistory();
        $model->tool_id = $id;
        $model->tool_status_id = ToolStatus::getEntityId('Сломан');
        $model->user_id = Yii::$app->user->id;

        if ($model->save()) {
            return $this->redirect(['index', 'page' => $page, 'per-page' => $perPage]);
        }
    }

    public function actionLoss($id, $page = 1, $perPage = 8)
    {
        $model = new ToolHistory();
        $model->tool_id = $id;
        $model->tool_status_id = ToolStatus::getEntityId('Утерян');
        $model->user_id = Yii::$app->user->id;

        if ($model->save()) {
            return $this->redirect(['index', 'page' => $page, 'per-page' => $perPage]);
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
