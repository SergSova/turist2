<?php

    use yii\db\Migration;

    class m160908_142326_add_column_difficult_to_event_table extends Migration{
        public function up(){
            $this->addColumn('{{%event}}', 'difficult', $this->integer());
        }

        public function down(){
            $this->dropColumn('{{%event}}','difficult');
        }

    }
