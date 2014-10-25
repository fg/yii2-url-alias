<?php

namespace fg\UrlAlias\components;

use yii\web\UrlRule;

class BaseUrlRule extends UrlRule
{
    public $connectionID  = 'db';

    public $indexSlugMap  = ['index', 'site/index'];


    public function init()
    {
        if ($this->name === null) {
            $this->name = __CLASS__;
        }
    }

    public function createUrl($manager, $route, $params)
    {
        $dbRoute = \fg\UrlAlias\models\UrlRule::getRoute($route, $params);

        if ( !is_null($dbRoute))
        {
            return $dbRoute->getAttribute('slug');
        }

        return false;
    }

    public function parseRequest($manager, $request)
    {
        $slug = ltrim($request->getUrl(), '/');

        if ( in_array($slug, $this->indexSlugMap))
        {
            $slug = '';
        }

        $route = \fg\UrlAlias\models\UrlRule::getRouteBySlug($slug);

        if ( !is_null($route))
        {
            return [
                $route->getAttribute('route'),
                unserialize($route->getAttribute('params'))
            ];
        }

        return false;
    }
}
