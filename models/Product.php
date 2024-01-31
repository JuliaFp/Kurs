<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property string $image
 * @property string $name
 * @property int $amount
 * @property int $price
 * @property int $id_product
 * @property int $region_id
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image', 'name', 'amount', 'price', 'id_product', 'region_id'], 'required'],
            [['amount', 'price', 'id_product', 'region_id'], 'integer'],
            [['image'], 'string', 'max' => 700],
            [['name'], 'string', 'max' => 100],
            [['region_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'image' => 'Image',
            'name' => 'Name',
            'amount' => 'Amount',
            'price' => 'Price',
            'id_product' => 'Id Product',
            'region_id' => 'Region ID',
        ];
    }
}
