<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "temp_photos".
 *
 * @property int $id
 * @property string $temp_photo
 */
class TempPhotos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'temp_photos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['temp_photo'], 'required'],
            [['temp_photo'], 'string', 'max' => 55],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'temp_photo' => 'Temp Photo',
        ];
    }
}
