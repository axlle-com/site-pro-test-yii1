<?php

class SiteController extends Controller
{
    public function actionIndex(): void
    {
        $this->render('index');
    }

    public function actionError(): void
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {
                echo $error['message'];
            } else {
                $this->render('error', $error);
            }
        }
    }

    public function actionContact(): void
    {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                    "Reply-To: {$model->email}\r\n" .
                    "MIME-Version: 1.0\r\n" .
                    "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    public function actionLogin(): void
    {
        $model = new LoginForm;
        $this->render('login', ['model' => $model]);
    }

    public function actionRegistration(): void
    {
        $model = new RegistrationForm();
        $this->render('registration', ['model' => $model]);
    }

    public function actionLogout(): void
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
}