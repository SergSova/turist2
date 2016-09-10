<?php

use yii\db\Migration;

/**
 * Handles the creation for table `event_rule`.
 */
class m160910_125241_create_event_rule_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%event_rule}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('event_rule');
    }
}
