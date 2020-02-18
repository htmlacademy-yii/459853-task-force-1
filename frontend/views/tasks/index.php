<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;
use frontend\models\Category;
use frontend\helpers\TemplateForm;

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
    <div class="search-task__wrapper">

        <?php $form = ActiveForm::begin([
            'id' => 'search-task-form',
            'options' => [
                'class' => 'search-task__form',
                'name' => $tasksForm->formName()
            ],
            'fieldConfig' => [
                'options' => [
                    'tag' => false
                ]
            ]
        ]); ?>

        <fieldset class="search-task__categories">
            <legend>Категории</legend>
            <?=
            Html::activeCheckboxList($tasksForm, 'categories', Category::find()->select('name')->indexBy('id')->column(), ['item' => function ($index, $label, $name, $checked, $value) {
                return TemplateForm::getTemplateCheckbox($label, $value, $name, $checked);
            }]);
            ?>
        </fieldset>

        <fieldset class="search-task__categories">
            <legend>Дополнительно</legend>
            <?= $form->field($tasksForm, 'replies', ['template' => "{label}\n{input}"])->checkbox([
                'class' => 'visually-hidden checkbox__input',
                'id' => 'replies',
                'tag' => false,
                'value' => 1
            ], false)->label(false); ?>
            <label for="replies">Без откликов</label>

            <?= $form->field($tasksForm, 'location', ['template' => "{label}\n{input}"])->checkbox([
                'class' => 'visually-hidden checkbox__input',
                'id' => 'location',
                'value' => 1
            ], false)->label(false); ?>
            <label for="location">Удаленная работа</label>
        </fieldset>

        <label class="search-task__name" for="period">Период</label>
        <?= $form->field($tasksForm, 'period', ['template' => "{label}\n{input}"])
            ->dropDownList(
                ['all' => 'За все время', 'day' => 'За день', 'week' => 'За неделю', 'month' => 'За месяц'],
                [
                    'class' => 'multiple-select input',
                    'id' => 'period',
                    'size' => '1',
                ]
            )->label(false); ?>

        <label class="search-task__name" for="search">Поиск по названию</label>
        <?php $field = new ActiveField([
            'model' => $tasksForm,
            'template' => "{input}\n{error}",
            'attribute' => 'search',
            'form' => $form,
        ]);
        $field->textInput([
            'class' => 'input-middle input',
            'id' => 'search',
        ]); ?>
        <?= $field->render(); ?>

        <button class="button" type="submit">Искать</button>

        <?php ActiveForm::end(); ?>
    </div>
</section>
