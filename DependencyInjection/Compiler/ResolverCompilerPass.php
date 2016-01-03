<?php

namespace Arthem\Bundle\GraphQLBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ResolverCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('arthem_graphql.schema_factory');
        $services   = $container->findTaggedServiceIds('arthem_graphql.resolver_factory');

        foreach ($services as $serviceId => $tag) {
            $definition->addMethodCall('addResolver', [new Reference($serviceId)]);
        }
    }
}
