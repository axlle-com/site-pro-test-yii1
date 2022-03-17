<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    private $_id;
    private ?string $key;
    private bool $is2fa = true;

    public function setKey(string $key): void
    {
        $this->key = $key;
    }

    public function authenticate(): bool
    {
        $record = User::model()->findByAttributes(['email' => $this->username]);
        if ($record === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else if (!CPasswordHelper::verifyPassword($this->password, $record->password_hash)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else if ($this->is2fa && !(new Google2FA($record, $this->key))->verifyKey()) {
            $this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
        } else {
            $this->_id = $record->id;
            $this->setState('title', $record->name);
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_id;
    }
}