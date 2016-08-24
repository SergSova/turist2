<?php

use yii\db\Migration;

class m160823_083318_add_column_foto_user extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}','foto',$this->string(255));
    }

    public function down()
    {
        $this->dropColumn('{{%user}','foto');
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
