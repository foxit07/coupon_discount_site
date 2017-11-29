<?php
/**
 * Created by PhpStorm.
 * User: foxit
 * Date: 11.11.2017
 * Time: 20:37
 */

namespace frontend\modules\admitad\widgets\modal;

use yii\base\Widget;

class Modal extends Widget
{

    public $coupon;

    public function run()
    {

        return $this->render('views',[
            'coupon'=>$this->coupon,
        ]);
    }
}