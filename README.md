# MagisBundle

*Symfony bundle for php templates rendering*

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