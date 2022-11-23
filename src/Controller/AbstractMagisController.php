<?php

namespace pjpawel\Magis\MagisBundle\Controller;

use pjpawel\Magis\ViewDispatcherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Paweł Podgórski <pawel.jan.podgorski@gmail.com>
 */
class AbstractMagisController extends AbstractController
{

    protected function renderPhpView(string $view, array $parameters = [], Response $response = null): Response
    {
        $content = $this->container->get('magis')->render($view, $parameters);

        if (null === $response) {
            $response = new Response();
        }

        $response->setContent($content);
        return $response;
    }

    public static function getSubscribedServices(): array
    {
        return array_merge(
            parent::getSubscribedServices(),
            [
                'magis' => ViewDispatcherService::class
            ]
        );
    }


}