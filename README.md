# MagisBundle

### *Symfony bundle for php templates rendering*

[![Latest Version on Packagist](https://img.shields.io/packagist/v/pjpawel/magis-bundle.svg?style=flat-square)](https://packagist.org/packages/pjpawel/magis-bundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/pjpawel/MagisBundle/badges/quality-score.png?b=dev)](https://scrutinizer-ci.com/g/pjpawel/MagisBundle/?branch=dev)
![PHPStanLevel](https://img.shields.io/badge/PHPStan-highest%20level-brightgreen.svg?style=flat)

## Why Magis?
### - It's incredible fast!
### - It's easy to understand!
### - It can implement all services you need!


## Install

If you want to install Magis symfony bundle
```
composer require pjpawel/magis-bundle
```
If you want raw view service and view classes use [Magis](https://github.com/pjpawel/Magis)
```
composer require pjpawel/magis
```

## Usage

In container, you will find `magis` alias for `ViewDispatcherService`;
You should use 'AbstractMagisController':
```php
use pjpawel\Magis\MagisBundle\Controller\AbstractMagisController;
use Symfony\Component\HttpFoundation\Response;

class FooController extends AbstractMagisController
{

    public function test(): Response
    {
        return $this->renderPhpView($templateName, $params);
    }

}
```
