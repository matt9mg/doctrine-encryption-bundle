<?php
/**
 * Created by PhpStorm.
 * User: matthewthomas
 * Date: 12/11/2017
 * Time: 15:52
 */

namespace Matt9mg\Encryption\Tests\Bridge;

use Matt9mg\Encryption\Bridge\Bridge;
use Matt9mg\Encryption\Encryptor\OpenSSL;
use Matt9mg\Encryption\Factory\Factory;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

/**
 * Class BridgeTest
 * @package Matt9mg\Encryption\Tests\Bridge
 */
class BridgeTest extends TestCase
{
    private $bridge;

    public function setUp()
    {
        $encryptor = new OpenSSL('KEY', 'AES-256-CBC', 'IV', '<SUFFIX>');

        $factory = $this->getMockBuilder(Factory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $factory->expects($this->any())
            ->method('get')
            ->willReturn($encryptor);

        $this->bridge = new Bridge($factory);
    }

    /**
     * @dataProvider encryptionProvider
     * @param string $data
     * @param $expected
     */
    public function testEncryption(string $data, string $expected)
    {
        $encrypted = $this->bridge->encrypt($data, OpenSSL::class);

        $this->assertSame($expected, $encrypted);
        $this->assertSame($data, $this->bridge->decrypt($encrypted, OpenSSL::class));
    }

    /**
     * @return array
     */
    public function encryptionProvider(): array
    {
        return [
            ['banana', 'NEwxdFl5aDdSS3JVOUJBbHVMaWw0dz09<SUFFIX>'],
            ['apple', 'Vk5tTUlLTUx1MHl4bWVaMTQ0Uk9Qdz09<SUFFIX>'],
            ['orange', 'WEFlVVFEQ0ZkUWl6OTdSeG1NSldyZz09<SUFFIX>'],
            ['O\'Conner', 'UU42MkVwOW5XdWhRekV4c3VZTzJiUT09<SUFFIX>'],
            ['09876543211', 'VENUQTNTbFQrZ1N6dHRRaDVya1ZhQT09<SUFFIX>'],
            ['email@address.com', 'S1NOalg4cnlVUy9Ec1R2TW1rZVd3c3IvemtISTJQckJndG8wMnFscFEwOD0=<SUFFIX>']
        ];
    }
}