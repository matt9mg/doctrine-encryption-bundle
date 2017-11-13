<?php
/**
 * Created by PhpStorm.
 * User: matthewthomas
 * Date: 12/11/2017
 * Time: 15:52
 */

namespace Matt9mg\Encryption\Tests\Encryptor;

use Matt9mg\Encryption\Encryptor\OpenSSL;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

/**
 * Class OpenSSLTest
 * @package Matt9mg\Encryption\Tests\Encryptor
 */
class OpenSSLTest extends TestCase
{
    /**
     * @var OpenSSL
     */
    private $encryptor;

    public function setUp()
    {
        $this->encryptor = new OpenSSL('KEY', 'AES-256-CBC', 'IV', 'SUFFIX');
    }

    /**
     * @dataProvider encryptionProvider
     * @param string $data
     * @param $expected
     */
    public function testEncryption(string $data, string $expected)
    {
        $encrypted = $this->encryptor->encrypt($data);

        $this->assertSame($expected, $encrypted);
        $this->assertSame($data, $this->encryptor->decrypt($encrypted));
    }

    /**
     * @return array
     */
    public function encryptionProvider(): array
    {
        return [
            ['banana', 'NEwxdFl5aDdSS3JVOUJBbHVMaWw0dz09'],
            ['apple', 'Vk5tTUlLTUx1MHl4bWVaMTQ0Uk9Qdz09'],
            ['orange', 'WEFlVVFEQ0ZkUWl6OTdSeG1NSldyZz09'],
            ['O\'Conner', 'UU42MkVwOW5XdWhRekV4c3VZTzJiUT09'],
            ['09876543211', 'VENUQTNTbFQrZ1N6dHRRaDVya1ZhQT09'],
            ['email@address.com', 'S1NOalg4cnlVUy9Ec1R2TW1rZVd3c3IvemtISTJQckJndG8wMnFscFEwOD0=']
        ];
    }
}