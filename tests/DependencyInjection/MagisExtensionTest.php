<?php

namespace pjpawel\Magis\MagisBundle\Test\DependencyInjection;

use PHPUnit\Framework\TestCase;
use pjpawel\Magis\MagisBundle\DependencyInjection\MagisExtension;
use pjpawel\Magis\ViewDispatcherService;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class MagisExtensionTest extends TestCase
{

    public function testDependencyInjection(): void
    {
        $config = [
            'magis' => [
                'template_path' => __DIR__ . '/../../templates',
                'default_view_mode' => 'direct',
                //'services' => []
            ]
        ];

        $container = new ContainerBuilder();
        $extension = new MagisExtension();
        $extension->load($config, $container);
        $container->compile();

        $viewDispatcherClass = $container->get('magis.view');
        $this->assertInstanceOf(ViewDispatcherService::class, $viewDispatcherClass);
        $this->assertEquals(
            ViewDispatcherService::VIEW_MODE[$config['magis']['default_view_mode']],
            $viewDispatcherClass->getDefaultViewClass());

    }

}