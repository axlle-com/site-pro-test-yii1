<?php


class LoginForm extends CFormModel
{
    public $email;
    public $password;
    public $google2fa;
    public $rememberMe;

    private $_identity;

    public function rules(): array
    {
        return [
            ['email, password, google2fa', 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'authenticate'],
        ];
    }

    public function getAttributeForForm(string $attribute): array
    {
        return [
            'class' => 'form-control form-control-lg',
            'placeholder' => $this->attributeLabels()[$attribute],
            'data-validator' => $attribute,
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'email' => 'Email address',
            'password' => 'Password',
            'google2fa' => 'Google 2Fa',
            'rememberMe' => 'Remember me next time',
        ];
    }

    public function authenticate($attribute, $params): void
    {
        if (!$this->hasErrors()) {
            $this->_identity = new UserIdentity($this->email, $this->password);
            $this->_identity->setKey($this->google2fa);
            if (!$this->_identity->authenticate()) {
                $this->addError('email', 'Incorrect email or password or Google 2Fa');
                $this->addError('password', 'Incorrect email or password or Google 2Fa');
                $this->addError('google2fa', 'Incorrect email or password or Google 2Fa');
            }
        }
    }

    public function login(): bool
    {
        if ($this->_identity === null) {
            $this->_identity = new UserIdentity($this->email, $this->password);
            $this->_identity->setKey($this->google2fa);
            $this->_identity->authenticate();
        }
        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
            Yii::app()->user->login($this->_identity, $duration);
            return true;
        }
        return false;
    }
}
