<?php
/**
 * Created by PhpStorm.
 * User: matthewthomas
 * Date: 12/11/2017
 * Time: 16:04
 */

namespace Matt9mg\Encryption\DependencyInjection;


use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class DoctrineEncryptionExtension
 * @package Matt9mg\Encryption\DependencyInjection
 */
class DoctrineEncryptionExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        if(!isset($config[Configuration::KEY])) {
            throw new \RunTimeException('A key must be specified for DoctrineEncryptionBundle.');
        }

        if(!isset($config[Configuration::ENCRYPTOR_METHOD])) {
            $config[Configuration::ENCRYPTOR_METHOD] = 'AES-256-CBC';
        }

        if(!isset($config[Configuration::ENCRYPTOR_CLASS])) {
            $config[Configuration::ENCRYPTOR_CLASS] =
        }
    }

}