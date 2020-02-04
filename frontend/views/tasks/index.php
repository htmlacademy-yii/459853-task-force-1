<?php

/* @var $this yii\web\View */

use frontend\helpers\TemplateForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Задания';
?>

<section class="new-task">
    <div class="new-task__wrapper">
        <h1>Новые задания</h1>

        <?php foreach ($tasks as $task): ?>

            <div class="new-task__card">
                <div class="new-task__title">
                    <a href="#" class="link-regular">
                        <h2><?= Html::encode($task->title); ?></h2>
                    </a>
                    <a class="new-task__type link-regular" href="<?= Html::encode($task->category->code) ?>">
                        <p><?= Html::encode($task->category->name); ?></p>
                    </a>
                </div>
                <div class="new-task__icon new-task__icon--translation"></div>
                <p class="new-task_description">
                    <?= Html::encode($task->description); ?>
                </p>
                <b class="new-task__price new-task__price--translation"><?= $task->price; ?><b> ₽</b></b>
                <p class="new-task__place"><?= Html::encode($task->location ?? 'Уточняется'); ?></p>
                <span class="new-task__time"> <?= $task->created_at; ?></span>
            </div>

        <?php endforeach; ?>

    </div>
    <div class="new-task__pagination">
        <ul class="new-task__pagination-list">
            <li class="pagination__item"><a href="#"></a></li>
            <li class="pagination__item pagination__item--current">
                <a>1</a></li>
            <li class="pagination__item"><a href="#">2</a></li>
            <li class="pagination__item"><a href="#">3</a></li>
            <li class="pagination__item"><a href="#"></a></li>
        </ul>
    </div>
</section>
<section class="search-task">

    <?php
    $arr = [
        'Курьерские услуги',
        'Грузоперевозки',
        'Переводы',
        'Строительство и ремонт',
        'Выгул животных'
    ];

    $select = [
        'response' => 'Без откликов',
        'freelance' => 'Удаленная работа'
    ];

    $date = [
        'day' => 'За день',
        'week' => 'За неделю',
        'month' => 'За месяц'
    ];
    ?>

    <div class="search-task__wrapper">
        <?php $filter = ActiveForm::begin([
            'options' => ['class' => 'search-task__form']
        ]); ?>

        <fieldset class="search-task__categories">
            <legend>Категории</legend>
            <?= Html::activeCheckboxList($tasksForm, 'categories', $arr, ['item' => function ($index, $label, $name, $checked, $value) {
                return TemplateForm::getTemplateCheckbox($label, $value, $name);
            }]); ?>
        </fieldset>

        <fieldset class="search-task__categories">
            <legend>Дополнительно</legend>

            <?= Html::activeCheckboxList($tasksForm, 'additional', $select, ['item' => function ($index, $label, $name, $checked, $value) {
                return TemplateForm::getTemplateCheckbox($label, $value, $name);
            }]); ?>
        </fieldset>

        <?= Html::activeLabel($tasksForm, 'time', [
            'for' => '8',
            'class' => 'search-task__name'
        ]); ?>
        <?= Html::activeDropDownList($tasksForm, 'time', $date, [
            'class' => 'multiple-select input'
        ]); ?>

        <?= Html::activeLabel($tasksForm, 'search', [
            'for' => '9',
            'class' => 'search-task__name'
        ]); ?>
        <?= Html::activeInput('search', $tasksForm, 'search', [
            'class' => 'input-middle input',
            'id' => '9'
        ]) ?>

        <?= Html::submitButton('Искать', ['class' => 'button']); ?>
        <?php $filter = ActiveForm::end(); ?>
    </div>
</section>
