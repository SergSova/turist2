<?php

use yii\db\Migration;

class m160910_125623_insert_defaults_into_event_rule_tanle extends Migration
{
    public function up()
    {
        $this->insert('{{%event_rule}}', ['name' => 'photo']);
        $this->insert('{{%event_rule}}', ['name' => 'all']);
        $this->insert('{{%event_rule}}', ['name' => 'participiat']);
    }

    public function down()
    {
        echo "m160910_125623_insert_defaults_into_event_rule_tanle cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
