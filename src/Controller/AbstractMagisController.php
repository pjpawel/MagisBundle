<?php

namespace pjpawel\Magis\MagisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AbstractMagisController extends AbstractController
{

    protected function renderPhpView(string $view, array $parameters = [], Response $response = null): Response
    {
        $content = $this->renderMagisView($view, $parameters);

        if (null === $response) {
            $response = new Response();
        }

        $response->setContent($content);
        return $response;
    }

    protected function renderMagisView(string $view, array $parameters = [])
    {
        if (!$this->container->has('magis')) {
            throw new \LogicException('You cannot use the "renderMagisView" method if the Magis Bundle is not available. Try running "composer require pjpawel/magis-bundle".');
        }

        return $this->container->get('magis')->render($view, $parameters);
    }

    public static function getSubscribedServices(): array
    {
        return array_merge(
            parent::getSubscribedServices(),
            [
                'magis' => '?' . 'Magis::class'
            ]
        );
    }


}