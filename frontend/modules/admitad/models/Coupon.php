<?php
/**
 * Created by PhpStorm.
 * User: foxit
 * Date: 08.11.2017
 * Time: 19:07
 */

namespace frontend\modules\admitad\models;

use yii\base\Model;
use yii\db\Query;
use Yii;
use yii\web\HttpException;
use yii\web\Response;
use Admitad\Api\Api;

class Coupon extends Model
{

 private const DURATION_CACHE =3600;
    private $admitad;
    private $limit=500;
    private $offset=0;
    private $region='RU';
    private $order_by='-rating';
    private $uri='/coupons/website/759678/';
    private $scope='coupons '.'coupons_for_website '.'public_data '.'manage_websites '.'websites ';
    private $key_1='coupon';
    private $key_2='image';
    private $key_3='company';
    private $key_4='letter';
   
   private $clientId = 'c43bc2a73cf44fb4b29b13be03a9a3';
   private $clientSecret = 'fe87c1897aa8ad8b43c81e9ee043be';
   private $redirectUri='https://abens.ru/';
   private $username = 'foxit77';
   private $password = '4CApv5omBf';	
  
  public function connectToAdmitad()
    {
	
        $api = new Api();
	$authorizeResult = $api->authorizeClient($this->clientId, $this->clientSecret, $this->scope)->getArrayResult();
        $this->admitad=new Api($authorizeResult['access_token']);

	return true;	
    }

    private function setCache()
    {	

       Yii::$app->cache->flush();
      if($this->connectToAdmitad()) {
          Yii::$app->cache->set($this->key_1, $this->getCouponsToAdmitad(), self::DURATION_CACHE);
          Yii::$app->cache->set($this->key_2, $this->getImageCouponAdmitad(), self::DURATION_CACHE);
          Yii::$app->cache->set($this->key_3, $this->getCompanyCouponAdmitad(), self::DURATION_CACHE);
          Yii::$app->cache->set($this->key_4, $this->getFirstLetterCompanyCouponAdmitad(), self::DURATION_CACHE);
          return true;
      }else{
          return false;
      }
    }

    private function getCouponsToAdmitad()
    {
        $couponResults=NULL;
        $coupon= $this->admitad->get($this->uri,
            array(
                'limit' => $this->limit,
                'offset' => $this->offset,
                'region'=>$this->region,
                'order_by'=>$this->order_by,
            ))->getArrayResult();

        foreach ($coupon['results'] as $value){
            if($value['status']=='active'){
                $couponResults[]=$value;
            }
        }

	 foreach ($couponResults as &$value){
            $value['image']=$this->pathImage($value['image'],$value['campaign']['name']);
        }
        unset($value);

        return $couponResults;
    }

    private function stateCache()
    {
        if(!Yii::$app->cache->get($this->key_1) || !Yii::$app->cache->get($this->key_2)){
            $this->setCache();
        }
    }

    private function getImageCouponAdmitad()
    {
        $image=array();
        $coupon=Yii::$app->cache->get($this->key_1);
        foreach ($coupon as $value){
               $image[]=array(
                    'image'=>$value['image'],
                    'company_name'=>$value['campaign']['name']
                );
        }
        $image=$this->unique_multidim_array($image, 'image');
        sort($image);
        return  $image;
    }

 private function pathImage($path, $name)
    {

        $file = file_get_contents($path);
        $rootPath=Yii::getAlias('@webroot');
       // $name=trim(mb_strtolower($name));
        $fileName=mb_strrichr($path,'/');
        $pathSave=$rootPath . '/images/'. hash('md5',$name);  // $name;
        if(!file_exists($pathSave)){
            mkdir($pathSave);
        }

        $fullPath=$pathSave . $fileName;
        file_put_contents($fullPath ,$file);

        $pos=mb_strlen(Yii::getAlias('@webroot'));
        $path=mb_substr( $fullPath,$pos);
        return $path;
    }

