<?php

/* @var $this SiteController
 * @var $model RegistrationForm
 * @var $form CActiveForm
 */

$this->pageTitle = Yii::app()->name . ' - Registration';
$this->breadcrumbs = ['Registration',];
?>
<div class="js-registration">
    <?php
    $form = $this->beginWidget('CActiveForm', [
        'id' => 'registration-user-form',
        'enableClientValidation' => true,
        'clientOptions' => [
            'validateOnSubmit' => true,
        ],
        'htmlOptions' => [
            'class' => 'needs-validation',
        ],
    ]);
    ?>
    <div class="text-center mb-4">
        <img class="mb-4" src="<?= axAssetsFrontend('/images/bootstrap-solid.svg') ?>" alt="" width="72" height="72">
    </div>
    <h2 class="text-center mb-4">Registration</h2>
    <div class="form-label-group">
        <?= $form->textField($model, 'name', $model->getAttributeForForm('name')) ?>
        <?= $form->error($model, 'name', ['class' => 'invalid-feedback']) ?>
    </div>
    <div class="form-label-group">
        <?= $form->textField($model, 'surname', $model->getAttributeForForm('surname')) ?>
        <?= $form->error($model, 'surname', ['class' => 'invalid-feedback']) ?>
    </div>
    <div class="form-label-group">
        <?= $form->textField($model, 'email', $model->getAttributeForForm('email')) ?>
        <?= $form->error($model, 'email', ['class' => 'invalid-feedback']) ?>
    </div>
    <div class="form-label-group">
        <?= $form->textField($model, 'password', $model->getAttributeForForm('password')) ?>
        <?= $form->error($model, 'password', ['class' => 'invalid-feedback']) ?>
    </div>
    <div class="form-label-group">
        <?= $form->textField($model, 'rePassword', $model->getAttributeForForm('rePassword')) ?>
        <?= $form->error($model, 'rePassword', ['class' => 'invalid-feedback']) ?>
    </div>
    <div class="card border-success mb-3" style="display:none">
        <div class="card-header">Download the Google 2-Factor Authentication app and scan the code</div>
        <div class="card-body text-success">
            <h5 class="card-title">Congratulations! You have successfully registered!</h5>
            <div class="js-qr"></div>
        </div>
    </div>
    <?= CHtml::submitButton('Registration', ['class' => 'btn btn-lg btn-primary btn-block js-registration-user-submit-button']) ?>
    <?php $this->endWidget(); ?>
</div>
