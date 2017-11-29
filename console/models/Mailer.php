<?php
/**
 * Created by PhpStorm.
 * User: foxit
 * Date: 23.11.2017
 * Time: 14:50
 */

namespace console\models;

use yii\base\Model;
use frontend\modules\admitad\models\Coupon;
use Yii;

class Mailer extends Model
{

    private $coupon;


    public function getCoupon()
    {
       $coupon = new Coupon();
       $coupon=$coupon->getCoupon();
       $couponAction=null;
       foreach($coupon as $value){
           if($value['species']=='action'){
               $couponAction[]=$value;
           }
       }
       $this->coupon=$couponAction;
       return true;
    }

    public function send()
    {

        //print_r($this->coupon); die;
     $result= Yii::$app->mailer->compose('coupon/html',[
         'coupon'=>$this->coupon,
     ])
            ->setFrom(['rotokan2@gmail.com'=>'Привет от Давида'])
            ->setTo('rotokan2@gmail.com')
            ->setSubject('Тема сообщения')
            ->send();

     var_dump($result);
     if($result){
         return true;
     }else{
         return false;
     }
    }
}