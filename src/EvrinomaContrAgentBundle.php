<?php


namespace Evrinoma\ContrAgentBundle;


use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Evrinoma\ContrAgentBundle\DependencyInjection\EvrinomaContrAgentExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EvrinomaContrAgentBundle extends Bundle
{
//region SECTION: Getters/Setters
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $ormCompilerClass = 'Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass';
        if (class_exists($ormCompilerClass)) {
            $container->addCompilerPass(
                DoctrineOrmMappingsPass::createAnnotationMappingDriver(
                    ['Evrinoma\ContrAgentBundle\Entity'],
                    [sprintf('%s/Entity', $this->getPath())]
                )
            );
        }
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