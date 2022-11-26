<?php

namespace pjpawel\Magis\MagisBundle\Service;

use pjpawel\Magis\Helper\AppContainerInterface;
use pjpawel\Magis\Exception\TemplateException;
use Symfony\Bridge\Twig\AppVariable;

class App implements AppContainerInterface
{

    /**
     * <id>:<function_name>
     *
     * array<string, string>
     */
    private const VARIABLE_LIST = [
        'app.user' => 'getUser',
        'app.request' => 'getRequest',
        'app.session' => 'getSession',
        'app.environment' => 'getEnvironment',
        'app.debug' => 'getDebug',
        'app.flashes' =>'getFlashes'
    ];

    /**
     * @var array<string, mixed>
     */
    private array $variables = [];

    public function __construct(AppVariable $appVariable)
    {
        $this->update($appVariable);
    }

    /**
     * @param string $id Call id without 'app' prefix, e.g. 'app.user' you should call get('user')
     * @return mixed
     * @throws TemplateException
     */
    public function get(string $id): mixed
    {
        if (array_key_exists($id, $this->variables)) {
            return $this->variables[$id];
        } else {
            throw new TemplateException(sprintf('Undefined %s variable from App', $id));
        }
    }

    public function update(AppVariable $appVariable): void
    {
        foreach (self::VARIABLE_LIST as $id => $function) {
            $id = substr($id, 4);
            try {
                $this->variables[$id] = $appVariable->$function();
            } catch (\Exception $e) {
                $this->variables[$id] = null;
            }
        }
    }
}