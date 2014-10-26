<?php

namespace fg\UrlAlias\components;

use Yii;
use yii\web\UrlRule;

class BaseUrlRule extends UrlRule
{
    public $connectionID  = 'db';

    public $routePrefix   = 'route_';

    public $redirect301   = false;

    public $indexSlugMap  = ['index', 'site/index'];


    public function init()
    {
        if ($this->name === null) {
            $this->name = __CLASS__;
        }
    }

    public function createUrl($manager, $route, $params)
    {
        if ( strpos($route, $this->routePrefix) !== false)
        {
            $route   = str_replace($this->routePrefix, '', $route);
            $dbRoute = Yii::$app->cache->get($this->getCachePrefix($route, $params));

            if ($dbRoute === false)
            {
                $dbRoute = \fg\UrlAlias\models\UrlRule::getRoute($route, $params);
                Yii::$app->cache->set($this->getCachePrefix($route, $params), $dbRoute);
            }

            if ( !is_null($dbRoute))
            {
                return $dbRoute->getAttribute('slug');
            }
        }

        return false;
    }

    public function parseRequest($manager, $request)
    {
        $_slug  = $this->generateSaltUrl($request);
        $route  = \fg\UrlAlias\models\UrlRule::getRouteBySlug($_slug);

        if ( !is_null($route))
        {
            return [
                $route->getAttribute('route'),
                unserialize($route->getAttribute('params'))
            ];
        }

        return false;
    }

    public function generateSaltUrl($request)
    {
        $_url    = ltrim(parse_url($request->getUrl(), PHP_URL_PATH), '/');
        $_params = $request->get();

        if ($this->redirect301 == true)
        {

            $route = \fg\UrlAlias\models\UrlRule::getRoute($_url, $_params);

            if ( !is_null($route) && $route->redirect)
            {
                Yii::$app->response->redirect(
                    [$route->slug],
                    301
                );
            }
        }

        return $_url;
    }

    public function getCachePrefix($route, $params)
    {
        return $this->routePrefix . md5($route . serialize($params));
    }
}