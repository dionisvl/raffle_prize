<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%prize_params}}`.
 */
class m190324_163617_create_prize_params_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%prize_params}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%prize_params}}');
    }

    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('prize_params', [
            'id' => $this->primaryKey(),
            'param' => $this->string(32)->notNull(),
            'value' => $this->string(32)->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('prize_params');
    }
}
