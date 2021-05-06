<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


/* @var $this yii\web\View */

$this->title = \Yii::$app->name;
?>
<div class="site-index">

    

    <div class="body-content">

        <?php

             if(Yii::$app->session->hasFlash('success')){
            print ' <div class="alert alert-success alert-dismissable">
                             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-check"></i> Success!</h5>
 ';
            echo Yii::$app->session->getFlash('success');
            print '</div>';
        }else if(Yii::$app->session->hasFlash('error')){
            print ' <div class="alert alert-danger alert-dismissable">
                                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-times"></i> Error!</h5>
                                ';
            echo Yii::$app->session->getFlash('error');
            print '</div>';
        }

        ?>

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
                                        <?= $form->field($model, 'Key')->hiddenInput()->label(false) ?>
                                        <div class="col-md-6">
                                         <?= $form->field($model, 'ID_Number')->textInput(['value' => Yii::$app->user->identity->National_ID, 'readonly' => true]) ?>
                                          <?= $form->field($model, 'First_Name')->textInput(['maxlength' => 100]) ?>
                                          <?= $form->field($model, 'Middle_Name')->textInput(['maxlength' => 100]) ?>
                                          <?= $form->field($model, 'Last_Name')->textInput(['maxlength' => 100]) ?>
                                          <?= $form->field($model, 'County')->dropDownList($model->counties,[
                                            'prompt' => 'Select County.',
                                            'onchange' => '

                                                $.post("../site/subcountydd?countyCode="+$(this).val(), (data) => {
                                                       $("select#registration-sub_county").html(data);
                                                });

                                            ',

                                        ]) ?>
                                          <?= $form->field($model, 'Sub_County')->dropDownList([], ['prompt' => 'Select ...']) ?>
                                          <?= $form->field($model, 'Ward')->textInput(['maxlength' => 100]); ?>
                                    </div>


                                     <div class="col-md-6">
                                         <?= $form->field($model, 'Gender')->dropDownList(['_blank_' => '_blank_', 'Male' => 'Male','Female' => 'Female'],['prompt' => 'Select ...']) ?>
                                         <?= $form->field($model, 'Phone_No')->textInput(['maxlength' => 15]) ?>
                                         <?= $form->field($model, 'E_Mail')->textInput(['readonly' => true, 'value' => Yii::$app->user->identity->email]) ?>
                                         <?= $form->field($model, 'Status')->textInput(['readonly' => true, 'value' => 'Application']) ?>
                                         <?= $form->field($model, 'Date_of_Birth')->textInput(['type' => 'date']) ?>
                                         <?= $form->field($model, 'Land_Acrege')->textInput(['type' => 'number']) ?>
                                         <?= $form->field($model, 'KRA_Pin_No')->textInput(['maxlength' => '35']) ?>
                                         <?= $form->field($model, 'Disabled')->checkbox(['checked' => $model->Disabled]) ?>
                                    </div>
                                        
                                    </div>

                                    
                                     <div class="form-group">
                                         <?= Html::submitButton($model->isNewRecord?'Submit':'Update Data', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>

                                    </div>

                            <?php ActiveForm::end(); ?>
                    </div>
                </div>
                        
            </div><!--End Card.-- >

        </div>
            

    </div>
</div>
