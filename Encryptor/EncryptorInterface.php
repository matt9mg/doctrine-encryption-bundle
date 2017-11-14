<?php
/**
 * Created by PhpStorm.
 * User: matthewthomas
 * Date: 12/11/2017
 * Time: 16:29
 */

namespace Matt9mg\Encryption\Encryptor;

/**
 * Interface EncryptorInterface
 * @package Matt9mg\Encryption\Encryptor
 */
interface EncryptorInterface
{
    /**
     * Encrypts the given data and returns an encrypted version of it
     * @param string $data
     * @return string
     */
    public function encrypt(string $data): string;

    /**
     * Takes the encrypted data and returns the data decrypted
     *
     * @param string $data
     * @return string
     */
    public function decrypt(string $data): string;

    /**
     * Adds a suffix to the encryptor
     *
     * @return string
     */
    public function getSuffix(): string;
}
