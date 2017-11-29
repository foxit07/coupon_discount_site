<?php

namespace frontend\modules\admitad\controllers;
use yii\web\Controller;
use frontend\models\SubscribersForm;
use Yii;


/**
 * Default controller for the `admitad` module
 */
class DefaultController extends Controller
{


    public function actionSubscribe()
    {

        $subscribe = new SubscribersForm();

        if($subscribe->load(Yii::$app->request->post())){
            if($subscribe->validate() && $subscribe->save()){
                Yii::$app->session->setFlash('subscribe');
                return $this->redirect(['kupon/index']);
            }
        }

        return $this->render('subscribe',[
           'subscribe'=> $subscribe
        ]);
    }
}
