<?php
/**
 * Created by PhpStorm.
 * User: matthewthomas
 * Date: 11/11/2017
 * Time: 23:40
 */

namespace Matt9mg\Encryption;

use Matt9mg\Encryption\DependencyInjection\Compiler\EncryptionCompilerPass;
use Matt9mg\Encryption\DependencyInjection\DoctrineEncryptionExtension;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class DoctrineEncryptionBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new EncryptionCompilerPass(), PassConfig::TYPE_AFTER_REMOVING);
    }

    public function getContainerExtension()
    {
        return new DoctrineEncryptionExtension();
    }
}
