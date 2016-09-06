<?php

    use yii\db\Migration;

    class m160905_133906_create_table_organizator_role extends Migration{
        public function up(){
            $this->createTable('{{%org_role}}', [
                'id' => $this->primaryKey(),
                'name' => $this->string(50)
                               ->notNull(),
                'desc' => $this->text()
            ]);

            $this->batchInsert('{{%org_role}}', [
                'name',
                'desc'
            ], [
                                   [
                                       'модератор',
                                       'может удалять добавлять пользователей из события'
                                   ],
                                   [
                                       'ведущий',
                                       'человек который будет направлять всю толпу'
                                   ]
                               ]);
        }

        public function down(){
            echo "m160905_133906_create_table_organizator_role cannot be reverted.\n";

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
