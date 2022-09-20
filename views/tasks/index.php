<?php

/** @var yii\web\View $this
 * @var object $dataProvider
 */

use app\models\Category;
use app\models\TaskFilterForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
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
                'fieldConfig' => [
                    'template' => "{input}",
                    'options' => ['tag' => false],
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
                            'item' => function ($index, $label, $name, $checked, $value) {
                                $index++;
                                return
                                    "<label class='control-label' for='{$index}'>
                                 <input type='checkbox' id='{$index}' value='{$value}' >$label
                                 </label>";
                            }
                        ]) ?>
                </div>
            </div>
            <h4 class="head-card">Дополнительно</h4>
            <div class="form-group">

                <?php /*$executor = ArrayHelper:: map(User::find()->all(), 'id', 'is_executor'); */
                /*= $form->field($taskFilterForm, 'executor')->checkbox([
                    'labelOptions' => [
                        'class' => 'control-label',
                    ]
                ]); */
                ?>
                <?= $form->field($taskFilterForm, 'withoutResponses')
                    ->checkbox(['id' => 'withoutResponses',
                        'name'=> false,
                        'labelOptions' => [
                            'class' => 'control-label',
                        ]
                    ]); ?>
            </div>
            <div class="form-group">
                <?= $form->field($taskFilterForm, 'remoteWork')
                    ->checkbox(['id' => 'remoteWork',
                        'name'=> false,
                        'labelOptions' => [
                            'class' => 'control-label',
                        ]
                    ]); ?>
            </div>
            <h4 class="head-card">Период</h4>
            <div class="form-group">
                <?= $form->field($taskFilterForm, 'period', [
                    'template' => "{label}\n{input}",
                    'labelOptions' => [
                        'for' => 'period-value'],
                         'inputOptions' => ['id' => 'period-value']

                ])
                    ->dropDownList(TaskFilterForm::getPeriodValue(), [
                    ]); ?>
            </div>

            <?=Html::submitInput('Искать', ['class' => 'button button--blue'])?>

            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>




