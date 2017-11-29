<?php

use yii\db\Migration;

/**
 * Handles the creation of table `subcategory_product`.
 */
class m171106_103920_create_subcategory_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('subcategory_product', [
            'id' => $this->primaryKey(),
            'name'=>$this->text()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('subcategory_product');
    }
}
