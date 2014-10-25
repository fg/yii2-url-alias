<?php

namespace fg\UrlAlias\models\base;

use Yii;

/**
 * This is the model class for table "url_rule".
 *
 * @property integer $id
 * @property string $slug
 * @property string $route
 * @property string $params
 * @property integer $status
 */
class UrlRule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'url_rule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['slug', 'route'], 'required'],
            [['status'], 'integer'],
            [['slug', 'route', 'params'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'     => 'ID',
            'slug'   => 'Slug',
            'route'  => 'Route',
            'params' => 'Params',
            'status' => 'Status',
        ];
    }
}