<?php ?>

<aside class="shadow">
    <?php
    echo \yii\bootstrap5\Nav::widget([
        'options' => [
            'class' => 'd-flex flex-column nav-pills'
        ],
        'encodeLabels' => false,
        'items' => [
            [
                'label' =>  '<i class="fa-solid fa-house"></i> Home',
                'url' => ['/video/index']
            ],

            [
                'label' =>  '<i class="fa-solid fa-clock-rotate-left"></i> History',
                'url' => ['/video/history']
            ],
        ]
    ]);

    ?>
</aside>