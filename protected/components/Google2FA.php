<?php

use chillerlan\QRCode\QRCode;
use PragmaRX\Google2FA\Google2FA as G2FA;

class Google2FA
{
    private User $user;
    private G2FA $google;
    private ?string $key;

    public function __construct(User $user, $key = null)
    {
        $this->user = $user;
        $this->google = new G2FA();
        $this->key = $key;
    }

    public function getQR()
    {
        $google2fa_secret = $this->google->generateSecretKey();
        $codeURL = $this->google->getQRCodeUrl(
            Yii::app()->name,
            $this->user->email,
            $google2fa_secret
        );
        $this->user->auth_key_google_2fa = $google2fa_secret;
        return $this->user->save() ? (new QRCode)->render($codeURL) : null;
    }

    public function verifyKey()
    {
        return $this->google->verifyKey($this->user->auth_key_google_2fa, $this->key);
    }

}