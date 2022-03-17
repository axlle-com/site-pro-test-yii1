<?php

class AjaxController extends BaseController
{
    public function actionRegistration(): void
    {
        $post = axClearArray($_POST);
        if (isset($post['RegistrationForm'])) {
            $model = new RegistrationForm;
            $model->attributes = $post['RegistrationForm'];
            if ($model->validate() && $model->registration()) {
                $this->setData(['view' => $model->getQR()]);
                $this->setStatus(1);
                $this->renderJSON();
            }
            $this->setError($model->getErrors() ?: null);
        }
        $this->renderJSON();
    }

    public function actionLogin(): void
    {
        $post = axClearArray($_POST);
        if (isset($post['LoginForm'])) {
            $model = new LoginForm;
            $model->attributes = $post['LoginForm'];
            if ($model->validate() && $model->login()) {
                $this->setData(['url' => '/']);
                $this->setStatus(1);
                $this->renderJSON();
            }
            $this->setError($model->getErrors() ?: null);
        }
        $this->renderJSON();
    }
}