<?php
/**
 * Created by PhpStorm.
 * User: matthewthomas
 * Date: 13/11/2017
 * Time: 07:52
 */

namespace Matt9mg\Encryption\Factory;

use Matt9mg\Encryption\Encryptor\EncryptorInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class Factory
 * @package Matt9mg\Encryption\Factory
 */
class Factory
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Factory constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Gets the encryption class
     *
     * @param string $serviceClass
     * @return EncryptorInterface
     */
    public function get(string $serviceClass): EncryptorInterface
    {
        return $this->container->get($serviceClass);
    }
}