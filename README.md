# Doctrine Encryption Bundle

With GDPR becoming business critical here's a bundle that handles the data encryption layer.

## Installation
```composer require matt9mg/doctrine-encryption-bundle dev-master```

```php
   app/AppKernel.php
   
   
    public function registerBundles()
    {
        $bundles = [
            ...
            new Matt9mg\Encryption\DoctrineEncryptionBundle(),
            ...
        ];
    }
```

## Configuration

***Basic***

Basic configuration will take advantage of the encryption library provided
```yaml
matt9mg_doctrine_encryption:
  key: 'an encryption key'
  iv: 'an encryption iv'
  suffix: 'an encryption suffix'
```

***Full***
```yaml
matt9mg_doctrine_encryption:
  key: 'an encryption key'
  iv: 'an encryption iv'
  suffix: 'an encryption suffix'
  method: 'AES-256-CBC' // This is the default setting
  class: 'Full\Namespace\To\Your\Encryptor' // If not supplied will use the default
```

## Usage

### Using the encryption service in controller
```php
use Matt9mg\Encryption\Bridge\Bridge;

$this->get(Bridge::class)->encrypt($string)
$this->get(Bridge::class)->decrypt($string);
```

### Entity Annotation
```php
    use Matt9mg\Encryption\Annotation\Encrypted;

    class User {
       /**
       * @Encrypted()
       */
       private $firstname;
    
    }
```

The above will auto encrypt on `prePersist` and `preUpdate` 

### Twig
```twig
{{ user.firstname | decrypt }}
```

## Design decision
You'll notice there is no postLoad event to convert back to decrypted. Experience with doctrine is that as the entity is changed it adds it to the queue to be flushed. Say if you have an account with 1000 users each user would be decrypted meaning re saved. 

## How to add a custom Encryptor
Create a class that extends ```Matt9mg\Encryption\Encryptor\EncryptorInterface```. Then register as mentioned in the above config.

## Tests
Yes there a loads of lovely unit tests :)

## Roadmap
- [ ] Form inputs
- [ ] Command line util
- [ ] Travis integration