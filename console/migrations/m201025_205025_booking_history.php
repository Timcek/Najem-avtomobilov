<?php

use yii\db\Migration;

/**
 * Class m201025_205025_booking_history
 */
class m201025_205025_booking_history extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%booking_history}}', [
                        'id' => $this->primaryKey(),
                        'booking_date' => $this->date(),
                        "booking_date_until" => $this->date(),
                        "user" => $this->char(50),
                        "car_id"=>$this->integer(10)
                    ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201025_205025_booking_history cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201025_205025_booking_history cannot be reverted.\n";

        return false;
    }
    */
}
