<?php

    use yii\db\Migration;

    class m160908_070757_add_column_people_count_to_event_table extends Migration{
        public function up(){
            $this->addColumn('{{%event}}', 'people_count', $this->integer());
        }

        public function down(){
            $this->dropColumn('{{%event}}','people_count');
        }
    }
