<?php
/**
 * Created by PhpStorm.
 * User: matthewthomas
 * Date: 13/11/2017
 * Time: 07:56
 */

namespace Matt9mg\Encryption\Bridge;


use Matt9mg\Encryption\Encryptor\EncryptorInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

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
     * @param ContainerInterface $container
     * @param string $service
     */
    public function __construct(ContainerInterface $container, string $service)
    {
        $this->encryptor = $container->get($service);
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
