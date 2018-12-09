<?php

//nome: sbadmin.php
use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Helpers;
use yii\widgets\Breadcrumbs;
use app\assets\SbadminAsset;

SbadminAsset::register($this);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body id="page-top">
<?php $this->beginBody() ?>

	<!-- <a class="navbar-brand mr-1" href="index.html"><img src="<?=//Url::to("@web/sbadmin/img/logo.png")?>" alt="logo" /> -->

<?= Alert::widget() ?>
        <?= $content ?>


