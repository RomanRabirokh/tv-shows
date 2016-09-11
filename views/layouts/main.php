<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="/web/favicon.ico" rel="shortcut icon" type="image/x-icon"/>
</head>
<body>
<?php $this->beginBody() ?>

<!--<div class="row">-->
	<div class="wrapper">
		 <div class="img_logo">
 		 </div>
 		<div class="menu">
 			<nav>
 			<a href='<?=Yii::$app->urlManager->createUrl(['site/index']);?>'>Главная</a>
    		<a href='<?=Yii::$app->urlManager->createUrl(['site/enter']);?>'>Вход</a>
    		<div class="serch"><a href='#'>Поиск</a>
    		<input type="text" id="serch_input" style="display:none"></div>
			</nav>
 		</div>
 		<div class="content">
 			<div class="toblur">
 			</div>
 				
 			  <?= $content ?>
 			  
 		<a href="#0" class="cd-top">Top</a>		  
 		</div>
 	</div>
<!-- </div>	-->	





<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
