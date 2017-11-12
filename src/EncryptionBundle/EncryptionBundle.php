<?php
/**
 * Created by PhpStorm.
 * User: matthewthomas
 * Date: 11/11/2017
 * Time: 23:40
 */

namespace EncryptionBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class EncryptionBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
    }
}