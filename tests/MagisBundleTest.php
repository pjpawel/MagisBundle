<?php

namespace pjpawel\Magis\MagisBundle\Test;

use PHPUnit\Framework\TestCase;
use pjpawel\Magis\MagisBundle\DependencyInjection\MagisBundleExtension;
use pjpawel\Magis\ViewDispatcherService;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class MagisBundleTest extends TestCase
{

    public function testDependencyInjection(): void
    {
        $config = [
            'magis' => [
                'template_path' => __DIR__ . '/../templates',
                'default_view_mode' => 'direct',
                //'services' => []
            ]
        ];

        $container = new ContainerBuilder();
        $extension = new MagisBundleExtension();
        $extension->load($config, $container);
        $container->compile();

        $viewDispatcherClass = $container->get('magis');
        $this->assertInstanceOf(ViewDispatcherService::class, $viewDispatcherClass);
        $this->assertEquals(
            ViewDispatcherService::VIEW_MODE[$config['magis']['default_view_mode']],
            $viewDispatcherClass->getDefaultViewMode());

    }

}