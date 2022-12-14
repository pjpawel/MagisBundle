<?php

namespace pjpawel\Magis\MagisBundle\Test;

use PHPUnit\Framework\TestCase;
use pjpawel\Magis\MagisBundle\MagisBundle;
use pjpawel\Magis\ViewDispatcherService;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

/**
 * @covers \pjpawel\Magis\MagisBundle\MagisBundle
 */
class MagisBundleTest extends TestCase
{

    public function testServiceWiring(): void
    {

        $kernel = new MagisKernel('test', true);
        $kernel->boot();
        $container = $kernel->getContainer();

        $magis = $container->get('magis.view');
        $this->assertInstanceOf(ViewDispatcherService::class, $magis);
        $this->assertIsString($magis->getDefaultViewClass());
    }
}

/**
 * @codeCoverageIgnore
 */
class MagisKernel extends Kernel
{

    public function registerBundles(): iterable
    {
        return [
            new MagisBundle()
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        $loader->load(realpath(__DIR__ . '/../recipes/config/packages/magis.yaml'));
    }
}