<?php

use yii\db\Migration;

class m190626_000000_is_hidden extends Migration
{
    public function safeUp()
    {
    	$this->addColumn('{{%settings}}', 'is_hidden', $this->boolean()->unsigned()->notNull()->defaultValue(0));
    }

    public function safeDown()
    {
    	$this->dropColumn('{{%settings}}', 'is_hidden');
    }
}
