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
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $encryptMethod;

    /**
     * @var string
     */
    private $iv;

    /**
     * @var string
     */
    private $suffix;

    /**
     * OpenSSL constructor.
     * @param string $key
     * @param string $encryptMethod
     * @param string $iv
     * @param string $suffix
     */
    public function __construct(string $key, string $encryptMethod, string $iv, string $suffix)
    {
        $this->key = $key;
        $this->encryptMethod = $encryptMethod;
        $this->iv = $iv;
        $this->suffix = $suffix;
    }

    /**
     * @inheritdoc
     */
    public function encrypt(string $data): string
    {
        return base64_encode(
            openssl_encrypt(
                $data,
                $this->encryptMethod,
                $this->generateKeyHash(),
                0,
                $this->generateIVHash()
            )
        );
    }

    /**
     * @inheritdoc
     */
    public function decrypt(string $data): string
    {
        $data = str_replace($this->getSuffix(), '', $data);

        return openssl_decrypt(
            base64_decode($data),
            $this->encryptMethod,
            $this->generateKeyHash(),
            0,
            $this->generateIVHash()
        );
    }

    /**
     * @return string
     */
    public function getSuffix(): string
    {
        return $this->suffix;
    }

    /**
     * Returns a hash from the specified key
     *
     * @return string
     */
    private function generateKeyHash(): string
    {
        return hash('sha256', $this->key);
    }

    /**
     * iv - AES expects 16 bytes - else you will get a warning
     *
     * @return string
     */
    private function generateIVHash(): string
    {
        return substr(hash('sha256', $this->iv), 0, 16);
    }
}