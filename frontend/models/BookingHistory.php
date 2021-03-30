<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "booking_history".
 *
 * @property int|null $id
 * @property string|null $booking_date
 * @property int|null $booking_time_days
 * @property string|null $user
 */
class BookingHistory extends \yii\db\ActiveRecord
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
            [['id', 'booking_time_days'], 'integer'],
            [['booking_date'], 'safe'],
            [['user'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'booking_date' => 'Booking Date',
            'booking_time_days' => 'Booking Time Days',
            'user' => 'User',
        ];
    }
}
