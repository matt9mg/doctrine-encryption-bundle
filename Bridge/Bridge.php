<?php
/**
 * Created by PhpStorm.
 * User: matthewthomas
 * Date: 13/11/2017
 * Time: 07:56
 */

namespace Matt9mg\Encryption\Bridge;


use Matt9mg\Encryption\Encryptor\EncryptorInterface;
use Matt9mg\Encryption\Factory\Factory;

/**
 * Class Bridge
 * @package Matt9mg\Encryption\Bridge
 */
class Bridge
{
    /**
     * @var Factory
     */
    private $factory;

    /**
     * Bridge constructor.
     * @param Factory $factory
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Encrypt the data and adds the suffix
     *
     * @param string $data
     * @param string $service
     * @return string
     */
    public function encrypt(string $data, string $service): string
    {
        $service = $this->factory->get($service);

        return $service->encrypt($data) . $service->getSuffix();
    }

    /**
     * Decrypt the data and adds the suffix
     *
     * @param string $data
     * @param string $service
     * @return string
     */
    public function decrypt(string $data, string $service): string
    {
        return $this->factory->get($service)->decrypt($data);
    }

    /**
     * Returns the encryptor service from the factory
     *
     * @param string $service
     * @return EncryptorInterface
     */
    public function getEncryptor(string $service): EncryptorInterface
    {
        return $this->factory->get($service);
    }
}