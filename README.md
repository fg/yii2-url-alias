fg/UrlAlias
===================


Installation
------------
#### 1. Install Repository
You can install via [composer](http://getcomposer.org/download/).

Run
```
php composer.phar require --prefer-dist "fg/yii2-url-alias" "dev-master"
```

or add to require section of `composer.json:`

```
"fg/yii2-url-alias": "dev-master"
```

#### 2. Edit your config files
#####2.1. Check Database Connection Params
Check your `config/db.php` file. Have correct parameters?
#####2.2. Install migrations
`php yii migrate/up --migrationPath=@vendor/fg/yii2-url-alias/migrations`

If you want example data, run this queries:
```
INSERT INTO `url_rule` (`id`, `slug`, `route`, `params`, `status`) VALUES
(1, '', 'site/index', 'a:0:{}', 1),
(2, 'about', 'site/about', 'a:0:{}', 1),
(3, 'contact', 'site/contact', 'a:0:{}', 1),
(4, 'login', 'site/login', 'a:0:{}', 1),
(5, 'logout', 'site/logout', 'a:0:{}', 1);
```
#####2.3. Edit `config/web.php:` file

```
/** Example urlManager config */
'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules' => [
                [
                    'class' => 'fg\UrlAlias\components\BaseUrlRule',
                    'connectionID'  => 'db',
                    'redirect301'   => true //if you want 301 redirect
                ]
                ...
            ]
        ],
```
#####2.4 Test
http://YOUR_LOCAL_SERVER/about