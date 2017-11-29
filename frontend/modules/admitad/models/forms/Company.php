<?php
/**
 * Created by PhpStorm.
 * User: foxit
 * Date: 25.11.2017
 * Time: 15:58
 */

namespace frontend\modules\admitad\models\forms;
use yii\db\ActiveRecord;


class Company extends ActiveRecord
{

    public static function tableName()
    {
        return '{{company}}';
    }

    public function getCompanyAbout($company)
    {
        if(self::find()->where(['short_name' => $company])->one()) {
            return self::find()->where(['short_name' => $company])->one();
        }

        return null;
    }

}