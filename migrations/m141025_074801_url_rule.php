<?php

use yii\db\Schema;
use yii\db\Migration;

class m141025_074801_url_rule extends Migration
{
    public function up()
    {
        $this->createTable('url_rule', [
            'id'            => 'pk',
            'slug'          => Schema::TYPE_STRING  . ' NOT NULL',
            'route'         => Schema::TYPE_STRING  . ' NOT NULL',
            'params'        => Schema::TYPE_STRING  . " DEFAULT 'a:0:{}'",
            'redirect'      => Schema::TYPE_BOOLEAN . " DEFAULT '0'",
            'redirect_code' => Schema::TYPE_INTEGER . " DEFAULT '302'",
            'status'        => Schema::TYPE_BOOLEAN . " DEFAULT '1'"
        ]);
    }

    public function down()
    {
        $this->dropTable('url_rule');
    }
}