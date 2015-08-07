<?php namespace UrlAlias;

use Yii;
use yii\base\Module as BaseModule;
use yii\base\BootstrapInterface;

class Module extends BaseModule implements BootstrapInterface
{
    /**
     * @var string
     */
    public $configPath = '/config/module.php';

    /**
     * @var string
     */
    public $connectionID = 'db';

    /**
     * @var string
     */
    public $routeCachePrefix = 'route_';

    /**
     * @var int
     */
    public $defaultRedirectCode = 302;

    /**
     * @var array
     */
    public $indexSlugMap = ['index', 'site/index'];

    public $urlAliasAdminName = 'admin/rule';

    public function init() {
        parent::init();
        Yii::configure($this, require $this->configPath);
    }

    /**
     * @inheritdoc
     * @param \yii\web\Application $app
     */
    public function bootstrap($app)
    {
        $app->getUrlManager()->addRules([
            $this->urlAliasAdminName . '/<controller:[\w\-]+>/<action:[\w\-]+>' => $this->id . '/<controller>/<action>',
        ], false);

    }
}
