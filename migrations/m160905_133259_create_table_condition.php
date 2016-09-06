<?php

    use yii\db\Migration;

    class m160905_133259_create_table_condition extends Migration{
        public function up(){
            $this->createTable('{{%condition}}', [
                'id' => $this->primaryKey(),
                'name' => $this->string(50)
                               ->notNull(),
                'desc' => $this->text()
                               ->notNull()
            ]);

            $this->batchInsert('{{%condition}}', [
                'name',
                'desc'
            ], [
                                   [
                                       'иметь при себе',
                                       'деньги'
                                   ],
                                   [
                                       'собираемся в',
                                       '20:00'
                                   ]
                               ]);
        }

        public function down(){
            $this->dropTable('{{%condition}}');
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
