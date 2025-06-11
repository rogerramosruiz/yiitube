<?php
/** @var $channel \common\models\User */
/** @var $user \common\models\User */
?>

<p>Hello <?php echo $channel->username ?></p>
<p>
    user  <?php echo \common\helpers\Html::ChannelLink($user, true)?>  
    has suscribed to you
</p>

<p>
    FreeCodeTube team
</p>
