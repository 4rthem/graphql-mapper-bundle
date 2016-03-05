<?php

namespace Arthem\Bundle\GraphQLBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ArthemGraphQLExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config        = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');
        $loader->load('cache.yml');
        $loader->load('guess.yml');
        $loader->load('resolver.yml');

        $definition = $container->getDefinition('arthem_graphql.mapping.driver.yaml');
        $definition->addArgument($config['mapping']['files']);
        $definition->setAbstract(false);

        if ($config['mapping']['cache']['enabled']) {
            $this->loadCache($container, $config['mapping']['cache']);
        }
    }

    /**
     * @param ContainerBuilder $container
     * @param array            $config
     */
    private function loadCache(ContainerBuilder $container, array $config)
    {
        $definition = $container->getDefinition('arthem_graphql.mapping.cache.file');
        $definition->addArgument($config['file']);
        $definition->addArgument(!$container->getParameter('kernel.debug'));
        $definition->setAbstract(false);
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return 'arthem_graphql';
    }
}
