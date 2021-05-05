<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $user->verification_token]);
?>
<div class="verify-email">
    <p>Hello <?= Html::encode($user->username) ?>,</p>

    <p>Follow the link below to verify your email:</p>

    <p><?= Html::a('Verification Link', $verifyLink) ?></p>

    <p> <i><b>or copy and paste below link on your browser's address bar</i></b></p>
    <code><?= Html::encode($verifyLink) ?></code>
</div>
