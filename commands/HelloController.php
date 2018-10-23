<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii;
use app\models\User;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";

        return ExitCode::OK;
    }

    public function actionPermissoes()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $root = $auth->createRole('root');
        $auth->add($root);
        $usuario = $auth->createRole('usuario');
        $auth->add($usuario);

        $tables = ['variety','country','province,','winery','region'];

        foreach ($tables as $key => $table) {
            //Cria o objeto que representa a permissão
            $permRW = $auth->createPermission($table.'RW');
            $permR = $auth->createPermission($table.'R');

            //Informa ao gerenciador de autenticação/autorização que estas permissoes existem
            $auth->add($permRW);
            $auth->add($permR);

            //Informa que o admin pode executar a permissão RW
            $auth->addChild($admin,$permRW);
            //Informa que o usuário pode executar a permissão R
            $auth->addChild($usuario,$permR);
        }
        
        //Wine
            $wineRW = $auth->createPermission('wineRW');
            $wineR = $auth->createPermission('wineR');

            $auth->add($wineRW);
            $auth->add($wineR);

            $auth->addChild($usuario,$wineRW);
            $auth->addChild($usuario,$wineR);

            //User 
            $userRW = $auth->createPermission('userRW');
            $userR = $auth->createPermission('userR');

            $auth->add($userRW);
            $auth->add($userR);

            $auth->addChild($root,$userRW);
            $auth->addChild($root,$userR);


            $auth->addchild($admin,$usuario);
            $auth->addchild($root,$admin);

            $obj = User::findOne(['username'=>'root']);
            if(!$obj){
                $obj = new User();
                $obj->username = 'root';
                $obj->password = '12345';
                $obj->save();
            }

            //Associa a permissão de root ao id do usuário root
            $auth->assign($root,$obj->id);
            echo "Sucesooooo\n";
    }
}
