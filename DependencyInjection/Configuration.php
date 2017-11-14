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
class Configuration implements ConfigurationInterface
{
    const KEY = 'key';
    const ENCRYPTOR_METHOD = 'method';
    const ENCRYPTOR_CLASS = 'class';
    const ENCRYPTOR_IV = 'iv';
    const ENCRYPTOR_SUFFIX = 'suffix';
    const ROOT = 'matt9mg_doctrine_encryption';

        /**
         * @return TreeBuilder
         */
        public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root(self::ROOT);

        $rootNode
            ->children()
            ->scalarNode(self::KEY)
            ->end()
            ->scalarNode(self::ENCRYPTOR_METHOD)
            ->end()
            ->scalarNode(self::ENCRYPTOR_CLASS)
            ->end()
            ->scalarNode(self::ENCRYPTOR_IV)
            ->end()
            ->scalarNode(self::ENCRYPTOR_SUFFIX)
            ->end()
            ->end();

        return $treeBuilder;
    }

}
