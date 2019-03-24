<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%phys_prizes}}`.
 */
class m190324_163634_create_phys_prizes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%phys_prizes}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%phys_prizes}}');
    }


    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('phys_prizes', [
            'id' => $this->primaryKey(),
            'name' => $this->string(32)->notNull(),
            'count' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('phys_prizes');
    }
}
