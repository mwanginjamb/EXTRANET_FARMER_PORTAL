<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


/* @var $this yii\web\View */

$this->title = \Yii::$app->name.' - File Uploads';
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
                        <div class="card-title"><?= Yii::$app->user->identity->Registration_Type ?> File Uploads</div>

                    </div>

                    <div class="card-body">


                        <?php if(Yii::$app->user->identity->Registration_Type == 'Farmer'){ ?>

                            <div class="row">

                                <div class="col-md-12">
                                     <?php $form = \yii\widgets\ActiveForm::begin(['action'=> 'uploads','options' => ['enctype' => 'multipart/form-data']]); ?>

                                        <?= $form->errorSummary($model); ?>

                                        <button class="btn btn-sm btn-primary btn-file"><?= 'Upload Farm Image' ?>
                                            <!--<input type="file" class="imageFile" name="imageFile">-->
                                            <?= $form->field($model,'attachmentfile')->fileInput(['class'=>'imageFile','name'=>'imageFile'])->label(false) ?>
                                            <?= $form->field($model,'DocumentTypeID')->hiddenInput(['value' => $uploadList[0]->Line_No])->label(false) ?>
                                        </button>

                                        <?php \yii\widgets\ActiveForm::end(); ?>
                                </div>



                                <?php




                                 if(is_array($FarmImages)): ?>

                                 <div class="row">

                                        <?php foreach($FarmImages as $f): ?>

                                            <div class="col-md-3">
                                                <img src="<?= $f->FilePath ?>" class="img-fluid img-thumbnail m-2" >

                                                <div class="action-buttons" style="position: relative;z-index:10; top:-30%; right: -40%">
                                                    <?= Html::a('<i class="fas fa-trash"></i>',['remove-image','Key' => $f->Key],['class' => 'btn btn-sm btn-danger m-1','title' => 'Delete Farm  Image'])?>
                                                </div>
                                            </div>

                                        <?php endforeach; ?>

                                    
                                </div><!-- Farm Images row -->

                                <?php endif; ?>


                            </div>

                        <?php } ?>

                        <?php if(Yii::$app->user->identity->Registration_Type == 'Transporter'){ ?>

                            <table class="table">
                                <thead>
                                    <th>Description</th>
                                    <th>File</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php foreach($uploadList as $doc): ?>

                                        <tr>
                                            <td><?=$doc->Description?></td>
                                            <td><?= ($model->file($doc->Line_No))?Html::a('view',['site/read','path' => $model->file($doc->Line_No)],['class' => 'btn btn-warning btn-sm','view Uploaded attachment.']):'Not Yet Uploaded '?></td>
                                            <td>
                                                

                                                <?php $form = \yii\widgets\ActiveForm::begin(['action'=> 'uploads','options' => ['enctype' => 'multipart/form-data']]); ?>

                                        <?= $form->errorSummary($model); ?>

                                        <button class="btn btn-sm btn-success btn-file" title="upload an attachment"><i class="fas fa-upload"></i>
                                            <!--<input type="file" class="imageFile" name="imageFile">-->
                                            <?= $form->field($model,'attachmentfile')->fileInput(['class'=>'imageFile','name'=>'imageFile'])->label(false) ?>
                                            <?= $form->field($model,'DocumentTypeID')->hiddenInput(['value' => $doc->Line_No])->label(false) ?>
                                        </button>

                                        <?php \yii\widgets\ActiveForm::end(); ?>

                                            </td>
                                        </tr>

                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        <?php } ?>



                      
                    </div>
                </div>
                        
            </div><!--End Card.-- >

        </div>
            

    </div>
</div>


<?php

$script = <<<JS
$('.imageFile').change((e) => {
        $(e.target).closest('form').trigger('submit');
    });
JS;

$this->registerJs($script);


$style = <<<CSS
    div.meeting-image {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-content: center;
        width: 100%;
    }
    .upload-icon {
        width: 80%;
        height: 70%;
        border-radius: 0;
        padding:2px;
        background-color: #e0e0e0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        color: #454545;
        margin: 0 auto;
    }
    
    .upload-icon img{
        max-width: 100%;
        max-height: 100%;
    }
    
    .upload-icon p{
        text-align: center;
        margin: 0;
        padding: 5px;
    }
    
    .btn-file {
        display: flex;
        position: relative;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    
    }
    .btn-file input {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
    }
    
    td.upload {
        cursor: pointer;
        border:1px gainsboro dashed;
        
    }
    
    .upload > i{
      display: none;
      position: relative;
          
    }
    .upload:hover >  i{
       display: flex;
       flex-direction: column; 
    }
CSS;

$this->registerCss($style);
