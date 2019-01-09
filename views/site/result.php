<?php

use yii\helpers\Html;

?>
<div class="site-index">
    <div class="body-content">
    <?=\dosamigos\highcharts\HighCharts::widget([
           'clientOptions' => [
            'chart' => [
                    'type' => 'line'
            ],
            'xAxis' => [
                'title' => [
                    'text' => 'Операция'
                ],
                'categories' => array_keys($data),
            ],
            'yAxis' => [
                'title' => [
                    'text' => 'Баланс'
                ],
            ],
            'series' => [
                ['name' => 'Баланс', 'data' => array_values($data)],
            ]
        ]
        ]); ?>
    </div>
</div>
