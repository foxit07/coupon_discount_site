<?php
/**
 * Created by PhpStorm.
 * User: foxit
 * Date: 23.11.2017
 * Time: 13:31
 */

namespace console\controllers;

use yii\console\Controller;
use console\models\Mailer;

class MailerController extends Controller
{

    public function actionSend()
    {

        $mail = new Mailer();

        if($mail->getCoupon() && $mail->send())
        {
            return true;
        }

        return false;
    }

}