<?php

use app\models\Category;
use app\models\ToolMaker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\admin\models\Tool2Search $model */
/** @var yii\widgets\ActiveForm $form */
?>


    <div class="col-xl-3 col-lg-4 col-md-12 mb-3 mb-md-0">
        <div class="card p-3 mb-3">

            <?php $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
            ]); ?>

            <?= $form->field($model, 'id') ?>

            <?= $form->field($model, 'created_at') ?>

            <?= $form->field($model, 'updated_at') ?>

            <?= $form->field($model, 'tool_maker_id')->dropDownList(ToolMaker::getEntities(), [
                    'prompt' => 'Выберите производителя',
                ]) ?>

            <?= $form->field($model, 'category_id')->dropDownList(Category::getEntities(), [
                    'prompt' => 'Выберите категорию',
                ]) ?>

            <?php // echo $form->field($model, 'diameter') ?>

            <?php // echo $form->field($model, 'full_length') ?>

            <?php // echo $form->field($model, 'work_length') ?>

            <?php // echo $form->field($model, 'material_made_of_id') ?>

            <?php // echo $form->field($model, 'min_amount') ?>

            <?php // echo $form->field($model, 'location_id') ?>

            <?php // echo $form->field($model, 'cell') ?>

            <?php // echo $form->field($model, 'project_id') ?>

            <?php // echo $form->field($model, 'inventory_time') ?>

            <?php // echo $form->field($model, 'delete_status') ?>

            <?php // echo $form->field($model, 'qr') ?>

            <div class="form-group d-flex flex-column gap-2">
                <?= Html::submitButton('Поиск', ['class' => 'btn btn-outline-primary rounded-pill btn-wave waves-effect waves-light']) ?>
                <?= Html::a('Сбросить', ['index'], ['class' => 'btn btn-outline-secondary rounded-pill btn-wave waves-effect waves-light']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <!-- <div class="col-xl-3 col-lg-4 col-md-12 mb-3 mb-md-0">
        <div class="card">
            <div class="card-header border-bottom py-3 mb-0 fw-bold text-uppercase">Category</div>
            <div class="card-body pb-0">
                <div class="form-group">
                    <label class="form-label">Mens</label>
                    <div class="choices" data-type="select-one" tabindex="0" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false"><div class="choices__inner"><select class="form-control choices__input" data-trigger="" name="choices-single-default" id="choices-single-default1" hidden="" tabindex="-1" data-choice="active"><option value="" data-custom-properties="[object Object]">--Select--</option></select><div class="choices__list choices__list--single"><div class="choices__item choices__placeholder choices__item--selectable" data-item="" data-id="1" data-value="" data-custom-properties="[object Object]" aria-selected="true">--Select--</div></div></div><div class="choices__list choices__list--dropdown" aria-expanded="false"><input type="text" class="choices__input choices__input--cloned" autocomplete="off" autocapitalize="off" spellcheck="false" role="textbox" aria-autocomplete="list" aria-label="--Select--" placeholder="Search"><div class="choices__list" role="listbox"><div id="choices--choices-single-default1-item-choice-5" class="choices__item choices__item--choice is-selected choices__placeholder choices__item--selectable is-highlighted" role="option" data-choice="" data-id="5" data-value="" data-select-text="Press to select" data-choice-selectable="" aria-selected="true">--Select--</div><div id="choices--choices-single-default1-item-choice-1" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="1" data-value="Choice 5" data-select-text="Press to select" data-choice-selectable="">Accessories</div><div id="choices--choices-single-default1-item-choice-2" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="2" data-value="Choice 3" data-select-text="Press to select" data-choice-selectable="">Bootom wear</div><div id="choices--choices-single-default1-item-choice-3" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="3" data-value="Choice 1" data-select-text="Press to select" data-choice-selectable="">Foot wear</div><div id="choices--choices-single-default1-item-choice-4" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="4" data-value="Choice 4" data-select-text="Press to select" data-choice-selectable="">Men's Groming</div><div id="choices--choices-single-default1-item-choice-6" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="6" data-value="Choice 2" data-select-text="Press to select" data-choice-selectable="">Top wear</div></div></div></div>
                </div>
                <div class="form-group mt-2">
                    <label class="form-label">Women</label>
                    <div class="choices" data-type="select-one" tabindex="0" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false"><div class="choices__inner"><select class="form-control choices__input" data-trigger="" name="choices-single-default" id="choices-single-default2" hidden="" tabindex="-1" data-choice="active"><option value="" data-custom-properties="[object Object]">--Select--</option></select><div class="choices__list choices__list--single"><div class="choices__item choices__placeholder choices__item--selectable" data-item="" data-id="1" data-value="" data-custom-properties="[object Object]" aria-selected="true">--Select--</div></div></div><div class="choices__list choices__list--dropdown" aria-expanded="false"><input type="text" class="choices__input choices__input--cloned" autocomplete="off" autocapitalize="off" spellcheck="false" role="textbox" aria-autocomplete="list" aria-label="--Select--" placeholder="Search"><div class="choices__list" role="listbox"><div id="choices--choices-single-default2-item-choice-6" class="choices__item choices__item--choice is-selected choices__placeholder choices__item--selectable is-highlighted" role="option" data-choice="" data-id="6" data-value="" data-select-text="Press to select" data-choice-selectable="" aria-selected="true">--Select--</div><div id="choices--choices-single-default2-item-choice-1" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="1" data-value="Choice 6" data-select-text="Press to select" data-choice-selectable="">Accessories</div><div id="choices--choices-single-default2-item-choice-2" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="2" data-value="Choice 5" data-select-text="Press to select" data-choice-selectable="">Beauty Groming</div><div id="choices--choices-single-default2-item-choice-3" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="3" data-value="Choice 4" data-select-text="Press to select" data-choice-selectable="">Bottom wear</div><div id="choices--choices-single-default2-item-choice-4" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="4" data-value="Choice 2" data-select-text="Press to select" data-choice-selectable="">Foot wear</div><div id="choices--choices-single-default2-item-choice-5" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="5" data-value="Choice 7" data-select-text="Press to select" data-choice-selectable="">jewellery</div><div id="choices--choices-single-default2-item-choice-7" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="7" data-value="Choice 3" data-select-text="Press to select" data-choice-selectable="">Top wear</div><div id="choices--choices-single-default2-item-choice-8" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="8" data-value="Choice 1" data-select-text="Press to select" data-choice-selectable="">Western wear</div></div></div></div>
                </div>
                <div class="form-group mt-2">
                    <label class="form-label">Baby &amp; Kids</label>
                    <div class="choices" data-type="select-one" tabindex="0" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false"><div class="choices__inner"><select class="form-control choices__input" data-trigger="" name="choices-single-default" id="choices-single-default3" hidden="" tabindex="-1" data-choice="active"><option value="" data-custom-properties="[object Object]">--Select--</option></select><div class="choices__list choices__list--single"><div class="choices__item choices__placeholder choices__item--selectable" data-item="" data-id="1" data-value="" data-custom-properties="[object Object]" aria-selected="true">--Select--</div></div></div><div class="choices__list choices__list--dropdown" aria-expanded="false"><input type="text" class="choices__input choices__input--cloned" autocomplete="off" autocapitalize="off" spellcheck="false" role="textbox" aria-autocomplete="list" aria-label="--Select--" placeholder="Search"><div class="choices__list" role="listbox"><div id="choices--choices-single-default3-item-choice-5" class="choices__item choices__item--choice is-selected choices__placeholder choices__item--selectable is-highlighted" role="option" data-choice="" data-id="5" data-value="" data-select-text="Press to select" data-choice-selectable="" aria-selected="true">--Select--</div><div id="choices--choices-single-default3-item-choice-1" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="1" data-value="Choice 4" data-select-text="Press to select" data-choice-selectable="">Baby care</div><div id="choices--choices-single-default3-item-choice-2" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="2" data-value="Choice 1" data-select-text="Press to select" data-choice-selectable="">Boys Clothing</div><div id="choices--choices-single-default3-item-choice-3" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="3" data-value="Choice 2" data-select-text="Press to select" data-choice-selectable="">Girls Clothing</div><div id="choices--choices-single-default3-item-choice-4" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="4" data-value="Choice 6" data-select-text="Press to select" data-choice-selectable="">Kids Footwear</div><div id="choices--choices-single-default3-item-choice-6" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="6" data-value="Choice 3" data-select-text="Press to select" data-choice-selectable="">Toys</div></div></div></div>
                </div>
                <div class="form-group mt-2">
                    <label class="form-label">Electronics</label>
                    <div class="choices" data-type="select-one" tabindex="0" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false"><div class="choices__inner"><select class="form-control choices__input" data-trigger="" name="choices-single-default" id="choices-single-default4" hidden="" tabindex="-1" data-choice="active"><option value="" data-custom-properties="[object Object]">--Select--</option></select><div class="choices__list choices__list--single"><div class="choices__item choices__placeholder choices__item--selectable" data-item="" data-id="1" data-value="" data-custom-properties="[object Object]" aria-selected="true">--Select--</div></div></div><div class="choices__list choices__list--dropdown" aria-expanded="false"><input type="text" class="choices__input choices__input--cloned" autocomplete="off" autocapitalize="off" spellcheck="false" role="textbox" aria-autocomplete="list" aria-label="--Select--" placeholder="Search"><div class="choices__list" role="listbox"><div id="choices--choices-single-default4-item-choice-5" class="choices__item choices__item--choice is-selected choices__placeholder choices__item--selectable is-highlighted" role="option" data-choice="" data-id="5" data-value="" data-select-text="Press to select" data-choice-selectable="" aria-selected="true">--Select--</div><div id="choices--choices-single-default4-item-choice-1" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="1" data-value="Choice 3" data-select-text="Press to select" data-choice-selectable="">Gaming &amp; Accessories</div><div id="choices--choices-single-default4-item-choice-2" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="2" data-value="Choice 4" data-select-text="Press to select" data-choice-selectable="">Health care Appliances</div><div id="choices--choices-single-default4-item-choice-3" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="3" data-value="Choice 2" data-select-text="Press to select" data-choice-selectable="">Laptops</div><div id="choices--choices-single-default4-item-choice-4" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="4" data-value="Choice 1" data-select-text="Press to select" data-choice-selectable="">Mobiles</div></div></div></div>
                </div>
                <div class="form-group mt-2 mb-3">
                    <label class="form-label">Sport,Books &amp; More </label>
                    <div class="choices" data-type="select-one" tabindex="0" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false"><div class="choices__inner"><select class="form-control choices__input" data-trigger="" name="choices-single-default" id="choices-single-default5" hidden="" tabindex="-1" data-choice="active"><option value="" data-custom-properties="[object Object]">--Select--</option></select><div class="choices__list choices__list--single"><div class="choices__item choices__placeholder choices__item--selectable" data-item="" data-id="1" data-value="" data-custom-properties="[object Object]" aria-selected="true">--Select--</div></div></div><div class="choices__list choices__list--dropdown" aria-expanded="false"><input type="text" class="choices__input choices__input--cloned" autocomplete="off" autocapitalize="off" spellcheck="false" role="textbox" aria-autocomplete="list" aria-label="--Select--" placeholder="Search"><div class="choices__list" role="listbox"><div id="choices--choices-single-default5-item-choice-5" class="choices__item choices__item--choice is-selected choices__placeholder choices__item--selectable is-highlighted" role="option" data-choice="" data-id="5" data-value="" data-select-text="Press to select" data-choice-selectable="" aria-selected="true">--Select--</div><div id="choices--choices-single-default5-item-choice-1" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="1" data-value="Choice 2" data-select-text="Press to select" data-choice-selectable="">Books</div><div id="choices--choices-single-default5-item-choice-2" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="2" data-value="Choice 5" data-select-text="Press to select" data-choice-selectable="">Exercise &amp; fitness</div><div id="choices--choices-single-default5-item-choice-3" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="3" data-value="Choice 3" data-select-text="Press to select" data-choice-selectable="">Gaming</div><div id="choices--choices-single-default5-item-choice-4" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="4" data-value="Choice 4" data-select-text="Press to select" data-choice-selectable="">Music</div><div id="choices--choices-single-default5-item-choice-6" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="6" data-value="Choice 1" data-select-text="Press to select" data-choice-selectable="">Stationery</div></div></div></div>
                </div>
            </div>
            <div class="card-header border-bottom border-top py-3 mb-0 fw-bold text-uppercase rounded-0">
                Filter</div>
            <div class="card-body">
                <form>
                    <div class="form-group mb-3">
                        <label class="form-label">Brand</label>
                        <div class="choices" data-type="select-one" tabindex="0" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false"><div class="choices__inner"><select class="form-control choices__input" data-trigger="" name="choices-single-default" id="choices-single-default6" hidden="" tabindex="-1" data-choice="active"><option value="Wallmart" data-custom-properties="[object Object]">Wallmart</option></select><div class="choices__list choices__list--single"><div class="choices__item choices__item--selectable" data-item="" data-id="1" data-value="Wallmart" data-custom-properties="[object Object]" aria-selected="true">Wallmart</div></div></div><div class="choices__list choices__list--dropdown" aria-expanded="false"><input type="text" class="choices__input choices__input--cloned" autocomplete="off" autocapitalize="off" spellcheck="false" role="textbox" aria-autocomplete="list" aria-label="This is a placeholder set in the config" placeholder="Search"><div class="choices__list" role="listbox"><div id="choices--choices-single-default6-item-choice-1" class="choices__item choices__item--choice choices__item--selectable is-highlighted" role="option" data-choice="" data-id="1" data-value="Catseye" data-select-text="Press to select" data-choice-selectable="" aria-selected="true">Catseye</div><div id="choices--choices-single-default6-item-choice-2" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="2" data-value="Moonsoon" data-select-text="Press to select" data-choice-selectable="">Moonsoon</div><div id="choices--choices-single-default6-item-choice-3" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="3" data-value="Textmart" data-select-text="Press to select" data-choice-selectable="">Textmart</div><div id="choices--choices-single-default6-item-choice-4" class="choices__item choices__item--choice is-selected choices__item--selectable" role="option" data-choice="" data-id="4" data-value="Wallmart" data-select-text="Press to select" data-choice-selectable="">Wallmart</div></div></div></div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Type</label>
                        <div class="choices" data-type="select-one" tabindex="0" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false"><div class="choices__inner"><select class="form-control choices__input" data-trigger="" name="choices-single-default" id="choices-single-default7" hidden="" tabindex="-1" data-choice="active"><option value="Small" data-custom-properties="[object Object]">Small</option></select><div class="choices__list choices__list--single"><div class="choices__item choices__item--selectable" data-item="" data-id="1" data-value="Small" data-custom-properties="[object Object]" aria-selected="true">Small</div></div></div><div class="choices__list choices__list--dropdown" aria-expanded="false"><input type="text" class="choices__input choices__input--cloned" autocomplete="off" autocapitalize="off" spellcheck="false" role="textbox" aria-autocomplete="list" aria-label="This is a placeholder set in the config" placeholder="Search"><div class="choices__list" role="listbox"><div id="choices--choices-single-default7-item-choice-1" class="choices__item choices__item--choice choices__item--selectable is-highlighted" role="option" data-choice="" data-id="1" data-value="Extra Large" data-select-text="Press to select" data-choice-selectable="" aria-selected="true">Extra Large</div><div id="choices--choices-single-default7-item-choice-2" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="2" data-value="Large" data-select-text="Press to select" data-choice-selectable="">Large</div><div id="choices--choices-single-default7-item-choice-3" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="3" data-value="Medium" data-select-text="Press to select" data-choice-selectable="">Medium</div><div id="choices--choices-single-default7-item-choice-4" class="choices__item choices__item--choice is-selected choices__item--selectable" role="option" data-choice="" data-id="4" data-value="Small" data-select-text="Press to select" data-choice-selectable="">Small</div></div></div></div>
                    </div>
                </form>
            </div>
            <div class="card-header border-bottom border-top py-3 mb-0 fw-bold text-uppercase rounded-0">
                Rating</div>
            <div class="py-2 px-3">
                <label class="p-1 mt-2 d-flex align-items-center">
                    <span class="check-box mb-0">
                        <span class="ckbox"><input checked="" type="checkbox"><span></span></span>
                    </span>
                    <span class="fs-16 my-auto">
                        <i class="ion ion-md-star  text-warning"></i>
                        <i class="ion ion-md-star  text-warning"></i>
                        <i class="ion ion-md-star  text-warning"></i>
                        <i class="ion ion-md-star  text-warning"></i>
                        <i class="ion ion-md-star  text-warning"></i>
                    </span>
                </label>
                <label class="p-1 mt-2 d-flex align-items-center">
                    <span class="check-box mb-0">
                        <span class="ckbox"><input checked="" type="checkbox"><span></span></span>
                    </span>
                    <span class="fs-16 my-auto">
                        <i class="ion ion-md-star  text-warning"></i>
                        <i class="ion ion-md-star  text-warning"></i>
                        <i class="ion ion-md-star  text-warning"></i>
                        <i class="ion ion-md-star  text-warning"></i>
                    </span>
                </label>
                <label class="p-1 mt-2 d-flex align-items-center">
                    <span class="check-box mb-0">
                        <span class="ckbox"><input checked="" type="checkbox"><span></span></span>
                    </span>
                    <span class="fs-16 my-auto">
                        <i class="ion ion-md-star  text-warning"></i>
                        <i class="ion ion-md-star  text-warning"></i>
                        <i class="ion ion-md-star  text-warning"></i>
                    </span>
                </label>
                <label class="p-1 mt-2 d-flex align-items-center">
                    <span class="checkbox mb-0">
                        <span class="check-box">
                            <span class="ckbox"><input type="checkbox"><span></span></span>
                        </span>
                    </span>
                    <span class="fs-16 my-auto">
                        <i class="ion ion-md-star  text-warning"></i>
                        <i class="ion ion-md-star  text-warning"></i>
                    </span>
                </label>
                <label class="p-1 mt-2 d-flex align-items-center">
                    <span class="checkbox mb-0">
                        <span class="check-box">
                            <span class="ckbox"><input type="checkbox"><span></span></span>
                        </span>
                    </span>
                    <span class="fs-16 my-auto">
                        <i class="ion ion-md-star  text-warning"></i>
                    </span>
                </label>
                <button class="btn btn-primary-gradient mt-2 mb-2 pb-2" type="submit">Filter</button>
            </div>
        </div>
    </div> -->
