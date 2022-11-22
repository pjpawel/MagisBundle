<?php

namespace pjpawel\Magis\MagisBundle\Test;

use PHPUnit\Framework\TestCase;
use pjpawel\Magis\MagisBundle\MagisBundle;
use pjpawel\Magis\ViewDispatcherService;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class ServiceWiringTest extends TestCase
{

    public function testServiceWiring()
    {
        $kernel = new MagisKernel('test', true);
        $kernel->boot();
        $container = $kernel->getContainer();

        $magis = $container->get('magis.view');
        $this->assertInstanceOf(ViewDispatcherService::class, $magis);
        $this->assertIsString($magis->getDefaultViewMode());
    }

}

class MagisKernel extends Kernel
{

    public function registerBundles(): iterable
    {
        return [
            new MagisBundle()
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        // TODO: Implement registerContainerConfiguration() method.
    }
}