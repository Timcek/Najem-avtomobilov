<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
/**
 *
 * @property int $id
 * @property string $booking_date
 * @property int $booking_date_until 
 * @property string $user
 * @property int $car_id 
 */
class car_info extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'booking_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [["booking_date"],"string"],
            [["booking_date","booking_date_until"],"required","message"=>"{attribute} cannot be blank."],
            [["booking_date_until"],"string"],
            [["car_id"],"integer"]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
        ];
    }
}
