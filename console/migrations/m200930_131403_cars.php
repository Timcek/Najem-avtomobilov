<?php

use yii\db\Migration;

/**
 * Class m200930_131403_cars
 */
class m200930_131403_cars extends Migration
{
    public function up()
    {
        $this->createTable('{{%cars}}', [
            'id' => $this->primaryKey(),
            'car_company' => $this->string()->defaultValue(null),
            "model" => $this->string()->defaultValue(null),
            "year" => $this->integer(30),
            'price'=> $this->string(),
            'engine_power'=> $this->integer(11),
            'dors'=> $this->integer(11),
            'seats'=> $this->integer(11),
            'gearing_type'=> $this->char(50),
            'fuel_type'=> $this->char(50),
            "Booking"=>$this->char(20),
            "user"=>$this->char(20),
            "car_photo"=>$this->char(40)
        ]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200930_131403_cars cannot be reverted.\n";

        return false;
    }
    */
}
