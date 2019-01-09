<?php

use yii\helpers\Html;
?>

<div class="site-index">
    <div class="body-content">
    <div class="form">
        <?= Html::beginForm('/', 'post', ['enctype' => 'multipart/form-data']) ?>
        <?= Html::activeFileInput($form, 'file', ['id' => 'file', 'accept' => '.html']) ?>
        <div class="button">
        <?= Html::submitButton('Построить график', ['id' => 'button','class' => 'btn-primary']); ?>
        </div>
        <?= Html::endForm() ?>
    </div>
    </div>
</div>
