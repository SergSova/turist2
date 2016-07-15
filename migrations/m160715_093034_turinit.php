<?php

    use yii\db\Migration;

    class m160715_093034_turinit extends Migration{
        public function safeUp(){
            $this->createTable('{{%user}}', [
                                              'id'           => $this->primaryKey(10),
                                              'username'     => $this->string(50),
                                              'password'     => $this->string(255),
                                              'auth_key'     => $this->string(255),
                                              'status'       => "enum('inactive', 'active', 'blocked')",
                                              'email'        => $this->string(50),
                                              'access_token' => $this->string(255),
                                              'created_at'   => $this->dateTime(),
                                              'rate'         => $this->integer(),
                                              'f_name'       => $this->string(50),
                                              'l_name'       => $this->string(50),
                                          ]);
            $this->createIndex('{{%user_email}}', '{{%user}}', 'email', true);
            $this->createIndex('{{%user_username}}', '{{%user}}', 'username', true);

            $this->createTable('{{%event}}', [
                'id'            => $this->primaryKey(10),
                'event_type_id' => $this->integer(10), //связь с типом акции
                'creator_id'    => $this->integer(10), //связь с пользователем
                'title'         => $this->string(255),
                'photo'         => $this->text(),
                'desc'          => $this->text(),
                'organizators'  => $this->text(), //список организаторов id
                'particip'      => $this->text(),
                'condition'     => $this->text(),
                'date_start'    => $this->dateTime(),
                'date_end'      => $this->dateTime(),
                'date_creation' => $this->timestamp()
                                        ->defaultExpression('CURRENT_TIMESTAMP'),
                'status'        => "ENUM('ACTIVE', 'INACTIVE', 'BLOCKED','FINISH') DEFAULT 'INACTIVE'",
                'rate'          => $this->integer()
            ]);

            $this->createTable('{{%event_type}}', [
                'id'   => $this->primaryKey(10),
                'name' => $this->string(50)
            ]);

            $this->createTable('{{%coments}}', [
                'id'       => $this->primaryKey(10),
                'event_id' => $this->integer(10),
                'user_id'  => $this->integer(10),
                'text'     => $this->text(),
                'rate'     => $this->integer()
            ]);

            $this->createTable('{{%partic_event}}', [
                'id'       => $this->primaryKey(10),
                'user_id'  => $this->integer(10),
                'event_id' => $this->integer(10)
            ]);

            $this->createTable('{{%friends}}', [
                'id'        => $this->primaryKey(10),
                'user_id'   => $this->integer(10),
                'friend_id' => $this->integer(10)
            ]);

            $this->createTable('{{%log}}', [
                'id'      => $this->primaryKey(10),
                'date'    => $this->timestamp()
                                  ->defaultExpression('CURRENT_TIMESTAMP'),
                'user_id' => $this->integer(10),
                'action'  => $this->string(50),
                'table'   => $this->string(50),
                'blob'    => $this->string()
            ]);

            // add indexes for performance optimization
            $this->createIndex('{{%event-creator_id}}', '{{%event}}', 'creator_id');
            $this->createIndex('{{%event-event_type_id}}', '{{%event}}', 'event_type_id');
            $this->createIndex('{{%coments-event_id}}', '{{%coments}}', 'event_id');
            $this->createIndex('{{%coments-user_id}}', '{{%coments}}', 'user_id');
            $this->createIndex('{{%partic_event-user_id}}', '{{%partic_event}}', 'user_id');
            $this->createIndex('{{%partic_event-event_id}}', '{{%partic_event}}', 'event_id');
            $this->createIndex('{{%friends-user_id}}', '{{%friends}}', 'user_id');
            $this->createIndex('{{%friends-friend_id}}', '{{%friends}}', 'friend_id');
            $this->createIndex('{{%log-user_id}}', '{{%log}}', 'user_id');

            // add foreign keys for data integrity
            $this->addForeignKey('{{%event-creator_id}}', '{{%event}}', 'creator_id', '{{%user}}', 'id');
            $this->addForeignKey('{{%event-event_type_id}}', '{{%event}}', 'event_type_id', '{{%event_type}}', 'id');
            $this->addForeignKey('{{%coments-event_id}}', '{{%coments}}', 'event_id', '{{%event}}', 'id');
            $this->addForeignKey('{{%coments-user_id}}', '{{%coments}}', 'user_id', '{{%user}}', 'id');
            $this->addForeignKey('{{%partic_event-user_id}}', '{{%partic_event}}', 'user_id', '{{%user}}', 'id');
            $this->addForeignKey('{{%partic_event-event_id}}', '{{%partic_event}}', 'event_id', '{{%event}}', 'id');
            $this->addForeignKey('{{%friends-user_id}}', '{{%friends}}', 'user_id', '{{%user}}', 'id');
            $this->addForeignKey('{{%friends-friend_id}}', '{{%friends}}', 'friend_id', '{{%user}}', 'id');
            $this->addForeignKey('{{%log-user_id}}', '{{%log}}', 'user_id', '{{%user}}', 'id');
        }

        public function safeDown(){
            echo "m160715_093034_turinit cannot be reverted.\n";
            $this->dropTable('{{%coments}}');
            $this->dropTable('{{%log}}');
            $this->dropTable('{{%partic_event}}');
            $this->dropTable('{{%event}}');
            $this->dropTable('{{%event_type}}');
            $this->dropTable('{{%friends}}');

            $this->dropTable('{{%user}}');

            return false;
        }
    }
