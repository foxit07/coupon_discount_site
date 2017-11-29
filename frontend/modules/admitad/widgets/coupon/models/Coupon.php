<?php
/**
 * Created by PhpStorm.
 * User: foxit
 * Date: 11.11.2017
 * Time: 15:53
 */

namespace frontend\modules\admitad\widgets\coupon\models;


class Coupon
{

    const PROMOCODE='promocode';
    const ACTION='action';

    public static function getTypeDiscounts($coupon)
    {
        $typeDiscounts=array();
        foreach ($coupon as $value){
            if($value['species']==self::ACTION){
                $typeDiscounts[]=array(
                    'id'=>$value['id'],
                    'type'=>'action',
                    'name'=>'Перейти к акции',
                    'link'=>$value['goto_link'],
                    'promocode'=>null,
                    'attribute'=>array(
                        'data-toggle'=>null,
                        'data-target'=>null,
                    ),
                );
            }elseif($value['species']==self::PROMOCODE){
                $typeDiscounts[]=array(
                    'id'=>$value['id'],
                    'type'=>'promocode',
                    'name'=>'Получить промокод',
                    'link'=>$value['goto_link'],
                    'promocode'=>$value['promocode'],
                    'attribute'=>array(
                        'data-toggle'=>'data-toggle="modal"',
                        'data-target'=>'data-target="#myModal"',
                    ),
                ) ;
            }

        }

        return $typeDiscounts;
    }
}