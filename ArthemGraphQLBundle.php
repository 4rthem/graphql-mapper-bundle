<?php

namespace Arthem\Bundle\GraphQLBundle;

use Arthem\Bundle\GraphQLBundle\DependencyInjection\ArthemGraphQLExtension;
use Arthem\Bundle\GraphQLBundle\DependencyInjection\Compiler\MappingGuesserCompilerPass;
use Arthem\Bundle\GraphQLBundle\DependencyInjection\Compiler\ResolverCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ArthemGraphQLBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new ResolverCompilerPass());
        $container->addCompilerPass(new MappingGuesserCompilerPass());
    }

    /**
     * {@inheritdoc}
     */
    public function getContainerExtension()
    {
        return new ArthemGraphQLExtension();
    }

}
