<?php

use yii\db\Migration;

class m180529_000000_new_columns extends Migration
{
    public function safeUp()
    {
    	$this->addColumn('{{%settings}}', 'is_deprecated', $this->boolean()->unsigned()->notNull()->defaultValue(0));
    	$this->addColumn('{{%settings}}', 'info', $this->text());
    }

    public function safeDown()
    {
    	$this->dropColumn('{{%settings}}', 'is_deprecated');
    	$this->dropColumn('{{%settings}}', 'info');
    }
}
