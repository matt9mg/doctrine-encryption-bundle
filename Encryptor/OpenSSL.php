<?php
/**
 * Created by PhpStorm.
 * User: matthewthomas
 * Date: 12/11/2017
 * Time: 16:35
 */

namespace Matt9mg\Encryption\Encryptor;

/**
 * Class OpenSSL
 * @package Matt9mg\Encryption\Encryptor
 */
class OpenSSL implements EncryptorInterface
{
    /**
     * @inheritdoc
     */
    public function encrypt(string $data): string
    {
        // TODO: Implement encrypt() method.
    }

    /**
     * @inheritdoc
     */
    public function decrypt(string $data): string
    {
        // TODO: Implement decrypt() method.
    }

}