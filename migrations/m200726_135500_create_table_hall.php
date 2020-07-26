<?php

use yii\db\Migration;

/**
 * Class m200726_135500_create_table_hall
 */
class m200726_135500_create_table_hall extends Migration
{


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%hall}}', [
            'id' => $this->primaryKey(),
            'row' => $this->integer()->notNull(),
            'col' => $this->integer()->notNull(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'phone' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%hall}}');

        return false;
    }

}
