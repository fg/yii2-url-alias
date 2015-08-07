<?php namespace UrlAlias\models;

use yii\db\ActiveRecord;

class UrlRule extends ActiveRecord
{
    const STATUS_ACTIVE  = 1;

    const STATUS_PASSIVE = 0;

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
            [['redirect_code', 'redirect', 'status'], 'integer'],
            [['slug', 'route', 'params'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slug' => 'Slug',
            'route' => 'Route',
            'params' => 'Params',
            'redirect' => 'Redirect',
            'redirect_code' => 'Redirect Code',
            'status' => 'Status',
        ];
    }

    public static function getRoute($route, $params = array(), $status = self::STATUS_ACTIVE)
    {
        return self::getDb()->cache(function() use ($route, $params, $status) {
            return UrlRule::find()->where(
                'route = :ROUTE AND params = :PARAMS AND status = :STATUS',
                [
                    ':ROUTE'  => $route,
                    ':PARAMS' => serialize($params),
                    ':STATUS' => $status
                ]
            )->one();
        });
    }

    public static function getRouteBySlugWithParams($slug, $params = array(), $status = self::STATUS_ACTIVE) {
        return self::getDb()->cache(function() use ($slug, $params, $status) {
            return self::find()->where(
                'slug = :SLUG AND params = :PARAMS AND status = :STATUS',
                [
                    ':SLUG' => $slug,
                    ':PARAMS' => serialize($params),
                    ':STATUS' => $status
                ]
            )->one();
        });

    }

    public static function getRouteBySlug($slug, $status = self::STATUS_ACTIVE)
    {
        return self::getDb()->cache(function() use ($slug, $status) {
            return self::find()->where(
                'slug = :SLUG AND status = :STATUS',
                [
                    ':SLUG'  => $slug,
                    ':STATUS' => $status
                ]
            )->one();
        });

    }
}