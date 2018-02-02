<?php


namespace frontend\modules\admitad\controllers;

use yii\web\Controller;
use frontend\modules\admitad\models\Coupon;
use frontend\modules\admitad\models\forms\Company;
use Yii;

/**
 * Description of AdmitadController
 *
 * @author foxit
 */
class KuponController extends Controller
{

   public function actionAuth()
{
	$coupon = new Coupon();
	$coupon->connectToAdmitad();

	 return $this->render('auth');

}

    public function actionIndex()
    {

        $couponId=null;
        $coupon = new Coupon();
        if(Yii::$app->request->get('idc')){
            $idc=Yii::$app->request->get('idc');
            $couponId=$coupon->findId($idc);
        }
        return $this->render('index', [
            'coupon' => $coupon->getCoupon(),
            'image' => $coupon->getImage(),
            'couponId'=>$couponId,
        ]);
    }

    public function actionCategory($category=null)
    {

        $couponId=null;
        $coupon = new Coupon();
        if(Yii::$app->request->get('idc')){
            $idc=Yii::$app->request->get('idc');
            $couponId=$coupon->findId($idc);
        }
        $coupon = new Coupon();
        return $this->render('category', [
            'image' => $coupon->getImage(),
            'categoryCoupon' => $coupon->getCategoryCoupon($category),
            'category' => $category,
            'couponId'=>$couponId,
        ]);
    }

    public function actionListCompany()
    {


        $coupon = new Coupon();
        return $this->render('listCompany', [
            'companyName' => $coupon->getCompany(),
            'letterCompany' => $coupon->getLetterCompany(),
        ]);
    }

    public function actionCompany($company)
    {

        $couponId=null;
        $coupon = new Coupon();
        $companyAbout=new Company();

        if(Yii::$app->request->get('idc')){
            $idc=Yii::$app->request->get('idc');
            $couponId=$coupon->findId($idc);
        }
        $coupon = new Coupon();
        return $this->render('company', [
            'couponCompany' => $coupon->getCompanyCoupons($company),
            'id' => $company,
            'couponId'=>$couponId,
            'companyAbout'=>$companyAbout->getCompanyAbout($company),
        ]);
    }

    public function actionGoto()
    {
        $id=Yii::$app->request->Get('id');
        $coupon= new Coupon();
        $coupon=$coupon->findId($id);
        return  $this->redirect($coupon['goto_link']); //Yii::$app->response->redirect($coupon['goto_link']);

    }

    public function actionMail()
    {
        $couponId=null;
        $coupon = new Coupon();
        $id=Yii::$app->request->Get('id');
        return $this->render('mail', [
            'coupon' => $coupon->findId($id),
            'image' => $coupon->getImage(),
            'couponId'=>$id,
        ]);
    }

}


