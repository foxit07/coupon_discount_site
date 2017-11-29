<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category_product`.
 */
class m171106_101601_create_category_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('category_product', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(),
            'route_name'=>$this->string(),
            'subcategory_id'=>$this->integer(),
            'status'=>$this->integer()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('category_product');
    }
}
