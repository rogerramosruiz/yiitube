<?php 
use yii\helpers\Url;
?>

<a 
    class="btn <?php echo $channel->isSubscribed(Yii::$app->user->id)? 'btn-secondary': 'btn-danger'?>" 
    href="<?php echo Url::to(['channel/subscribe', 'username' => $channel->username]) ?>" 
    data-method="post"
    role="button" 
    data-pjax= "1">
    <?php echo $channel->isSubscribed(Yii::$app->user->id)? 'Unsuscribe': 'Suscribe'?>
    <i class="far fa-bell"></i>
</a> 
<?php
echo $channel->getSubscribers()->count();
?>