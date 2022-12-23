<?php

namespace pjpawel\Magis\MagisBundle\Controller;

use pjpawel\Magis\ViewDispatcherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * @codeCoverageIgnore
 *
 * @author Paweł Podgórski <pawel.jan.podgorski@gmail.com>
 */
class AbstractMagisController extends AbstractController
{

    /**
     * @param string $view
     * @param array<string,mixed> $parameters
     * @param Response|null $response
     * @return Response
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    protected function renderPhpView(string $view, array $parameters = [], Response $response = null): Response
    {
        /** @var ViewDispatcherService $magis */
        $magis = $this->container->get('magis');
        $content = $magis->render($view, $parameters);

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