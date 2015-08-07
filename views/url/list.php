<?php use yii\grid\GridView; ?>1
2
<?php


    echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'slug',
        'route',
        ['class' => 'yii\grid\ActionColumn']
    ],
]) ?>