<?php

namespace app\modules\admin\controllers;

use app\models\Category;
use app\models\Location;
use app\models\MaterialMadeOf;
use app\models\MaterialUseFor;
use app\models\Project;
use app\models\Tool;
use app\models\ToolHistory;
use app\models\ToolImage;
use app\models\ToolMaker;
use app\modules\admin\models\ToolSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use FPDF;

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
        $model = $this->findModel($id);

        $lastUser = ToolHistory::getLastUser($id);
        $lastStatus = ToolHistory::getLastStatus($id);

        $toolHistories = ToolHistory::find()
            ->where(['tool_id' => $id])
            ->with(['user', 'toolStatus'])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();

        return $this->render('view', [
            'model' => $model,
            'lastUser' => $lastUser,
            'lastStatus' => $lastStatus,
            'toolHistories' => $toolHistories,
        ]);
    }

    /**
     * Creates a new Tool model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Tool();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                if ($model->tool_maker_id == -1) {
                    $model->tool_maker_id = $model->addNewToolMaker();
                }

                $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');

                $transaction = Yii::$app->db->beginTransaction();
                if ($model->saveToolData()) {
                    if ($model->addToolMaterialUseFors($model->materialsUseFor)) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
                $transaction->rollback();
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'categories' => Category::getEntities(),
            'locations' => Location::getEntities(),
            'projects' => Project::getEntities(),
            'toolMakers' => ToolMaker::getEntities(),
            'materialsMadeOf' => MaterialMadeOf::getEntities(),
            'materialsUseFor' => MaterialUseFor::getEntities(),
        ]);
    }

    /**
     * Updates an existing Tool model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $materialsUseForCurrent = $model->getMaterialsUseFors()->select(['id'])->column();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                if ($model->tool_maker_id == -1) {
                    $model->tool_maker_id = $model->addNewToolMaker();
                }

                $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');

                if ($model->saveToolData()) {
                    $model->updateToolMaterialUseFors($materialsUseForCurrent);

                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'categories' => Category::getEntities(),
            'locations' => Location::getEntities(),
            'projects' => Project::getEntities(),
            'toolMakers' => ToolMaker::getEntities(),
            'materialsMadeOf' => MaterialMadeOf::getEntities(),
            'materialsUseFor' => MaterialUseFor::getEntities(),
            'materialsUseForCurrent' => $materialsUseForCurrent,
        ]);
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

    public function actionDeleteToolImage($id, $filename)
    {
        $imageModel = ToolImage::findOne(['tool_id' => $id, 'image' => $filename]);

        if (!is_null($imageModel)) {
            $imageModel->delete();
            // Удаляем файл изображения
            $fileToDeletePath = Tool::IMG_PATH . $filename;
            if (file_exists($fileToDeletePath)) {
                unlink($fileToDeletePath);
            }
        }

        return $this->redirect(['update', 'id' => $id]);
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

        throw new NotFoundHttpException('Запрашиваемая страница не найдена');
    }

    public function actionDownloadQr($id)
    {
        $model = $this->findModel($id);

        // Укажите путь к вашему PNG файлу
        $imagePath = 'img/qr/' . $model->qr;

        if (file_exists($imagePath)) {
            // Создаем новый PDF документ
            $pdf = new FPDF();
            $pdf->AddPage();

            // Получаем размеры изображения
            list($width, $height) = getimagesize($imagePath);

            // Преобразуем размеры в миллиметры (1px = 0.264583 mm)
            $width_mm = 20;
            $height_mm = 20;

            // Добавляем текст (подпись) над изображением
            $pdf->SetFont('Arial', 'B', 8); // Устанавливаем шрифт и размер
            $pdf->SetXY(3, 22); // Устанавливаем позицию текста (X, Y)
            $pdf->Cell(0, 10, $model->id . '. ' . $model->toolMaker->title, 0, 1); // Параметры: ширина, высота, текст, рамка, переход на новую строку, выравнивание

            // Добавляем изображение в PDF
            $pdf->Image($imagePath, 3, 3, $width_mm, $height_mm);

            // Отправляем PDF на загрузку
            $pdf->Output('D', $model->id . '_' . $model->toolMaker->title . '.pdf'); // D - для загрузки

        } else {
            throw new NotFoundHttpException('Файл не найден.');
        }
    }
}
