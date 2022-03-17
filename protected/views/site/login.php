<?php
/* @var $this SiteController
 * @var $model LoginForm
 * @var $form CActiveForm
 */

$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = ['Login',];
?>
<div class="js-login">
    <?php
        $form = $this->beginWidget('CActiveForm', [
            'id' => 'login-user-form',
            'enableClientValidation' => true,
            'clientOptions' => [
                'validateOnSubmit' => true,
            ],
            'htmlOptions' => [
                'class' => 'form-signin',
            ],
        ]);
    ?>
    <div class="text-center mb-4">
        <img class="mb-4" src="<?= axAssetsFrontend('/images/bootstrap-solid.svg') ?>" alt="" width="72" height="72">
    </div>
    <h2 class="text-center mb-4">Sign in</h2>
    <div class="form-label-group">
        <?= $form->textField($model, 'email', $model->getAttributeForForm('email')) ?>
        <?= $form->error($model, 'email', ['class' => 'invalid-feedback']) ?>
    </div>

    <div class="form-label-group">
        <?= $form->passwordField($model, 'password', $model->getAttributeForForm('password')) ?>
        <?= $form->error($model, 'password', ['class' => 'invalid-feedback']) ?>
    </div>
    <div class="form-label-group">
        <?= $form->passwordField($model, 'google2fa', $model->getAttributeForForm('google2fa')) ?>
        <?= $form->error($model, 'google2fa', ['class' => 'invalid-feedback']) ?>
    </div>
    <div class="checkbox mb-3">
        <?= $form->checkBox($model, 'rememberMe') ?>
        <?= $form->label($model, 'rememberMe') ?>
        <?= $form->error($model, 'rememberMe', ['class' => 'invalid-feedback']) ?>
    </div>
    <?= CHtml::submitButton('Sign in', ['class' => 'btn btn-lg btn-primary btn-block js-login-user-submit-button']) ?>
    <?php $this->endWidget(); ?>
</div>
