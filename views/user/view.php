<?php
/** @var yii\web\View $this
* @var object $user
*/
?>
<div class="left-column">
    <h3 class="head-main"><?= $user->name; ?></h3>
    <div class="user-card">
        <div class="photo-rate">
            <img class="card-photo" src="<?= (empty($user->avatarFile->path)) ? '' : $user->avatarFile->path; ?>"
                 width="191" height="190" alt="Фото пользователя">
            <div class="card-rate">
                <div class="stars-rating big"><span class="fill-star">&nbsp;</span><span class="fill-star">&nbsp;</span><span
                            class="fill-star">&nbsp;</span><span class="fill-star">&nbsp;</span><span>&nbsp;</span>
                </div>
                <span class="current-rate"><?= $user->rating; ?></span>
            </div>
        </div>
        <p class="user-description">
            <?= $user->description; ?>
        </p>
    </div>
    <div class="specialization-bio">
        <div class="specialization">
            <p class="head-info">Специализации</p>

            <ul class="special-list">
                <?php
                foreach ($user->userCategories as $userCategory) : ?>
                    <li class="special-item">
                        <a href="#" class="link link--regular"><?= $userCategory->category->name ?></a>
                    </li>
                <?php
                endforeach; ?>
            </ul>

        </div>
        <div class="bio">
            <p class="head-info">Био</p>
            <?= $user->bio; ?>
        </div>
    </div>
    <?php
    foreach ($user->feedbacks as $feedback): ?>
        <h4 class="head-regular">Отзывы заказчиков</h4>
        <div class="response-card">
            <img class="customer-photo" src="<?= $feedback->task->customer->avatarFile->path; ?>" width="120"
                 height="127" alt="Фото заказчиков">
            <div class="feedback-wrapper">
                <p class="feedback"><?= $feedback->description ?></p>
                <p class="task">Задание «<a href="#" class="link link--small"><?= $feedback->task->name; ?>
                    </a>» <?= $feedback->task->getStatusName() ?></p>
            </div>
            <div class="feedback-wrapper">
                <div class="stars-rating small"><span class="fill-star">&nbsp;</span><span
                            class="fill-star">&nbsp;</span><span class="fill-star">&nbsp;</span><span class="fill-star">&nbsp;</span><span>&nbsp;</span>
                </div>
                <p class="info-text"><span class="current-time">
                        <?= Yii::$app->formatter->format($feedback->date_creation, 'relativeTime'); ?>
                    </span>
                </p>
            </div>
        </div>
    <?php
    endforeach; ?>
</div>
<div class="right-column">
    <div class="right-card black">
        <h4 class="head-card">Статистика исполнителя</h4>
        <dl class="black-list">
            <dt>Всего заказов</dt>
            <dd><?= $user->complete . ', ' . $user->refuse; ?> </dd>
            <dt>Место в рейтинге</dt>
            <dd><?= $placeInRating = 0// считать будем динамически ?></dd>
            <dt>Дата регистрации</dt>
            <dd><?= Yii::$app->formatter->asDate($user->date_creation, 'php:d F, H:i'); ?></dd>
            <dt>Статус</dt>
            <dd><?= $user->getExecutorStatusName(); ?></dd>
        </dl>
    </div>
    <div class="right-card white">
        <h4 class="head-card">Контакты</h4>
        <ul class="enumeration-list">
            <li class="enumeration-item">
                <a href="#" class="link link--block link--phone"><?= $user->phone; ?></a>
            </li>
            <li class="enumeration-item">
                <a href="#" class="link link--block link--email"><?= $user->email; ?></a>
            </li>
            <li class="enumeration-item">
                <a href="#" class="link link--block link--tg"><?= $user->telegram; ?></a>
            </li>
        </ul>
    </div>
</div>
