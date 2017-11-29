<?php

namespace frontend\modules\admitad\models;

use Yii;
use yii\base\Model;


/**
 * Description of AdmitadData
 * @author foxit
 */
class AdmitadData extends Model
{
    private const DURATION_CACHE = 10;
    private $admitad;
    private $limit=500;
    private $offset=0;

    private function connectToAdmitad()
    {
        $this->admitad= new Connection();
    }

    public function getCache()
    {
        if(!Yii::$app->cache->get('coupon')){
            $this->connectToAdmitad();
            Yii::$app->cache->add('coupon',$this->getCouponArea(),self::DURATION_CACHE);
            return Yii::$app->cache->get('coupon');
        }else {
            return  Yii::$app->cache->get('coupon');
        }
    }

    public function getCouponArea()
    {
        return $this->admitad->get('/coupons/website/495007/',
            array(
                'limit' => $this->limit,
                'offset' => $this->offset,
            ))
            ->getArrayResult();
    }

    public function getCouponResults()
    {
        $coupon=$this->getCache();
        foreach ($coupon['results'] as $value){
            if($value['status']=='active' && in_array('RU',$value['regions'])){
                $couponResults[]=$value;
            }
        }
        return $couponResults;
    }

    public function getCouponCategoryResults($id)
    {
        $coupon=$this->getCouponResults();
        $category=$this->getCategory($id);
        foreach ($coupon as $value){
            foreach ($value['categories'] as $key){
                if (in_array($key['name'],$category)){
                    $couponCategoryResults[]= $value;
                    break;
                }
            }
        }
        if (empty($couponCategoryResults)){
            $couponCategoryResults=$id;
        }
        return $couponCategoryResults;
    }

    private function getCategory($id)
    {
        $category=[
            'clothes-and-accessories'=>[
                'Одежда и Аксессуары',
                'Товары для детей',
                'Аксессуары и сумки',
                'Обувь',
                'Одежда',
                'Часы и украшения',
                'Аксессуары и сумки',
                ],
            'technology-and-electronics'=>[
                'Техника и Электроника',
                'Компьютеры и электроника'
                ],
            'beauty-and-health'=>[
                'Красота и Здоровье',
                'Спорт и отдых',
                'Красота и здоровье',
                ],
            'travels'=>[
                'Путешествия',
                ],
            'house-and-garden'=>[
                'Дом и Сад',
                'Товары для дома',
                'Цветы и подарки',
                'Книги',
                'Зоотовары',
                'Игры',
                'Автотовары',
                'Инструменты и садовая техника',
                ],
        ];

        return $category[$id];
    }

    public function getImage()
    {
        $coupon=$this->getCache();
        $image[]=NULL;
        foreach ($coupon['results'] as $value){
            if(!in_array($value['image'],$image)){
              $image[]=$value['image'];
            }
        }
        return $image;
    }

    public function getCompany()
    {
        $company=NULL;
        $coupon=$this->getCouponResults();
        foreach ($coupon as $value){
            $company[]=$value['campaign']['name'];
        }
        $company=array_unique($company);
        foreach ($company as $value){
            $companyName[]=preg_replace('#([a-zа-яё]+)([\s\.]+)([a-z\sа-яё]+)#iu','$1',$value);
        }
        sort($companyName);
        return $companyName;
    }

    public function getFirstLetterCompany()
    {
        $company=$this->getCompany();
        foreach ($company as $value){
           $letter[]=($value{0});
        }
        $letter=array_unique($letter);

        return $letter;
    }

}
