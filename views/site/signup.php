<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

//$this->title = 'HRMIS - SignUp';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>Please fill out the following fields to signup:</p>



            <?php $form = ActiveForm::begin([
                'id' => 'form-signup',
                'encodeErrorSummary' => false,
                'errorSummaryCssClass' => 'help-block',
            ]); ?>

                <?= $form->errorSummary($model) ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email')->textInput(['type' => 'email']); ?>

                <?= $form->field($model, 'National_ID')->textInput() ?>

                <?= $form->field($model, 'Registration_Type')->dropDownList(['Farmer' => 'Farmer','Transporter' => 'Transporter'],['prompt' => 'Select ...']) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'password_repeat')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    <?= Html::a('I have an account',['login'],['class' => 'btn btn-outline-success', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>


</div>
