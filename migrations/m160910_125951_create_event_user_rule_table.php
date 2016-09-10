<?php

    use yii\db\Migration;

    /**
     * Handles the creation for table `event_user_rule`.
     */
    class m160910_125951_create_event_user_rule_table extends Migration{
        /**
         * @inheritdoc
         */
        public function up(){
            $this->createTable('{{%event_user_rule}}', [
                'id'      => $this->primaryKey(),
                'userId'  => $this->integer(),
                'ruleId'  => $this->integer(),
                'eventId' => $this->integer(),
            ]);

            $this->addForeignKey('FK_event_user_rule_user_id', '{{%event_user_rule}}', 'userId', '{{%user}}', 'id');
            $this->addForeignKey('FK_event_user_rule_event_id', '{{%event_user_rule}}', 'eventId', '{{%event}}', 'id');
            $this->addForeignKey('FK_event_user_rule_rule_id', '{{%event_user_rule}}', 'ruleId', '{{%event_rule}}', 'id');
            $this->createIndex('IX_event_user_rule_user_event', '{{%event_user_rule}}', ['userId', 'eventId'], true);
        }

        /**
         * @inheritdoc
         */
        public function down(){
            $this->dropTable('{{%event_user_rule}}');
        }
    }
