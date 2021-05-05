<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


/* @var $this yii\web\View */

$this->title = \Yii::$app->name;
?>
<div class="site-index">

    

    <div class="body-content">

        <div class="row">

            <div class="col-md-12 col-lg-12">
                <div class="card card-success">
                    <div class="card-header">
                        <div class="card-title"><?= Yii::$app->user->identity->Registration_Type ?> Registration</div>
                    </div>

                    <div class="card-body">

                        <?php $form = ActiveForm::begin([
                                'id' => 'form-signup',
                                'encodeErrorSummary' => false,
                                'errorSummaryCssClass' => 'help-block',
                            ]); ?>
                                                


                                    <div class="row">

                                        <div class="col-md-6">
                                         <?= $form->field($model, 'Registration_Type')->textInput(['readonly' => true]) ?>
                                         <?= $form->field($model, 'ID_Number')->textInput(['value' => Yii::$app->user->identity->National_ID, 'readonly' => true]) ?>
                                          <?= $form->field($model, 'First_Name')->textInput(['maxlength' => 100,'readonly' => true]) ?>
                                          <?= $form->field($model, 'Middle_Name')->textInput(['maxlength' => 100, 'readonly' => true]) ?>
                                          <?= $form->field($model, 'Last_Name')->textInput(['maxlength' => 100, 'readonly' => true]) ?>
                                           <?= $form->field($model, 'County')->dropDownList($model->counties,[
                                            'prompt' => 'Select County.','readonly' => true,'disabled' => true ]) ?>
                                          <?= $form->field($model, 'Sub_County')->dropDownList($model->Subcounties, ['prompt' => 'Select ...','readonly' => true, 'disabled' => true]) ?>
                                          <?= $form->field($model, 'Ward')->textInput(['maxlength' => 100, 'readonly' => true]); ?>
                                    </div>


                                     <div class="col-md-6">
                                         <?= $form->field($model, 'Source_Type')->textInput(['readonly' => true, 'readonly' => true]) ?>
                                         <?= $form->field($model, 'Gender')->textInput(['readonly' => true]) ?>
                                         <?= $form->field($model, 'Phone_No')->textInput(['maxlength' => 15, 'readonly' => true]) ?>
                                         <?= $form->field($model, 'E_Mail')->textInput(['readonly' => true]) ?>
                                         <?= $form->field($model, 'Status')->textInput(['readonly' => true]) ?>
                                         <?= $form->field($model, 'Date_of_Birth')->textInput(['type' => 'date', 'readonly' => true]) ?>
                                         <?= $form->field($model, 'Land_Acrege')->textInput(['type' => 'number', 'readonly' => true]) ?>
                                         <?= $form->field($model, 'KRA_Pin_No')->textInput(['maxlength' => '35', 'readonly' => true]) ?>
                                         <?= $form->field($model, 'Disabled')->checkbox(['checked' => $model->Disabled, 'readonly' => true]) ?>
                                    </div>
                                        
                                    </div>


                                   <!--   <div class="form-group">
                                         <?php Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>

                                    </div> -->

                            <?php ActiveForm::end(); ?>
                    </div>
                </div>
                        
            </div><!--End Card.-- >

        </div>
            

    </div>
</div>
