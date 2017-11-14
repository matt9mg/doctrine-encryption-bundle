<?php
/**
 * Created by PhpStorm.
 * User: matthewthomas
 * Date: 12/11/2017
 * Time: 15:52
 */

namespace Matt9mg\Encryption\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * @package Matt9mg\Encryption\DependencyInjection
 */
class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return TreeBuilder
     */
    public function testTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('matt9mg_doctrine_encryption');

        $rootNode
            ->children()
            ->scalarNode('secret_key')
            ->end()
            ->scalarNode('encryptor')
            ->end()
            ->scalarNode('encryptor_class')
            ->end()
            ->end();
    }

}
