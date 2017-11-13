<?php
/**
 * Created by PhpStorm.
 * User: matthewthomas
 * Date: 12/11/2017
 * Time: 15:52
 */

namespace Matt9mg\Encryption\Twig;

use Matt9mg\Encryption\Bridge\Bridge;
use Matt9mg\Encryption\Encryptor\OpenSSL;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class TwigTest
 * @package Matt9mg\Encryption\Twig
 */
class TwigTest extends TestCase
{
    /**
     * @var EncryptionExtension
     */
    private $twigExtension;

    public function setUp()
    {
        $factor = $this->getMockBuilder(ContainerInterface::class)->disableOriginalConstructor()->getMock();
        $factor->expects($this->any())
            ->method('get')
            ->willReturn(new OpenSSL('key', 'AES-256-CBC', 'IV', 'SUFFIX'));

        $bridge = new Bridge($factor, OpenSSL::class);

        $this->twigExtension = new EncryptionExtension($bridge);
    }

    /**
     * @dataProvider decryptProvider
     * @param string $expected
     * @param string $data
     */
    public function testDecrypt(string $expected, string $data)
    {
        $this->assertSame($expected, $this->twigExtension->decrypt($data));
    }


    /**
     * @return array
     */
    public function decryptProvider(): array
    {
        return [
            ['bob', 'TUcyS1dHQ2tFNlVtT2ZNVWw1ZzdVQT09SUFFIX'],
            ['O\'Conner', 'U3VUNHprQkZwUWF2Wno5YnJ5ZjE5Zz09SUFFIX'],
            ['R-ily', 'cmwrZFBqM2lnd25vczI3QUcxUGE5UT09SUFFIX']
        ];
    }
}