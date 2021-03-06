<?php


namespace Evrinoma\ContrAgentBundle;


use Evrinoma\ContrAgentBundle\DependencyInjection\Compiler\MapEntityPass;
use Evrinoma\ContrAgentBundle\DependencyInjection\EvrinomaContrAgentExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EvrinomaContrAgentBundle extends Bundle
{
//region SECTION: Getters/Setters
    public const CONTR_AGENT_BUNDLE = 'contr_agent';

    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new MapEntityPass($this->getNamespace(), $this->getPath()));
    }

    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new EvrinomaContrAgentExtension();
        }
        return $this->extension;
    }
//endregion Getters/Setters
}