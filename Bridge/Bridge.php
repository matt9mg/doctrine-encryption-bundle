<?php
/**
 * Created by PhpStorm.
 * User: matthewthomas
 * Date: 13/11/2017
 * Time: 07:56
 */

namespace Matt9mg\Encryption\Bridge;


use Matt9mg\Encryption\Encryptor\EncryptorInterface;

/**
 * Class Bridge
 * @package Matt9mg\Encryption\Bridge
 */
class Bridge
{
    /**
     * @var EncryptorInterface
     */
    private $encryptor;

    /**
     * Bridge constructor.
     * @param EncryptorInterface $encryptor
     */
    public function __construct(EncryptorInterface $encryptor)
    {
        $this->encryptor = $encryptor;
    }

    /**
     * Encrypt the data and adds the suffix
     *
     * @param string $data
     * @return string
     */
    public function encrypt(string $data): string
    {
        return $this->encryptor->encrypt($data) . $this->encryptor->getSuffix();
    }

    /**
     * Decrypt the data and adds the suffix
     *
     * @param string $data
     * @return string
     */
    public function decrypt(string $data): string
    {
        return $this->encryptor->decrypt($data);
    }

    /**
     * Returns the encryptor service from the factory
     *
     * @return EncryptorInterface
     */
    public function getEncryptor(): EncryptorInterface
    {
        return $this->encryptor;
    }
}
