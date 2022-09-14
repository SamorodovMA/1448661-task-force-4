<?php
/** @var yii\web\View $this

 * @var object $model
 */

use yii\bootstrap5\Html;
use yii\helpers\HtmlPurifier;

?>

<div class="left-column">
    <h3 class="head-main head-task">Новые задания</h3>
        <div class="task-card">
            <div class="header-task">
                <a  href="#" class="link link--block link--big"><?=HtmlPurifier::process($model->name) ?></a>
                <p class="price price--task"><?= HtmlPurifier::process($model->budget) ?> ₽</p>
            </div>
            <p class="info-text"><span class="current-time"><?= Yii::$app->formatter->format(HtmlPurifier::process($model->date_creation), 'relativeTime') ?></span></p>
            <p class="task-text">Описание</p>
            <div class="footer-task">
                <p class="info-text town-text"><?= HtmlPurifier::process($model->city->name) ?></p>
                <p class="info-text category-text"><?= HtmlPurifier::process($model->category->name) ?></p>
                <a href="#" class="button button--black">Смотреть Задание</a>
            </div>
        </div>

   <!-- <div class="pagination-wrapper">
        <ul class="pagination-list">
            <li class="pagination-item mark">
                <a href="#" class="link link--page"></a>
            </li>
            <li class="pagination-item">
                <a href="#" class="link link--page">1</a>
            </li>
            <li class="pagination-item pagination-item--active">
                <a href="#" class="link link--page">2</a>
            </li>
            <li class="pagination-item">
                <a href="#" class="link link--page">3</a>
            </li>
            <li class="pagination-item mark">
                <a href="#" class="link link--page"></a>
            </li>
        </ul>
    </div>-->
</div>
