<?php

namespace app\modules\account\controllers;

use app\models\User;
use app\models\UserExtras;
use app\modules\account\models\ProfileForm;
use app\modules\account\models\ProfileSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
                    'class' => VerbFilter::className(),
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

        $userExtras = UserExtras::findOne(['user_id' => Yii::$app->user->id]);

        if (!$userExtras) {
            $userExtras = new UserExtras();
            $userExtras->user_id = Yii::$app->user->id;
            $userExtras->save();
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if ($model->saveAll()) {
                    return $this->redirect(['index']);
                }
            }
        } else {
            // $model->loadDefaultValues();
        }

        return $this->render('index', [
            'model' => $model,
        ]);
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
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
