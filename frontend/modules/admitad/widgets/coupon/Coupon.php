<?php
/**
 * Created by PhpStorm.
 * User: foxit
 * Date: 09.11.2017
 * Time: 20:46
 */

namespace frontend\modules\admitad\widgets\coupon;
use yii\base\Widget;
use frontend\modules\admitad\widgets\coupon\models\Coupon as CouponType;

class Coupon extends Widget
{
    public $coupon;
    public $timeOutPjax=10000;
    public $countCouponOnPage=12;
    public $linkPagerMaxButtonCount=5;
    public $blockcollg2left='image';
    public $typeDiscount=null;


    public function run()
    {

        return $this->render('index',[
            'coupon'=>$this->coupon,
            'timeOutPjax'=>$this->timeOutPjax,
            'countCouponOnPage'=>$this->countCouponOnPage,
            'linkPagerMaxButtonCount'=>$this->linkPagerMaxButtonCount,
            'blockcollg2left'=>$this->blockcollg2left, //показать блок со скидкой или лого компании
            'typeDiscount'=>$this->getTypeDiscount(),
        ]);
    }

    private function getTypeDiscount()
    {
        if($this->typeDiscount!=null){
            return $this->typeDiscount;
        }
        return CouponType::getTypeDiscounts($this->coupon);
    }

}