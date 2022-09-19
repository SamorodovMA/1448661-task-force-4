<?php

/** @var yii\web\View $this
 * @var object $dataProvider
 */

use app\models\Category;
use app\models\TaskFilterForm;
use app\models\User;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

$this->title = 'tasks';

?>

<div class="left-column">
    <h3 class="head-main head-task">Новые задания</h3>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_tasks',
        'layout' => "{items}\n<div class='pagination-wrapper'>{pager}</div>",
        'pager' => [
            'prevPageLabel' => '',
            'nextPageLabel' => '',
            'maxButtonCount' => 3,

            'options' => [
                'tag' => 'ul',
                'class' => 'pagination-list',
            ],

            'linkOptions' => ['class' => 'link link--page'],
            'activePageCssClass' => 'pagination-item pagination-item--active',
            'pageCssClass' => 'pagination-item',

            'prevPageCssClass' => 'pagination-item mark',
            'nextPageCssClass' => 'pagination-item mark',
        ],
    ]);
    ?>
</div>

<div class="right-column">
    <div class="right-card black">
        <div class="search-form">
            <?php
            $form = ActiveForm:: begin([
                'method' => 'get',
                'fieldConfig' => [
                    'template' => "{input}",
                    'options' => ['tag' => false],
                    'labelOptions' => [
                        'class' => 'control-label',
                    ]
                ]


            ]); ?>


            <h4 class="head-card">Категории</h4>
            <div class="form-group">
                <div class="checkbox-wrapper">
                    <?php
                    $itemsCategory = ArrayHelper:: map(Category::find()->all(), 'id', 'name'); ?>

                    <?= $form->field($taskFilterForm, 'categories')
                        ->checkboxList($itemsCategory, [
                            'tag' => false,
                            'item' => function ($index, $label, $name, $checked) {
                                $index++;
                                $selected = $checked ? 'checked' : '';
                                return
                                    "<label class='control-label' for='{$index}'>
                                 <input type='checkbox' id='{$index}' {$selected}>\n{$label}
                                 </label>";
                            }
                        ]) ?>

                </div>
            </div>
            <h4 class="head-card">Дополнительно</h4>
            <div class="form-group">
                <?php
                $executor = ArrayHelper:: map(User::find()->all(), 'id', 'is_executor'); ?>
                <?= $form->field($taskFilterForm, 'executor')->checkbox([
                    'labelOptions' => [
                        'class' => 'control-label',
                    ]
                ]); ?>

            </div>
            <h4 class="head-card">Период</h4>
            <div class="form-group">
                <?= $form->field($taskFilterForm, 'period', [
                    'template' => "{label}\n{input}"
                ])
                    ->dropDownList(TaskFilterForm::getPeriodValue(), [
                    ]); ?>
            </div>

            <input type="submit" class="button button--blue" value="Искать">
            <?php
            ActiveForm::end() ?>

        </div>
    </div>
</div>




