<?php
/**
 * Created by PhpStorm.
 * User: HP ELITEBOOK 840 G5
 * Date: 5/11/2020
 * Time: 3:51 AM
 */

namespace app\models;
use Yii;
use yii\base\Model;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class Attachment extends Model
{

    /**
     * @var UploadedFile
     */

    public $Key;
    public $National_ID;
    public $FilePath;
    public $DocumentTypeID;
    public $Line_No;

    public $attachmentfile;



    public function rules()
    {
        return [
            [['attachmentfile'],'file','maxFiles'=> Yii::$app->params['maxUploadFiles']],
            [['attachmentfile'],'file','mimeTypes'=> Yii::$app->params['MimeTypes']],
            [['attachmentfile'],'file','maxSize' => Yii::$app->params['maxSize']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'attachmentfile' => 'File Upload',
        ];
    }

    public function upload($docId='')
    {
        $model = $this;

        $imageId = Yii::$app->security->generateRandomString(8);

        $imagePath = Yii::getAlias('@app/web/uploads/'.$imageId.'.'.$this->attachmentfile->extension);
        $navPath = \yii\helpers\Url::home(true).'uploads/'.$imageId.'.'.$this->attachmentfile->extension; // Readable from nav interface

        if($model->validate()){
            // Check if directory exists, else create it
            if(!is_dir(dirname($imagePath))){
                FileHelper::createDirectory(dirname($imagePath));
            }

            $this->attachmentfile->saveAs($imagePath);

           
            
                $service = Yii::$app->params['ServiceName']['RegistrationAttachments'];
                $model->FilePath = $navPath;
                $model->National_ID = Yii::$app->user->identity->National_ID;
                $model->DocumentTypeID = $this->DocumentTypeID;
                $result = Yii::$app->navhelper->postData($service, $model);
                
                return $result;
                
           
            
        }else{
            return false;
        }
    }

    public function getPath($DocNo=''){
        if(!$DocNo){
            return false;
        }
        $service = Yii::$app->params['ServiceName']['RegistrationAttachments'];
        $filter = [
            'DocumentTypeID' => $DocNo,
            'National_ID' => Yii::$app->user->identity->National_ID
        ];

        $result = Yii::$app->navhelper->getData($service,$filter);
        if(is_array($result)) {
            return basename($result[0]->FilePath);
        }else{
            return false;
        }

    }

    public function readAttachment($DocNo)
    {
        $service = Yii::$app->params['ServiceName']['RegistrationAttachments'];
        $filter = [
            'DocumentTypeID' => $DocNo,
            'National_ID' => Yii::$app->user->identity->National_ID
        ];

        $result = Yii::$app->navhelper->getData($service,$filter);

        

        $path = strtolower($result[0]->FilePath);

         // $binary = $this->curl_get_contents($path);

        $binary = file_get_contents($path);

       if(is_string($path)){
            return base64_encode($binary);
       }

       return false;

       

    }

    function curl_get_contents($url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

   

    public function getImages()
    {

        $service = Yii::$app->params['ServiceName']['RegistrationAttachments'];
        $filter = [
            'National_ID' => Yii::$app->user->identity->National_ID,
            'DocumentTypeID' => 1
        ];



        $result = Yii::$app->navhelper->getData($service,$filter);

        //Yii::$app->recruitment->printrr($result);
        if(is_array($result)){
            return $result;
        }else{
            return false;
        }

    }

     public function File($No)
    {

        $service = Yii::$app->params['ServiceName']['RegistrationAttachments'];
        $filter = [
            'National_ID' => Yii::$app->user->identity->National_ID,
            'DocumentTypeID' => $No
        ];



        $result = Yii::$app->navhelper->getData($service,$filter);

        //Yii::$app->recruitment->printrr($result);
        if(is_array($result)){
            return $result[0]->FilePath;
        }else{
            return false;
        }

    }

    public function getFileProperties($binary)
    {
        $bin  = base64_decode($binary);
        $props =  getImageSizeFromString($bin);
        return $props['mime'];
    }
}
