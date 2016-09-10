<?php

    use yii\db\Migration;

    class m160715_093034_turinit extends Migration{
        public function safeUp(){
            $this->createTable('{{%user}}', [
                'id'                   => $this->primaryKey(10),
                'username'             => $this->string(50)
                                               ->notNull()
                                               ->comment('Логин'),
                'password'             => $this->string(255)
                                               ->comment('Пароль'),
                'auth_key'             => $this->string(255),
                'password_reset_token' => $this->text(),
                'status'               => "enum('inactive', 'active', 'blocked')",
                'email'                => $this->string(50),
                'access_token'         => $this->string(255),
                'created_at'           => $this->dateTime()
                                               ->comment('Дата создания'),
                'rate'                 => $this->integer()
                                               ->defaultValue(0)
                                               ->comment('Рейтинг'),
                'f_name'               => $this->string(50)
                                               ->comment('Фамилия'),
                'l_name'               => $this->string(50)
                                               ->comment('Имя'),
                'photo'                => $this->string(255)
                                               ->comment('Фото')
            ]);
            $this->createIndex('{{%user_email}}', '{{%user}}', 'email', true);
            $this->createIndex('{{%user_username}}', '{{%user}}', 'username', true);

            $this->createTable('{{%event}}', [
                'id'            => $this->primaryKey(10),
                'event_type_id' => $this->integer(10)
                                        ->notNull(),
                //связь с типом акции
                'creator_id'    => $this->integer(10)
                                        ->notNull(),
                //связь с пользователем
                'title'         => $this->string(255)
                                        ->notNull()
                                        ->comment('Название'),
                'photo'         => $this->text(),
                'desc'          => $this->text()
                                        ->notNull()
                                        ->comment('Описание'),
                'organizators'  => $this->text(),
                //список организаторов id
                'particip'      => $this->text(),
                'condition'     => $this->text(),
                'date_start'    => $this->dateTime()
                                        ->notNull()
                                        ->comment('Дата начала'),
                'date_end'      => $this->dateTime()
                                        ->notNull()
                                        ->comment('Дата окончания'),
                'date_creation' => $this->timestamp()
                                        ->defaultExpression('CURRENT_TIMESTAMP')
                                        ->comment('Дата создания'),
                'status'        => "ENUM('ACTIVE', 'INACTIVE', 'BLOCKED','FINISH') DEFAULT 'INACTIVE'",
                'rate'          => $this->integer()
                                        ->defaultValue(0)
                                        ->comment('Рейтинг'),
                'track_path'    => $this->text()
            ]);

            $this->createTable('{{%event_type}}', [
                'id'   => $this->primaryKey(10),
                'name' => $this->string(50)
                               ->notNull()
                               ->comment('Тип события'),
                'icon' => $this->string(25)
                               ->notNull()
            ]);

            $this->insert('{{%event_type}}', ['name' => 'free', 'icon' => 'accessibility']);
            $this->insert('{{%event_type}}', ['name' => 'cash', 'icon' => 'monetization_on']);
            $this->insert('{{%event_type}}', ['name' => 'closed', 'icon' => 'lock']);
            $this->insert('{{%event_type}}', ['name' => 'registred', 'icon' => 'record_voice_over']);

            $this->createTable('{{%comments}}', [
                'id'       => $this->primaryKey(10),
                'event_id' => $this->integer(10)
                                   ->notNull(),
                'user_id'  => $this->integer(10)
                                   ->notNull(),
                'text'     => $this->text()
                                   ->notNull()
                                   ->comment('Коментарий'),
                'rate'     => $this->integer()
                                   ->defaultValue(0)
                                   ->comment('Рейтинг')
            ]);

            $this->createTable('{{%partic_event}}', [
                'id'            => $this->primaryKey(10),
                'user_id'       => $this->integer(10),
                'event_id'      => $this->integer(10),
                'confirmed'     => $this->boolean()
                                        ->defaultValue(true),
                'confirmedtext' => $this->text()
            ]);

            $this->createTable('{{%friends}}', [
                'id'        => $this->primaryKey(10),
                'user_id'   => $this->integer(10)
                                    ->notNull(),
                'friend_id' => $this->integer(10)
                                    ->notNull()
            ]);

            $this->createTable('{{%log}}', [
                'id'      => $this->primaryKey(10),
                'date'    => $this->timestamp()
                                  ->defaultExpression('CURRENT_TIMESTAMP'),
                'user_id' => $this->integer(10),
                'action'  => $this->string(150),
                'table'   => $this->string(50),
                'blob'    => $this->string()
            ]);

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

            $this->createIndex('IX_user_model_model_id', '{{%vote}}', [
                'user_id',
                'model_name',
                'model_id'
            ], true);
            $this->addForeignKey('FK_vote_user', '{{%vote}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');

            $this->createTable('{{%social_acc}}', [
                'id'          => $this->primaryKey(),
                'user_id'     => $this->integer()
                                      ->notNull(),
                'social_name' => $this->string()
                                      ->notNull(),
                'social_id'   => $this->string()
                                      ->notNull()
            ]);

            $this->addForeignKey('FK_social_user', '{{%social_acc}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');

            // add indexes for performance optimization
            $this->createIndex('{{%event-creator_id}}', '{{%event}}', 'creator_id');
            $this->createIndex('{{%event-event_type_id}}', '{{%event}}', 'event_type_id');
            $this->createIndex('{{%comments-event_id}}', '{{%comments}}', 'event_id');
            $this->createIndex('{{%comments-user_id}}', '{{%comments}}', 'user_id');
            $this->createIndex('{{%partic_event-user_id}}', '{{%partic_event}}', 'user_id');
            $this->createIndex('{{%partic_event-event_id}}', '{{%partic_event}}', 'event_id');
            $this->createIndex('IX_event_id_user_id}}', '{{%partic_event}}', ['event_id', 'user_id'], true);
            $this->createIndex('{{%friends-user_id}}', '{{%friends}}', 'user_id');
            $this->createIndex('{{%friends-friend_id}}', '{{%friends}}', 'friend_id');
            $this->createIndex('IX_friend_id_user_id}}', '{{%friends}}', ['friend_id', 'user_id'], true);
            //            $this->createIndex('{{%log-user_id}}', '{{%log}}', 'user_id');

            // add foreign keys for data integrity
            $this->addForeignKey('{{%event-creator_id}}', '{{%event}}', 'creator_id', '{{%user}}', 'id');
            $this->addForeignKey('{{%event-event_type_id}}', '{{%event}}', 'event_type_id', '{{%event_type}}', 'id');
            $this->addForeignKey('{{%comments-event_id}}', '{{%comments}}', 'event_id', '{{%event}}', 'id');
            $this->addForeignKey('{{%comments-user_id}}', '{{%comments}}', 'user_id', '{{%user}}', 'id');
            $this->addForeignKey('{{%partic_event-user_id}}', '{{%partic_event}}', 'user_id', '{{%user}}', 'id');
            $this->addForeignKey('{{%partic_event-event_id}}', '{{%partic_event}}', 'event_id', '{{%event}}', 'id');
            $this->addForeignKey('{{%friends-user_id}}', '{{%friends}}', 'user_id', '{{%user}}', 'id');
            $this->addForeignKey('{{%friends-friend_id}}', '{{%friends}}', 'friend_id', '{{%user}}', 'id');
            //            $this->addForeignKey('{{%log-user_id}}', '{{%log}}', 'user_id', '{{%user}}', 'id');
        }

        public function safeDown(){
            echo "m160715_093034_turinit cannot be reverted.\n";
            $this->dropTable('{{%vote}}');
            $this->dropTable('{{%comments}}');
            $this->dropTable('{{%log}}');
            $this->dropTable('{{%partic_event}}');
            $this->dropTable('{{%event}}');
            $this->dropTable('{{%event_type}}');
            $this->dropTable('{{%friends}}');

            $this->dropTable('{{%user}}');

            return false;
        }
    }
