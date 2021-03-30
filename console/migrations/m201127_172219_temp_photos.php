<?php

use yii\db\Migration;

/**
 * Class m201127_172219_temp_photos
 */
class m201127_172219_temp_photos extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%temp_photos}}', [
            'id' => $this->primaryKey(),
            "temp_photo"=>$this->char(40)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201127_172219_temp_photos cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201127_172219_temp_photos cannot be reverted.\n";

        return false;
    }
    */
}