    private function unique_multidim_array($array, $key)
    {
        $temp_array = array();
        $i = 0;
        $key_array = array();

        foreach($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }

    private function getCompanyCouponAdmitad()
    {
        $company=NULL;
        $coupon=Yii::$app->cache->get($this->key_1);
        foreach ($coupon as $value){
            $company[]=$value['campaign']['name'];
        }
        $company=array_unique($company);
        foreach ($company as $value){
            $companyName[]=$value;//   preg_replace('#([a-zа-яё]+)([\s\.]+)([a-z\sа-яё]+)#iu','$1',$value);
        }
        sort($companyName);
        return $companyName;
    }

    private function getFirstLetterCompanyCouponAdmitad()
    {
        $company=Yii::$app->cache->get($this->key_3);
	foreach ($company as $value){
            $letter[]=mb_strtoupper(mb_substr($value,0,1));
        }
        $letter=array_unique($letter);
        return $letter;
    }

    private function getSubCategory($category)
    {
        $db=new Query();
        $db->select(['category_product.id', 'category_product.name as category_name', 'subcategory_product.name as subcategory_name']);
        $db->from('category_product');
        $db->innerJoin('subcategory_product', 'category_product.subcategory_id=subcategory_product.id');
        $db->where(['category_product.route_name' => $category]);
        return $db->all();

    }

    private function findCouponOfCategory($category)
    {
        $couponOfCategory=NULL;
        $coupon=$this->getCoupon();
       if(!$category=$this->getSubCategory($category)){
            throw new HttpException(404 ,'Bad Request');
       }
        $subcategory= $subCategory=explode('/',$category[0]['subcategory_name']);
        foreach ($coupon as $value){
            foreach ($value['categories'] as $key){
                if (in_array($key['name'],$subcategory)){
                    $couponOfCategory[]= $value;
                    break;
                }
            }
        }
        if (empty($couponOfCategory)){
            $couponOfCategory=$category[0]['category_name'];
        }
        return $couponOfCategory;
    }

    public function getCompanyCoupons($company)
    {
        $companyCoupons=NULL;
        $coupons=$this->getCoupon();
        foreach ($coupons as $value ){
            if(mb_strripos($value['campaign']['name'], $company)===0){
                $companyCoupons[]= $value;
            }
        }

        if(!$companyCoupons){
            throw new HttpException(404 ,'Bad Request');
        }
        return $companyCoupons;
    }


    public function getCoupon()
    {
        $this->stateCache();
        return Yii::$app->cache->get($this->key_1);
    }

    public function getImage()
    {
        $this->stateCache();
       $image=Yii::$app->cache->get($this->key_2);
	shuffle($image);
	$image=array_slice($image,0,7);
	 return $image;// Yii::$app->cache->get($this->key_2);
    }

    public function getCompany()
    {
        $this->stateCache();
        return Yii::$app->cache->get($this->key_3);
    }

    public function getLetterCompany()
    {
        $this->stateCache();
        return Yii::$app->cache->get($this->key_4);
    }

    public function countCoupons()
    {
        return count($this->getCoupon());
    }

    public function getCategoryCoupon($category)
    {
        return $this->findCouponOfCategory($category);
    }

    public function findCouponById($id)
    {
        $coupon=$this->getCoupon();

        foreach ($coupon as $value) {
            if ($value['id'] == $id && $value['species'] == 'action') {
                return [
                    'success'=>true,
                    'id'=>$value['id'],
                    'type'=>'action',
                    'link'=>$value['goto_link'],
                    'short_name'=>$value['short_name'],
                    'name'=>$value['name'],
                    'image'=>$value['image'],
                ];
            }elseif(($value['id'] == $id && $value['species'] == 'promocode')){
                return [
                    'success'=>true,
                    'id'=>$value['id'],
                    'type'=>'promocode',
                    'link'=>$value['goto_link'],
                    'promocode'=>$value['promocode'],
                    'short_name'=>$value['short_name'],
                    'name'=>$value['name'],
                    'image'=>$value['image'],
                ];
            }
        }
}

public function findId($id)
    {
        $coupon=$this->getCoupon();

        foreach ($coupon as $value) {
            if ($value['id'] == $id ) {
                return $value;
            }

        }
        throw new HttpException(404 ,'Bad Request');
    }
}
