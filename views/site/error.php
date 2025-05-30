<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception$exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode("Ошибка 404. Страница не найдена") ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode("Упс! Что-то пошло не так, этой страницы не существует")) ?>
    </div>

    <div class="my-3">
        <img src="/img/404.gif" alt="Страница не найдена" class="rounded">
    </div>

    <?= Html::a('<i class="fas fa-arrow-left fa-fade" style="--fa-animation-duration: 2s; --fa-fade-opacity: 0.6;"></i> На главную', ['index'], ['class' => 'btn btn-outline-info rounded-pill btn-wave waves-effect waves-light mt-1']) ?>



</div>