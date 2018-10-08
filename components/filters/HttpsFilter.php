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
	public function boolean beforeAction ( $action ) {
		if(!Yii::$app->request->isSecureConnection) {
			$acaoMontada = $action->controller-> .'/'.$action->id;
            return $this->redirect(Url::toRoute($acaoMontada,'https'));
        }
	}
}