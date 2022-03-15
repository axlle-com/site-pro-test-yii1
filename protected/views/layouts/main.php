<?php

/* @var $this Controller
 * @var $content string
 */


?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="en">
    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl ?>/assets/frontend/css/screen.css"
          media="screen, projection">
    <link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl ?>/assets/frontend/css/print.css"
          media="print">
    <!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl ?>/assets/frontend/css/ie.css" media="screen, projection">
	<![endif]-->
    <link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl ?>/assets/frontend/css/main.min.css">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

    <div id="header">
        <div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
    </div><!-- header -->

    <div id="mainmenu">
        <?php $this->widget('zii.widgets.CMenu', array(
            'items' => array(
                array('label' => 'Home', 'url' => array('/site/index')),
                array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
                array('label' => 'Contact', 'url' => array('/site/contact')),
                array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
            ),
        )); ?>
    </div><!-- mainmenu -->
    <?php if (isset($this->breadcrumbs)): ?>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'links' => $this->breadcrumbs,
        )); ?><!-- breadcrumbs -->
    <?php endif ?>

    <?php echo $content; ?>

    <div class="clear"></div>

    <div id="footer">
        Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
        All Rights Reserved.<br/>
        <?php echo Yii::powered(); ?>
    </div><!-- footer -->

</div><!-- page -->
<script src="<?= Yii::app()->request->baseUrl ?>/assets/frontend/js/manifest.js"></script>
<script src="<?= Yii::app()->request->baseUrl ?>/assets/frontend/js/vendor.js"></script>
<script src="<?= Yii::app()->request->baseUrl ?>/assets/frontend/js/app.js"></script>
<script src="<?= Yii::app()->request->baseUrl ?>/assets/frontend/js/main.min.js"></script>
</body>
</html>
