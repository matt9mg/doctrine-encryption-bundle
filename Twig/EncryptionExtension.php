<?php
/**
 * Created by PhpStorm.
 * User: matthewthomas
 * Date: 13/11/2017
 * Time: 14:27
 */

namespace Matt9mg\Encryption\Twig;

use Matt9mg\Encryption\Bridge\Bridge;

/**
 * Class EncryptionExtension
 * @package Matt9mg\Encryption\Twig
 */
class EncryptionExtension extends \Twig_Extension
{
    /**
     * @var Bridge
     */
    private $bridge;

    /**
     * EncryptionExtension constructor.
     * @param Bridge $bridge
     */
    public function __construct(Bridge $bridge)
    {
        $this->bridge = $bridge;
    }

    /**
     * @return array
     */
    public function getFilters(): array
    {
        return [
            new \Twig_SimpleFilter('decrypt', [$this, 'decrypt'])
        ];
    }

    /**
     * Twig wrapper for the decryption function
     *
     * @param string $data
     * @return string
     */
    public function decrypt(string $data): string
    {
        return $this->bridge->decrypt($data);
    }
}
