<?php

namespace frontend\models;


use yii\db\ActiveRecord;
/**
 * This is the model class for table "cars".
 *
 * @property int $id
 * @property string $car_company
 * @property string $model
 * @property int $year
 * @property string $price
 * @property string $gearing_type
 * @property int $dors
 * @property int $seats
 * @property string $fuel_type
 * @property int $engine_power
 * @property string $user
 * @property string $car_photo
 */
class Cars extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cars';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['car_company', 'model', 'year'], 'required'],
            [['year'], 'string'],
            [["id"],"integer"],
            [['car_company'], 'string', 'max' => 255],
            [['model'], 'string', 'max' => 50],
            [["price"],"string"],
            [["gearing_type"],"string"],
            [["dors"],"integer"],
            [["seats"],"integer"],
            [["fuel_type"],"string"],
            [["engine_power"],"integer"],
            [["Booking"],"string"],
            [["car_photo"],"string"]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'car_company' => 'Car Company',
            'model' => 'Model',
            'year' => 'Year',
            "price"=>"Price"
        ];
    }
}
