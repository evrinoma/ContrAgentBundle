<?php

namespace Evrinoma\ContrAgentBundle\DependencyInjection\Compiler;


use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Evrinoma\ContrAgentBundle\DependencyInjection\EvrinomaContrAgentExtension;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class MapEntityPass
 *
 * @package Evrinoma\ContrAgentBundle\DependencyInjection\Compiler
 */
class MapEntityPass implements CompilerPassInterface
{
//region SECTION: Fields
    private $nameSpace;
    private $path;
//endregion Fields
//region SECTION: Constructor
    /**
     * MapEntityPass constructor.
     *
     * @param string $nameSpace
     */
    public function __construct(string $nameSpace, string $path)
    {
        $this->nameSpace = $nameSpace;
        $this->path = $path;
    }
//endregion Constructor

//region SECTION: Public
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {

        $driver = $container->findDefinition('doctrine.orm.default_metadata_driver');
        $referenceAnnotationReader = new Reference('annotations.reader');

        $definitionAnnotationDriver = new Definition(AnnotationDriver::class, [$referenceAnnotationReader, sprintf('%s/Model', $this->path)]);
        $driver->addMethodCall('addDriver', [$definitionAnnotationDriver,sprintf('%s\Model', $this->nameSpace)]);

        if ($container->getParameter('evrinoma.contr_agent.class') === EvrinomaContrAgentExtension::ENTITY_BASE_CONTR_AGENT) {

            $definitionAnnotationDriver = new Definition(AnnotationDriver::class, [$referenceAnnotationReader, sprintf('%s/Entity', $this->path)]);
            $driver->addMethodCall('addDriver', [$definitionAnnotationDriver,sprintf('%s\Entity', $this->nameSpace)]);

            return;
        }
    }
}