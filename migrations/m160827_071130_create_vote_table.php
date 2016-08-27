<?php

    use yii\db\Migration;

    /**
     * Handles the creation for table `vote`.
     */
    class m160827_071130_create_vote_table extends Migration{
        /**
         * @inheritdoc
         */
        public function up(){
            $this->createTable('{{%vote}}', [
                'id'         => $this->primaryKey(),
                'user_id'    => $this->integer()
                                     ->notNull(),
                'model_name' => $this->string(25)
                                     ->notNull(),
                'model_id'   => $this->integer()
                                     ->notNull(),
                'rate_type'  => $this->string(5)
                                     ->notNull(),
            ]);
            $this->createIndex('IX_user_model_model_id', '{{%vote}}', ['user_id', 'model_name', 'model_id'], true);
            $this->addForeignKey('FK_vote_user', '{{%vote}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        }

        /**
         * @inheritdoc
         */
        public function down(){
            $this->dropIndex('IX_user_model_model_id', '{{%vote}}');
            $this->dropForeignKey('FK_vote_user', '{{%vote}}');
            $this->dropTable('{{%vote}}');
        }
    }
