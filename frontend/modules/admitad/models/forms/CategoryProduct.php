<?php
/**
 * Created by PhpStorm.
 * User: foxit
 * Date: 06.11.2017
 * Time: 14:29
 */

namespace frontend\modules\admitad\models\forms;
use yii\db\ActiveRecord;

class CategoryProduct extends ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public static function tableName()
    {
        return '{{category_product}}';
    }

    public function getMenu()
    {
        return $this->find()->where(['status'=>self::STATUS_ACTIVE])->asArray()->all();
    }
}