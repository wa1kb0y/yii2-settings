<?php

use yii\db\Migration;

class m180513_000000_add_hide_active extends Migration
{
    public function safeUp()
    {
    	$this->addColumn('{{%settings}}', 'hide_active', $this->boolean()->notNull()->defaultValue(0));
    }

    public function safeDown()
    {
    	$this->dropColumn('{{%settings}}', 'hide_active');
    }
}
