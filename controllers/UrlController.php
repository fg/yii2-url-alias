<?php namespace UrlAlias\controllers;

use UrlAlias\models\UrlRule;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class UrlController extends Controller
{
    public $layout = 'main';

    public function actionIndex() {
        echo 'test';
    }

    public function actionList() {
        $dataProvider = new ActiveDataProvider([
            'query' => UrlRule::find(),
            'pagination' => [
                'pageSize' => 10
            ]
        ]);

        return $this->render('list', [
            'dataProvider' => $dataProvider,
            'model' => $dataProvider->getModels()
        ]);
    }

    public function actionUpdate() {
        $id = Yii::$app->getRequest()->get('id', false);
        $model = new UrlRule();

        if ($id) {
            $model = $model->find($id);
        }

        return $this->render('form', [
            'model' => $model
        ]);
    }

    public function indexAction() {
        echo 'test';
    }
}