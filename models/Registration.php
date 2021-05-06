<?php
/**
 * Created by PhpStorm.
 * User: HP ELITEBOOK 840 G5
 * Date: 3/9/2020
 * Time: 4:09 PM
 */

namespace app\models;
use yii\base\Model;

use Yii;


class Registration extends Model
{

public $Key;
public $Source_Type;
public $Registration_Type;
public $ID_Number;
public $First_Name;
public $Middle_Name;
public $Last_Name;
public $County;
public $Sub_County;
public $Ward;
public $Gender;
public $Phone_No;
public $E_Mail;
public $Status;
public $Farmer_Type;
public $Date_of_Birth;
public $Land_Acrege;
public $KRA_Pin_No;
public $Disabled;
public $Age;
public $isNewRecord;

    public function rules()
    {
        return [
           
        ];
    }

    public function attributeLabels()
    {
        return [
             'Disabled' => 'Are you Physically Challenged ?'
        ];
    }

    public function getCounties(){
        $service = Yii::$app->params['ServiceName']['Counties'];
        $filter = [];
        $result = \Yii::$app->navhelper->getData($service, $filter);
        return Yii::$app->navhelper->refactorArray($result,'Code','Name');
    }

     public function getSubcounties(){
        $service = Yii::$app->params['ServiceName']['SubCounties'];
        $filter = [];
        $result = \Yii::$app->navhelper->getData($service, $filter);
        return Yii::$app->navhelper->refactorArray($result,'Sub_County_Code','Subcounty_Name');
    }

    public function hasApplication($No)
    {
        $model = new Registration();
        $service = Yii::$app->params['ServiceName']['FarmerApplication'];

        $result = Yii::$app->navhelper->findOne($service, 'ID_Number', $No);


       return is_object($result) && isset($result->ID_Number);

        
    }
}