<?php

namespace app\modules\account;

use Yii;
use yii\filters\AccessControl;


/**
 * account module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\account\controllers';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            // Если пользователь НЕ админ — пускаем дальше (например, на frontend)
                            if (!Yii::$app->user->identity->isAdmin) {
                                return true;
                            }

                            // Если это просмотр инструмента — извлекаем id
                            $id = Yii::$app->request->get('id');

                            // Перенаправляем админа на /admin/tool/view с тем же id
                            if ($id && Yii::$app->controller->route === 'account/tool/view') {
                                Yii::$app->response->redirect(['/admin/tool/view', 'id' => $id]);
                                Yii::$app->end();
                            }
                        }
                    ],
                ],
                // 'denyCallback' => fn() => Yii::$app->response->redirect('/site/login'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
