<?php

use yii\db\Migration;

class m160823_140129_add_column_confirmed_to_partic_event_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%partic_event}}','confirmed',$this->boolean()->defaultValue(true));
    }

    public function down()
    {
        $this->dropColumn('{{%partic_event}}','confirmed');
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
