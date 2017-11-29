<?php

use yii\db\Migration;

/**
 * Handles the creation of table `company`.
 */
class m171106_102344_create_company_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('company', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(),
            'short_name'=>$this->string(),
            'about'=>$this->text(),
            'status'=>$this->integer()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('company');
    }
}
