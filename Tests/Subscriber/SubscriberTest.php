<?php
/**
 * Created by PhpStorm.
 * User: matthewthomas
 * Date: 12/11/2017
 * Time: 15:52
 */

namespace Matt9mg\Encryption\Subscriber;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Matt9mg\Encryption\Annotation\Encrypted;
use Matt9mg\Encryption\Bridge\Bridge;
use Matt9mg\Encryption\Encryptor\OpenSSL;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
/**
 * Class SubscriberTest
 * @package Matt9mg\Encryption\Subscriber
 */
class SubscriberTest extends TestCase
{
    /**
     * @var DoctrineEncryptionSubscriber
     */
    private $subscriber;

    private $class;

    public function setUp()
    {
        $bridge = new Bridge(new OpenSSL('key', 'AES-256-CBC', 'IV', 'SUFFIX'));

        $this->class = new class
        {
            /**
             * @var string
             * @Encrypted()
             */
            private $firstname;

            /**
             * @return string
             */
            public function getFirstname(): string
            {
                return $this->firstname;
            }

            /**
             * @param string $firstname
             */
            public function setFirstname(string $firstname)
            {
                $this->firstname = $firstname;
            }
        };

        $this->subscriber = new DoctrineEncryptionSubscriber(new AnnotationReader(), $bridge);
    }


    /**
     * @dataProvider prePersistDataProvider
     * @param string $firstname
     * @param string $expected
     */
    public function testPrePersist(string $firstname, string $expected)
    {
        $lifeCycleArgs = $this->getMockBuilder(LifecycleEventArgs::class)->disableOriginalConstructor()->getMock();
        $lifeCycleArgs->expects($this->any())
            ->method('getEntity')
            ->willReturn($this->class);

        $this->class->setFirstname($firstname);
        $this->subscriber->prePersist($lifeCycleArgs);

        $this->assertSame($this->class->getFirstname(), $expected);
    }

    /**
     * @dataProvider preUpdateDataProvider
     * @param string $firstname
     * @param string $expected
     */
    public function testPreUpdate(string $firstname, string $expected)
    {
        $lifeCycleArgs = $this->getMockBuilder(PreUpdateEventArgs::class)->disableOriginalConstructor()->getMock();
        $lifeCycleArgs->expects($this->any())
            ->method('getEntity')
            ->willReturn($this->class);

        $this->class->setFirstname($firstname);

        $this->subscriber->preUpdate($lifeCycleArgs);

        $this->assertSame($this->class->getFirstname(), $expected);
    }

    /**
     * @return array
     */
    public function prePersistDataProvider(): array
    {
        return [
            ['bob', 'TUcyS1dHQ2tFNlVtT2ZNVWw1ZzdVQT09SUFFIX'],
            ['O\'Conner', 'U3VUNHprQkZwUWF2Wno5YnJ5ZjE5Zz09SUFFIX'],
            ['R-ily', 'cmwrZFBqM2lnd25vczI3QUcxUGE5UT09SUFFIX']
        ];
    }

    /**
     * @return array
     */
    public function preUpdateDataProvider(): array
    {
        return [
            ['TUcyS1dHQ2tFNlVtT2ZNVWw1ZzdVQT09SUFFIX', 'TUcyS1dHQ2tFNlVtT2ZNVWw1ZzdVQT09SUFFIX'],
            ['bob', 'TUcyS1dHQ2tFNlVtT2ZNVWw1ZzdVQT09SUFFIX'],
            ['O\'Conner', 'U3VUNHprQkZwUWF2Wno5YnJ5ZjE5Zz09SUFFIX'],
            ['U3VUNHprQkZwUWF2Wno5YnJ5ZjE5Zz09SUFFIX', 'U3VUNHprQkZwUWF2Wno5YnJ5ZjE5Zz09SUFFIX'],
            ['R-ily', 'cmwrZFBqM2lnd25vczI3QUcxUGE5UT09SUFFIX'],
            ['cmwrZFBqM2lnd25vczI3QUcxUGE5UT09SUFFIX', 'cmwrZFBqM2lnd25vczI3QUcxUGE5UT09SUFFIX']
        ];
    }
}
