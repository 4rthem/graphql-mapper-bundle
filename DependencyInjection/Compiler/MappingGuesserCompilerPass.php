<?php

namespace Arthem\Bundle\GraphQLBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class MappingGuesserCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('arthem_graphql.mapping.guesser');
        $services   = $container->findTaggedServiceIds('arthem_graphql.mapping_guesser');

        foreach ($services as $serviceId => $tag) {
            $definition->addMethodCall('addGuesser', [new Reference($serviceId)]);
        }
    }
}
