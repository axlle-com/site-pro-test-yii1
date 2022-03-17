<?php


class RegistrationForm extends CFormModel
{
    public $name;
    public $surname;

    public $email;
    public $password;
    public $rePassword;
    public $rememberMe;

    private $_identity;
    private $qr;

    public function rules(): array
    {
        return [
            ['name, surname, email, password, rePassword', 'required'],
            ['email', 'checkUniqueEmail'],
            ['email', 'email',],
            ['password', 'length', 'min' => 4],
            ['rePassword', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    public function checkUniqueEmail($attribute, $params): void
    {
        $user = User::model()->findByAttributes(['email' => $this->email,]);
        if ($user !== null) {
            $this->addError($attribute, 'Такой пользователь уже существует');
        }
    }

    public function registration(): bool
    {
        $user = User::create($this->getAttributes());
        if ($user) {
            $this->qr = (new Google2FA($user))->getQR();
            return true;
        }
        return false;
    }

    public function getQR(): string
    {
        return '<img src="' . $this->qr . '">';
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
            'name' => 'First Name',
            'surname' => 'Last Name',
            'email' => 'Email address',
            'password' => 'Password',
            'rePassword' => 'Password Repeat',
            'rememberMe' => 'Remember me next time',
        ];
    }
}
