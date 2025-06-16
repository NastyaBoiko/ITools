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
use app\models\ToolStatus;
use app\models\User;
use app\modules\admin\models\ToolSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use TCPDF;

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

        // $users = User::find()->all();

        // foreach ($users as $user) {
        //     if ($user->role_id == 2) {
        //         continue;
        //     }
        //     $user->password = Yii::$app->security->generatePasswordHash('123456qQ');
        //     $user->save();
        // }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'statuses' => ToolStatus::getEntities(),
            'users' => User::getEntities(),
            'locations' => Location::getEntities(),
            'materialsMadeOf' => MaterialMadeOf::getEntities(),
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
        $toolHistories = $model->getFullToolHistory();

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

                $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');

                $transaction = Yii::$app->db->beginTransaction();

                if ($model->saveToolData()) {
                    if ($model->addToolMaterialUseFors($model->materialsUseFor)) {
                        $transaction->commit();

                        Yii::$app->session->setFlash('success', 'Вы успешно создали инструмент');

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

                $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');

                $transaction = Yii::$app->db->beginTransaction();

                if ($model->saveToolData()) {
                    $model->updateToolMaterialUseFors($materialsUseForCurrent);

                    $transaction->commit();
                    Yii::$app->session->setFlash('success', 'Вы успешно изменили инструмент');

                    return $this->redirect(['view', 'id' => $model->id]);
                }

                $transaction->rollback();
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

    public function actionStatistics()
    {
        // Получаем статистику из модели
        $statistics = ToolHistory::getMonthlyStatistics();

        // Группируем данные для графика
        $chartData = [];
        foreach ($statistics as $row) {
            $yearMonth = $row['year'] . '-' . str_pad($row['month'], 2, '0', STR_PAD_LEFT); // Формат: YYYY-MM
            $chartData[$yearMonth][$row['tool_status_id']] = $row['count'];
        }

        // Массив с названиями месяцев на русском языке
        $monthsRu = [
            'January' => 'Январь',
            'February' => 'Февраль',
            'March' => 'Март',
            'April' => 'Апрель',
            'May' => 'Май',
            'June' => 'Июнь',
            'July' => 'Июль',
            'August' => 'Август',
            'September' => 'Сентябрь',
            'October' => 'Октябрь',
            'November' => 'Ноябрь',
            'December' => 'Декабрь',
        ];

        // Преобразуем даты в формат "Месяц Год" с локализацией
        $categories = array_map(function ($yearMonth) use ($monthsRu) {
            $date = \DateTime::createFromFormat('Y-m', $yearMonth);
            $monthEn = $date->format('F'); // Месяц на английском
            $monthRu = $monthsRu[$monthEn]; // Месяц на русском
            return $monthRu . ' ' . $date->format('Y'); // Например, "Март 2025"
        }, array_keys($chartData));

        // Определяем уникальные статусы
        $statuses = array_unique(array_column($statistics, 'tool_status_id'));

        // Формируем данные для series
        $series = [];
        foreach ($statuses as $status) {
            // Находим название статуса
            $statusTitle = '';
            foreach ($statistics as $row) {
                if ($row['tool_status_id'] === $status) {
                    $statusTitle = $row['status_title'];
                    break;
                }
            }

            // Формируем данные для серии
            $data = [];
            foreach ($chartData as $yearMonth => $counts) {
                $data[] = $counts[$status] ?? 0; // Если данных нет, используем 0
            }
            $series[] = [
                'name' => $statusTitle, // Используем название статуса
                'data' => $data,
            ];
        }

        // Передаем данные в представление
        return $this->render('statistics', [
            'categories' => $categories, // Месяцы в формате "Месяц Год"
            'series' => $series, // Данные для графика
        ]);
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
            $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8'); // Параметры: ориентация, единицы измерения, формат, UTF-8
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('ITools');
            $pdf->SetSubject('QR Code');
            $pdf->SetKeywords('TCPDF, QR Code, PDF');

            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);

            // Добавляем страницу
            $pdf->AddPage();

            // Устанавливаем шрифт с поддержкой кириллицы
            $pdf->SetFont('dejavusans', '', 8); // Шрифт DejaVuSans поддерживает кириллицу

            // Получаем размеры изображения
            list($width, $height) = getimagesize($imagePath);

            // Преобразуем размеры в миллиметры (1px = 0.264583 mm)
            $width_mm = 20;
            $height_mm = 20;

            // Добавляем текст (подпись) над изображением
            $pdf->SetXY(3, 22); // Устанавливаем позицию текста (X, Y)
            $pdf->Cell(0, 10, $model->id . '. ' . $model->toolMaker->title, 0, 1); // Параметры: ширина, высота, текст, рамка=0, переход на новую строку

            // Добавляем изображение в PDF
            $pdf->Image($imagePath, 3, 3, $width_mm, $height_mm);

            // Отправляем PDF на загрузку
            $pdf->Output($model->id . '_' . $model->toolMaker->title . '.pdf', 'D'); // D - для загрузки
        } else {
            throw new NotFoundHttpException('Файл не найден');
        }
    }

    public function actionDownloadQrs($ids)
    {
        // Преобразуем строку или массив ID в массив
        $ids = is_array($ids) ? $ids : explode(',', $ids);

        // Находим все модели по переданным ID
        $models = Tool::find()->where(['id' => $ids])->all();

        if (empty($models)) {
            throw new NotFoundHttpException('Модели с указанными ID не найдены');
        }

        // Создаем новый PDF документ
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8'); // Параметры: ориентация, единицы измерения, формат, UTF-8
        $name = 'QR_codes_' . date('d_m_Y') . '_' . count($models);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('ITools');
        $pdf->SetTitle('Tool QR Codes PDF');
        $pdf->SetSubject($name);
        $pdf->SetKeywords('TCPDF, QR Code, PDF');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Добавляем первую страницу
        $pdf->AddPage();

        // Устанавливаем шрифт с поддержкой кириллицы
        $pdf->SetFont('dejavusans', '', 8); // Шрифт DejaVuSans поддерживает кириллицу

        // Генерируем HTML-разметку
        $html = '<style>
            table {
                width: 100%;
                border-collapse: collapse; /* Убирает пробелы между границами */
            }
            td {
                height: 90px;
                text-align: center;
                vertical-align: middle;
                border: 1px solid black; /* Добавляет границу вокруг каждой ячейки */
            }
            img {
                max-width: 100%;
                height: auto;
            }
        </style>';

        // Создаем HTML-таблицу для QR-кодов
        $html .= '<table>';
        $html .= '<tr>';

        foreach ($models as $index => $model) {
            // Перевод строки
            if (($index !== 0) && ($index % 6 === 0)) {
                $html .= '</tr><tr>';
            }

            $imagePath = 'img/qr/' . $model->qr;

            if (file_exists($imagePath)) {
                $html .= '<td>';
                $html .= '<img src="' . $imagePath . '" alt="QR Code" style="width: 50px; height: auto;">';
                $html .= '<p>' . $model->id . '. ' . $model->toolMaker->title . '</p>';
                $html .= '</td>';
            }
        }

        $html .= '</tr></table>';

        // Добавляем HTML в PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Отправляем PDF на загрузку
        $pdf->Output($name . '.pdf', 'D'); // D - для загрузки
    }
}
