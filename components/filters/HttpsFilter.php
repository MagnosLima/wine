<?php

namespace app\components\filters;

use Yii;
use yii\base\ActionFilter;
use yii\helpers\Url;

class HttpsFilter extends ActionFilter {
	/**
	* @param yii\base\Action $action ação que está sendo executada
	* @return boolean
	*/
	public function beforeAction ( $action ) {
		if(!YII_ENV_DEV && !Yii::$app->request->isSecureConnection) {
			$acaoMontada = $action->controller->id .'/'.$action->id;
            $action->controller->redirect(Url::toRoute($acaoMontada,'https'));
            return false;
        }

        return parent::beforeAction($action);
	}
}