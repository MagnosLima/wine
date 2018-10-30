<?php

namespace app\components\filters;

use Yii;
use yii\base\ActionFilter;
use yii\helpers\Url;

class AuthFilter extends ActionFilter {
	public static $permsR = ['index','view'];

	public function beforeAction ( $action ) {
		
		$controlador = strtolower($action->controller->id);
		$terminacao = (in_array(strtolower($action->id),self::$permsR))?'R':'RW';


		$permissao = $controlador.$terminacao;

		/*yii::trace()
		yii::trace()*/

		if(!\Yii::$app->user->can($permissao)) {
			throw new \yii\web\ForbiddenHttpException(Yii::t('app','Você não tem permissão para acessar esta página'));
			return false;
		}

        return parent::beforeAction($action);
	}
}