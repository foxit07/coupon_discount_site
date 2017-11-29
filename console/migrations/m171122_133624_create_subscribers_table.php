<?php

use yii\db\Migration;

/**
 * Handles the creation of table `subscribers`.
 */
class m171122_133624_create_subscribers_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('subscribers', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(255),
            'email'=>$this->string(255),
            'status'=>$this->integer(2),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('subscribers');
    }
}
