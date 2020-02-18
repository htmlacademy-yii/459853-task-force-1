<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;
use frontend\models\Category;
use frontend\helpers\TemplateForm;

$this->title = 'Пользователи';
?>

<section class="user__search">
    <div class="user__search-link">
        <p>Сортировать по:</p>
        <ul class="user__search-list">
            <li class="user__search-item user__search-item--current">
                <a href="#" class="link-regular">Рейтингу</a>
            </li>
            <li class="user__search-item">
                <a href="#" class="link-regular">Числу заказов</a>
            </li>
            <li class="user__search-item">
                <a href="#" class="link-regular">Популярности</a>
            </li>
        </ul>
    </div>

    <?php foreach ($users as $user): ?>

        <div class="content-view__feedback-card user__search-wrapper">
            <div class="feedback-card__top">
                <div class="user__search-icon">
                    <a href="#"><img src="./img/man-glasses.jpg" width="65" height="65"></a>
                    <span>17 заданий</span>
                    <span>6 отзывов</span>
                </div>
                <div class="feedback-card__top--name user__search-card">
                    <p class="link-name"><a href="#"
                                            class="link-regular"><?= Html::encode($user['name']); ?> <?= Html::encode($user['lastname']); ?></a>
                    </p>
                    <span></span><span></span><span></span><span></span><span class="star-disabled"></span>
                    <b>4.25</b>
                    <p class="user__search-content">
                        <?= Html::encode($user['description']); ?>
                    </p>
                </div>
                <span class="new-task__time">Был на сайте 25 минут назад</span>
            </div>
            <div class="link-specialization user__search-link--bottom">
                <a href="#" class="link-regular">Ремонт</a>
                <a href="#" class="link-regular">Курьер</a>
                <a href="#" class="link-regular">Оператор ПК</a>
            </div>
        </div>

    <?php endforeach; ?>

</section>
<section class="search-task">
    <div class="search-task__wrapper">

        <?php $form = ActiveForm::begin([
            'id' => 'search-task-form',
            'options' => [
                'class' => 'search-task__form',
                'name' => $usersForm->formName()
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
            Html::activeCheckboxList($usersForm, 'categories', Category::find()->select('name')->indexBy('id')->column(), ['item' => function ($index, $label, $name, $checked, $value) {
                return TemplateForm::getTemplateCheckbox($label, $value, $name, $checked);
            }]);
            ?>

        </fieldset>
        <fieldset class="search-task__categories">
            <legend>Дополнительно</legend>
            <?= $form->field($usersForm, 'available', ['template' => "{label}\n{input}"])->checkbox([
                'class' => 'visually-hidden checkbox__input',
                'id' => 'available',
                'tag' => false,
                'value' => 1
            ], false)->label(false); ?>
            <label for="available">Сейчас свободен</label>

            <?= $form->field($usersForm, 'online', ['template' => "{label}\n{input}"])->checkbox([
                'class' => 'visually-hidden checkbox__input',
                'id' => 'online',
                'tag' => false,
                'value' => 1
            ], false)->label(false); ?>
            <label for="online">Сейчас онлайн</label>

            <?= $form->field($usersForm, 'comments', ['template' => "{label}\n{input}"])->checkbox([
                'class' => 'visually-hidden checkbox__input',
                'id' => 'comments',
                'tag' => false,
                'value' => 1
            ], false)->label(false); ?>
            <label for="comments">Есть отзывы</label>

            <?= $form->field($usersForm, 'favorite', ['template' => "{label}\n{input}"])->checkbox([
                'class' => 'visually-hidden checkbox__input',
                'id' => 'favorite',
                'tag' => false,
                'value' => 1
            ], false)->label(false); ?>
            <label for="favorite">В избранном</label>
        </fieldset>

        <label class="search-task__name" for="search">Поиск по имени</label>
        <?php $field = new ActiveField([
            'model' => $usersForm,
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
