<?php
/**
 * Created by PhpStorm.
 * User: foxit
 * Date: 22.11.2017
 * Time: 16:25
 */

namespace frontend\models;
use yii\db\ActiveRecord;


class SubscribersForm extends ActiveRecord
{

    public static function tableName()
    {

        return '{{subscribers}}';
    }

    public function rules()
    {

        return [
            [['name','email'], 'required'],
            [['email'],'email'],
            [['email'],'unique'],
            [['status'],'default','value' => '1'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'email' => 'Почта',
        ];
    }

}