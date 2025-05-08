<?php

namespace app\modules\admin\controllers;

use app\models\User;
use app\models\UserExtras;
use app\modules\admin\models\ChangePasswordForm;
use app\modules\admin\models\ProfileForm;
use Yii;
use yii\bootstrap5\ActiveForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * ProfileController implements the CRUD actions for User model.
 */
class ProfileController extends Controller
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
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new ProfileForm();
        $changePasswordModel = new ChangePasswordForm();


        if ($model->load($this->request->post())) {

            // Ajax-валидация
            if ($this->request->isAjax) {
                $this->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }

            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if (is_null($model->imageFile)) {
                if ($model->saveAll(true)) {
                    Yii::$app->session->setFlash('success', 'Профиль успешно изменен');

                    return $this->redirect(['index']);
                }
            } elseif ($model->upload()) {
                if ($model->saveAll(false)) {
                    Yii::$app->session->setFlash('success', 'Профиль успешно изменен');

                    return $this->redirect(['index']);
                }
            }

            return $this->render('index', [
                'index' => false, //для открытия вкладки
                'settings' => true, //для открытия вкладки
                'change_password' => false, //для открытия вкладки
                'model' => $model,
                'changePasswordModel' => $changePasswordModel,
            ]);
        }

        // Если значение phone пустое, заполняем его из текущего пользователя
        if (empty($model->phone)) {
            $model->phone = Yii::$app->user->identity->phone;
        }

        // Если значение email пустое, заполняем его из текущего пользователя
        if (empty($model->email)) {
            $model->email = Yii::$app->user->identity->email;
        }

        return $this->render('index', [
            'index' => true, //для открытия вкладки
            'settings' => false, //для открытия вкладки
            'change_password' => false, //для открытия вкладки
            'model' => $model,
            'changePasswordModel' => $changePasswordModel,
        ]);
    }

    public function actionChangePassword()
    {
        $model = new ProfileForm();
        $changePasswordModel = new ChangePasswordForm();

        if ($changePasswordModel->load($this->request->post())) {

            // Ajax-валидация
            if ($this->request->isAjax) {
                $this->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($changePasswordModel);
            }

            if ($changePasswordModel->updatePassword()) {
                Yii::$app->session->setFlash('success', 'Пароль успешно изменен');

                return $this->redirect(['index']);
            }
        }

        return $this->render('index', [
            'index' => false, //для открытия вкладки
            'settings' => false, //для открытия вкладки
            'change_password' => true, //для открытия вкладки
            'model' => $model,
            'changePasswordModel' => $changePasswordModel,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionDeleteAvatar()
    {
        $userExtras = UserExtras::findOne(['user_id' => Yii::$app->user->id]);

        if ($userExtras && !empty($userExtras->avatar)) {
            // Удаляем файл изображения
            $filePath = '/avatars/' . $userExtras->avatar;
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Очищаем поле avatar в базе данных
            $userExtras->avatar = null;
            $userExtras->save();
        }

        return $this->redirect(['index']); // Перенаправляем на страницу профиля
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id Номер
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $model = User::find()
            ->where(['id' => $id])
            ->with(['userExtras'])
            ->one();
        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
