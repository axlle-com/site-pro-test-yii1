<?php

class FirstDumpCommand extends CConsoleCommand
{
    public function run($args)
    {
        $model = new Migration();
        if (isset($args[0]) && $args[0] === 'bd') {
            $db = Yii::app()->getComponent('default');
            $model->setDbConnection($db);
            $model->execute('CREATE SCHEMA IF NOT EXISTS `site_pro` DEFAULT CHARACTER SET utf8');
        }
        if (isset($args[0]) && $args[0] === 'reset') {
            $db = Yii::app()->getComponent('db');
            $model->setDbConnection($db);
            $model->execute('DROP TABLE IF EXISTS `ax_user`');
        }
    }
}

class Migration extends CDbMigration
{
}